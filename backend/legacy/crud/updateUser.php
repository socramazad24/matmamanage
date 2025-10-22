<?php
namespace CRUD;
require_once "../templates/header2.php";
require_once "../Database.php";
use matmanager\Database;
use templates\header2;


class updateUserClass {
    public function updateUserF() {
        ?>
        <?php
            $db = new Database();
            $conex = $db->getConnection();

            $idEmployee = $_POST['idEmployee'];
            $firstName = $_POST["firstName"];
            $lastName = $_POST['lastName'];
            $username = $_POST['username'];
            $password =$_POST['password'];  
            $email =$_POST['email'];
            $phone =$_POST['phone'];     
            $role =$_POST['role'];                           
            $datereg = date("y/m/d");

            $sentencia = $conex->prepare("UPDATE users SET firstName=?,lastName=?,username=?,password=?,email=?,phone=?,role=?,date_reg=? 
            WHERE idEmployee=?");

            $sentencia->bind_param("sssssisss", $firstName ,$lastName,$username,$password,$email,$phone,$role,$datereg,$idEmployee );
            $sentencia->execute();
            header("location: ../tables/recuperarUsuarios.php");

        ?>
                

        
        <?php
    }
}

// Instanciamos la clase y llamamos al método render para generar el HTML
$main = new updateUserClass();
$main->updateUserF();
?>
