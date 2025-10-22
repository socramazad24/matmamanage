<?php
/**
 * Punto de entrada principal para XAMPP
 * Redirige al login del frontend
 */
require_once 'config.php';

// Verificar si ya hay sesión activa
if (isset($_SESSION['user_id'])) {
    // Redirigir según el rol
    $role = $_SESSION['role'] ?? '';
    switch ($role) {
        case 'administrador':
            header('Location: frontend/admin/index.html');
            break;
        case 'gerente':
            header('Location: frontend/gerente/index.html');
            break;
        case 'bodeguero':
            header('Location: frontend/bodeguero/index.html');
            break;
        default:
            header('Location: frontend/login.html');
    }
    exit();
}

// Si no hay sesión, mostrar login
header('Location: frontend/login.html');
exit();
?>
