<?php 

   
        if(strlen($IdMaterial) > 4 ) {
            ?>
            <h3 class="bad">El id del material excede el límite de caracteres permitido (4 caracteres de la forma N000) .</h3>
            <?php
            exit(); // Detener la ejecución si el nombre excede el límite de caracteres
        }
        if(strlen($MaterialName) > 30 ) {
            ?>
            <h3 class="bad">El nombre del material excede el límite de caracteres permitido (30 caracteres).</h3>
            <?php
            exit(); // Detener la ejecución si el nombre excede el límite de caracteres
        }
        if(strlen($Description) > 100 ) {
            ?>
            <h3 class="bad">la descripcion del material excede el límite de caracteres permitido (100 caracteres).</h3>
            <?php
            exit(); // Detener la ejecución si el nombre excede el límite de caracteres
        }
        if($costoUnitario > 999999 && $costoUnitario < 10000) {
            ?>
            <h3 class="bad">El costo no esta dentro del rango permitido  (mínimo 10000 máximo 999999).</h3>
            <?php
            exit(); // Detener la ejecución si el nombre excede el límite de caracteres
        }
        if($cantidadMaterial > 10 && $cantidadMaterial < 1) {
            ?>
            <h3 class="bad">la cantidad no esta dentro del rango permitido  (mínimo 1 máximo 100).</h3>
            <?php
            exit(); // Detener la ejecución si el nombre excede el límite de caracteres
        }
        if(strlen($idProveedor) > 50 ) {
            ?>
            <h3 class="bad">el nombre del proveedor excede el límite de caracteres permitido (50 caracteres).</h3>
            <?php
            exit(); // Detener la ejecución si el nombre excede el límite de caracteres
        } 
    
?>
