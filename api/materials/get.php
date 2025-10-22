<?php
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

    if (!isset($_GET['idMaterial'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'ID de material requerido']);
        exit();
    }

    $idMaterial = $_GET['idMaterial'];

    // Connect to database
    $db = new Database();
    $conex = $db->getConnection();

    // Query material
    $stmt = $conex->prepare("SELECT * FROM Materiales WHERE idMaterial = ?");
    $stmt->bind_param("s", $idMaterial);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $material = $resultado->fetch_assoc();
        echo json_encode([
            'success' => true,
            'data' => $material
        ]);
    } else {
        http_response_code(404);
        echo json_encode([
            'success' => false,
            'message' => 'Material no encontrado'
        ]);
    }

    $stmt->close();
    $db->close();

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error del servidor: ' . $e->getMessage()
    ]);
}
?>
