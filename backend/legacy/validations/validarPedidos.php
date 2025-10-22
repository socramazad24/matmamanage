<?php    
        if(strlen($idPedido) > 10 ) {
            ?>
            <h3 class="bad">El id del pedido excede el límite de caracteres permitido (10 caracteres).</h3>
            <?php
            exit(); // Detener la ejecución si el nombre excede el límite de caracteres
        }
        if(strlen($idProveedor) > 30 ) {
            ?>
            <h3 class="bad">El nombre del proveedor excede el límite de caracteres permitido (30 caracteres).</h3>
            <?php
            exit(); // Detener la ejecución si el nombre excede el límite de caracteres
        }
        if(strlen($material) > 30 ) {
            ?>
            <h3 class="bad">el nombre del material excede el límite de caracteres permitido (1 caracteres).</h3>
            <?php
            exit(); // Detener la ejecución si el nombre excede el límite de caracteres
        }
        if($cantidad > 100 && $cantidad < 1 ) {
            ?>
            <h3 class="bad">el rango esta fuera del limite permitido(minimo 1 maximo 100)</h3>
            <?php
            exit(); // Detener la ejecución si el nombre excede el límite de caracteres
        }
        if($costoUnitario > 999999 && $costoUnitario < 10000) {
            ?>
            <h3 class="bad">el rango esta fuera del limite permitido(minimo 10000 maximo 999999)</h3>
            <?php
            exit(); // Detener la ejecución si el nombre excede el límite de caracteres
        }    
?>
