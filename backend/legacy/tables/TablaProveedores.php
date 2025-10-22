<?php
namespace tables;
require_once "../vendor/autoload.php";
require_once "../Database.php";
//require_once "../Auth.php";
use matmanager\Database;
use templates\header;
use templates\Footer;

class Main {
    public function render() {
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Proveedores</title>
            
            <script src="../tailwind.js" integrity="sha384-pXbtEM0s3abRFqEyAChS+PGW3VqbeR/BWCGz6yIMx1rq9ZyeEtJhfCHyPSUpD3XF" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/Loopple/loopple-public-assets@main/riva-dashboard-tailwind/riva-dashboard.css">
            <style>
                /* Estilos adicionales para alinear el campo de búsqueda y el botón */
                .search-wrapper {
                    display: flex;
                    align-items: center;
                }

                .search-input {
                    margin-right: 10px;
                }
            </style>
            <script>
                function buscarProveedores() {
                    const input = document.getElementById("searchInput");
                    const filter = input.value.toUpperCase();
                    const table = document.getElementById("proveedoresTable");
                    const tr = table.getElementsByTagName("tr");

                    for (let i = 1; i < tr.length; i++) {
                        let visible = false;
                        const td = tr[i].getElementsByTagName("td");

                        for (let j = 0; j < td.length; j++) {
                            if (td[j] && td[j].innerText.toUpperCase().indexOf(filter) > -1) {
                                visible = true;
                            }
                        }

                        if (visible) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            </script>
        </head>
        <body>
            <!-- Header -->
            <header>
                <?php $pageTitle = "Header"; 
                    $header = new header;
                    $header->head($pageTitle);?>
            </header>
            
            <div class="overflow-scroll px-0">
                <div class="px-4 py-4 flex justify-between items-stretch flex-wrap min-h-[70px] pb-5 bg-transparent">
                    <h3 class="flex flex-col items-start justify-center m-2 ml-0 font-medium text-3xl">
                        <span class="mr-2 font-bold text-amber-400">Tabla de Proveedores</span>
                    </h3>
                </div>
                <div class="flex items-center mb-5">
                <a href="../proveedores/registerProveedores.php"
                    class=" inline-block text-xl font-medium leading-normal text-center align-middle cursor-pointer rounded-2xl duration-300 text-light-inverse gray-500 bg-light-dark border-light shadow-none py-2 px-5 hover:bg-amber-400 hover:text-white active:bg-light focus:bg-light ml-5">Registrar Proveedores</a>
                <input type="text" id="searchInput" onkeyup="buscarProveedores()" placeholder="Buscar proveedores..." class="search-input px-4 py-2 rounded-lg border-2 border-gray-300 ml-5">
                </div>
                
                <table id="proveedoresTable" class="w-full min-w-max table-auto text-left">
                    <thead>
                        <tr>
                            <th class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                                <p class="antialiased font-sans font-bold text-lg text-amber-500 flex items-center justify-between gap-2 leading-none opacity-70">ID</p>
                            </th>
                            <th class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 transition-colors hover:bg-blue-gray-50">
                                <p class="antialiased font-sans font-bold text-lg text-amber-500 flex items-center justify-between m-3 gap-1 leading-none opacity-70">Nombre de la Empresa <br>Email</p>
                            </th>
                            <th class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                                <p class="antialiased font-sans font-bold text-lg text-amber-500 flex items-center justify-between gap-2 leading-none opacity-70">Nombre del Material</p>
                            </th>
                            <th class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                                <p class="antialiased font-sans font-bold text-lg text-amber-500 flex items-center justify-between gap-2 leading-none opacity-70">Telefono</p>
                            </th>
                            <th class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                                <p class="antialiased font-sans font-bold text-lg text-amber-500 flex items-center justify-between gap-2 leading-none opacity-70">Direccion</p>
                            </th>
                            <th class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                                <p class="antialiased font-sans font-bold text-lg text-amber-500 flex items-center justify-between gap-2 leading-none opacity-70">Accion</p>
                            </th>
                            <th class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                                <p class="antialiased font-sans font-bold text-lg text-amber-500 flex items-center justify-between gap-2 leading-none opacity-70">Fecha</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $db = new Database();
                            $conex = $db->getConnection();
                            $consulta = "SELECT * FROM Proovedores";
                            $resultado = mysqli_query($conex, $consulta);  
                            if ($resultado){
                                while ($row = $resultado->fetch_assoc()){
                                    echo "<tr>";
                                    echo "<td class='p-4 border-b border-blue-gray-50'>
                                        <div class='flex items-center gap-2'>
                                            <div class='flex flex-col'>
                                                <p class='block antialiased font-sans text-base leading-normal text-blue-gray-100 font-normal'> ".
                                                    $row["idProveedor"]. "
                                                </p>
                                            </div>
                                        </div>
                                    </td>";
                                                
                                    echo "<td class='p-4 border-b border-blue-gray-50'>
                                        <div class='flex items-center gap-3'>
                                            <div class='flex flex-col'>
                                                <p class='block antialiased uppercase text-base font-sans leading-normal text-blue-gray-100 font-normal'>"
                                                    . $row["nameProveedor"] . "<span> </span>" . 
                                                    "<p class='block antialiased font-sans text-base leading-normal text-blue-gray-900 font-normal opacity-70'>".  $row["correo"] ."
                                                    </p> 
                                                </p>
                                            </div>
                                        </div>
                                    </td>";
                                    echo "<td class='p-4 border-b border-blue-gray-50'>
                                        <div class='flex items-center gap-3'>
                                            <div class='flex flex-col'>
                                                <p class='block antialiased font-sans text-base leading-normal text-blue-gray-100 font-normal'> ".
                                                $row["materiales"]. "
                                                </p>
                                            </div>
                                        </div>
                                    </td>";
                                    echo "<td class='p-4 border-b border-blue-gray-50'>
                                        <div class='flex items-center gap-3'>
                                            <div class='flex flex-col'>
                                                <p class='block antialiased font-sans uppercase text-base leading-normal text-blue-gray-100 font-normal'> ".
                                                $row["telefono"]. "
                                                </p>
                                            </div>
                                        </div>
                                    </td>";
                                    echo "<td class='border-b border-blue-gray-50'>
                                            <div class='flex items-center gap-3'>
                                                <div class='flex flex-col'>
                                                    <p class='block antialiased font-sans uppercase text-base leading-normal text-blue-gray-100 font-normal'> ".
                                                    $row["direccion"]. "
                                                    </p>
                                                </div>
                                            </div>
                                        </td>";
                                    echo "<td class='p-4 border-b border-blue-gray-50'>
                                        <a href='../CRUD/editarProveedores.php?idProveedor=" . $row["idProveedor"] . "'> 
                                        <button class='relative align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-10 max-w-[40px] h-10 max-h-[40px] rounded-lg text-xs text-blue-gray-500 hover:bg-gray-500/10 active:bg-gray-500/30' type='button'>
                                            <span class='absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2'>
                                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='currentColor' aria-hidden='true' class='h-5 w-5'>
                                                    <path d='M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z'></path>
                                                </svg>
                                            </span>
                                        </button>
                                        </a>
                                        |
                                        <a href='../CRUD/deleteProveedores.php?idProveedor=" . $row["idProveedor"] . "'>
                                        <button class='relative align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-10 max-w-[40px] h-10 max-h-[40px] rounded-lg text-xs text-red-500 hover:bg-red-500/10 active:bg-red-500/30' type='button'>
                                            <span class='absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2'>
                                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='currentColor' aria-hidden='true' class='h-6 w-6'>
                                                    <path d='M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1M18 8H6v12a2 2 0 002 2h8a2 2 0 002-2V8z'></path>
                                                </svg>
                                            </span>
                                        </button>
                                        </a>
                                    </td>";
                                    echo "<td class=' border-b border-blue-gray-50'>
                                        <div class='flex items-center gap-3'>
                                            <div class='flex flex-col'>
                                                <p class='block antialiased font-sans uppercase text-base leading-normal text-blue-gray-100 font-normal'> ".
                                                    $row["date_reg"]. "
                                                </p>
                                            </div>
                                        </div>
                                    </td>";
                                } 
                            } else {
                                echo "No se encontraron registros";
                            }
                            mysqli_close($conex);
                        ?>
                    </tbody>
                </table>  
            </div>
            
            <footer> 
                <?php $pageTitle = "Footer"; 
                    $footer = new Footer;
                    $footer->Footer($pageTitle);
                ?>
            </footer>
        </body>
        </html>

        

        
        <?php
    }
}

// Instanciamos la clase y llamamos al método render para generar el HTML
$main = new Main();
$main->render();
?>
