<?php
namespace CRUD;
require_once "../templates/header2.php";
require_once "../Database.php";
use matmanager\Database;
use templates\header2;

class DeleteMaterialClass {
    public function DeleteMaterialF() {
        ?>
		<?php
		$db = new Database();
		$conex = $db->getConnection();
		

		if (isset($_GET['idMaterial'])) {
			$idMaterial = $_GET['idMaterial'];

			$sql = "DELETE FROM `materiales` WHERE idMaterial='$idMaterial'";
			$consulta=mysqli_query($conex,$sql);
			if($consulta){
			echo '<script language="javascript">';
			echo 'alert("Registro eliminado exitósamente");';
			echo 'window.location="../tables/MaterialsTable.php";';
			echo '</script>';
			
			} else {
			echo '<script language="javascript">';
			echo 'alert("Error eliminando registro!");';
			//echo 'window.location="../tables/MaterialsTable.php";';
			echo '</script>';
			}
		}



		?>
        

        
        <?php
    }
}

// Instanciamos la clase y llamamos al método render para generar el HTML
$main = new DeleteMaterialClass();
$main->DeleteMaterialF();
?>
