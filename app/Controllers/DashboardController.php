<?php
class DashboardController extends Controller {

    public function index() {

        $modeloCliente = new Cliente();
        $modeloProducto = new Productos();
        $modeloPedido = new Pedido();

        $totalClientes = $modeloCliente->totalClientes();
        $totalClientesInactivos = $modeloCliente->totalClientesInactivos();


        $totalProductos = $modeloProducto->totalProductos();
        $totalProductosInactivos = $modeloProducto->totalProductosInactivos();

        $totalPedidos = $modeloPedido->totalPedidos();
        $sumaTotalPedidos = $modeloPedido->sumaTotalPedidos();

        $params = [
            'totalClientes' => $totalClientes,
            'totalClientesInactivos' => $totalClientesInactivos,
            'totalProductos' => $totalProductos,
            'totalPedidos' => $totalPedidos,
            'sumaTotalPedidos' => $sumaTotalPedidos,
            'totalProductosInactivos' => $totalProductosInactivos
        ];




        require __DIR__ . '/../templates/dashboard.php';
        }
        
}
?>