<?php
namespace CRUD;
require_once "../templates/header2.php";
require_once "../Database.php";
use matmanager\Database;
use templates\header2;
$db = new Database();
$conex = $db->getConnection();

class EditProviderClass {
    public function EditProviderF() {
        ?>
        <?php

        $db = new Database();
        $conex = $db->getConnection();


        $idProveedor = $_GET['idProveedor'];
        $sentencia = $conex->prepare("SELECT * FROM idProveedores WHERE idProveedor=?");
        $sentencia->bind_param("s",$idProveedor);
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

        <?php include ("../templates/header.php"); ?>

        <div class="container">
                <h2>editar Proveedores</h2>
                <form action='updateProveedores.php' method="post">
                    <input type="text"  name="idProveedor" value="<?php echo $result["idProveedor"] ?>" placeholder="id Proveedor" >

                    <input type="text"  name="nombre" value="<?php echo $result["nameProveedor"] ?>" placeholder="nombre de proveedor" >            

                    <select name="materiales" id="materiales" >
                            <option value="">elija material</option>
                            <option value="cobre">cobre</option>
                            <option value="cemento">cemento</option>
                            <option value="hierro">cemento</option>
                    </select>   
                    <input type="text"  name="telefono" value="<?php echo $result["telefono"] ?>" placeholder="telefono" >
                    <input type="email"  name="correo" value="<?php echo $result["correo"] ?>" placeholder="correo" >       
                    <input type="text"  name="direccion"  value="<?php echo $result["direccion"] ?>" placeholder="direccion" >  
                    <br><br>
                    <input type="submit" name="register" value="editar">
                </form>  
                
                
            </div>
        

            <?php include ("../templates/footer.php"); ?>

        
        <?php
    }
}

// Instanciamos la clase y llamamos al método render para generar el HTML
$main = new EditProviderClass();
$main->EditProviderF();
?>
