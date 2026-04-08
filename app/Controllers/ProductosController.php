<?php
class ProductosController extends Controller {

    public function Productos() {
        try {
            $modelo = new Productos();
            $productos = $modelo->getByProduct();
    
            $params = [
                'productos' => $productos,
                'rol' => $this->session->getUserLevel()
            ];
            require __DIR__ . '/../templates/productos/productos.php';
        } catch (Throwable $e) {
            $this->handleError($e);
        }
    }


}





?>