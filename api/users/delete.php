<?php
session_start();
require_once "../config/cors.php";
require_once "../config/Database.php";
require_once "../middleware/auth.php";

use API\Config\Database;

try {
    checkRole(['administrador']);

    if ($_SERVER["REQUEST_METHOD"] !== "DELETE") {
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Método no permitido']);
        exit();
    }

    $input = json_decode(file_get_contents('php://input'), true);

    if (!isset($input['idEmployee'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'ID de empleado requerido']);
        exit();
    }

    $db = new Database();
    $conex = $db->getConnection();

    $stmt = $conex->prepare("DELETE FROM users WHERE idEmployee = ?");
    $stmt->bind_param("i", $input['idEmployee']);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode([
                'success' => true,
                'message' => 'Usuario eliminado exitosamente'
            ]);
        } else {
            http_response_code(404);
            echo json_encode([
                'success' => false,
                'message' => 'Usuario no encontrado'
            ]);
        }
    } else {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Error al eliminar usuario'
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
