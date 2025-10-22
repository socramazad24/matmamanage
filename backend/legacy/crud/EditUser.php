<?php
namespace CRUD;
require_once "../templates/header2.php";
require_once "../Database.php";
use matmanager\Database;
use templates\header2;
$db = new Database();
$conex = $db->getConnection();

class EditUserClass {
    public function EditUserF() {
        ?>
        
        <!-- component -->
        <!DOCTYPE html>
            <?php

            $db = new Database();
            $conex = $db->getConnection();


            $idEmployee = $_GET['idEmployee'];
            $sentencia = $conex->prepare("SELECT * FROM users WHERE idEmployee=?");
            $sentencia->bind_param("s",$idEmployee);
            $sentencia-> execute();
            $resultado = $sentencia -> get_Result();
            $result=$resultado->fetch_assoc();
            if (!$result) {    
                echo '<script language="javascript">';
                echo 'alert("no hay resultados para ese id");';
                //echo 'window.location="../tables/TablaPedidos.php";';
                echo '</script>';
            }
            ?>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <script src="../tailwind.js" integrity="sha384-pXbtEM0s3abRFqEyAChS+PGW3VqbeR/BWCGz6yIMx1rq9ZyeEtJhfCHyPSUpD3XF" crossorigin="anonymous"></script>
            <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
            <title>Editar Usuario</title>
        </head>
        <body class='bg-gray-100'>
            <header> 
                <?php $pageTitle = "Header"; include '../templates/header.php';?>
            </header>
            <div class="h-full p-8 ">
                <div class="h-full bg-gray-100 rounded-lg shadow-xl pb-8">
                    
                    <div class="w-full h-[250px]">
                        <img src="https://vojislavd.com/ta-template-demo/assets/img/profile-background.jpg" class="w-full h-full rounded-tl-lg rounded-tr-lg">
                    </div>
                    <div class="flex flex-col items-center -mt-20">
                        <img src="https://vojislavd.com/ta-template-demo/assets/img/profile.jpg" class="w-40 border-4 border-white rounded-full">
                        <div class="flex items-center space-x-2 mt-2">
                            <span class="text-gray-700 uppercase"><?php echo $result["firstName"] . " " . $result["lastName"]; ?></span>
                        </div>
                        <span class="text-sm text-gray-500 uppercase"><?php echo $result["role"] . ",  " . $result["idEmployee"]; ?></span>
                    </div>
                </div>
                <div class="my-4 flex justify-end items-end flex-col 2xl:flex-row space-y-4 2xl:space-y-0 2xl:space-x-4 ">
                    <div class="w-full flex flex-col 2xl:w-1/3 ">
                        <div class="flex-1 bg-white rounded-lg shadow-xl p-8 " >
                            <h4 class="text-xl text-gray-900 font-bold ">Informacion Personal</h4>
                            <form action="updateUser.php" method="post">
                                <ul class=" text-gray-700">
                                    <li class="flex border-y py-2 border-yellow-500">
                                        <span class="font-bold w-24">Cedula:</span>
                                        <span class="text-gray-700"><input class="block w-full bg-white border border-gray-300 hover:border-gray-600 px-4 py-1 rounded-md shadow-sm focus:outline-none focus:border-yellow-500 focus:ring focus:ring-amber-400 focus:ring-opacity-15" type="text" name="idEmployee" value="<?php echo $result["idEmployee"] ?>" placeholder="id usuario"></span>
                                    </li>
                                    <li class="flex border-y py-2 border-yellow-500">
                                        <span class="font-bold w-24">Primer Nombre:</span>
                                        <span class="text-gray-700"><input class="block w-full bg-white border border-gray-300 hover:border-gray-600 px-4 py-1 mt-2 rounded-md shadow-sm focus:outline-none focus:border-yellow-500 focus:ring focus:ring-amber-400 focus:ring-opacity-15" type="text"  name="firstName" value="<?php echo $result["firstName"] ?>" placeholder="firstName"></span>
                                    </li>
                                    <li class="flex border-y py-2 ">
                                        <span class="font-bold w-24">Primer Apellido:</span>
                                        <span class="text-gray-700"><input class="block w-full bg-white border border-gray-300 hover:border-gray-600 px-4 py-1 mt-2 rounded-md shadow-sm focus:outline-none focus:border-yellow-500 focus:ring focus:ring-amber-400 focus:ring-opacity-15" type="text"  name="lastName" value="<?php echo $result["lastName"] ?>" placeholder="lastName"></span>
                                    </li>
                                    <li class="flex border-y py-2 border-yellow-500">
                                        <span class="font-bold w-24">Usuario:</span>
                                        <span class="text-gray-700"><input class="block w-full bg-white border hover:border-gray-600 px-4 py-1 rounded-md shadow-sm focus:outline-none focus:border-yellow-500 focus:ring focus:ring-amber-400 focus:ring-opacity-15" type="text"  name="username" value="<?php echo $result["username"] ?>" placeholder="username" ></span>
                                    </li>
                                    <li class="flex border-b py-2 border-yellow-500">
                                        <span class="font-bold w-24">Contraseña:</span>
                                        <span class="text-gray-700"> <input class="block w-full bg-white border border-gray-300 hover:border-gray-600 px-4 py-1 rounded-md shadow-sm focus:outline-none focus:border-yellow-500 focus:ring focus:ring-amber-400 focus:ring-opacity-15" type="text"  name="password" value="<?php echo $result["password"] ?>" placeholder="password" ></span>
                                    </li>
                                    <li class="flex border-b py-2 border-yellow-500">
                                        <span class="font-bold w-24">Correo Electronico:</span>
                                        <span class="text-gray-700"><input class="block w-full bg-white border border-gray-300 hover:border-gray-600 px-4 py-1 mt-2 rounded-md shadow-sm focus:outline-none focus:border-yellow-500 focus:ring focus:ring-amber-400 focus:ring-opacity-15" type="email"  name="email" value="<?php echo $result["email"] ?>" placeholder="email" ></span>
                                    </li>
                                    <li class="flex border-b py-2 border-yellow-500">
                                        <span class="font-bold w-24">Telefono:</span>
                                        <span class="text-gray-700"><input class="block w-full bg-white border border-gray-300 hover:border-gray-600 px-4 py-1 rounded-md shadow-sm focus:outline-none focus:border-yellow-500 focus:ring focus:ring-amber-400 focus:ring-opacity-15" type="tel"  name="phone" value="<?php echo $result["phone"] ?>" placeholder="phone" ></span>
                                    </li>
                                    <li class="flex border-b py-2 border-yellow-500">
                                        <span class="font-bold w-24 block appearance-none">Fecha de Inicio:</span>
                                        <span class="text-gray-700"><input class="block w-full bg-white border border-gray-300 hover:border-gray-600 px-4 py-1 mt-2 rounded-md shadow-sm focus:outline-none focus:border-yellow-500 focus:ring focus:ring-amber-400 focus:ring-opacity-15" type="text"  name="fecha" value="<?php echo $result["date_reg"] ?>" placeholder="AAAA-MM-DD" ></span>
                                    </li>
                                    
                                
                                    <li class="flex border-b py-2 border-yellow-500">
                                        <span class="font-bold w-24">Rol:</span>
                                        <span class="text-gray-700">
                                        <select id="role" name="role" class="block appearance-none w-full bg-white border border-gray-300 hover:border-gray-600 px-4 py-1 rounded-md shadow-sm focus:outline-none focus:border-yellow-500 focus:ring focus:ring-amber-400 focus:ring-opacity-15">
                                        <option value=""><?php echo $result["role"] ?></option>
                                        <option value="administrador">Administrador</option>
                                        <option value="gerente">Gerente</option>
                                        <option value="bodeguero">Bodeguero</option>
                                        </select></span>
                                    </li>
                                    
                                </ul>
                                
                                <input class="w-full mt-3 block text-base font-semibold text-gray-700 bg-transparent border border-[#D4DEFF] rounded-md text-center p-3 hover:text-white hover:bg-yellow-500 focus:outline-none focus:border-yellow-500 focus:ring focus:ring-amber-400 focus:ring-opacity-15
                                    " type="submit" name="register" value="Guardar">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <footer> 
                <?php $pageTitle = "Footer"; include '../templates/footer.php';?>
            </footer>
        </body>
        </html>
        

        
        <?php
    }
}

// Instanciamos la clase y llamamos al método render para generar el HTML
$main = new EditUserClass();
$main->EditUserF();
?>
