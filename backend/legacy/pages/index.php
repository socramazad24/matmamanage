<?php
namespace matmanager;
//require_once "vendor/autoload.php";
//require_once "../templates/header2.php";
//require_once "../Database.php";
//use matmanager\Database;
//$db = new Database();
//$conex = $db->getConnection();

class Main {
    public function render() {
        ?> 
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>MAT-MANAGER</title>
                <link rel="stylesheet" href="styles/style.css">
                <script src="tailwind.js" integrity="sha384-pXbtEM0s3abRFqEyAChS+PGW3VqbeR/BWCGz6yIMx1rq9ZyeEtJhfCHyPSUpD3XF" crossorigin="anonymous"></script>
                <script>
                    tailwind.config = {
                        theme: {
                            extend: {
                                colors: {
                                    cPrimary: '#0F0F0F',
                                    cSecondary: '#FEB900'
                                },
                            },
                        },
                    };

                    // JavaScript para cambiar el tipo de entrada de la contraseña
                    function togglePasswordVisibility() {
                        var passwordInput = document.getElementById("password");
                        if (passwordInput.type === "password") {
                            passwordInput.type = "text";
                        } else {
                            passwordInput.type = "password";
                        }
                    }
                </script>
            </head>
            <body>
                <div class="bg-gray-50 flex justify-center items-center h-screen rounded-lg">
                    <div class="w-full lg:w-4/5 xl:w-3/4 flex flex-col lg:flex-row bg-whiteppp rounded-lg shadow-lg">
                        <!-- Left: Image -->
                        <div class="w-1/2 hidden lg:block justify-center bg-cPrimary rounded-md">
                        <img src="images/logo.png?text=MAT-MANAGER&font=Montserrat" alt="images/logo.png" class="object-cover w-max h-max flex items-center mx-auto m-52">
                    </div>

                        <!-- Right: Login Form -->
                        <div class="lg:p-24 md:p-32 sm:p-16 p-8 w-full lg:w-1/2 flex flex-col justify-center">
                            <form action="loginUser.php" method="post">
                                <h1 class="text-3xl font-semibold mb-8">Login</h1>
                                <div class="mb-6">
                                    <label for="username" class="block text-gray-500 font-bold mb-2">Usuario</label>
                                    <input class="block w-full border rounded-md py-3 px-4 focus:outline-none focus:border-yellow-500" type="text" name="username" placeholder="Usuario" autocomplete="off">
                                </div>
                                <div class="mb-6">
                                    <label for="password" class="block text-gray-500 font-bold mb-2">Contraseña</label>
                                    <div class="relative">
                                        <input id="password" class="block w-full border text-semibold rounded-md py-3 px-4 focus:outline-none focus:border-yellow-500" type="password" name="password" placeholder="Contraseña" autocomplete="off">
                                        <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                            <!-- Icono del ojo para mostrar/ocultar la contraseña -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500 hover:text-yellow-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM9 12a1 1 0 11-2 0 1 1 0 012 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <a href="#" class="hover:underline font-semibold text-sm text-yellow-500">¿Olvidó su contraseña?</a>
                                </div>
                                <div class="mb-8">
                                    <input class="text-white bg-cSecondary font-semibold rounded-md py-3 px-6 w-full hover:text-white hover:bg-yellow-500 border border-yellow-500 text-center" type="submit" value="Iniciar sesión">
                                </div>
                            </form>
                            <div id="error-message" style="color: red;"></div>
                        </div>
                    </div>
                </div>
                <footer class='bg-cPrimary text-center py-4 text-white mt-4'>
                    &copy; 2023 MAT-MANAGER
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
