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
            <title>Usuarios</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/Loopple/loopple-public-assets@main/riva-dashboard-tailwind/riva-dashboard.css">
            <script>
                function filterUsers() {
                    const searchValue = document.getElementById('search').value.toLowerCase();
                    const users = document.querySelectorAll('.user-row');
                    users.forEach(user => {
                        const userId = user.querySelector('.user-id').textContent.toLowerCase();
                        const userName = user.querySelector('.user-name').textContent.toLowerCase();
                        const userEmail = user.querySelector('.user-email').textContent.toLowerCase();
                        const userUsername = user.querySelector('.user-username').textContent.toLowerCase();
                        const userPassword = user.querySelector('.user-password').textContent.toLowerCase();
                        const userPhone = user.querySelector('.user-phone').textContent.toLowerCase();
                        const userRole = user.querySelector('.user-role').textContent.toLowerCase();
                        const userDate = user.querySelector('.user-date').textContent.toLowerCase();

                        if (
                            userId.includes(searchValue) ||
                            userName.includes(searchValue) ||
                            userEmail.includes(searchValue) ||
                            userUsername.includes(searchValue) ||
                            userPassword.includes(searchValue) ||
                            userPhone.includes(searchValue) ||
                            userRole.includes(searchValue) ||
                            userDate.includes(searchValue)
                        ) {
                            user.style.display = '';
                        } else {
                            user.style.display = 'none';
                        }
                    });
                }
            </script>
        </head>

        <body>
            <!-- Header -->
            <header>
                <?php $pageTitle = "Header"; 
                    $header = new header;
                    $header->head($pageTitle);
                ?>
            </header>

            <div class="overflow-scroll px-0">
                <div class="px-4 py-4 flex justify-between items-stretch flex-wrap min-h-[70px] pb-5 bg-transparent">
                    <h3 class="flex flex-col items-start justify-center m-2 ml-0 font-medium text-3xl">
                        <span class="mr-2 font-bold text-amber-400">Tabla de Usuarios</span>
                    </h3>
                </div>
                
                <div class="flex items-center mb-5">
                    <a href="../users/RegisterUser.php" class="inline-block text-xl font-medium leading-normal text-center align-middle cursor-pointer rounded-2xl duration-300 text-light-inverse bg-light-dark border-light shadow-none py-2 px-5 hover:bg-amber-400 hover:text-white active:bg-light focus:bg-light ml-3">Registrar Usuario</a>
                    <div class="flex">
                        <input type="text" id="search" placeholder="Buscar usuarios" onkeyup="filterUsers()" class="border rounded-lg py-2 px-4 ml-10">
                    </div>
                </div>
                <table class="w-full min-w-max table-auto text-left">
                    <thead>
                        <tr>
                            <th class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                                <p class="antialiased font-sans font-bold text-lg text-amber-500 flex items-center justify-between gap-2 leading-none opacity-70">ID<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="h-4 w-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                </svg></p>
                            </th>
                            <th class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50  transition-colors hover:bg-blue-gray-50">
                                <p class="antialiased font-sans font-bold text-lg text-amber-500 flex items-center justify-between  m-3 gap-1 leading-none opacity-70">Nombre y Apellido <br>Email<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="h-4 w-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                </svg></p>
                            </th>
                            <th class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                                <p class="antialiased font-sans font-bold text-lg text-amber-500 flex items-center justify-between gap-2  leading-none opacity-70">Usuario<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="h-4 w-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                </svg></p>
                            </th>
                            <th class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                                <p class="antialiased font-sans font-bold text-lg text-amber-500 flex items-center justify-between gap-2 leading-none opacity-70">Contraseña<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="h-4 w-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                </svg></p>
                            </th>
                            <th class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                                <p class="antialiased font-sans font-bold text-lg text-amber-500 flex items-center justify-between gap-2  leading-none opacity-70">Teléfono<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="h-4 w-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                </svg></p>
                            </th>
                            <th class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                                <p class="antialiased font-sans font-bold text-lg text-amber-500 flex items-center justify-between gap-2 leading-none opacity-70">Rol<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="h-4 w-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                </svg></p>
                            </th>
                            <th class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                                <p class="antialiased font-sans font-bold text-lg text-amber-500 flex items-center justify-between gap-2 leading-none opacity-70">Acción<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="h-4 w-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                </svg></p>
                            </th>
                            <th class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                                <p class="antialiased font-sans font-bold text-lg text-amber-500 flex items-center justify-between gap-2leading-none opacity-70">Fecha<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="h-4 w-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                </svg></p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $db = new Database();
                            $conex = $db->getConnection();
                            $consulta = "SELECT * FROM users";
                            $resultado = mysqli_query($conex, $consulta);  
                            if ($resultado){
                                while ($row = $resultado->fetch_assoc()){
                                    echo "<tr class='user-row'>";
                                    echo "<td class='p-4 border-b border-blue-gray-50 user-id'>
                                            <div class='flex items-center gap-2'>
                                                <div class='flex flex-col'>
                                                    <p class='block antialiased font-sans text-base leading-normal text-blue-gray-100 font-normal'> ".
                                                        $row["idEmployee"]. "
                                                    </p>
                                                </div>
                                            </div>
                                        </td>";
                                                
                                    echo "<td class='p-4 border-b border-blue-gray-50 user-name'>
                                            <div class='flex items-center gap-3'>
                                                <div class='flex flex-col'>
                                                    <p class='block antialiased uppercase text-base font-sans leading-normal text-blue-gray-100 font-normal'>"
                                                        . $row["firstName"] . " " . $row["lastName"] . 
                                                        "<p class='block antialiased font-sans text-base leading-normal text-blue-gray-900 font-normal opacity-70 user-email'>".  $row["email"] ."
                                                        </p> 
                                                    </p>
                                                </div>
                                            </div>
                                        </td>";
                                    echo "<td class='p-4 border-b border-blue-gray-50 user-username'>
                                            <div class='flex items-center gap-3'>
                                                <div class='flex flex-col'>
                                                    <p class='block antialiased font-sans text-base leading-normal text-blue-gray-100 font-normal'> ".
                                                        $row["username"]. "
                                                    </p>
                                                </div>
                                            </div>
                                        </td>";
                                    echo "<td class='p-4 border-b border-blue-gray-50 user-password'>
                                            <div class='flex items-center gap-3'>
                                                <div class='flex flex-col'>
                                                    <p class='block antialiased font-sans text-base leading-normal text-blue-gray-100 font-normal'> ".
                                                        $row["password"]. "
                                                    </p>
                                                </div>
                                            </div>
                                        </td>";
                                    echo "<td class='p-4 border-b border-blue-gray-50 user-phone'>
                                            <div class='flex items-center gap-3'>
                                                <div class='flex flex-col'>
                                                    <p class='block antialiased font-sans uppercase text-base leading-normal text-blue-gray-100 font-normal'> ".
                                                        $row["phone"]. "
                                                    </p>
                                                </div>
                                            </div>
                                        </td>";
                                    echo "<td class='border-b border-blue-gray-50 user-role'>
                                            <div class='flex items-center gap-3'>
                                                <div class='flex flex-col'>
                                                    <p class='block antialiased font-sans uppercase text-base leading-normal text-blue-gray-100 font-normal'> ".
                                                        $row["role"]. "
                                                    </p>
                                                </div>
                                            </div>
                                        </td>";
                                    echo "<td class='p-4 border-b border-blue-gray-50'>
                                        <a href='../CRUD/editUser.php?idEmployee=" . $row["idEmployee"] . "'> 
                                            <button class='relative align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-10 max-w-[40px] h-10 max-h-[40px] rounded-lg text-xs text-blue-gray-500 hover:bg-gray-500/10 active:bg-gray-500/30' type='button'>
                                                <span class='absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='currentColor' aria-hidden='true' class='h-5 w-5'>
                                                        <path d='M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z'></path>
                                                    </svg>
                                                </span>
                                            </button>
                                        </a>
                                        |
                                        <a href='../CRUD/deleteUser.php?idEmployee=" . $row["idEmployee"] . "'>
                                            <button class='relative align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-10 max-w-[40px] h-10 max-h-[40px] rounded-lg text-xs text-red-500 hover:bg-red-500/10 active:bg-red-500/30' type='button'>
                                                <span class='absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2'>
                                                    <svg xmlns='http://www.rw3.og/2000/svg' viewBox='0 0 24 24' fill='currentColor' aria-hidden='true' class='h-6 w-6'>
                                                        <path d='M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1M18 8H6v12a2 2 0 002 2h8a2 2 0 002-2V8z'></path>
                                                    </svg>
                                                </span>
                                            </button>
                                        </a>
                                    </td>";
                                    echo "<td class='border-b border-blue-gray-50 user-date'>
                                            <div class='flex items-center gap-3'>
                                                <div class='flex flex-col'>
                                                    <p class='block antialiased font-sans uppercase text-base leading-normal text-blue-gray-100 font-normal'> ".
                                                        $row["date_reg"]. "
                                                    </p>
                                                </div>
                                            </div>
                                        </td>";
                                    echo "</tr>";
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
