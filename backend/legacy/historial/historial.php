<?php
namespace historial;
require_once "../vendor/autoload.php";
require_once "../Database.php";
use templates\header;
use templates\Footer;


class Main {
    public function render() {
        ?>
        <html lang="en">
        <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Registros Mat-Manager</title>
        </head>
        <body>
          
          <!-- component -->
          
          <header> 
            <?php $pageTitle = "Header"; 
                $header = new header;
                $header->head($pageTitle);?>
          </header>
          <div id="blog" class="bg-gray-100 px-16 xl:px-12 py-5 w-screen  flex justify-items-stretch">
            <div class=" w-max py-4">
              <div>
                <div class="grid sm:grid-cols-1 lg:grid-cols-2 xl:grid-cols-2 gap-24 ">
                  <div tabindex="0" class="focus:outline-none ml-48" >
                    <div class="py-2 px-4 w-full flex justify-start bg-amber-500">
                      <p class="focus:outline-none  text-sm text-white font-semibold tracking-wide">Registros Usuarios</p>
                    </div>
                    <div class="bg-white px-1 lg:px-6 py-4 rounded-bl-3xl rounded-br-xl">
                      <h1 tabindex="0" class="focus:outline-none text-xl text-gray-900 font-semibold tracking-wider">Historial de Usuario</h1>
                      <p tabindex="0" class="focus:outline-none text-gray-700 text-sm lg:text-base lg:leading-8 pr-4 tracking-wide mt-2">
                        Registros de todos los usuarios de la base de datos, sus estados y fecha de realizacion de sus distintos estados.

                      </p>
                      <div class="w-full flex justify-end" >
                        <button class="focus:outline-none focus:ring-2 ring-offset-2 focus:ring-gray-600 hover:opacity-75 mt-4 justify-end flex items-center cursor-pointer">
                          <span class=" text-base tracking-wide text-amber-500">
                            <a href="historialUsuarios.php" class="button">Ir al Historial Usuario</span>
                              <svg class="ml-3 lg:ml-6 text-amber-500"  xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 20 18" fill="none">
                                <path d="M11.7998 1L18.9998 8.53662L11.7998 16.0732" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M1 8.53662H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                              </svg>
                            </a>
                        </button>
                      </div>
                    </div>            
                  </div>
                  <div  tabindex="0" class="focus:outline-none py-1 mr-48">
                    <div class="py-2 px-4 w-full flex justify-between bg-amber-500">
                      <p tabindex="0" class="focus:outline-none text-sm text-white font-semibold tracking-wide">Registros Materiales</p>
                    </div>
                    <div class="bg-white px-3 lg:px-6 py-4 rounded-bl-3xl rounded-br-3xl ">
                      <h1 tabindex="0" class="focus:outline-none text-lg text-gray-900 font-semibold tracking-wider">Historial de Materiales</h1>
                      <p tabindex="0" class="focus:outline-none text-gray-700 text-sm lg:text-base lg:leading-8 pr-4 tracking-wide mt-2">
                      Registros de todos los materiales de la base de datos, sus estados y fecha de realizacion de sus distintos estados.
                      </p>
                        <div class="w-full flex justify-end" >
                          <button class="focus:outline-none focus:ring-2 ring-offset-2 focus:ring-gray-600 hover:opacity-75 mt-4 justify-end flex items-center cursor-pointer">
                          <span class=" text-base tracking-wide text-amber-500">
                          <a href="historialMateriales.php" class="button">Ir al Historial Materiales</span>
                              <svg class="ml-3 lg:ml-6 text-amber-500"  xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 20 18" fill="none">
                                <path d="M11.7998 1L18.9998 8.53662L11.7998 16.0732" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M1 8.53662H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                              </svg>
                            </a>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="grid sm:grid-cols-1 lg:grid-cols-2 xl:grid-cols-2 gap-24 justify-center">
                    <div tabindex="0" class="focus:outline-none py-5 ml-48">
                      <div class="py-2 px-4 w-full flex justify-between bg-amber-500">
                        <p tabindex="0" class="focus:outline-none text-sm text-white font-semibold tracking-wide">Registro de Pedidos</p>
                      </div>
                      <div class="bg-white px-3 lg:px-6 py-4 rounded-bl-3xl rounded-br-3xl">
                        <h1 tabindex="0" class="focus:outline-none text-lg text-gray-900 font-semibold tracking-wider">Historial de Pedidos</h1>
                        <p tabindex="0" class="focus:outline-none text-gray-700 text-sm lg:text-base lg:leading-8 pr-4 tracking-wide mt-2">
                        Registros de todos los pedidos de la base de datos, sus estados y fecha de realizacion de sus distintos estados.</p>
                        <div class="w-full flex justify-end">
                          <button class="focus:outline-none focus:ring-2 ring-offset-2 focus:ring-gray-600 hover:opacity-75 mt-4 justify-end flex items-center cursor-pointer">
                            <span class=" text-base tracking-wide text-amber-500">
                              <a href="historialPedidos.php" class="button">Historial Pedidos</span>
                                <svg class="ml-3 lg:ml-6 text-amber-500"  xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 20 18" fill="none">
                                  <path d="M11.7998 1L18.9998 8.53662L11.7998 16.0732" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                  <path d="M1 8.53662H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                              </a>
                          </button>
                        </div></div>
                      </div>
                      <div tabindex="0" class="focus:outline-none py-5 mr-48">
                        <div class="py-2 px-4 w-full flex justify-between bg-amber-500">
                          <p tabindex="0" class="focus:outline-none text-sm text-white font-semibold tracking-wide">Registros de Proveedores</p>
                        </div>
                        <div class="bg-white px-3 lg:px-6 py-4 rounded-bl-3xl rounded-br-3xl">
                          <h1 tabindex="0" class="focus:outline-none  text-lg text-gray-900 font-semibold tracking-wider">Historial de Proveedores</h1>
                          <p tabindex="0" class="focus:outline-none  text-gray-700 text-sm lg:text-base lg:leading-8 pr-4 tracking-wide mt-2">
                          Registros de todos los proveedores de la base de datos, sus estados y fecha de realizacion de sus distintos estados.
                        </p>
                          <div class="w-full flex justify-end" >
                            <button class="focus:outline-none focus:ring-2 ring-offset-2 focus:ring-gray-600 hover:opacity-75 mt-4 justify-end flex items-center cursor-pointer">
                              <span class=" text-base tracking-wide text-amber-500">
                                <a href="historialProveedores.php" class="button">Ir al Historial Proveedores</a></span>
                                  <svg class="ml-3 lg:ml-6 text-amber-500"  xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 20 18" fill="none">
                                    <path d="M11.7998 1L18.9998 8.53662L11.7998 16.0732" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M1 8.53662H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                  </svg>
                                </a>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
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
