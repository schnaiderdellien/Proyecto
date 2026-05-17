<?php
class Productos {
    private PDO $conexion;

    public function __construct(){
        $this->conexion = Database::getConnection();
    }

    public function getByProduct(): array {
        try{
            $sql = "SELECT * FROM Productos ORDER BY id_productos ASC";
            $stmt = $this->conexion->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch (Throwable $e){
            throw $e;
        }
    }
    // INSERTAR PRODUCTO

    public function insert(array $datos): void {

        try {

            $sql = "INSERT INTO productos (

                        sku,
                        nombre,
                        descripcion_corta,
                        descripcion_larga,
                        modelo,
                        precio_coste,
                        precio_venta,
                        moneda,
                        stock,
                        stock_minimo,
                        stock_maximo,
                        id_estado,
                        fecha_de_alta,
                        fecha_de_baja

                    ) VALUES (

                        :sku,
                        :nombre,
                        :descripcion_corta,
                        :descripcion_larga,
                        :modelo,
                        :precio_coste,
                        :precio_venta,
                        :moneda,
                        :stock,
                        :stock_minimo,
                        :stock_maximo,
                        :id_estado,
                        :fecha_alta,
                        :fecha_baja
                    )";

            $stmt = $this->conexion->prepare($sql);

            $stmt->execute([

                ':sku'               => $datos['sku'],
                ':nombre'            => $datos['nombre'],
                ':descripcion_corta' => $datos['descripcion_corta'],
                ':descripcion_larga' => $datos['descripcion_larga'],
                ':modelo'            => $datos['modelo'],
                ':precio_coste'      => $datos['precio_coste'],
                ':precio_venta'      => $datos['precio_venta'],
                ':moneda'            => $datos['moneda'],
                ':stock'             => $datos['stock'],
                ':stock_minimo'      => $datos['stock_minimo'],
                ':stock_maximo'      => $datos['stock_maximo'],
                ':id_estado'         => $datos['id_estado'],
                ':fecha_alta'        => $datos['fecha_alta'],
                ':fecha_baja'        => $datos['fecha_baja']

            ]);

        } catch (Throwable $e) {
            throw $e;
        }
    }

    // EDITAR PRODUCTO

    public function update(int $id, array $datos): void {

        try {

            $sql = "UPDATE productos SET

                        sku = :sku,
                        nombre = :nombre,
                        descripcion_corta = :descripcion_corta,
                        descripcion_larga = :descripcion_larga,
                        modelo = :modelo,
                        precio_coste = :precio_coste,
                        precio_venta = :precio_venta,
                        moneda = :moneda,
                        stock = :stock,
                        stock_minimo = :stock_minimo,
                        stock_maximo = :stock_maximo,
                        id_estado = :id_estado,
                        fecha_de_alta = :fecha_alta,
                        fecha_de_baja = :fecha_baja

                    WHERE id_productos = :id";

            $stmt = $this->conexion->prepare($sql);

            $stmt->execute([

                ':sku'               => $datos['sku'],
                ':nombre'            => $datos['nombre'],
                ':descripcion_corta' => $datos['descripcion_corta'],
                ':descripcion_larga' => $datos['descripcion_larga'],
                ':modelo'            => $datos['modelo'],
                ':precio_coste'      => $datos['precio_coste'],
                ':precio_venta'      => $datos['precio_venta'],
                ':moneda'            => $datos['moneda'],
                ':stock'             => $datos['stock'],
                ':stock_minimo'      => $datos['stock_minimo'],
                ':stock_maximo'      => $datos['stock_maximo'],
                ':id_estado'         => $datos['id_estado'],
                ':fecha_alta'        => $datos['fecha_alta'] === '-' ? null : $datos['fecha_alta'],

                ':fecha_baja' => $datos['id_estado'] == 2
                    ? date('Y-m-d')
                    : null,

                ':id' => $id

            ]);

        } catch (Throwable $e) {
            throw $e;
        }
    }

    //función para contar el total de productos
    public function totalProductos(): int {
        try {
            $sql = "SELECT COUNT(*) AS total FROM productos WHERE id_estado = 1";
            $stmt = $this->conexion->query($sql);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return (int)$resultado['total'];
        } catch (Throwable $e) {
            throw $e;}
    }
    //función para contar el total de productos inactivos
        public function totalProductosInactivos(): int {
        try {
            $sql = "SELECT COUNT(*) AS totalProductosInactivos FROM productos WHERE id_estado = 2";
            $stmt = $this->conexion->query($sql);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return (int)$resultado['totalProductosInactivos'];
        } catch (Throwable $e) {
            throw $e;}
    }

}

?> 