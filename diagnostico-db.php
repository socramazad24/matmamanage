<?php
require_once 'config.php';

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagnóstico de Base de Datos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .section {
            background: white;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .success { color: #22c55e; font-weight: bold; }
        .error { color: #ef4444; font-weight: bold; }
        .warning { color: #f59e0b; font-weight: bold; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #f3f4f6;
            font-weight: bold;
        }
        pre {
            background: #1f2937;
            color: #f3f4f6;
            padding: 15px;
            border-radius: 4px;
            overflow-x: auto;
        }
        .info {
            background: #dbeafe;
            padding: 10px;
            border-left: 4px solid #3b82f6;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <h1>Diagnóstico de Base de Datos - MAT-MANAGER</h1>

    <?php
    // Test 1: Conexión a MySQL
    echo '<div class="section">';
    echo '<h2>1. Conexión a MySQL</h2>';
    $conex = @new mysqli(DB_HOST, DB_USER, DB_PASS);
    if ($conex->connect_error) {
        echo '<p class="error">❌ Error de conexión: ' . $conex->connect_error . '</p>';
        echo '<div class="info">Verifica que XAMPP esté corriendo y que MySQL esté activo.</div>';
    } else {
        echo '<p class="success">✅ Conexión a MySQL exitosa</p>';
        echo '<p>Host: ' . DB_HOST . '</p>';
        echo '<p>Usuario: ' . DB_USER . '</p>';
    }
    echo '</div>';

    // Test 2: Base de datos existe
    echo '<div class="section">';
    echo '<h2>2. Base de Datos</h2>';
    $db_exists = $conex->select_db(DB_NAME);
    if (!$db_exists) {
        echo '<p class="error">❌ La base de datos "' . DB_NAME . '" NO existe</p>';
        echo '<div class="info">';
        echo '<p>Necesitas crear la base de datos. Ejecuta este comando en phpMyAdmin:</p>';
        echo '<pre>CREATE DATABASE `mat-manager` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;</pre>';
        echo '</div>';
    } else {
        echo '<p class="success">✅ Base de datos "' . DB_NAME . '" existe</p>';
        
        // Test 3: Listar tablas
        echo '<h3>Tablas en la base de datos:</h3>';
        $result = $conex->query("SHOW TABLES");
        if ($result->num_rows > 0) {
            echo '<table>';
            echo '<tr><th>Tabla</th><th>Registros</th></tr>';
            while ($row = $result->fetch_array()) {
                $table_name = $row[0];
                $count_result = $conex->query("SELECT COUNT(*) as count FROM `$table_name`");
                $count = $count_result->fetch_assoc()['count'];
                echo '<tr><td>' . $table_name . '</td><td>' . $count . '</td></tr>';
            }
            echo '</table>';
        } else {
            echo '<p class="warning">⚠️ No hay tablas en la base de datos</p>';
            echo '<div class="info">';
            echo '<p>Necesitas ejecutar el script de setup. Ve a phpMyAdmin y ejecuta el archivo:</p>';
            echo '<pre>backend/database/setup.sql</pre>';
            echo '</div>';
        }
    }
    echo '</div>';

    // Test 4: Verificar tabla de usuarios
    if ($db_exists) {
        echo '<div class="section">';
        echo '<h2>3. Tabla de Usuarios</h2>';
        
        // Verificar si existe tabla 'users' o 'employee'
        $users_exists = $conex->query("SHOW TABLES LIKE 'users'")->num_rows > 0;
        $employee_exists = $conex->query("SHOW TABLES LIKE 'employee'")->num_rows > 0;
        
        if ($users_exists) {
            echo '<p class="success">✅ Tabla "users" encontrada</p>';
            $result = $conex->query("SELECT * FROM users");
            if ($result->num_rows > 0) {
                echo '<h3>Usuarios en la base de datos:</h3>';
                echo '<table>';
                echo '<tr><th>ID</th><th>Username</th><th>Role</th><th>Password (primeros 20 chars)</th></tr>';
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . ($row['idEmployee'] ?? $row['id'] ?? 'N/A') . '</td>';
                    echo '<td>' . $row['username'] . '</td>';
                    echo '<td>' . $row['role'] . '</td>';
                    echo '<td>' . substr($row['password'], 0, 20) . '...</td>';
                    echo '</tr>';
                }
                echo '</table>';
            } else {
                echo '<p class="warning">⚠️ La tabla "users" existe pero está vacía</p>';
            }
        } elseif ($employee_exists) {
            echo '<p class="success">✅ Tabla "employee" encontrada</p>';
            $result = $conex->query("SELECT * FROM employee");
            if ($result->num_rows > 0) {
                echo '<h3>Empleados en la base de datos:</h3>';
                echo '<table>';
                echo '<tr><th>ID</th><th>Username</th><th>Name</th><th>Role</th><th>Password (primeros 20 chars)</th></tr>';
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['idEmployee'] . '</td>';
                    echo '<td>' . $row['username'] . '</td>';
                    echo '<td>' . ($row['name'] ?? 'N/A') . '</td>';
                    echo '<td>' . $row['role'] . '</td>';
                    echo '<td>' . substr($row['password'], 0, 20) . '...</td>';
                    echo '</tr>';
                }
                echo '</table>';
            } else {
                echo '<p class="warning">⚠️ La tabla "employee" existe pero está vacía</p>';
            }
        } else {
            echo '<p class="error">❌ No se encontró tabla de usuarios (ni "users" ni "employee")</p>';
            echo '<div class="info">';
            echo '<p>Ejecuta el script de setup en phpMyAdmin:</p>';
            echo '<pre>backend/database/setup.sql</pre>';
            echo '</div>';
        }
        echo '</div>';

        // Test 5: Estructura de la tabla
        echo '<div class="section">';
        echo '<h2>4. Estructura de Tablas</h2>';
        $table_to_check = $users_exists ? 'users' : ($employee_exists ? 'employee' : null);
        
        if ($table_to_check) {
            $result = $conex->query("DESCRIBE `$table_to_check`");
            echo '<h3>Estructura de la tabla "' . $table_to_check . '":</h3>';
            echo '<table>';
            echo '<tr><th>Campo</th><th>Tipo</th><th>Null</th><th>Key</th><th>Default</th></tr>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['Field'] . '</td>';
                echo '<td>' . $row['Type'] . '</td>';
                echo '<td>' . $row['Null'] . '</td>';
                echo '<td>' . $row['Key'] . '</td>';
                echo '<td>' . ($row['Default'] ?? 'NULL') . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        }
        echo '</div>';
    }

    // Test 6: Configuración actual
    echo '<div class="section">';
    echo '<h2>5. Configuración Actual</h2>';
    echo '<table>';
    echo '<tr><th>Parámetro</th><th>Valor</th></tr>';
    echo '<tr><td>DB_HOST</td><td>' . DB_HOST . '</td></tr>';
    echo '<tr><td>DB_USER</td><td>' . DB_USER . '</td></tr>';
    echo '<tr><td>DB_PASS</td><td>' . (DB_PASS === '' ? '(vacío)' : '***') . '</td></tr>';
    echo '<tr><td>DB_NAME</td><td>' . DB_NAME . '</td></tr>';
    echo '<tr><td>PHP Version</td><td>' . phpversion() . '</td></tr>';
    echo '<tr><td>MySQL Version</td><td>' . ($conex ? $conex->server_info : 'N/A') . '</td></tr>';
    echo '</table>';
    echo '</div>';

    // Recomendaciones
    echo '<div class="section">';
    echo '<h2>6. Recomendaciones</h2>';
    echo '<div class="info">';
    echo '<h3>Para que el login funcione necesitas:</h3>';
    echo '<ol>';
    echo '<li>Base de datos "mat-manager" creada ✓</li>';
    echo '<li>Tabla de usuarios (users o employee) con datos ✓</li>';
    echo '<li>Al menos un usuario con credenciales válidas ✓</li>';
    echo '</ol>';
    echo '<h3>Credenciales de prueba:</h3>';
    echo '<p>Si usaste el script setup.sql:</p>';
    echo '<ul>';
    echo '<li>Usuario: <strong>admin</strong></li>';
    echo '<li>Contraseña: <strong>admin123</strong></li>';
    echo '</ul>';
    echo '</div>';
    echo '</div>';

    if ($conex) {
        $conex->close();
    }
    ?>

    <div class="section">
        <h2>Siguiente Paso</h2>
        <p>Una vez que todo esté correcto aquí, prueba el login en:</p>
        <p><a href="index.php" style="color: #3b82f6; font-weight: bold;">→ Ir al Login</a></p>
    </div>
</body>
</html>
