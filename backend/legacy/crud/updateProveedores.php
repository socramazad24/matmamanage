<?php
namespace CRUD;
require_once "../templates/header2.php";
require_once "../Database.php";
use matmanager\Database;
use templates\header2;


class UpdateProviderClass {
    public function UpdateProviderF() {
        ?>
        <?php
            $db = new Database();
            $conex = $db->getConnection();

            
            $idProveedor = trim($_POST['idProveedor']);
            $nombre = trim($_POST['nombre']);
            $materiales = trim($_POST['materiales']);
            $telefono = trim($_POST['telefono']);
            $correo = trim($_POST['correo']); 
            $direccion = trim($_POST['direccion']);
            $datereg = date("y/m/d");                     
            //UPDATE idProveedores SET idProveedor='[value-1]',nameProveedor='[value-2]',`='[value-3]',='[value-4]',='[value-5]',`='[value-6]',date_reg='[value-7]' WHERE 1
            $sentencia = $conex->prepare("UPDATE idProveedores SET idProveedor=?,nameProveedor=?,materiales=?,telefono=?,correo=?,direccion=?,date_reg=?
            WHERE idProveedor=?");

            $sentencia->bind_param("sssissss", $idProveedor ,$nombre,$materiales,$telefono,$correo,$direccion,$datereg,$idProveedor );
            $sentencia->execute();
            header("location: ../tables/TablaProveedores.php");

        ?>

        

        
        <?php
    }
}

// Instanciamos la clase y llamamos al método render para generar el HTML
$main = new UpdateProviderClass();
$main->UpdateProviderF();
?>
