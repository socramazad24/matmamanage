<?php
error_reporting(0);
ini_set('display_errors', 0);

session_start();
require_once "../config/cors.php";
require_once "../config/Database.php";
require_once "../middleware/auth.php";

use API\Config\Database;

try {
    checkRole(['administrador', 'gerente']);

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Método no permitido']);
        exit();
    }

    $input = json_decode(file_get_contents('php://input'), true);

    $required = ['idMaterial', 'cantidad'];
    foreach ($required as $field) {
        if (!isset($input[$field]) || empty($input[$field])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => "Campo requerido: $field"]);
            exit();
        }
    }

    $db = new Database();
    $conex = $db->getConnection();

    $estado = $input['estado'] ?? 'Pendiente';
    
    $stmt = $conex->prepare("INSERT INTO Pedidos (idMaterial, cantidad, estado, fecha) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param(
        "sis",
        $input['idMaterial'],
        $input['cantidad'],
        $estado
    );

    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Pedido creado exitosamente',
            'data' => ['idPedido' => $conex->insert_id]
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Error al crear pedido'
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
