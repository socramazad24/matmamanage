<?php
session_start();
require_once "../config/cors.php";
require_once "../config/Database.php";
require_once "../middleware/auth.php";

use API\Config\Database;

try {
    checkRole(['administrador']);

    if ($_SERVER["REQUEST_METHOD"] !== "PUT") {
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

    $updates = [];
    $types = "";
    $values = [];

    $allowedFields = ['username', 'password', 'role'];
    foreach ($allowedFields as $field) {
        if (isset($input[$field]) && !empty($input[$field])) {
            $updates[] = "$field = ?";
            $types .= "s";
            $values[] = $input[$field];
        }
    }

    if (empty($updates)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'No hay campos para actualizar']);
        exit();
    }

    $types .= "i";
    $values[] = $input['idEmployee'];

    $query = "UPDATE users SET " . implode(", ", $updates) . " WHERE idEmployee = ?";
    $stmt = $conex->prepare($query);
    $stmt->bind_param($types, ...$values);

    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Usuario actualizado exitosamente'
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Error al actualizar usuario'
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
