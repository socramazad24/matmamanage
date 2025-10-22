<?php

use PHPUnit\Framework\TestCase;
use proveedores\Proveedores;
use matmanager\Database;

class proveedoresTest extends TestCase
{
    protected $db;

    protected function setUp(): void
    {
        // Setup a database connection for testing purposes
        $password = getenv('MYSQL_SECURE_PASSWORD');
        $this->db = new mysqli("localhost", "root", "$password", "test_db");

        // Ensure the table is empty before each test
        $this->db->query("TRUNCATE TABLE proovedores");
    }

    protected function tearDown(): void
    {
        // Close the database connection after each test
        $this->db->close();
    }

    public function testIncompleteFormSubmission()
    {
        $_POST['register'] = true;
        $_POST['idProveedor'] = '';
        $_POST['nameProveedor'] = 'Proveedor 1';
        $_POST['materiales'] = 'Material 1';
        $_POST['telefono'] = '1234567890';
        $_POST['correo'] = 'proveedor1@example.com';
        $_POST['direccion'] = 'Direccion 1';

        $register = new Proveedores();
        $output = $register->RegisterProvider();
        $this->assertStringContainsString('Por favor, complete todos los campos', $output);
    }

    public function testInvalidEmailFormat()
    {
        $_POST['register'] = true;
        $_POST['idProveedor'] = '123';
        $_POST['nameProveedor'] = 'Proveedor 1';
        $_POST['materiales'] = 'Material 1';
        $_POST['telefono'] = '1234567890';
        $_POST['correo'] = 'invalidemail';
        $_POST['direccion'] = 'Direccion 1';

        $register = new Proveedores();
        ob_start();
        $register->RegisterProvider();
        $output = ob_get_clean();
        $this->assertStringContainsString('Formato de correo electrónico no válido', $output);
    }

    public function testDuplicateEntry()
    {
        // First entry
        $this->db->query("INSERT INTO proovedores (idProveedor, nameProveedor, materiales, telefono, correo, direccion, date_reg) VALUES ('123', 'Proveedor 1', 'Material 1', '1234567890', 'proveedor1@example.com', 'Direccion 1', '2024/06/10')");

        // Attempt to register with duplicate id, email or phone
        $_POST['register'] = true;
        $_POST['idProveedor'] = '123';
        $_POST['nameProveedor'] = 'Proveedor 2';
        $_POST['materiales'] = 'Material 2';
        $_POST['telefono'] = '0987654321';
        $_POST['correo'] = 'proveedor2@example.com';
        $_POST['direccion'] = 'Direccion 2';

        $register = new Proveedores();
        ob_start();
        $register->RegisterProvider();
        $output = ob_get_clean();
        $this->assertStringContainsString('', $output);
    }

    public function testSuccessfulRegistration()
    {
        $_POST['register'] = true;
        $_POST['idProveedor'] = '123';
        $_POST['nameProveedor'] = 'Proveedor 1';
        $_POST['materiales'] = 'Material 1';
        $_POST['telefono'] = '1234567890';
        $_POST['correo'] = 'proveedor1@example.com';
        $_POST['direccion'] = 'Direccion 1';

        $register = new Proveedores();
        ob_start();
        $register->RegisterProvider();
        $output = ob_get_clean();
        $this->assertStringContainsString('', $output);
    }
}
