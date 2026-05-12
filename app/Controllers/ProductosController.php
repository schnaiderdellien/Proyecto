<?php
class ProductosController extends Controller {



    public function Productos (){
        try{
            $params =[
                'js'=> 'productos.js',
                'rol' => $this->session->getUserLevel() 
            ];

            require __DIR__ . '/../templates/productos/productos.php';

        }catch(Throwable $e){
            $this->handleError($e);
        }
    }

    public function apiProductos() {
        try {
            header('Content-Type: application/json');
            $modelo = new Productos();

            $idUsuario = $this->session->getUserId();
            $rol = $this->session->getUserLevel();

            $productos = $modelo->getByProduct($idUsuario, $rol);
    
            echo json_encode([
                'userLevel' => $rol,
                'data' => $productos
            ]);
        } catch (Throwable $e) {
            $this->handleError($e);
        }
    }


}





?>