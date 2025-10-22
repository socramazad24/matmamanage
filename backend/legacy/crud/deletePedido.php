<?php
namespace CRUD;
require_once "../templates/header2.php";
require_once "../Database.php";
use matmanager\Database;
use templates\header2;


class DeletePedidoClass {
    public function DeletePedidoF() {
        ?>
		<?php
        $db = new Database();
		$conex = $db->getConnection();
		if (isset($_GET['idPedido'])) {
			$idPedido = $_GET['idPedido'];

			$sql = "DELETE FROM `pedidos` WHERE idPedido='$idPedido'";
			$consulta=mysqli_query($conex,$sql);
			if($consulta){
			echo '<script language="javascript">';
			echo 'alert("Registro eliminado exitósamente");';
			echo 'window.location="../tables/TablaPedidos.php";';
			echo '</script>';
			
			} else {
			echo '<script language="javascript">';
			echo 'alert("Error eliminando registro!");';
			echo 'window.location="../tables/TablaPedidos.php";';
			echo '</script>';
			}
		}
		?>
				
				<?php
			}
		}

// Instanciamos la clase y llamamos al método render para generar el HTML
$main = new DeletePedidoClass();
$main->DeletePedidoF();
?>
