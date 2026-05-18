<?php
class PedidosController extends Controller {

    public function pedidos() {
        try {
            $params = [
                'js' => 'pedidos.js',
                'rol' => $this->session->getUserLevel()
            ];

            require __DIR__ . '/../templates/pedidos/pedidos.php';

        } catch (Throwable $e) {
            $this->handleError($e);
        }
    }

    public function apiPedidos(){
        try {
            header('Content-Type: application/json');
            $modelo = new Pedido();
            $pedidos = $modelo->getAll(
                $this->session->getUserId(),
                $this->session->getUserLevel()
            );

            echo json_encode([
                'userLevel' => $this->session->getUserLevel(),
                'data' => $pedidos
            ]);

        } catch (Throwable $e) {
            $this->handleError($e);
        }
    }

    public function apiEstadosPedido() {

        try {

            header('Content-Type: application/json');

            $modelo = new EstadoPedido();

            $estados = $modelo->getAll();

            echo json_encode([
                'data' => $estados
            ]);

        } catch (Throwable $e) {

            $this->handleError($e);

        }
    }

    // Método para mostrar el formulario de edición de pedido

    public function editarPedido() {

        try {

            $params = [
                'js' => 'editarPedido.js',
                'rol' => $this->session->getUserLevel()
            ];

            require __DIR__ . '/../templates/pedidos/editarPedido.php';

        } catch (Throwable $e) {

            $this->handleError($e);

        }
    }

    public function apiPedidoById() {

        try {

            header('Content-Type: application/json');

            $id = $_GET['id'];

            $modelo = new Pedido();

            $pedido = $modelo->getById(
                $id,
                $this->session->getUserId(),
                $this->session->getUserLevel()
            );

            $detalle = $modelo->getDetallePedido($id);

            echo json_encode([
                'pedido' => $pedido,
                'detalle' => $detalle
            ]);

        } catch (Throwable $e) {

            $this->handleError($e);

        }
    }


        public function guardarPedido() {

        try {

            header('Content-Type: application/json');

            $data = json_decode(
                file_get_contents("php://input"),
                true
            );

            $modelo = new Pedido();

            $ok = $modelo->guardarPedido($data);

            echo json_encode([
                'success' => $ok
            ]);

        } catch (Throwable $e) {

            echo json_encode([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

        public function verPedido() {

        try {

            $params = [
                'js' => 'verPedido.js',
                'rol' => $this->session->getUserLevel()
            ];

            require __DIR__ . '/../templates/pedidos/verPedido.php';

        } catch (Throwable $e) {

            $this->handleError($e);
        }
    }

        public function nuevoPedido() {

        try {

            $params = [
                'js' => 'nuevoPedido.js',
                'rol' => $this->session->getUserLevel()
            ];

            require __DIR__
                . '/../templates/pedidos/nuevoPedido.php';

        } catch (Throwable $e) {

            $this->handleError($e);
        }
    }

        public function apiNuevoPedido() {

        try {

            header('Content-Type: application/json');

            $modelo = new Pedido();

            $numeroPedido =
                $modelo->getSiguienteNumeroPedido();

            echo json_encode([

                'numero_pedido' =>
                    $numeroPedido,

                'fecha_pedido' =>
                    date('Y-m-d'),

                'id_estado_pedido' => 1
            ]);

        } catch (Throwable $e) {

            $this->handleError($e);
        }
    }

        public function crearPedido() {

        try {

            header('Content-Type: application/json');

            $data = json_decode(
                file_get_contents("php://input"),
                true
            );

            $modelo = new Pedido();

            $idPedido =
                $modelo->crearPedido($data);

            echo json_encode([

                'success' => true,

                'id_pedido' => $idPedido
            ]);

        } catch (Throwable $e) {

            echo json_encode([

                'success' => false,

                'error' => $e->getMessage()
            ]);
        }
    }
    

}





?>