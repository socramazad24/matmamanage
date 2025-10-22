<?php
namespace pedidos;
require_once "../vendor/autoload.php";
require_once "../Database.php";
//require_once "../Auth.php";
use matmanager\Database;
use templates\Footer;
use templates\header3;

class Order {
    public function render() {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Registro de Pedidos</title>
            <script src="../tailwind.js" integrity="sha384-pXbtEM0s3abRFqEyAChS+PGW3VqbeR/BWCGz6yIMx1rq9ZyeEtJhfCHyPSUpD3XF" crossorigin="anonymous"></script>
            <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
            <!-- SweetAlert2 CSS -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
            <!-- SweetAlert2 JS -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        </head>
        <body>
            <header>
                <?php $pageTitle = "Header";
                    $header = new header3;
                    $header->head3($pageTitle);
                ?>
            </header>
            <div class="bg-gray-200 w-screen min-h-screen flex items-center justify-center">
                <div class="w-full py-8">
                    <div class="flex items-center justify-center space-x-2">
                        <img src="../images/logo.png" alt="" class="object-cover w-20 h-20 flex-shrink-0 ml-5">
                        <h1 class="text-3xl font-bold text-gray-600 tracking-wider">Mat-Manager</h1>
                    </div>
                    <div class="bg-white w-5/6 md:w-3/4 lg:w-2/3 xl:w-[500px] 2xl:w-[550px] mt-8 mx-auto px-16 py-8 rounded-lg shadow-2xl">
                        <h2 class="text-center text-2xl font-bold tracking-wide text-gray-800">Registro de Pedidos</h2>
                        <p class="text-center text-sm text-gray-600 mt-2 font-semibold">Formulario de Registro de Pedidos<br><a href="../tables/recuperarPedidos.php" class="text-amber-400 hover:text-yellow-600 duration-700 hover:underline" title="Tabla Pedidos">Ir a la Tabla</a></p>
                        <form class="my-8 text-sm" method="post">
                            <div class="flex flex-col my-4">
                                <label for="idPedido" class="text-gray-700 font-semibold">ID Pedido</label>
                                <input class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" type="text" name="idPedido" placeholder="ID Pedido" >
                            </div>
                            <div class="flex flex-col my-4">
                                <label for="idProveedor" class="text-gray-700 font-semibold">Proveedor</label>
                                <select id="idProveedor" name="idProveedor" class="block appearance-none w-full bg-white border border-gray-300 hover:border-gray-600 px-4 py-2 pr-8 rounded-md shadow-sm focus:outline-none focus:border-yellow-500 focus:ring focus:ring-amber-600 focus:ring-opacity-50">
                                <?php
                                // Obtener lista de proveedores
                                    $db = new Database();
                                    $conex = $db->getConnection();
                                    $sql = "SELECT idProveedor, nameProveedor FROM proovedores";
                                    $result = $conex->query($sql);

                                    if ($result->num_rows > 0) {
                                        // Mostrar opciones de proveedores
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row['idProveedor'] . "'>" . $row['nameProveedor'] . "</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No hay proveedores disponibles</option>";
                                    }

                                    //$conn->close();
                                    ?>
                                </select>
                            </div>
                            <div class="flex flex-col my-4">
                                <label for="MaterialName" class="text-gray-700 font-semibold">Material</label>
                                <input class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" type="text" name="MaterialName" placeholder="Material" >
                            </div>
                            <div class="flex flex-col my-4">
                                <label for="Description" class="text-gray-700 font-semibold">Descripcion</label>
                                <input class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" type="text" name="Description" placeholder="Descripcion" >
                            </div>
                            <div class="flex flex-col my-4">
                                <label for="cantidadMaterial" class="text-gray-700 font-semibold">Cantidad</label>
                                <input class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" type="number" name="cantidadMaterial" placeholder="Cantidad" >
                            </div>
                            <div class="flex flex-col my-4">
                                <label for="costoUnitario" class="text-gray-700 font-semibold">Costo Unitario</label>
                                <input class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" type="number" name="costoUnitario" placeholder="Costo Unitario" >
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
                    $header-> Footer($pageTitle);
                ?>
            </footer>
        </body>
        </html>
        <?php
    }
}

class RegistrarPedido{
   public function RegisterPedido() {
         
        $db = new Database();
        $conex = $db->getConnection();

        if (isset($_POST['register'])){
            if (
                strlen($_POST['idPedido']) >= 1 &&
                strlen($_POST['idProveedor']) >= 1 &&
                strlen($_POST['MaterialName']) >= 1 &&
                strlen($_POST['Description']) >= 1 &&
                strlen($_POST['cantidadMaterial']) >= 1 &&
                strlen($_POST['costoUnitario']) >= 1
                ) {
                    $idPedido = trim($_POST['idPedido']);
                    $idProveedor = trim($_POST['idProveedor']);
                    $material = trim($_POST['MaterialName']);
                    $descripcion = trim($_POST['Description']);
                    $cantidad = trim($_POST['cantidadMaterial']);
                    $costoUnitario = trim($_POST['costoUnitario']); 
                    $Estado = 'Pendiente';                   
                    $datereg = date("y-m-d");
                    //include("../validaciones/validarPedidos.php");
                    $consulta = "INSERT INTO `pedidos`(`idPedido`, `idProveedor`, `MaterialName`, `Description`, `cantidadMaterial`, `costoUnitario`, `Estado`, `fecha_reg`) 
                    VALUES ('$idPedido ','$idProveedor','$material','$descripcion','$cantidad','$costoUnitario','$Estado','$datereg')";
                    
                    $resultado = mysqli_query($conex, $consulta);
                    if ($resultado){
                                        echo "<script>Swal.fire({icon: 'success',title: 'Éxito',text: 'Pedido registrado exitosamente.'});</script>";
                    } else {
                        echo "<script>Swal.fire({icon: 'error',title: 'Error',text: 'Algo ha salido mal.'});</script>";
                    }
                } else {
                    echo "<script>Swal.fire({icon: 'error',title: 'Error',text: 'Llene todos los campos.'});</script>";
                }
            }
                        
    }
}
// Instanciamos la clase y llamamos al método render para generar el HTML
$main = new Order();
$main->render();
$register = new RegistrarPedido;
$register -> RegisterPedido();
?>
