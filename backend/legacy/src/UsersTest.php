<?php
class registrarUsuario{
public function registrarUsuario($idEmployee, $firstName, $lastName, $username, $password, $email, $phone, $role, $conex) {
    if (
        strlen($_POST['idEmployee']) >= 1 &&
    strlen($_POST['firstName']) >= 1 &&
    strlen($_POST['lastName']) >= 1 &&
    strlen($_POST['username']) >= 1 &&
    strlen($_POST['password']) >= 1 &&
    strlen($_POST['email']) >= 1 &&
    strlen($_POST['phone']) >= 1 &&
    strlen($_POST['role']) >= 1  ) {

      
        $datereg = date("y/m/d");
        include("../validaciones/validarUsuarios.php");

        $consultaUser = "SELECT * FROM users WHERE username = '$username'";
        $resultadoUser = mysqli_query($conex, $consultaUser);

        if (mysqli_num_rows($resultadoUser) > 0) {
            // El usuario ya existe, muestra un mensaje de error
            //echo "El usuario ya existe. Por favor, elige otro nombre de usuario.";
            ?>
            <h3 class="bad">El usuario ya existe. Por favor, elige otro nombre de usuario."</h3>
            <?php
        } else {
            // El usuario no existe, puedes proceder con el registro          
            
            $consulta = "INSERT INTO users(idEmployee,firstName, lastName, username, password, email, phone, role, date_reg) 
            VALUES ('$idEmployee','$firstName','$lastName','$username','$password','$email','$phone','$role','$datereg')";
            $resultado = mysqli_query($conex, $consulta);
            if ($resultado){
                ?>
                <h3 class="ok">te has registrado exitosamente</h3>
                <?php 
            } else {
                ?>
                <h3 class="bad">algo ha salido mal</h3>
                <?php 
            } 
        }

        
    }else {
        ?>
        <h3 class="bad">llene todos los campos</h3>
        <?php 
    }
}}
            ?>
