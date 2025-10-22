<?php
namespace proveedores;

require_once __DIR__ . '/../Database.php';
use matmanager\Database;

class Proveedores
{
    public function RegisterProvider()
    {
        $db = new Database();
        $conex = $db->getConnection();
        if (isset($_POST['register'])) {
            $idProveedor = trim($_POST['idProveedor']);
            $nombre = trim($_POST['nameProveedor']);
            $materiales = trim($_POST['materiales']);
            $telefono = trim($_POST['telefono']);
            $correo = trim($_POST['correo']);
            $direccion = trim($_POST['direccion']);
            $datereg = date("y/m/d");

            // Validación de campos obligatorios
            if (
                strlen($idProveedor) < 1 ||
                strlen($nombre) < 1 ||
                strlen($materiales) < 1 ||
                strlen($telefono) < 1 ||
                strlen($correo) < 1 ||
                strlen($direccion) < 1
            ) {
                return "<script>Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Por favor, complete todos los campos',
                            })</script>";
            }

            // Validación de formato de correo electrónico
            if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                echo "<script>Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Formato de correo electrónico no válido',
                            })</script>";
                return;
            }

            // Validación de longitud de teléfono
            if (strlen($telefono) < 10) {
                echo "<script>Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'El teléfono debe tener 10 caracteres.',
                            })</script>";
                return;
            }

            // Validación de existencia de proveedor
            $consultaProveedor = $conex->prepare("SELECT * FROM proovedores WHERE idProveedor = ? OR correo = ? OR telefono = ?");
            $consultaProveedor->bind_param("sss", $idProveedor, $correo, $telefono);
            $consultaProveedor->execute();
            $resultadoProveedor = $consultaProveedor->get_result();
            if ($resultadoProveedor->num_rows > 0) {
                $row = $resultadoProveedor->fetch_assoc();
                if ($row['idProveedor'] == $idProveedor) {
                    return "<script>Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'La ID ya está registrada. Por favor, introduzca otra ID.',
                                })</script>";
                }
                if ($row['correo'] == $correo) {
                    echo "<script>Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'El correo electrónico ya está registrado. Por favor, introduzca otro correo electrónico.',
                                })</script>";
                    return;
                }
                if ($row['telefono'] == $telefono) {
                    echo "<script>Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'El teléfono ya está registrado. Por favor, introduzca otro número de teléfono.',
                                })</script>";
                    return;
                }
            }

            // Si no hay errores, procede con el registro
            $consulta = $conex->prepare("INSERT INTO proovedores (idProveedor, nameProveedor, materiales, telefono, correo, direccion, date_reg) 
                                         VALUES (?, ?, ?, ?, ?, ?, ?)");
            $consulta->bind_param("sssssss", $idProveedor, $nombre, $materiales, $telefono, $correo, $direccion, $datereg);
            $resultado = $consulta->execute();
            if ($resultado) {
                // Registro exitoso, muestra una alerta con SweetAlert2          
                return "<script>Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Proveedor registrado exitosamente.'
                })</script>";
            } else {
                // Error en el registro, muestra una alerta con SweetAlert2
                return "<script>Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Algo ha salido mal.'
                })</script>";
            }
        }
    }
}
