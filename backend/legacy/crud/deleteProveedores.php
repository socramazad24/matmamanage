<?php
namespace CRUD;
require_once "../templates/header2.php";
require_once "../Database.php";
use matmanager\Database;
use templates\header2;


class DeleteProviderClass {
    public function DeleteProviderF() {
        ?>
        <?php
		$db = new Database();
		$conex = $db->getConnection();

		if (isset($_GET['idProveedor'])) {
			$idProveedor = $_GET['idProveedor'];

			$sql = "DELETE FROM `idProveedores` WHERE idProveedor='$idProveedor'";
			$consulta=mysqli_query($conex,$sql);
			if($consulta){
			echo '<script language="javascript">';
			echo 'alert("Registro eliminado exitósamente");';
			echo 'window.location="../tables/TablaProveedores.php";';
			echo '</script>';
			
			} else {
			echo '<script language="javascript">';
			echo 'alert("Error eliminando registro!");';
			echo 'window.location="../tables/TablaProveedores.php";';
			echo '</script>';
			}
		}
?>

        
        <?php
    }
}

// Instanciamos la clase y llamamos al método render para generar el HTML
$main = new DeleteProviderClass();
$main->DeleteProviderF();
?>
