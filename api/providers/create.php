<?php
error_reporting(0);
ini_set('display_errors', 0);

session_start();
require_once "../config/cors.php";
require_once "../config/Database.php";
require_once "../middleware/auth.php";

use API\Config\Database;

try {
    checkRole(['administrador']);

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Método no permitido']);
        exit();
    }

    $input = json_decode(file_get_contents('php://input'), true);

    $required = ['nombreProveedor', 'telefono', 'email', 'direccion'];
    foreach ($required as $field) {
        if (!isset($input[$field]) || empty($input[$field])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => "Campo requerido: $field"]);
            exit();
        }
    }

    $db = new Database();
    $conex = $db->getConnection();

    $stmt = $conex->prepare("INSERT INTO Proveedores (nombreProveedor, telefono, email, direccion) VALUES (?, ?, ?, ?)");
    $stmt->bind_param(
        "ssss",
        $input['nombreProveedor'],
        $input['telefono'],
        $input['email'],
        $input['direccion']
    );

    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Proveedor creado exitosamente',
            'data' => ['idProveedor' => $conex->insert_id]
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Error al crear proveedor'
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
