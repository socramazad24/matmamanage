<?php
use PHPUnit\Framework\TestCase;
use pedidos\pedidos;
use matmanager\Database;

class PedidosTest extends TestCase
{
    private $pedidos;

    protected function setUp(): void
    {
        $this->pedidos = new pedidos();

    }

    

    public function testRegisterPedidoFailEmptyFields()
    {
        $_POST = [
            'register' => true,
            'idPedido' => '',
            'idProveedor' => '',
            'MaterialName' => '',
            'Description' => '',
            'cantidadMaterial' => '',
            'costoUnitario' => ''
        ];

        ob_start();
        $this->pedidos->RegisterPedido();
        $output = ob_get_clean();

        $this->assertStringContainsString('Llene todos los campos.', $output);
    }

    public function testProveedorObligatorio()
    {
        $_POST = [
            'register' => true,
            'idPedido' => '123',
            'idProveedor' => '',
            'MaterialName' => 'Material Test',
            'Description' => 'Description Test',
            'cantidadMaterial' => '10',
            'costoUnitario' => '100'
        ];

        ob_start();
        $this->pedidos->RegisterPedido();
        $output = ob_get_clean();

        $this->assertStringContainsString('', $output);
    }

    
}
