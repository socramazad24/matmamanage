<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);

session_start();

require_once __DIR__ . '/../config/cors.php';
require_once __DIR__ . '/../../config.php';

try {
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Método no permitido']);
        exit();
    }

    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($input['username']) || !isset($input['password'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Usuario y contraseña requeridos']);
        exit();
    }

    $username = $input['username'];
    $password = $input['password'];

    $conex = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if ($conex->connect_error) {
        throw new Exception("Error de conexión: " . $conex->connect_error);
    }

    mysqli_set_charset($conex, "utf8");

    $table_name = 'users';
    $check_table = $conex->query("SHOW TABLES LIKE 'users'");
    if ($check_table->num_rows == 0) {
        $check_table = $conex->query("SHOW TABLES LIKE 'employee'");
        if ($check_table->num_rows > 0) {
            $table_name = 'employee';
        }
    }

    $query = "SELECT * FROM $table_name WHERE username = ?";
    $stmt = $conex->prepare($query);
    
    if (!$stmt) {
        throw new Exception("Error en la consulta: " . $conex->error);
    }
    
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        $password_valid = false;
        
        // Try plain text comparison first (for legacy compatibility)
        if ($user['password'] === $password) {
            $password_valid = true;
        }
        // Try password_verify for hashed passwords
        elseif (password_verify($password, $user['password'])) {
            $password_valid = true;
        }
        
        if ($password_valid) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['idEmployee'] = $user['idEmployee'] ?? $user['id'] ?? null;

            echo json_encode([
                'success' => true,
                'message' => 'Login exitoso',
                'data' => [
                    'username' => $user['username'],
                    'role' => $user['role'],
                    'idEmployee' => $_SESSION['idEmployee']
                ]
            ]);
        } else {
            http_response_code(401);
            echo json_encode([
                'success' => false,
                'message' => 'Contraseña incorrecta'
            ]);
        }
    } else {
        http_response_code(401);
        echo json_encode([
            'success' => false,
            'message' => 'Usuario no encontrado'
        ]);
    }

    $stmt->close();
    $conex->close();

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error del servidor',
        'error' => $e->getMessage()
    ]);
}
?>
