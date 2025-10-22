<?php
namespace tables;
require_once "../vendor/autoload.php";
require_once "../Database.php";
//require_once "../Auth.php";
use matmanager\Database;
use templates\header2;
use templates\Footer;

class MaterialsT {
    public function render() {
        ?>
        
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Materiales</title>
            <link rel="stylesheet" href="../styles/style.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/Loopple/loopple-public-assets@main/riva-dashboard-tailwind/riva-dashboard.css">
            <script src="../tailwind.js" integrity="sha384-pXbtEM0s3abRFqEyAChS+PGW3VqbeR/BWCGz6yIMx1rq9ZyeEtJhfCHyPSUpD3XF" crossorigin="anonymous"></script>
            <script>
                function filterMaterials() {
                    const searchValue = document.getElementById('search').value.toLowerCase();
                    const materials = document.getElementsByClassName('material-card');
                    Array.from(materials).forEach(function(material) {
                        const materialName = material.getElementsByClassName('material-name')[0].textContent.toLowerCase();
                        const materialDescription = material.getElementsByClassName('material-description')[0].textContent.toLowerCase();
                        const materialID = material.getElementsByClassName('material-id')[0].textContent.toLowerCase();
                        const materialCost = material.getElementsByClassName('material-cost')[0].textContent.toLowerCase();
                        const materialQuantity = material.getElementsByClassName('material-quantity')[0].textContent.toLowerCase();
                        const materialProvider = material.getElementsByClassName('material-provider')[0].textContent.toLowerCase();
                        const materialDate = material.getElementsByClassName('material-date')[0].textContent.toLowerCase();
                        
                        if (
                            materialName.includes(searchValue) || 
                            materialDescription.includes(searchValue) ||
                            materialID.includes(searchValue) ||
                            materialCost.includes(searchValue) ||
                            materialQuantity.includes(searchValue) ||
                            materialProvider.includes(searchValue) ||
                            materialDate.includes(searchValue)
                        ) {
                            material.style.display = '';
                        } else {
                            material.style.display = 'none';
                        }
                    });
                }

                function checkLowStock() {
                    const threshold = 50; // Umbral definido
                    const materials = document.getElementsByClassName('material-card');
                    let lowStockMaterials = [];
                    
                    Array.from(materials).forEach(function(material) {
                        const materialName = material.getElementsByClassName('material-name')[0].textContent;
                        const materialQuantity = parseInt(material.getElementsByClassName('material-quantity')[0].textContent);
                        
                        if (materialQuantity < threshold) {
                            lowStockMaterials.push(`${materialName}: ${materialQuantity}`);
                        }
                    });

                    if (lowStockMaterials.length > 0) {
                        alert("Materiales con bajo stock:\n" + lowStockMaterials.join("\n"));
                    } else {
                        alert("Todos los materiales están por encima del umbral de stock.");
                    }
                }
            </script>
        </head>
        <body>
            <header>
                <?php $pageTitle = "Header";  
                $header = new header2;
                $header->head2($pageTitle);
                ?>
            </header>
            
            <div class="flex min-h-screen bg-gray-50 justify-center">
                <div class="px-5 py-5">
                    <h3 class="flex flex-col items-start justify-center m-2 ml-0 font-medium text-3xl">
                        <span class="mr-2 font-bold">Registro de Materiales</span>
                    </h3>
                    

                    <!-- Barra de búsqueda -->
                    <div class="mb-5">
                        <div class="flex items-center justify-between mb-5">
                            <form onsubmit="return false;" class="flex-grow">
                                <input type="text" id="search" placeholder="Buscar materiales" onkeyup="filterMaterials()" class="border rounded-lg py-2 px-4 w-min">
                            </form>
                            <a href="../materiales/registerMateriales.php"
                            class="inline-block ml-4 text-xl font-medium leading-normal text-center align-middle cursor-pointer rounded-2xl duration-300 text-light-inverse bg-dark/80 border-light shadow-none py-2 px-5 hover:bg-secondary active:bg-light focus:bg-light">
                            Registrar Material
                            </a>
                            <button onclick="checkLowStock()" class="ml-4 text-xl font-medium leading-normal text-center align-middle cursor-pointer rounded-2xl duration-300 text-light-inverse bg-dark/80 border-light shadow-none py-2 px-5 hover:bg-secondary active:bg-light focus:bg-light">
                            Verificar Stock Bajo
                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4" id="materialsGrid">
                        <?php 
                        $db = new Database();
                        $conex = $db->getConnection();
                        $consulta = "SELECT * FROM Materiales";
                        $resultado = mysqli_query($conex, $consulta);  
                        if ($resultado) {
                            while ($row = $resultado->fetch_assoc()) {
                                echo '<div class="material-card uppercase max-w-xl cursor-pointer bg-white rounded-lg p-5 shadow-md duration-150 hover:scale-105 hover:shadow-lg">';
                                echo '  <div>';
                                echo '    <div class="my-6 flex items-center justify-between px-4">';
                                echo '      <p class="material-name font-bold text-2xl text-amber-500">' . $row["MaterialName"] . '</p>';
                                echo '      <p class="material-id rounded-full bg-gray-400 px-3 py-2 text-xl font-semibold text-white">' . $row["idMaterial"] . '</p>';
                                echo '    </div>';
                                echo '    <div class="my-4 flex items-center justify-between px-4">';
                                echo '      <p class="text-base font-semibold text-gray-500 mr-10">Descripción</p>';
                                echo '      <p class="material-description rounded-full bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-600">' . $row["Description"] . '</p>';
                                echo '    </div>';
                                echo '    <div class="my-4 flex items-center justify-between px-4">';
                                echo '      <p class="text-base font-semibold text-gray-500 mr-10">Costo Unitario</p>';
                                echo '      <p class="material-cost rounded-full bg-gray-200 px-3 py-2 text-sm font-semibold text-gray-600">$' . $row["costoUnitario"] . '</p>';
                                echo '    </div>';
                                echo '    <div class="my-4 flex items-center justify-between px-4">';
                                echo '      <p class="text-base font-semibold text-gray-500 mr-10">Cantidad</p>';
                                echo '      <p class="material-quantity rounded-full bg-gray-200 px-3 py-2 text-sm font-semibold text-gray-600">' . $row["cantidadMaterial"] . '</p>';
                                echo '    </div>';
                                echo '    <div class="my-4 flex items-center justify-between px-4">';
                                echo '      <p class="text-base font-semibold text-gray-500 mr-10">Proveedor</p>';
                                echo '      <p class="material-provider rounded-full bg-gray-200 px-3 py-2 text-sm font-semibold text-gray-600">' . $row["idProveedor"] . '</p>';
                                echo '    </div>';
                                echo '    <div class="my-4 flex items-center justify-between px-4">';
                                echo '      <p class="text-base font-semibold text-gray-500 mr-10">Pedido</p>';
                                echo '      <p class="material-provider rounded-full bg-gray-200 px-3 py-2 text-sm font-semibold text-gray-600">' . $row["idPedido"] . '</p>';
                                echo '    </div>';
                                echo '    <div class="my-4 flex items-center justify-between px-4">';
                                echo '      <p class="text-base font-semibold text-gray-500 mr-10">Fecha</p>';
                                echo '      <p class="material-date rounded-full bg-gray-200 px-3 py-2 text-sm font-semibold text-gray-600">' . $row["date_reg"] . '</p>';
                                echo '    </div>';
                                echo '    <div class="my-4 flex items-center justify-between px-4">';
                                echo '      <p class="text-base font-semibold text-gray-500 mr-10">Acción</p>';
                                echo '      <p class="text-xl font-semibold text-gray-500">
                                        <a class="items-center justify-center font-sans font-bold whitespace-nowrap select-none bg-yellow-500/20 text-yellow-600 hover:bg-yellow-500/50 py-1 px-2 text-xs rounded-md duration-700" href="../CRUD/editar.php?idMaterial=' . $row["idMaterial"] . '">Editar</a> | 
                                        <a href="../CRUD/eliminar.php?idMaterial=' . $row["idMaterial"] . '" class="items-center justify-center font-sans font-bold whitespace-nowrap select-none bg-red-500/20 text-red-700 py-1 px-2 text-xs rounded-md hover:bg-red-500/50 duration-700">Eliminar</a>
                                        </p>';
                                echo '    </div>';
                                echo '  </div>';
                                echo '</div>';
                            } 
                        } else {
                            echo '<p>No se encontraron registros</p>';    
                        }
                        mysqli_close($conex);
                        ?>
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

// Instanciamos la clase y llamamos al método render para generar el HTML
$main = new MaterialsT();
$main->render();
?>
