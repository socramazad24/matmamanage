<?php
namespace CRUD;
require_once "../templates/header2.php";
require_once "../Database.php";
use matmanager\Database;
use templates\header2;


class DeleteUserClass {
    public function DeleteUserF() {
        ?>
        <?php
        $db = new Database();
        $conex = $db->getConnection();

        if (isset($_GET['idEmployee'])) {
                $idEmployee = $_GET['idEmployee'];

                $sql = "DELETE FROM `users` WHERE idEmployee='$idEmployee'";
                $consulta=mysqli_query($conex,$sql);
                if($consulta){
                echo '<script language="javascript">';
                echo 'alert("Registro eliminado exitósamente");';
                echo 'window.location="../tables/recuperarUsuarios.php";';
                echo '</script>';
                
                } else {
                echo '<script language="javascript">';
                echo 'alert("Error eliminando registro!");';
                echo 'window.location="../tables/recuperarUsuarios.php";';
                echo '</script>';
                }
        }
        ?>
        
        <?php
    }
}

// Instanciamos la clase y llamamos al método render para generar el HTML
$main = new DeleteUserClass();
$main->DeleteUserF();
?>
