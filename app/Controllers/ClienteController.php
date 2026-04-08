<?php

class ClienteController extends Controller {

    public function clientes() {
        try {
            $params = [
                'js'=> 'clientes.js'
            ];

            require __DIR__ . '/../templates/clientes/clientes.php';

        } catch (Throwable $e) {
            $this->handleError($e);
        }
    }

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
}