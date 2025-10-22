<?php 

   
        if(strlen($idEmployee) > 10 ) {
            ?>
            <h3 class="bad">El id del usuario excede el límite de caracteres permitido (10 caracteres).</h3>
            <?php
            exit(); // Detener la ejecución si el nombre excede el límite de caracteres
        }
        if(strlen($firstName) > 30 ) {
            ?>
            <h3 class="bad">El nombre del usuario excede el límite de caracteres permitido (30 caracteres).</h3>
            <?php
            exit(); // Detener la ejecución si el nombre excede el límite de caracteres
        }
        if(strlen($lastName) > 30 ) {
            ?>
            <h3 class="bad">nombre del usuario excede el límite de caracteres permitido (30 caracteres).</h3>
            <?php
            exit(); // Detener la ejecución si el nombre excede el límite de caracteres
        }
        if(strlen($username) > 30 ) {
            ?>
            <h3 class="bad">El numero del usuario excede el límite de caracteres permitido (30 caracteres).</h3>
            <?php
            exit(); // Detener la ejecución si el nombre excede el límite de caracteres
        }
        if(strlen($password) > 30 ) {
            ?>
            <h3 class="bad">El correo del usuario excede el límite de caracteres permitido (30 caracteres).</h3>
            <?php
            exit(); // Detener la ejecución si el nombre excede el límite de caracteres
        }
        if(strlen($email) > 30 ) {
            ?>
            <h3 class="bad">la direccion del usuario excede el límite de caracteres permitido (30 caracteres).</h3>
            <?php
            exit(); // Detener la ejecución si el nombre excede el límite de caracteres
        } 
        if(strlen($phone) > 50 ) {
            ?>
            <h3 class="bad">la direccion del usuario excede el límite de caracteres permitido (50 caracteres).</h3>
            <?php
            exit(); // Detener la ejecución si el nombre excede el límite de caracteres
        }
        if(strlen($role) > 20 ) {
            ?>
            <h3 class="bad">la direccion del usuario excede el límite de caracteres permitido.</h3>
            <?php
            exit(); // Detener la ejecución si el nombre excede el límite de caracteres
        }
    
?>
