<?php
// Middleware to check authentication
function checkAuth() {
    if (!isset($_SESSION['username'])) {
        http_response_code(401);
        echo json_encode([
            'success' => false,
            'message' => 'No autenticado. Por favor inicie sesión.'
        ]);
        exit();
    }
}

function checkRole($allowedRoles) {
    checkAuth();
    
    if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], $allowedRoles)) {
        http_response_code(403);
        echo json_encode([
            'success' => false,
            'message' => 'No tiene permisos para realizar esta acción'
        ]);
        exit();
    }
}
?>
