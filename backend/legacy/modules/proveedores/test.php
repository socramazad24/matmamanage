<?php
namespace MaterialRegister;
require_once "../templates/header2.php";
require_once "../Database.php";
use matmanager\Database;
use templates\header2;

// Función para mostrar el formulario de registro
function showForm()
{
    ?>
        
            <?php
}

// Función para manejar el registro del material
function handleFormSubmission()
{
    $db = new Database();
    $conex = $db->getConnection();

    
    
}

// Lógica para mostrar el formulario o manejar la sumisión
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    handleFormSubmission();
    showForm();
} else {
    showForm();
}
?>



<?php
namespace index;
require_once "../templates/header2.php";
require_once "../Database.php";
use matmanager\Database;
use templates\header2;
$db = new Database();
$conex = $db->getConnection();

class Main {
    public function render() {
        ?>
        

        
        <?php
    }
}

// Instanciamos la clase y llamamos al método render para generar el HTML
$main = new Main();
$main->render();
?>
