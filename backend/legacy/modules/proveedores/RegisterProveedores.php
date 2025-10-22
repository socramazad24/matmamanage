<?php

namespace RegisterProveedores;

require_once "../vendor/autoload.php";
require_once "../Database.php";
//require_once "../Auth.php";
use matmanager\Database;
use templates\header;
use templates\footer;

class MainProvider
{
    public function render()
    {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <script src="../tailwind.js" integrity="sha384-pXbtEM0s3abRFqEyAChS+PGW3VqbeR/BWCGz6yIMx1rq9ZyeEtJhfCHyPSUpD3XF" crossorigin="anonymous"></script>
            <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
            <!-- SweetAlert2 CSS -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

            <!-- SweetAlert2 JS -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <title>Registro Proveedores</title>
        </head>

        <body>
            <header>
                <?php $pageTitle = "Header";
                $header = new header;
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
                        <h2 class="text-center text-2xl font-bold tracking-wide text-gray-800">Registrar Proveedores</h2>
                        <p class="text-center text-sm text-gray-600 mt-2 font-semibold">Formulario de Registro de Proveedores<br><a href="../tables/TablaProveedores.php" class="text-amber-400 hover:text-yellow-600 duration-700 hover:underline" title="Tabla Proveedores">Ir a la Tabla</a></p>
                        <form class="my-8 text-sm" method='post'>
                            <div class="flex flex-col my-4">
                                <label for="idProveedor" class="text-gray-700 font-semibold">ID Proveedor</label>
                                <input class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" type="text" name="idProveedor" placeholder="ID Proveedor">
                            </div>
                            <div class="flex flex-col my-4">
                                <label for="nameProveedor" class="text-gray-700 font-semibold">Nombre de Proveedor</label>
                                <input class='mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900' type="text" name="nameProveedor" placeholder="Nombre de Proveedor">
                            </div>

                            <div class="relative inline-flex my-4 ">

                                <select id="materiales" name="materiales" class="  block appearance-none w-full bg-white border border-gray-300 hover:border-gray-600 px-4 py-2 pr-8 rounded-md shadow-sm focus:outline-none focus:border-yellow-500 focus:ring focus:ring-amber-600 focus:ring-opacity-50">
                                    <option value="" disabled selected>Elija material</option>
                                    <option value="cobre">Cobre</option>
                                    <option value="cemento">Cemento</option>
                                    <option value="hierro">Hierro</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 font-semibold">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex flex-col my-4">
                                <label for="telefono" class="text-gray-700 font-semibold">Teléfono</label>
                                <input class='mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900' type="text" name="telefono" placeholder="Teléfono">
                            </div>
                            <div class="flex flex-col my-4">
                                <label for="correo" class="text-gray-700 font-semibold">Correo Electrónico</label>
                                <input class='mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900' type="email" name="correo" placeholder="Correo Electrónico">
                            </div>
                            <div class="flex flex-col my-4">
                                <label for="direccion" class="text-gray-700 font-semibold">Dirección</label>
                                <input class='mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900' type="text" name="direccion" placeholder="Dirección">
                            </div>
                            <div class="my-4 flex items-center justify-end space-x-4">
                                <button class="bg-amber-400 hover:bg-yellow-600 rounded-lg px-8 py-2 text-gray-100 hover:shadow-xl transition duration-150 uppercase" type="submit" name="register">Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <footer>
                <?php $pageTitle = "Footer";
                $header = new Footer;
                $header->Footer($pageTitle);
                ?>
            </footer>
        </body>

        </html>
<?php
    }
}

class RegisterProveedores
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
            $errors = array(); // Array para almacenar mensajes de error

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
            $consultaProveedor = "SELECT * FROM proovedores WHERE idProveedor = '$idProveedor' OR correo = '$correo' OR telefono = '$telefono'";
            $resultadoProveedor = mysqli_query($conex, $consultaProveedor);
            if (mysqli_num_rows($resultadoProveedor) > 0) {
                $row = mysqli_fetch_assoc($resultadoProveedor);
                if ($row['idProveedor'] == $idProveedor) {
                    echo "<script>Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'La ID ya está registrada. Por favor, introduzca otra ID.',
                                })</script>";
                    return;
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

            // Si hay errores, muestra una alerta con SweetAlert2

            // Si no hay errores, procede con el registro
            $consulta = "INSERT INTO proovedores(idProveedor, nameProveedor, materiales, telefono, correo, direccion, date_reg) 
                            VALUES ('$idProveedor', '$nombre', '$materiales', '$telefono', '$correo', '$direccion', '$datereg')";
            $resultado = mysqli_query($conex, $consulta);
            if ($resultado) {
                // Registro exitoso, muestra una alerta con SweetAlert2
                echo "<script>";
                echo "Swal.fire({";
                echo "  icon: 'success',";
                echo "  title: 'Éxito',";
                echo "  text: 'Proveedor registrado exitosamente.'";
                echo "});";
                echo "</script>";
            } else {
                // Error en el registro, muestra una alerta con SweetAlert2
                echo "<script>";
                echo "Swal.fire({";
                echo "  icon: 'error',";
                echo "  title: 'Error',";
                echo "  text: 'Algo ha salido mal.'";
                echo "});";
                echo "</script>";
            }
        }
    }
}


// Instanciamos la clase y llamamos al método render para generar el HTML
$main = new MainProvider();
$main->render();
$register = new RegisterProveedores;
$register -> RegisterProvider();
?>
