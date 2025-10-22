<?php
namespace CRUD;
require_once "../Database.php";
use matmanager\Database;
$db = new Database();
$conex = $db->getConnection();

class EditMaterialClass {
    public function EditMaterialF() {
        ?>
        <?php
        $db = new Database();
        $conex = $db->getConnection();


        $idMaterial = $_GET['idMaterial'];
        $sentencia = $conex->prepare("SELECT * FROM materiales WHERE idMaterial=?");
        $sentencia->bind_param("s",$idMaterial);
        $sentencia-> execute();
        $resultado = $sentencia -> get_Result();
        $result=$resultado->fetch_assoc();
        if (!$result) {    
            echo '<script language="javascript">';
            echo 'alert("no hay resultados para ese id");';
            echo 'window.location="../tables/MaterialsTable.php";';
            echo '</script>';
        }
        ?>

        <?php include ("../templates/header.php"); ?>

            <div class="container">
                <h2>modificar Materiales</h2>
                <form action="update.php" method="post">

                    <input type="text"  name="idMaterial" value="<?php echo $result["idMaterial"] ?>" placeholder="id delmaterial" >

                    <input type="text"  name="MaterialName" value="<?php echo $result["MaterialName"] ?>" placeholder="nombre del material" >

                    <input type="text"  name="Description" value="<?php echo $result["Description"] ?>" placeholder="descripcion del material" >

                    <input type="number"  name="costoUnitario" value="<?php echo $result["costoUnitario"] ?>" placeholder="costo Unitario" >            
                    
                    <input type="number"  name="cantidadMaterial" value="<?php echo $result["cantidadMaterial"] ?>" placeholder="cantidad de material" >

                    <select name="idProveedor" id="idProveedor" >
                            <option value="">elija proveedor</option>
                            <option value="cobre">cobre</option>
                            <option value="argo">argo</option>
                            <option value="megamex">megamex</option>
                    </select>            
                    
                    <br><br>
                    <input type="submit" name="register" value="guardar">
                </form>  
                
                
            </div>
        

            <?php include ("../templates/footer.php"); ?>

                
        <?php
    }
}

// Instanciamos la clase y llamamos al método render para generar el HTML
$main = new EditMaterialClass();
$main->EditMaterialF();
?>
