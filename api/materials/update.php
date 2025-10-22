<?php
session_start();
require_once "../config/cors.php";
require_once "../config/Database.php";
require_once "../middleware/auth.php";

use API\Config\Database;

try {
    // Check authentication and role
    checkRole(['administrador', 'gerente']);

    // Only accept PUT requests
    if ($_SERVER["REQUEST_METHOD"] !== "PUT") {
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Método no permitido']);
        exit();
    }

    // Get JSON input
    $input = json_decode(file_get_contents('php://input'), true);

    // Validate required fields
    if (!isset($input['idMaterial'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'ID de material requerido']);
        exit();
    }

    // Connect to database
    $db = new Database();
    $conex = $db->getConnection();

    // Build update query dynamically
    $updates = [];
    $types = "";
    $values = [];

    $allowedFields = ['MaterialName', 'Description', 'costoUnitario', 'cantidadMaterial', 'idProveedor', 'idPedido'];
    foreach ($allowedFields as $field) {
        if (isset($input[$field])) {
            $updates[] = "$field = ?";
            if (in_array($field, ['costoUnitario', 'cantidadMaterial'])) {
                $types .= "d";
            } else {
                $types .= "s";
            }
            $values[] = $input[$field];
        }
    }

    if (empty($updates)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'No hay campos para actualizar']);
        exit();
    }

    $types .= "s";
    $values[] = $input['idMaterial'];

    $query = "UPDATE Materiales SET " . implode(", ", $updates) . " WHERE idMaterial = ?";
    $stmt = $conex->prepare($query);
    $stmt->bind_param($types, ...$values);

    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Material actualizado exitosamente'
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Error al actualizar material'
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
