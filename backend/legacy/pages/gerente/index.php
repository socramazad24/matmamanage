<?php
namespace gerente;
require_once "../vendor/autoload.php";
require_once "../Database.php";
//require_once "../Auth.php";
use matmanager\Database;
use templates\header3;
use templates\Footer;
$db = new Database();
$conex = $db->getConnection();

class Main {
    public function render() {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <link rel="stylesheet" href="../styles/style.css">
        </head>
        <body>
            <header> 
                <?php $pageTitle = "Header"; 
                    $header = new header3;
                    $header -> head3($pageTitle);
                ?>
            </header>

        </body>

        <footer>
        <?php $pageTitle = "Footer"; 
                    $Footer = new Footer;
                    $Footer -> footer($pageTitle);
                ?>
        </footer>

        </html>
        </html>
        

        
        <?php
    }
}

// Instanciamos la clase y llamamos al método render para generar el HTML
$main = new Main();
$main->render();
?>
