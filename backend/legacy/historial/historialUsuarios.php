<?php
namespace historial;
require_once "../vendor/autoload.php";
require_once "../Database.php";
use matmanager\Database;
use templates\header;
use templates\Footer;

class Main {
    
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    private function getUsers() {
        $conex = $this->db->getConnection();
        $consulta = "SELECT * FROM historialusers";
        $resultado = mysqli_query($conex, $consulta);
        $users = [];
        if ($resultado) {
            while ($row = $resultado->fetch_assoc()) {
                $users[] = $row;
            }
        }
        mysqli_close($conex);
        return $users;
    }

    private function renderTable($users) {
        echo '<table class="w-full my-0 border-neutral-900">';
        echo '<thead class="align-bottom">';
        echo '<tr class="font-semibold text-xl text-amber-500 justify-center items-center">';
        echo '<th class="pb-3 text-start min-w-[120px]">idRegUser</th>';
        echo '<th class="pb-3 text-start min-w-[120px]">ID</th>';
        echo '<th class="pb-3 text-start min-w-[90px]">Nombre</th>';
        echo '<th class="pb-3 text-start min-w-[90px]">Apellido</th>';
        echo '<th class="pb-3 text-start min-w-[90px]">Usuario</th>';
        echo '<th class="pb-3 text-start min-w-[100px]">Contraseña</th>';
        echo '<th class="pb-3 text-start">Email</th>';
        echo '<th class="pb-3 text-start">Teléfono</th>';
        echo '<th class="pb-3 text-start">Rol</th>';
        echo '<th class="pb-3 text-start">Acción</th>';
        echo '<th class="pb-3 text-start">Fecha</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody class="text-base font-semibold text-gray-900 justify-center items-center">';

        foreach ($users as $row) {
            echo "<tr>";
            echo "<td class=''>" . $row["idRegUser"] . "</td>";
            echo "<td class=''>" . $row["idEmployee"] . "</td>";
            echo "<td class='uppercase'>" . $row["firstName"] . "</td>";
            echo "<td class='uppercase'>" . $row["lastName"] . "</td>";
            echo "<td class='py-6 px-4'>" . $row["username"] . "</td>";
            echo "<td class='py-6 px-4'>" . $row["password"] . "</td>";
            echo "<td class='py-6 px-4'>" . $row["email"] . "</td>";
            echo "<td class='py-6 px-2'>" . $row["phone"] . "</td>";
            echo "<td class='py-6 px-2 uppercase'>" . $row["role"] . "</td>";
            echo "<td class='py-6 px-2'>";
            
            if ($row["accion"] == "agregado") {
                echo "<div class='relative grid items-center justify-center font-sans font-bold uppercase whitespace-nowrap select-none bg-green-500/20 text-green-600 py-1 px-2 text-xs rounded-md' style='opacity: 1;'>";
            } elseif ($row["accion"] == "eliminado") {
                echo "<div class='relative grid items-center justify-center font-sans font-bold uppercase whitespace-nowrap select-none bg-red-500/20 text-red-700 py-1 px-2 text-xs rounded-md' style='opacity: 1;'>";
            } else {
                echo "<div class='relative grid items-center justify-center font-sans font-bold uppercase whitespace-nowrap select-none bg-yellow-500/20 text-yellow-600 py-1 px-2 text-xs rounded-md' style='opacity: 1;'>";
            }
            echo $row["accion"] . "</div></td>";
            echo "<td class='py-6 px-4'>" . $row["date_reg"] . "</td>";
            echo "</tr>";
        }

        echo '</tbody>';
        echo '</table>';
    }

    private function renderHeader() {
        $pageTitle = "Header";
        $header = new header;
        $header->head($pageTitle);
    }

    private function renderFooter() {
        $pageTitle = "Footer";
        $footer = new Footer;
        $footer->Footer($pageTitle);
    }

    public function render() {
        $users = $this->getUsers();
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Historial de usuarios</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/Loopple/loopple-public-assets@main/riva-dashboard-tailwind/riva-dashboard.css">
            <script>
                function filterUsers() {
                    const searchValue = document.getElementById('search').value.toLowerCase();
                    const users = document.querySelectorAll('tbody tr');
                    users.forEach(user => {
                        const cells = user.querySelectorAll('td');
                        let match = false;
                        cells.forEach(cell => {
                            if (cell.textContent.toLowerCase().includes(searchValue)) {
                                match = true;
                            }
                        });
                        if (match) {
                            user.style.display = '';
                        } else {
                            user.style.display = 'none';
                        }
                    });
                }
            </script>
        </head>
        <body>
            <!-- Header -->
            <header>
                <?php $this->renderHeader(); ?>
            </header>

            <!-- Table -->
            <div class="flex flex-wrap">
                <div class="w-full px-3 mb-6 mx-auto">
                    <div class="bg-clip-border bg-white m-2">
                        <div class="border border-dashed bg-clip-border rounded-5xl bg-light/30">
                            <!-- Table Header -->
                            <div class="px-9 py-16 flex justify-between items-stretch flex-wrap min-h-[70px] pb-5 bg-transparent">
                                <h3 class="flex flex-col items-start justify-center m-2 ml-0 font-medium text-3xl">
                                    <span class="mr-2 font-bold mb-5">Historial de Usuarios</span> <br>
                                </h3>
                                <!-- Search Input -->
                                <div class="p-4">
                                    <input type="text" id="search" onkeyup="filterUsers()" placeholder="Buscar usuario..." class="p-2 border rounded-lg w-full">
                                </div>
                            </div>
                            
                            <!-- Table Body -->
                            <div class="flex-auto block py-2 mr-6">
                                <div class="overflow-x-auto ml-5">
                                    <?php $this->renderTable($users); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer> 
                <?php $this->renderFooter(); ?>
            </footer>
        </body>
        </html>
        <?php
    }
}

// Instanciamos la clase y llamamos al método render para generar el HTML
$main = new Main();
$main->render();
?>

?>
