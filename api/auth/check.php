<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);

session_start();

require_once __DIR__ . '/../config/cors.php';

try {
    if (isset($_SESSION['username'])) {
        echo json_encode([
            'success' => true,
            'authenticated' => true,
            'data' => [
                'username' => $_SESSION['username'],
                'role' => $_SESSION['role'] ?? null,
                'idEmployee' => $_SESSION['idEmployee'] ?? null
            ]
        ]);
    } else {
        http_response_code(401);
        echo json_encode([
            'success' => false,
            'authenticated' => false,
            'message' => 'No autenticado'
        ]);
    }

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error del servidor',
        'error' => $e->getMessage()
    ]);
}
?>
