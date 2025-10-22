<?php
namespace CRUD;
require_once "../templates/header2.php";
require_once "../Database.php";
use matmanager\Database;
use templates\header2;


class UpdatePedidoClass {
    public function UpdatePedidoF() {
        ?>
        <?php
            $db = new Database();
            $conex = $db->getConnection();
            
            $idPedido = $_POST["idPedido"];
            $nameProveedor = $_POST['nameProveedor'];
            $materiales = $_POST['materiales'];
            $cantidad = $_POST['cantidad'];
            $costoUnitario =$_POST['costoUnitario'];                  
            $datereg = date("y/m/d");

            $sentencia = $conex->prepare("UPDATE pedidos SET nameProveedor=?,materiales=?,cantidad=?,costoUnitario=?,fecha_reg=? 
            WHERE idPedido=?");

            $sentencia->bind_param("ssiiss", $nameProveedor ,$materiales,$cantidad,$costoUnitario,$datereg,$idPedido );
            $sentencia->execute();
            header("location: ../tables/TablaPedidos.php");

        ?>
                

        
        <?php
    }
}

// Instanciamos la clase y llamamos al método render para generar el HTML
$main = new UpdatePedidoClass();
$main->UpdatePedidoF();
?>
