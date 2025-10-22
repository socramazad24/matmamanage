<?php
namespace bodeguero;

require_once "../vendor/autoload.php";
require_once "../Database.php";
//require_once "../Auth.php";

use matmanager\Database;
use templates\header2;

class Main {
    public function render() {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Inicio</title>
            <link rel="stylesheet" href="../styles/style.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/Loopple/loopple-public-assets@main/riva-dashboard-tailwind/riva-dashboard.css">
            <script src="../tailwind.js" integrity="sha384-pXbtEM0s3abRFqEyAChS+PGW3VqbeR/BWCGz6yIMx1rq9ZyeEtJhfCHyPSUpD3XF" crossorigin="anonymous"></script>
            <script>
                function filterMaterials() {
                    const searchValue = document.getElementById('search').value.toLowerCase();
                    const materials = document.getElementsByClassName('material-card');
                    Array.from(materials).forEach(function(material) {
                        const fields = [
                            'material-name',
                            'material-description',
                            'material-id',
                            'material-cost',
                            'material-quantity',
                            'material-provider',
                            'material-date'
                        ];

                        const match = fields.some(field => {
                            return material.getElementsByClassName(field)[0].textContent.toLowerCase().includes(searchValue);
                        });

                        material.style.display = match ? '' : 'none';
                    });
                }
            </script>
        </head>
        <body>
            <header>
                <?php
                $pageTitle = "Header";
                $header = new header2();
                $header->head2($pageTitle);
                ?>
            </header>
            
            <div class="flex min-h-screen bg-gray-50 justify-center">
                <div class="px-5 py-5">
                    <h3 class="flex flex-col items-start justify-center m-2 ml-0 font-medium text-3xl">
                        <span class="mr-2 font-bold">Materiales</span>
                    </h3>

                    <!-- Barra de búsqueda -->
                    <div class="mb-5">
                        <form onsubmit="return false;">
                            <input type="text" id="search" placeholder="Buscar materiales" onkeyup="filterMaterials()" class="border rounded-lg py-2 px-4 w-min">
                        </form>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4" id="materialsGrid">
                        <?php 
                        $db = new Database();
                        $conex = $db->getConnection();
                        $consulta = "SELECT * FROM Materiales";
                        $resultado = mysqli_query($conex, $consulta);  

                        if ($resultado) {
                            while ($row = $resultado->fetch_assoc()) {
                                $this->renderMaterialCard($row);
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
                &copy; 2023 MAT-MANAGER
            </footer>
        </body>
        </html>
        <?php
    }

    private function renderMaterialCard($row) {
        ?>
        <div class="material-card uppercase max-w-xl cursor-pointer rounded-lg bg-white p-5 shadow duration-150 hover:scale-105 hover:shadow-md">
            <div>
                <?php
                $this->renderMaterialField('material-name', 'text-amber-500', $row["MaterialName"], 'font-bold text-2xl');
                $this->renderMaterialField('material-id', 'bg-gray-400 text-white', $row["idMaterial"], 'rounded-full px-3 py-2 text-xl font-semibold');
                $this->renderMaterialField('material-description', 'bg-gray-200 text-gray-600', $row["Description"], 'rounded-full px-4 py-2 text-sm font-semibold');
                $this->renderMaterialField('material-cost', 'bg-gray-200 text-gray-600', '$' . $row["costoUnitario"], 'rounded-full px-3 py-2 text-sm font-semibold');
                $this->renderMaterialField('material-quantity', 'bg-gray-200 text-gray-600', $row["cantidadMaterial"], 'rounded-full px-3 py-2 text-sm font-semibold');
                $this->renderMaterialField('material-provider', 'bg-gray-200 text-gray-600', $row["idProveedor"], 'rounded-full px-3 py-2 text-sm font-semibold');
                $this->renderMaterialField('material-date', 'bg-gray-200 text-gray-600', $row["date_reg"], 'rounded-full px-3 py-2 text-sm font-semibold');
                ?>
                <div class="my-4 flex items-center justify-between px-4">
                    <p class="text-base font-semibold text-gray-500 mr-10">Acción</p>
                    <p class="text-xl font-semibold text-gray-500">
                        <a class="items-center justify-center font-sans font-bold whitespace-nowrap select-none bg-yellow-500/20 text-yellow-600 hover:bg-yellow-500/50 py-1 px-2 text-xs rounded-md duration-700" href="../CRUD/editar.php?idMaterial=<?= $row['idMaterial'] ?>">Editar</a> | 
                        <a href="../CRUD/eliminar.php?idMaterial=<?= $row['idMaterial'] ?>" class="items-center justify-center font-sans font-bold whitespace-nowrap select-none bg-red-500/20 text-red-700 py-1 px-2 text-xs rounded-md hover:bg-red-500/50 duration-700">Eliminar</a>
                    </p>
                </div>
            </div>
        </div>
        <?php
    }

    private function renderMaterialField($class, $bgClass, $content, $additionalClasses = '') {
        ?>
        <div class="my-4 flex items-center justify-between px-4">
            <p class="material-field-label text-base font-semibold text-gray-500 mr-10"><?= ucfirst(str_replace('-', ' ', $class)) ?></p>
            <p class="<?= $class ?> <?= $bgClass ?> <?= $additionalClasses ?>"><?= $content ?></p>
        </div>
        <?php
    }
}

// Instanciamos la clase y llamamos al método render para generar el HTML
$main = new Main();
$main->render();
?>
