<?php 

   
        if(strlen($idProveedor) > 10 ) {
            ?>
            <h3 class="bad">El id del proveedor excede el límite de caracteres permitido (10 caracteres).</h3>
            <?php
            exit(); // Detener la ejecución si el nombre excede el límite de caracteres
        }
        if(strlen($nombre) > 30 ) {
            ?>
            <h3 class="bad">El nombre del proveedor excede el límite de caracteres permitido (30 caracteres).</h3>
            <?php
            exit(); // Detener la ejecución si el nombre excede el límite de caracteres
        }
        if(strlen($materiales) > 50 ) {
            ?>
            <h3 class="bad">material del proveedor excede el límite de caracteres permitido (1 caracteres).</h3>
            <?php
            exit(); // Detener la ejecución si el nombre excede el límite de caracteres
        }
        if(strlen($telefono) > 10 ) {
            ?>
            <h3 class="bad">El numero del proveedor excede el límite de caracteres permitido (50 caracteres).</h3>
            <?php
            exit(); // Detener la ejecución si el nombre excede el límite de caracteres
        }
        if(strlen($correo) > 50 ) {
            ?>
            <h3 class="bad">El correo del proveedor excede el límite de caracteres permitido (50 caracteres).</h3>
            <?php
            exit(); // Detener la ejecución si el nombre excede el límite de caracteres
        }
        if(strlen($direccion) > 50 ) {
            ?>
            <h3 class="bad">la direccion del proveedor excede el límite de caracteres permitido (50 caracteres).</h3>
            <?php
            exit(); // Detener la ejecución si el nombre excede el límite de caracteres
        } 
    
?>
