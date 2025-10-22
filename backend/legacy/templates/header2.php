<?php 

    namespace templates;

    class header2 {
        public static function head2($pageTitle){
            echo "<!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>{$pageTitle}</title>
                <script src='../tailwind.js' integrity='sha384-pXbtEM0s3abRFqEyAChS+PGW3VqbeR/BWCGz6yIMx1rq9ZyeEtJhfCHyPSUpD3XF' crossorigin='anonymous'></script>
            </head>
            <body class=''>
            <header>
                  <nav class='md:flex w-screen h-min bg-white border-b'>
                <div class='flex items-center space-x-2'> <!-- Contenedor para el logo y el título -->
                    <img src='../images/logo.png' alt='' class='object-cover w-16 h-16 flex-shrink-0 ml-1'>
                    <h1 class='text-2xl font-bold cursor-pointer text-gray-500 hover:text-amber-500 duration-700'>Mat-Manager</h1>
                </div>
                <div class='flex items-center space-x-16 ml-auto m-3'> <!-- Contenedor para las demás opciones, alineado a la derecha -->
                    <ul class='flex space-x-6'>
                        <a href='../bodeguero/index.php'>
                        <li class='cursor-pointer text-gray-500 hover:text-amber-500 duration-700'>
                            <svg xmlns='http://www.w3.org/2000/svg' class='h-6 w-6' fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6' />
                            </svg>
                            
                            <span class='font-semibold'>Inicio</a></span>
                        </li>
                        <li class='cursor-pointer text-gray-500 hover:text-amber-500 duration-700'>
                            <a href='../tables/MaterialsTable.php'>
                            <svg xmlns='http://www.w3.org/2000/svg' class='h-6 w-6' fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z' />
                            </svg>
                            <span class='font-semibold'>Materiales</a></span>
                        </li>
                        <li class='cursor-pointer text-gray-500 hover:text-amber-500 duration-700'>
                            <a href='../materiales/Pedidos.php'>
                            <svg xmlns='http://www.w3.org/2000/svg' class='h-6 w-6' fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z' />
                            </svg>
                            <span class='font-semibold'>Pedidos</a></span>
                        </li>
                        <li>
                            <button class='bg-yellow-500 text-white font-semibold px-4 py-3 rounded-md hover:bg-amber-500 duration-700 mr-7'><a href='../logout.php'>Cerrar Sesion</a></button>
                
                        </li> 
                    </ul>
                </div>
            </nav>
            </header>
            <main>";
        }
    }


?>
