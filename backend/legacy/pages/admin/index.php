<?php
namespace admin;
require_once "../vendor/autoload.php";
require_once "../Database.php";
//require_once "../Auth.php";

use templates\header;
use templates\footer;


class Main {
    public function render() {
        ?>
                <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/Loopple/loopple-public-assets@main/riva-dashboard-tailwind/riva-dashboard.css">
            
            <script src="../tailwind.js" integrity="sha384-pXbtEM0s3abRFqEyAChS+PGW3VqbeR/BWCGz6yIMx1rq9ZyeEtJhfCHyPSUpD3XF" crossorigin="anonymous"></script>
            <script>
                tailwind.config = {
                    theme: {
                        extend: {
                            colors: {
                                cPrimary: '#0F0F0F',
                                cSecondary: '#FEB900',
                            },
                        },
                    },
                };
            </script>
            <title>Inicio</title>
        </head>
        <body class='bg-gray-100 h-max'>
        <header> 
            <?php $pageTitle = "Header";                 
                $header = new header();
                $header-> head($pageTitle);
            ;?>
        </header>
            <section class="text-gray-600 body-font">
                <div class="container px-5 py-24 mx-auto">
                    <div class=" flex-wrap -m-4  flex justify-center items-center">
                        <div class="p-4 md:w-1/4 ">
                            <div class="h-full rounded-xl shadow-cla-blue bg-gradient-to-r from-amber-50 to-yellow-50 overflow-hidden">
                                <img class="lg:h-48 md:h-32 2 w-full object-cover object-center flex justify-center scale-110 transition-all duration-400 hover:scale-100" src="../images/listaUsuarios.png" alt="h-10">
                                <div class="p-6 ">
                                    <h2 class="tracking-widest text-xs title-font font-medium text-gray-600 mb-1">CATEGORY-1</h2>
                                    <h1 class="title-font text-lg font-medium text-gray-900 mb-3">Usuarios</h1>
                                    <p class="leading-relaxed mb-3">Listado de usuarios registrados y/o por registrar, con sus respectiva informacion prevalente en el sistema </p>
                                    <div class="flex items-center flex-wrap ">
                                        <button class="bg-gradient-to-r from-amber-400 to-amber-500 hover:scale-105 drop-shadow-md  shadow-cla-blue px-4 py-1 rounded-lg text-gray-100"><a href="../tables/recuperarUsuarios.php">Usuarios</a></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 md:w-1/4 ">
                            <div class="h-full rounded-xl shadow-cla-violate bg-gradient-to-r from-amber-50 to-yellow-50 overflow-hidden">
                                <img class="lg:h-48 md:h-36 w-full object-cover object-center scale-110 transition-all duration-400 hover:scale-100" src="../images/listaProveedores.png" alt="blog">
                                <div class="p-6 ">
                                    <h2 class="tracking-widest text-xs title-font font-medium text-gray-600 mb-1">CATEGORY-1</h2>
                                    <h1 class="title-font text-lg font-medium text-gray-900 mb-3">Proveedores</h1>
                                    <p class="leading-relaxed mb-3">Listado de proveedores registrados y/o por registrar, con informacion prevalente e informacion de materiales</p>
                                    <div class="flex items-center flex-wrap ">
                                        <button class="bg-gradient-to-r from-orange-300 to-amber-400 text-white hover:scale-105 drop-shadow-md shadow-amber-400 px-4 py-1 rounded-lg"><a href="../tables/TablaProveedores.php">Proveedores</a></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 md:w-1/4 ">
                            <div class="h-full rounded-xl shadow-cla-pink bg-gradient-to-r from-amber-50 to-yellow-50 overflow-hidden">
                                <img class="lg:h-48 md:h-36 w-full ml-2.5  object-cover object-center scale-110 transition-all duration-400 hover:scale-100" src="../images/historial.png" alt="blog">
                                <div class="p-6 ">
                                    <h2 class="tracking-widest text-xs title-font font-medium text-gray-600 mb-1">CATEGORY-1</h2>
                                    <h1 class="title-font text-lg font-medium text-gray-900 mb-3">Registros</h1>
                                    <p class="leading-relaxed mb-3">Listado de los Historiales de usuarios, materiales, pedidos y proveedores, con informacion de creacion y edicion</p>
                                    <div class="flex items-center flex-wrap ">
                                        <button class="bg-gradient-to-r from-orange-300 to-amber-400 text-white hover:scale-105  shadow-cla-blue px-4 py-1 rounded-lg"><a href="../historial/historial.php">Registros </a></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <footer> 
            <?php $pageTitle = "Footer"; 
                $footer = new footer();
                $footer-> footer($pageTitle);
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
