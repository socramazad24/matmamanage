<?php
namespace materiales;
require_once "../vendor/autoload.php";
require_once "../Database.php";
//require_once "../Auth.php";
use matmanager\Database;
use templates\header2;

class Materials {
    public function render() {
        ?>

            <?php

            $db = new Database();
            $conex = $db->getConnection();

            if ($conex->connect_error) {
                die("Connection failed: " . $conex->connect_error);
            }

            $idPedido = $_GET['idPedido'] ?? '';
            if (empty($idPedido)) {
                echo '<script language="javascript">';
                echo 'alert("ID de Pedido no proporcionado.");';
                echo 'window.location="../tables/TablaPedidos.php";';
                echo '</script>';
                exit;
            }

            $sentencia = $conex->prepare("SELECT * FROM pedidos WHERE idPedido=?");
            $sentencia->bind_param("s", $idPedido);
            $sentencia->execute();
            $resultado = $sentencia->get_result();
            $result = $resultado->fetch_assoc();

            if (!$result) {
                echo '<script language="javascript">';
                echo 'alert("No hay resultados para ese ID de Pedido.");';
                echo 'window.location="../tables/TablaPedidos.php";';
                echo '</script>';
                exit;
            }
            ?>

            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Registro de Materiales</title>
                <link rel="stylesheet" href="../styles/style.css">
                <script src="../tailwind.js" integrity="sha384-pXbtEM0s3abRFqEyAChS+PGW3VqbeR/BWCGz6yIMx1rq9ZyeEtJhfCHyPSUpD3XF" crossorigin="anonymous"></script>
                <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            </head>
            <body class="bg-gray-100">
            <header>
                <?php
                $pageTitle = "Header";
                $header = new header2;
                $header->head2($pageTitle);
                ?>
            </header>
            <div class="container mx-auto py-10">
                <div class="flex justify-center items-center">
                    <div class="w-full max-w-lg bg-white shadow-md rounded-lg p-8">
                        <div class="flex justify-center mb-6">
                            <img src="../images/logo.png" alt="Logo" class="w-20 h-20">
                        </div>
                        <h2 class="text-center text-2xl font-bold text-gray-800">Registrar Materiales</h2>
                        <p class="text-center text-sm text-gray-600 mt-2 font-semibold">
                            Formulario de Registro de Materiales<br>
                            <a href="../tables/MaterialsTable.php" class="text-amber-400 hover:text-yellow-600 transition duration-700 hover:underline" title="Tabla Materiales">Ir a la Tabla</a>
                        </p>
                        <form class="mt-8 space-y-6" method="post">
                            <div class="space-y-4">
                                <div>
                                    <label for="idMaterial" class="block text-gray-700 font-semibold">ID del Material</label>
                                    <input class="mt-2 p-2 border border-gray-300 rounded w-full focus:ring-amber-500 focus:border-amber-500" type="text" value="<?php echo htmlspecialchars($result["idPedido"]); ?>" name="idMaterial" placeholder="ID del Material" readonly>
                                </div>
                                <div>
                                    <label for="idPedido" class="block text-gray-700 font-semibold">ID del Pedido</label>
                                    <input class="mt-2 p-2 border border-gray-300 rounded w-full focus:ring-amber-500 focus:border-amber-500" type="text" value="<?php echo htmlspecialchars($result["idPedido"]); ?>" name="idPedido" placeholder="ID del Pedido" readonly>
                                </div>
                                <div>
                                    <label for="MaterialName" class="block text-gray-700 font-semibold">Nombre del Material</label>
                                    <input class="mt-2 p-2 border border-gray-300 rounded w-full focus:ring-amber-500 focus:border-amber-500" type="text" value="<?php echo htmlspecialchars($result["MaterialName"]); ?>" name="MaterialName" placeholder="Nombre del Material" readonly>
                                </div>
                                <div>
                                    <label for="Description" class="block text-gray-700 font-semibold">Descripción del Material</label>
                                    <input class="mt-2 p-2 border border-gray-300 rounded w-full focus:ring-amber-500 focus:border-amber-500" type="text" value="<?php echo htmlspecialchars($result["Description"]); ?>" name="Description" placeholder="Descripción del Material" readonly>
                                </div>
                                <div>
                                    <label for="costoUnitario" class="block text-gray-700 font-semibold">Costo Unitario</label>
                                    <input class="mt-2 p-2 border border-gray-300 rounded w-full focus:ring-amber-500 focus:border-amber-500" type="number" value="<?php echo htmlspecialchars($result["costoUnitario"]); ?>" name="costoUnitario" placeholder="Costo Unitario" readonly>
                                </div>
                                <div>
                                    <label for="cantidadMaterial" class="block text-gray-700 font-semibold">Cantidad de Material</label>
                                    <input class="mt-2 p-2 border border-gray-300 rounded w-full focus:ring-amber-500 focus:border-amber-500" type="number" value="<?php echo htmlspecialchars($result["cantidadMaterial"]); ?>" name="cantidadMaterial" placeholder="Cantidad de Material" readonly>
                                </div>
                                <div>
                                    <label for="idProveedor" class="block text-gray-700 font-semibold">Proveedor</label>
                                    <select name="idProveedor" id="idProveedor" class="mt-2 p-2 border border-gray-300 rounded w-full focus:ring-amber-500 focus:border-amber-500">
                                    <?php
                                    $sql = "SELECT idProveedor, nameProveedor FROM proovedores";
                                    $result = $conex->query($sql);

                                    if ($result && $result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . htmlspecialchars($row['idProveedor']) . "'>" . htmlspecialchars($row['nameProveedor']) . "</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No hay proveedores disponibles</option>";
                                    }
                                    ?>
                                    </select>
                                </div>
                            </div>
                            <div class="flex justify-end mt-6">
                                <button class="bg-amber-400 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition duration-150" type="submit" name="register">Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php 
            
            ?>
            <footer> 
                <?php $pageTitle = "Footer"; include '../templates/footer.php'; ?>
            </footer>
            </body>
            </html>
        <?php
    }
}

class registerMateriales 
{
   public function registerMateriales() {
        $db = new Database();
            $conex = $db->getConnection();
        if (isset($_POST['register'])) {
            $IdMaterial = trim($_POST['idMaterial']);   
            $MaterialName = trim($_POST['MaterialName']);
            $Description = trim($_POST['Description']);
            $costoUnitario = trim($_POST['costoUnitario']);
            $cantidadMaterial = trim($_POST['cantidadMaterial']);
            $proovedor = trim($_POST['idProveedor']);      
            $idPedido = trim($_POST['idPedido']);              
            $datereg = date("y/m/d");
            $errors = array(); // Array para almacenar mensajes de error

            // Validación de campos obligatorios
            if (
                strlen($IdMaterial) < 1 ||
                strlen($MaterialName) < 1 ||
                strlen($Description) < 1 ||
                strlen($costoUnitario) < 1 ||
                strlen($cantidadMaterial) < 1 ||
                strlen($proovedor) < 1 ||
                strlen($idPedido) < 1
            ) {
                echo "<script>Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Por favor, complete todos los campos.',
                })</script>";
                return;
                
            }

            // Validación del campo proovedor
            if (empty($proovedor)) {
                echo "<script>Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Por favor, seleccione un proveedor.',
                })</script>";
                return;
               
            }

            // Validación de existencia de material
            $consultaMaterial = "SELECT * FROM materiales WHERE idMaterial = ?";
            $stmt = $conex->prepare($consultaMaterial);
            $stmt->bind_param("s", $IdMaterial);
            $stmt->execute();
            $resultadoMaterial = $stmt->get_result();
            if ($resultadoMaterial->num_rows > 0) {
                echo "<script>Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El ID del material ya está registrado. Por favor, introduzca otro ID.',
                })</script>";
                return;
                
            }

            // Si hay errores, muestra una alerta con SweetAlert2
            if (!empty($errors)) {
                echo "<script>";
                echo "Swal.fire({";
                echo "  icon: 'error',";
                echo "  title: 'Error',";
                echo "  html: '" . implode("<br>", $errors) . "'";
                echo "});";
            } else {
                // Si no hay errores, procede con el registro
                $consulta = "INSERT INTO materiales(idMaterial, MaterialName, Description, costoUnitario, cantidadMaterial, idProveedor, idPedido, date_reg) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $conex->prepare($consulta);
                    $stmt->bind_param("sssdissi", $IdMaterial, $MaterialName, $Description, $costoUnitario, $cantidadMaterial, $proovedor, $idPedido, $datereg);
                if ($stmt->execute()) {                    
                    echo "<script>Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: 'Material registrado exitosamente.',
                    })</script>";
                    return;
                } else {
                    echo "<script>Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Algo ha salido mal. " . htmlspecialchars($conex->error) . "',
                    })</script>";
                    return;
                }
            }
        }
        $conex->close();
    }
}


// Instanciamos la clase y llamamos al método render para generar el HTML
$main = new Materials();
$main->render();
$register = new registerMateriales;
$register -> registerMateriales();
?>
