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
    public function guardarCliente() {
        try {
            

            $modelo = new Cliente();

            $datos = [
                'nombre'            => $_POST['nombre'],
                'apellido1'         => $_POST['apellido1'],
                'apellido2'         => $_POST['apellido2'],
                'documento'         => $_POST['documento'],
                'email'             => $_POST['email'],
                'telefono'          => $_POST['telefono'],
                'fecha_nacimiento'  => $_POST['fecha_nacimiento'] ?: null,
                'direccion'         => $_POST['direccion'],
                'cp'                => $_POST['cp'],
                'ciudad'            => $_POST['ciudad'],
                'pais'              => $_POST['pais'],
                'id_metodo_pago'    => $_POST['id_metodo_pago'],
                'id_impuesto'       => $_POST['id_impuesto'],
                'credito'           => $_POST['credito'],
                'id_estado'         => $_POST['id_estado'],
                'fecha_alta'        => $_POST['fecha_alta'] ? : null,
                'fecha_baja'        => $_POST['fecha_baja'] === '-' ? null : $_POST['fecha_baja'],
                'id_usuario'        => $_POST['id_usuario']
            ];

            $modelo->insert($datos);

            header('Location: index.php?ctl=clientes');
            exit;

        } catch (Throwable $e) {
            $this->handleError($e);
        }
    }
}