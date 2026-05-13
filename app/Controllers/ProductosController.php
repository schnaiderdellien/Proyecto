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

        public function guardarProducto() {

            try {

                $errores = [];

                // Recoger y validar los datos del formulario

                $sku = recoge('sku');
                $nombre = recoge('nombre');
                $descripcionCorta = recoge('descripcion_corta');
                $descripcionLarga = recoge('descripcion_larga');
                $modeloProducto = recoge('modelo');
                $precioCoste = recoge('precio_coste');
                $precioVenta = recoge('precio_venta');
                $moneda = recoge('moneda');
                $stock = recoge('stock');
                $stockMinimo = recoge('stock_minimo');
                $stockMaximo = recoge('stock_maximo');
                $idEstado = recoge('id_estado');
                $fechaAlta = recoge('fecha_alta');

                // validaciones

                cUser($sku, 'SKU', $errores, 30, 2);

                cTextoProducto($nombre, 'Nombre', $errores);

                cTextoProducto($modeloProducto, 'Modelo', $errores);

                cDecimal($precioCoste, 'Precio coste', $errores);

                cDecimal($precioVenta, 'Precio venta', $errores);

                cNum($stock, 'Stock', $errores);

                cNum($stockMinimo, 'Stock mínimo', $errores);

                cNum($stockMaximo, 'Stock máximo', $errores);

                cRadio(
                    $idEstado,
                    'Estado',
                    $errores,
                    ['1', '2']
                );

                // Si algun campo le falta o no es correcto, se muestra el error y se detiene la ejecución

                if (!empty($errores)) {

                    header('Location: index.php?ctl=productos');
                    exit;
                }

                // Si todo es correcto, se prepara el array de datos para insertar en la base de datos

                $datos = [

                    'sku' => $sku,
                    'nombre' => $nombre,
                    'descripcion_corta' => $descripcionCorta,
                    'descripcion_larga' => $descripcionLarga,
                    'modelo' => $modeloProducto,
                    'precio_coste' => $precioCoste,
                    'precio_venta' => $precioVenta,
                    'moneda' => $moneda,
                    'stock' => $stock,
                    'stock_minimo' => $stockMinimo,
                    'stock_maximo' => $stockMaximo,
                    'id_estado' => $idEstado,
                    'fecha_alta' => $fechaAlta ?: null,
                    'fecha_baja' => null

                ];

                // insertar el producto en la base de datos

                $modelo = new Productos();

                $modelo->insert($datos);

                header('Location: index.php?ctl=productos');
                exit;

            } catch (Throwable $e) {

                $this->handleError($e);

            }
        }

    public function editarProducto() {
        try {

            $id = $_POST['id_productos'];

            $modelo = new Productos();

            $modelo->update($id, $_POST);

            header('Location: index.php?ctl=productos');
            exit;

        } catch (Throwable $e) {
            $this->handleError($e);
        }
    }


}


?>