<?php
namespace CRUD;
require_once "../templates/header2.php";
require_once "../Database.php";
use matmanager\Database;

class EditPedidoClass {
    public function EditPedidoF() {
        ?>
        <?php

            $db = new Database();
            $conex = $db->getConnection();


            $idPedido = $_GET['idPedido'];
            $sentencia = $conex->prepare("SELECT * FROM pedidos WHERE idPedido=?");
            $sentencia->bind_param("s",$idPedido);
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

            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
                <link rel="stylesheet" href="../styles/style.css">
            </head>
            <body>
                <header>
                    <h1>MAT-MANAGER</h1>
                    <nav>
                        <div class="menu-icon">
                            <i class="fa fa-bars"></i>
                        </div>
                        <ul class="menu">
                            <li><a href="index.php">Inicio</a></li>   
                            <li><a href="../tables/TablaPedidos.php">pedidos</a></li>
                            <li><a href="../logout.php">cerrar sesion</a></li>
                        </ul>
                    </nav>
                </header>

                <div class="container">
                    <h2>modificar pedidos</h2>
                    <form action="updatePedidos.php" method="post">

                        <input type="text"  name="idPedido" value="<?php echo $result["idPedido"] ?>" placeholder="id idPedido" >

                        <select name="nameProveedor" id="nameProveedor" >
                                <option value="">elija idProveedor</option>
                                <option value="cobre">cobre</option>
                                <option value="argo">argo</option>
                                <option value="megamex">megamex</option>
                        </select>  

                        <input type="text"  name="materiales" value="<?php echo $result["materiales"] ?>" placeholder="nombre del material" >

                        <input type="number"  name="cantidad" value="<?php echo $result["cantidad"] ?>" placeholder="cantidad" >

                        <input type="number"  name="costoUnitario" value="<?php echo $result["costoUnitario"] ?>" placeholder="costo Unitario" >            
                                    
                        <br><br>
                        <input type="submit" name="register" value="guardar">
                    </form>  
                    
                    
                </div>
            


            

                <footer>
                    &copy; 2023 MAT-MANAGER
                </footer>

            </body>
            </html>
            </html>
        

        
        <?php
    }
}

// Instanciamos la clase y llamamos al método render para generar el HTML
$main = new EditPedidoClass();
$main->EditPedidoF();
?>
