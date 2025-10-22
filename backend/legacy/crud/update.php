<?php
namespace CRUD;
require_once "../templates/header2.php";
require_once "../Database.php";
use matmanager\Database;
use templates\header2;

class UpdateMaterialClass {
    public function UpdateMaterialF() {
        ?>
        <?php
            $db = new Database();
            $conex = $db->getConnection();

            
            $idMaterial = $_POST["idMaterial"];
            $MaterialName = $_POST['MaterialName'];
            $Description = $_POST['Description'];
            $costoUnitario = $_POST['costoUnitario'];
            $cantidadMaterial =$_POST['cantidadMaterial'];
            $idProveedor = $_POST['idProveedor'];                    
            $datereg = date("y/m/d");

            $sentencia = $conex->prepare("UPDATE materiales SET MaterialName=?,Description=?,costoUnitario=?,cantidadMaterial=?,idProveedor=?,date_reg=?
            WHERE idMaterial=?");

            $sentencia->bind_param("ssiisss", $MaterialName ,$Description,$costoUnitario,$cantidadMaterial,$idProveedor,$datereg,$idMaterial );
            $sentencia->execute();
            header("location: ../tables/MaterialsTable.php");

        ?>
        

        
        <?php
    }
}

// Instanciamos la clase y llamamos al método render para generar el HTML
$main = new UpdateMaterialClass();
$main->UpdateMaterialF();
?>
