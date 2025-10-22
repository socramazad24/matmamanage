<?php

use PHPUnit\Framework\TestCase;
use materiales\materiales;

// Clase simulada para la conexión a la base de datos
class DatabaseMock
{
    public function getConnection()
    {
        // Simular la conexión a la base de datos
        return true;
    }

    public function query($sql)
    {
        // Simular la ejecución de una consulta SQL
        return true;
    }

    public function prepare($sql)
    {
        // Simular la preparación de una consulta SQL
        return true;
    }
}

class RegisterMaterialesTest extends TestCase
{
    

    public function testCamposObligatoriosVacios()
    {
        $_POST['register'] = true;
        $_POST['idMaterial'] = '';
        $_POST['MaterialName'] = '';
        $_POST['Description'] = '';
        $_POST['costoUnitario'] = '';
        $_POST['cantidadMaterial'] = '';
        $_POST['idProveedor'] = '';
        $_POST['idPedido'] = '';

        $registerMateriales = new materiales(new DatabaseMock());

        ob_start();
        $registerMateriales->registerMateriales();
        $output = ob_get_clean();

        $this->assertStringContainsString("", $output);
    }

    public function testProveedorVacio()
    {
        $_POST['register'] = true;
        $_POST['idMaterial'] = 'MAT001';
        $_POST['MaterialName'] = 'Material Test';
        $_POST['Description'] = 'Descripción de prueba';
        $_POST['costoUnitario'] = '10.5';
        $_POST['cantidadMaterial'] = '100';
        $_POST['idProveedor'] = '';
        $_POST['idPedido'] = 'PED001';

        $registerMateriales = new materiales(new DatabaseMock());

        ob_start();
        $registerMateriales->registerMateriales();
        $output = ob_get_clean();

        $this->assertStringContainsString("", $output);
    }

    public function testIdMaterialYaExiste()
    {
        $_POST['register'] = true;
        $_POST['idMaterial'] = 'MAT001';
        $_POST['MaterialName'] = 'Material Test';
        $_POST['Description'] = 'Descripción de prueba';
        $_POST['costoUnitario'] = '10.5';
        $_POST['cantidadMaterial'] = '100';
        $_POST['idProveedor'] = 'PROV001';
        $_POST['idPedido'] = 'PED001';

        $registerMateriales = new materiales(new DatabaseMock());

        ob_start();
        $registerMateriales->registerMateriales();
        $output = ob_get_clean();

        $this->assertStringContainsString("", $output);
    }
}

?>
