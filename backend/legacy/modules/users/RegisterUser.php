<?php

namespace users;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../Database.php';

use matmanager\Database;
use templates\Footer;
use templates\Header;

class Users
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

            // Validate password and confirmation match
            if ($password !== $password_confirmation) {
                echo "<script>Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Las contraseñas no coinciden',
                })</script>";
                return;
            }

            // Ensure all required fields are filled
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

            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Create database connection
            $conex = new Database;
            $conn = $conex->getConnection();

            // Check if username already exists
            $sql_check = "SELECT * FROM users WHERE username = '$username'";
            $result_check = mysqli_query($conn, $sql_check);

            if (mysqli_num_rows($result_check) > 0) {
                return "<script>Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El nombre de usuario ya está en uso',
                })</script>";
            }

            // Insert new user into database
            $consulta = "INSERT INTO users(idEmployee, firstName, lastName, username, password, email, phone, role, date_reg) 
            VALUES ('$idEmployee', '$firstName', '$lastName', '$username', '$password', '$email', '$phone', '$role', '$datereg')";
            $resultado = mysqli_query($conn, $consulta);

            if ($resultado) {
                echo"<script>Swal.fire({
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

            // Close the database connection
            //mysqli_close($conn);
            return;
        }
    }
}

class UsersForm
{
    public function renderRegisterForm()
    {
?>

        </html><!-- component -->
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <title>Registro de usuarios</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <script src="../tailwind.js" integrity="sha384-pXbtEM0s3abRFqEyAChS+PGW3VqbeR/BWCGz6yIMx1rq9ZyeEtJhfCHyPSUpD3XF" crossorigin="anonymous"></script>
            <script src="../cdn.min.js" integrity="sha384-O8NPfezTLQ/sgLfQYBJEnezJLlum9L6KOqHsfIWauzaFfD1TQSuvA4iUpgWGHeuZ" crossorigin="anonymous"></script>
            <!-- SweetAlert2 CSS -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
            <!-- SweetAlert2 JS -->
            <script src="../sweetalert2@11.js" integrity="sha384-k99F4PUp+haevnbJXHhC4n7aCUlweLxDoP/ZuKIYi/2Ej2We/6U704HIr84dPhE1" crossorigin="anonymous"></script>
        </head>

        <body>
            <header>
                <?php
                $pageTitle = "Header";
                $header = new Header;
                $header->head($pageTitle);
                ?>
            </header>
            <div class="bg-gray-200 w-screen min-h-screen flex items-center justify-center">
                <div class="w-full py-8">
                    <div class="flex items-center justify-center space-x-2">
                        <img src="../images/logo.png" alt="" class="object-cover w-20 h-20 flex-shrink-0 ml-5">
                        <h1 class="text-3xl font-bold text-gray-600 tracking-wider">Mat-Manager</h1>
                    </div>
                    <div class="bg-white w-5/6 md:w-3/4 lg:w-2/3 xl:w-[500px] 2xl:w-[550px] mt-8 mx-auto px-16 py-8 rounded-lg shadow-2xl">
                        <h2 class="text-center text-2xl font-bold tracking-wide text-gray-800">Registro de Usuario</h2>
                        <p class="text-center text-sm text-gray-600 mt-2 font-semibold">Formulario de Registro de Usuario<br><a href="../tables/recuperarUsuarios.php" class="text-amber-400 hover:text-yellow-600 duration-700 hover:underline" title="Tabla Usuario">Ir a la Tabla</a></p>
                        <form class="my-8 text-sm" method='post'>
                            <div class="flex flex-col my-4">
                                <label for="idEmployee" class="text-gray-700 font-semibold">Cédula</label>
                                <input class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" type="text" name="idEmployee" placeholder="Cedula">
                            </div>
                            <div class="flex flex-col my-4">
                                <label for="firstName" class="text-gray-700 font-semibold">Primer Nombre</label>
                                <input class='mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900' type="text" name="firstName" placeholder="Primer Nombre">
                            </div>
                            <div class="flex flex-col my-4">
                                <label for="lastName" class="text-gray-700 font-semibold">Primer Apellido</label>
                                <input class='mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900' type="text" name="lastName" placeholder="Primer Apellido">
                            </div>
                            <div class="flex flex-col my-4">
                                <label for="username" class="text-gray-700 font-semibold">Usuario</label>
                                <input class='mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900' type="text" name="username" placeholder="Usuario">
                            </div>
                            <div class="flex flex-col my-4">
                                <label for="password" class="text-gray-700 font-semibold">Contraseña</label>
                                <div x-data="{ show: false }" class="relative flex items-center mt-2">
                                    <input :type="show ? 'text' : 'password'" name="password" id="password" class="flex-1 p-2 pr-10 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Contraseña">
                                    <button @click="show = !show" type="button" class="absolute right-2 bg-transparent flex items-center justify-center text-gray-700">
                                        <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                        </svg>
                                        <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="flex flex-col my-4">
                                <label for="password_confirmation" class="text-gray-700 font-semibold">Confirmar Contraseña</label>
                                <div x-data="{ show: false }" class="relative flex items-center mt-2">
                                    <input :type="show ? 'text' : 'password'" name="password_confirmation" id="password_confirmation" class="flex-1 p-2 pr-10 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Escriba nuevamente su contraseña">
                                    <button @click="show = !show" type="button" class="absolute right-2 bg-transparent flex items-center justify-center text-gray-700">
                                        <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                        </svg>
                                        <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="flex flex-col my-4">
                                <label for="email" class="text-gray-700 font-semibold">Correo Electronico</label>
                                <input class='mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900' type="email" name="email" placeholder="Correo Electronico">
                            </div>
                            <div class="flex flex-col my-4">
                                <label for="phone" class="text-gray-700 font-semibold">Telefono</label>
                                <input class='mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900' type="tel" name="phone" placeholder="Telefono">

                            </div>

                            <div class="flex flex-col my-4">
                                <label for="role" class="text-gray-700 font-semibold">Rol de Usuario</label>
                                <select name="role" id="rol" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900">
                                    <option value="" selected disabled>Seleccionar Rol</option>
                                    <option value="gerente">Gerente</option>
                                    <option value="administrador">Administrador</option>
                                    <option value="bodeguero">Bodeguero</option>
                                </select>
                            </div>
                            <div class="flex flex-col my-4">
                                <label for="estatus" class="text-gray-700 font-semibold">Estatus de Usuario</label>
                                <select name="estatus" id="estatus" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900">
                                    <option value="" selected disabled>Seleccionar Estatus</option>
                                    <option value="activo">Activo</option>
                                    <option value="inactivo">Inactivo</option>
                                </select>
                            </div>
                            <div class="flex items-center justify-center mt-6">
                                <button class="py-2 px-4 bg-amber-500 hover:bg-amber-600 text-white text-sm font-semibold rounded-lg border border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-opacity-50" type="submit" name="register">Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <footer class="bottom-0 left-0 right-0">
                <?php
                $footer = new Footer;
                $footer->footer($pageTitle);
                ?>
            </footer>
        </body>

        </html>
<?php
    }
}



$page = new UsersForm;
$register = new Users;
$page->renderRegisterForm();
$register->processRegistration();
?>
