<?php
class DashboardController extends Controller {

    public function index() {

        $modeloCliente = new Cliente();
        $modeloProducto = new Productos();

        $totalClientes = $modeloCliente->totalClientes();
        $totalClientesInactivos = $modeloCliente->totalClientesInactivos();

        $totalProductos = $modeloProducto->totalProductos();
        $totalProductosInactivos = $modeloProducto->totalProductosInactivos();

        $params = [
            'totalClientes' => $totalClientes,
            'totalClientesInactivos' => $totalClientesInactivos,
            'totalProductos' => $totalProductos,
            'totalProductosInactivos' => $totalProductosInactivos
        ];




        require __DIR__ . '/../templates/dashboard.php';
        }
        
}
?>