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

    $required = ['username', 'password', 'role'];
    foreach ($required as $field) {
        if (!isset($input[$field]) || empty($input[$field])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => "Campo requerido: $field"]);
            exit();
        }
    }

    $db = new Database();
    $conex = $db->getConnection();

    // Check if username already exists
    $checkStmt = $conex->prepare("SELECT idEmployee FROM users WHERE username = ?");
    $checkStmt->bind_param("s", $input['username']);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        http_response_code(409);
        echo json_encode([
            'success' => false,
            'message' => 'El nombre de usuario ya existe'
        ]);
        $checkStmt->close();
        $db->close();
        exit();
    }
    $checkStmt->close();

    $hashedPassword = password_hash($input['password'], PASSWORD_DEFAULT);

    // Insert user
    $stmt = $conex->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $input['username'], $hashedPassword, $input['role']);

    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Usuario creado exitosamente',
            'data' => ['idEmployee' => $conex->insert_id]
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Error al crear usuario'
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
