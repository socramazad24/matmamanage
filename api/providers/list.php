<?php
error_reporting(0);
ini_set('display_errors', 0);

session_start();
require_once "../config/cors.php";
require_once "../config/Database.php";
require_once "../middleware/auth.php";

use API\Config\Database;

try {
    checkAuth();

    if ($_SERVER["REQUEST_METHOD"] !== "GET") {
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Método no permitido']);
        exit();
    }

    $db = new Database();
    $conex = $db->getConnection();

    $consulta = "SELECT * FROM Proveedores ORDER BY created_at DESC";
    $resultado = mysqli_query($conex, $consulta);

    if ($resultado) {
        $providers = [];
        while ($row = $resultado->fetch_assoc()) {
            $providers[] = $row;
        }

        echo json_encode([
            'success' => true,
            'data' => $providers
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Error al obtener proveedores'
        ]);
    }

    $db->close();

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error del servidor: ' . $e->getMessage()
    ]);
}
?>
