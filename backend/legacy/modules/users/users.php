<?php
namespace users;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../Database.php';
use matmanager\Database;

class users
{
    public function processRegistration()
    {
        if (isset($_POST['register'])) {
            $idEmployee = trim($_POST['idEmployee']);
            $firstName = trim($_POST['firstName']);
            $lastName = trim($_POST['lastName']);
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            $password_confirmation = $_POST['password_confirmation'];
            $email = trim($_POST['email']);
            $phone = trim($_POST['phone']);
            $role = $_POST['role'];
            $datereg = date("y/m/d");

            // Validar que las contraseñas coincidan
            if ($password !== $password_confirmation) {
                echo "<script>Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Las contraseñas no coinciden',
                })</script>";
                return;
            }

            // Validar que todos los campos obligatorios estén completos
            if (
                strlen($idEmployee) < 1 ||
                strlen($firstName) < 1 ||
                strlen($lastName) < 1 ||
                strlen($username) < 1 ||
                strlen($password) < 1 ||
                strlen($email) < 1 ||
                strlen($phone) < 1 ||
                strlen($role) < 1
            ) {
                return "<script>Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Por favor, complete todos los campos',
                })</script>";
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<script>Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Formato de correo electrónico no válido',
                })</script>";
                return;
            }

            // Hashear la contraseña
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Crear conexión a la base de datos
            $conex = new Database;
            $conn = $conex->getConnection();

            // Verificar si el nombre de usuario ya existe
            $stmt_check = $conn->prepare("SELECT * FROM users WHERE username = ?");
            $stmt_check->bind_param("s", $username);
            $stmt_check->execute();
            $result_check = $stmt_check->get_result();

            if ($result_check->num_rows > 0) {
                return "<script>Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El nombre de usuario ya está en uso',
                })</script>";
            }

            // Insertar el nuevo usuario en la base de datos
            $stmt = $conn->prepare("INSERT INTO users(idEmployee, firstName, lastName, username, password, email, phone, role, date_reg) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssss", $idEmployee, $firstName, $lastName, $username, $hashed_password, $email, $phone, $role, $datereg);
            $resultado = $stmt->execute();

            if ($resultado) {
                echo "<script>Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Usuario registrado con éxito',
                })</script>";
            } else {
                echo "<script>Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al registrar el usuario',
                })</script>";
            }

            // Cerrar la conexión a la base de datos
            $stmt->close();
            $conn->close();
            return;
        }
    }
}
