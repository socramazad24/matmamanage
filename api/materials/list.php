<?php
error_reporting(0);
ini_set('display_errors', 0);

session_start();
require_once "../config/cors.php";
require_once "../config/Database.php";
require_once "../middleware/auth.php";

use API\Config\Database;

try {
    // Check authentication
    checkAuth();

    // Only accept GET requests
    if ($_SERVER["REQUEST_METHOD"] !== "GET") {
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Método no permitido']);
        exit();
    }

    // Connect to database
    $db = new Database();
    $conex = $db->getConnection();

    // Query materials
    $consulta = "SELECT * FROM Materiales ORDER BY date_reg DESC";
    $resultado = mysqli_query($conex, $consulta);

    if ($resultado) {
        $materials = [];
        while ($row = $resultado->fetch_assoc()) {
            $materials[] = $row;
        }

        echo json_encode([
            'success' => true,
            'data' => $materials
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Error al obtener materiales'
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
