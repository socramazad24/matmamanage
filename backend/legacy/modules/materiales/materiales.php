<?php 
namespace materiales;
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../Database.php';
use matmanager\Database;

class Materiales 
{
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    private function validateInput($data) {
        $errors = [];
        foreach ($data as $key => $value) {
            if (empty(trim($value))) {
                $errors[] = "El campo $key es obligatorio.";
            }
        }
        return $errors;
    }

    private function materialExists($conex, $idMaterial) {
        $consultaMaterial = "SELECT * FROM materiales WHERE idMaterial = ?";
        $stmt = $conex->prepare($consultaMaterial);
        $stmt->bind_param("s", $idMaterial);
        $stmt->execute();
        $resultadoMaterial = $stmt->get_result();
        return $resultadoMaterial->num_rows > 0;
    }

    private function registerNewMaterial($conex, $data) {
        $consulta = "INSERT INTO materiales(idMaterial, MaterialName, Description, costoUnitario, cantidadMaterial, idProveedor, idPedido, date_reg) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conex->prepare($consulta);
        $stmt->bind_param(
            "sssdissi", 
            $data['idMaterial'], 
            $data['MaterialName'], 
            $data['Description'], 
            $data['costoUnitario'], 
            $data['cantidadMaterial'], 
            $data['idProveedor'], 
            $data['idPedido'], 
            $data['date_reg']
        );
        return $stmt->execute();
    }

    public function registerMateriales() {
        $conex = $this->db->getConnection();

        if (isset($_POST['register'])) {
            $data = [
                'idMaterial' => $_POST['idMaterial'],
                'MaterialName' => $_POST['MaterialName'],
                'Description' => $_POST['Description'],
                'costoUnitario' => $_POST['costoUnitario'],
                'cantidadMaterial' => $_POST['cantidadMaterial'],
                'idProveedor' => $_POST['idProveedor'],
                'idPedido' => $_POST['idPedido'],
                'date_reg' => date("y/m/d")
            ];

            $errors = $this->validateInput($data);

            if (!empty($errors)) {
                echo "<script>Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    html: '" . implode("<br>", $errors) . "'
                })</script>";
                return;
            }

            if ($this->materialExists($conex, $data['idMaterial'])) {
                echo "<script>Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El ID del material ya está registrado. Por favor, introduzca otro ID.'
                })</script>";
                return;
            }

            if ($this->registerNewMaterial($conex, $data)) {
                echo "<script>Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Material registrado exitosamente.'
                })</script>";
            } else {
                echo "<script>Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Algo ha salido mal. " . htmlspecialchars($conex->error) . "'
                })</script>";
            }
        }

        $conex->close();
    }
}

?>
