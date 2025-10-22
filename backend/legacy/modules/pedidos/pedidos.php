<?php

namespace pedidos;
require_once __DIR__ . '/../Database.php';
use matmanager\Database;

class pedidos
{
    public function RegisterPedido()
    {
        $db = new Database();
        $conex = $db->getConnection();
        if (isset($_POST['register'])) {
            $idPedido = trim($_POST['idPedido']);
            $idProveedor = trim($_POST['idProveedor']);
            $materialName = trim($_POST['MaterialName']);
            $description = trim($_POST['Description']);
            $cantidadMaterial = trim($_POST['cantidadMaterial']);
            $costoUnitario = trim($_POST['costoUnitario']);
            $dateReg = date("y/m/d");

            if (
                strlen($idPedido) < 1 ||
                strlen($idProveedor) < 1 ||
                strlen($materialName) < 1 ||
                strlen($description) < 1 ||
                strlen($cantidadMaterial) < 1 ||
                strlen($costoUnitario) < 1
            ) {
                echo "<script>Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Llene todos los campos.',
                            })</script>";
                return;
            }

            if (empty($idProveedor)) {
                echo "<script>Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Por favor, seleccione un proveedor.',
                })</script>";
                return;
            }



            $consulta = "INSERT INTO pedidos(idPedido, idProveedor, MaterialName, Description, cantidadMaterial, costoUnitario, dateReg) 
                            VALUES ('$idPedido', '$idProveedor', '$materialName', '$description', '$cantidadMaterial', '$costoUnitario', '$dateReg')";
            $resultado = $conex->query($consulta);
            if ($resultado) {
                echo "<script>Swal.fire({
                                icon: 'success',
                                title: 'Éxito',
                                text: 'Pedido registrado exitosamente.',
                            })</script>";
            } else {
                echo "<script>Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Algo ha salido mal.',
                            })</script>";
            }
        }
    }
}

//$register = new pedidos;
//$register -> RegisterPedido();
