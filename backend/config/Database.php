<?php
namespace matmanager;

class Database {
    private $conex;
    
    public function __construct() {
        require_once __DIR__ . '/../../config.php';
        
        $this->conex = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($this->conex->connect_error) {
            die("Error de conexión: " . $this->conex->connect_error);
        }
        
        // Establecer charset UTF-8
        mysqli_set_charset($this->conex, "utf8");
    }

    public function getConnection() {
        return $this->conex;
    }
}
?>
