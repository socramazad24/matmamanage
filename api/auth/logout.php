<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);

session_start();

require_once __DIR__ . '/../config/cors.php';

try {
    // Destroy session
    session_unset();
    session_destroy();

    echo json_encode([
        'success' => true,
        'message' => 'Sesión cerrada exitosamente'
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error al cerrar sesión',
        'error' => $e->getMessage()
    ]);
}
?>
