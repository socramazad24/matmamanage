<?php
error_reporting(0);
ini_set('display_errors', 0);

session_start();
require_once "../config/cors.php";
require_once "../config/Database.php";
require_once "../middleware/auth.php";

use API\Config\Database;

try {
    // Check authentication and role
    checkRole(['administrador', 'gerente']);

    // Only accept POST requests
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Método no permitido']);
        exit();
    }

    // Get JSON input
    $input = json_decode(file_get_contents('php://input'), true);

    // Validate required fields
    $required = ['MaterialName', 'Description', 'costoUnitario', 'cantidadMaterial', 'idProveedor'];
    foreach ($required as $field) {
        if (!isset($input[$field]) || empty($input[$field])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => "Campo requerido: $field"]);
            exit();
        }
    }

    // Connect to database
    $db = new Database();
    $conex = $db->getConnection();

    // Insert material
    $stmt = $conex->prepare("INSERT INTO Materiales (MaterialName, Description, costoUnitario, cantidadMaterial, idProveedor, idPedido) VALUES (?, ?, ?, ?, ?, ?)");
    $idPedido = $input['idPedido'] ?? null;
    $stmt->bind_param(
        "ssddss",
        $input['MaterialName'],
        $input['Description'],
        $input['costoUnitario'],
        $input['cantidadMaterial'],
        $input['idProveedor'],
        $idPedido
    );

    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Material creado exitosamente',
            'data' => ['idMaterial' => $conex->insert_id]
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Error al crear material'
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
