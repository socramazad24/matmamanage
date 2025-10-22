<?php
// session_manager.php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../index.php"); // Redirige al login si no está autenticado
    exit();
}
