<?php

class ClienteController extends Controller {

    public function clientes() {
        try {
            $params = [
                'js'=> 'clientes.js',
                'rol' => $this->session->getUserLevel() 
            ];

            require __DIR__ . '/../templates/clientes/clientes.php';

        } catch (Throwable $e) {
            $this->handleError($e);
        }
    }
 //API Para traer los clientes

    public function apiClientes(){
        try{
            header('Content-Type: application/json');
            $modelo = new Cliente ();

            $idUsuario = $this->session->getUserId();
            $rol = $this->session->getUserLevel();

            $clientes = $modelo->getByUsuario($idUsuario, $rol);

            echo json_encode([
                'userLevel' => $rol,
                'data'=> $clientes
            ]);
            
        }catch(Throwable $e){
            $this->handleError($e);
        }
    }

//API Para traer los comerciales

    public function apiComerciales() {
        try {
            header('Content-Type: application/json');
            $modelo = new Comerciales();
            $comerciales = $modelo->getByCommercial();
            echo json_encode(['data' => $comerciales]);
        } catch (Throwable $e) {
            $this->handleError($e);
        }
    }
    
 //API Para traer los metodos de pagos
    public function apiMetodosPago() {
    try {
        header('Content-Type: application/json');
        $modelo = new MetodosPago();
        $metodos = $modelo->getByPagos();
        echo json_encode(['data' => $metodos]);
    } catch (Throwable $e) {
        $this->handleError($e);
    }
}
 //API Para traer los impuesto
    public function apiImpuestos() {
        try {
            header('Content-Type: application/json');
            $modelo = new Impuestos();
            $impuestos = $modelo->getByImpuestos();
            echo json_encode(['data' => $impuestos]);
        } catch (Throwable $e) {
            $this->handleError($e);
        }
    }

    

    public function editarCliente() {
    try {
        $id = $_POST['id_cliente'];
        $modelo = new Cliente();
        $modelo->update($id, $_POST);

        header('Location: index.php?ctl=clientes');
        exit;
    } catch (Throwable $e) {
        $this->handleError($e);
    }
}
}