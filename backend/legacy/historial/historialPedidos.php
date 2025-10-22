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

    private function getOrders() {
        $conex = $this->db->getConnection();
        $consulta = "SELECT * FROM historialpedidos";
        $resultado = mysqli_query($conex, $consulta);
        $orders = [];

        if ($resultado) {
            while ($row = $resultado->fetch_assoc()) {
                $orders[] = $row;
            }
        }

        mysqli_close($conex);
        return $orders;
    }

    private function renderOrderRow($row) {
        $actionClass = $this->getActionClass($row["accion"]);
        return "
            <tr>
                <td>{$row['idRegPedido']}</td>
                <td>{$row['idPedido']}</td>
                <td class='uppercase'>{$row['nameProovedor']}</td>
                <td class='uppercase'>{$row['material']}</td>
                <td class='py-6 px-4'>{$row['cantidad']}</td>
                <td class='py-6 px-4'>{$row['precioUnitario']}</td>
                <td class='py-6 px-2'>
                    <div class='relative grid items-center justify-center font-sans font-bold uppercase whitespace-nowrap select-none {$actionClass} py-1 px-2 text-xs rounded-md'>
                        {$row['accion']}
                    </div>
                </td>
                <td class='py-6 px-4'>{$row['date_reg']}</td>
            </tr>
        ";
    }

    private function getActionClass($action) {
        switch ($action) {
            case 'insertado':
                return 'bg-green-500/20 text-green-600';
            case 'eliminado':
                return 'bg-red-500/20 text-red-700';
            default:
                return 'bg-yellow-500/20 text-yellow-600';
        }
    }

    public function render() {
        $orders = $this->getOrders();
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Tabla de Pedidos</title>
            <link rel="stylesheet" href="../styles/style.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/Loopple/loopple-public-assets@main/riva-dashboard-tailwind/riva-dashboard.css">
            <script>
                function filterOrders() {
                    const searchValue = document.getElementById('search').value.toLowerCase();
                    const orders = document.querySelectorAll('tbody tr');
                    orders.forEach(order => {
                        const cells = order.querySelectorAll('td');
                        let match = false;
                        cells.forEach(cell => {
                            if (cell.textContent.toLowerCase().includes(searchValue)) {
                                match = true;
                            }
                        });
                        if (match) {
                            order.style.display = '';
                        } else {
                            order.style.display = 'none';
                        }
                    });
                }
            </script>
        </head>
        <body>
            <!-- Header -->
            <header>
                <?php $pageTitle = "Header";
                $header = new header;
                $header->head($pageTitle);
                ?>
            </header>

            <!-- Table -->
            <div class="flex flex-wrap">
                <div class="w-full px-3 mb-6 mx-auto">
                    <div class="bg-clip-border bg-white m-2">
                        <div class="border border-dashed bg-clip-border rounded-5xl bg-light/30">
                            <!-- Table Header -->
                            <div class="px-9 py-16 flex justify-between items-center flex-wrap min-h-[70px] pb-5 bg-transparent">
                                <h3 class="flex flex-col items-start justify-center m-2 ml-0 font-medium text-3xl">
                                    <span class="mr-2 font-bold">Historial de Pedidos</span>
                                </h3>
                                <div class="flex items-center">
                                    <a href="../pedidos/RegistrarPedido.php"
                                    class="inline-block text-xl font-medium leading-normal text-center align-middle cursor-pointer rounded-2xl duration-300 text-light-inverse bg-light-dark border-light shadow-none py-2 px-5 hover:bg-secondary active:bg-light focus:bg-light mr-4">Registrar Pedido</a>
                                    <input type="text" id="search" onkeyup="filterOrders()" placeholder="Buscar pedido..." class="p-2 border rounded-lg w-64">
                                </div>
                            </div>

                            <!-- Table Body -->
                            <div class="flex-auto block py-2 mr-6">
                                <div class="overflow-x-auto ml-5">
                                    <table class="w-full my-0 border-neutral-900">
                                        <thead class="align-bottom">
                                            <tr class="font-semibold text-xl text-amber-500">
                                                <th class="pb-3 text-start min-w-[120px]">idRegPedido</th>
                                                <th class="pb-3 text-start min-w-[120px]">ID Pedido</th>
                                                <th class="pb-3 text-start min-w-[90px]">Nombre Proveedor</th>
                                                <th class="pb-3 text-start min-w-[90px]">Material</th>
                                                <th class="pb-3 text-start min-w-[100px]">Cantidad</th>
                                                <th class="pb-3 text-start min-w-[90px]">Costo unitario</th>
                                                <th class="pb-3 text-start">Acción</th>
                                                <th class="pb-3 text-start">Fecha</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-base font-semibold text-gray-900">
                                            <?php 
                                                if (count($orders) > 0) {
                                                    foreach ($orders as $row) {
                                                        echo $this->renderOrderRow($row);
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='8'>No se encontraron registros</td></tr>";
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer>
                <?php $pageTitle = "Footer";
                $footer = new Footer;
                $footer->Footer($pageTitle);?>
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
