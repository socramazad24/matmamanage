<?php
session_start();
require_once "../config/cors.php";
require_once "../config/Database.php";
require_once "../middleware/auth.php";

use API\Config\Database;

try {
    // Check authentication and role
    checkRole(['administrador']);

    // Only accept DELETE requests
    if ($_SERVER["REQUEST_METHOD"] !== "DELETE") {
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Método no permitido']);
        exit();
    }

    // Get JSON input
    $input = json_decode(file_get_contents('php://input'), true);

    if (!isset($input['idMaterial'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'ID de material requerido']);
        exit();
    }

    $idMaterial = $input['idMaterial'];

    // Connect to database
    $db = new Database();
    $conex = $db->getConnection();

    // Delete material
    $stmt = $conex->prepare("DELETE FROM Materiales WHERE idMaterial = ?");
    $stmt->bind_param("s", $idMaterial);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode([
                'success' => true,
                'message' => 'Material eliminado exitosamente'
            ]);
        } else {
            http_response_code(404);
            echo json_encode([
                'success' => false,
                'message' => 'Material no encontrado'
            ]);
        }
    } else {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Error al eliminar material'
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
