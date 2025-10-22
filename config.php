<?php
/**
 * Configuración para XAMPP
 * Este archivo debe estar en la raíz del proyecto
 */

// Configuración de la base de datos para XAMPP
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', ''); // XAMPP usa contraseña vacía por defecto
define('DB_NAME', 'mat-manager');

// Configuración de rutas
define('BASE_PATH', __DIR__);
define('API_PATH', BASE_PATH . '/api');
define('FRONTEND_PATH', BASE_PATH . '/frontend');

// Configuración de sesión
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 0); // Cambiar a 1 si usas HTTPS

// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Configuración de errores (desactivar en producción)
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
