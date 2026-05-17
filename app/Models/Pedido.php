<?php
class Pedido {
    private PDO $conexion;

    public function __construct() {
        $this->conexion = Database::getConnection();
    }

    public function getAll(int $idUsuario, int $rol): array {
        try {

        if ((int)$rol === 3 || (int)$rol === 4) {
             $sql = "SELECT p.*, c.nombreCliente, u.nombre AS comercial, ep.estado
                FROM Pedidos p
                JOIN Clientes c 
                    ON p.id_cliente = c.id_cliente
                JOIN Usuarios u 
                    ON p.id_usuario = u.id_usuario
                JOIN Estado_pedido ep
                    ON p.id_estado_pedido = ep.id_estado_pedido
                ORDER BY p.id_pedido DESC";


            $stmt = $this->conexion->query($sql);
        } else {

                $sql = "SELECT p.*, c.nombreCliente, u.nombre AS comercial, ep.estado
                FROM Pedidos p
                JOIN Clientes c 
                    ON p.id_cliente = c.id_cliente
                JOIN Usuarios u 
                    ON p.id_usuario = u.id_usuario
                JOIN Estado_pedido ep
                    ON p.id_estado_pedido = ep.id_estado_pedido
                WHERE p.id_usuario = :id
                ORDER BY p.id_pedido DESC";
                $stmt = $this->conexion->prepare($sql);
                $stmt->execute([':id' => $idUsuario]);
        }

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $e) {
            throw $e;
        }
    }


    public function getById(
        int $idPedido,
        int $idUsuario,
        int $rol
    ): array|false {

        if ((int)$rol === 3 || (int)$rol === 4) {

            // ADMIN Y DIRECCIÓN VEN TODO

            $sql = "SELECT p.*,
                        c.nombreCliente,
                        u.nombre AS comercial,
                        ep.estado,
                        mp.metodo_pago,
                        i.impuesto AS tipo_de_impuesto

                    FROM Pedidos p

                    JOIN Clientes c
                        ON p.id_cliente = c.id_cliente

                    JOIN Usuarios u
                        ON p.id_usuario = u.id_usuario

                    JOIN Estado_pedido ep
                        ON p.id_estado_pedido = ep.id_estado_pedido

                    JOIN Metodo_pago mp
                        ON p.id_metodo_pago = mp.id_metodo_pago

                    JOIN Impuestos i
                        ON p.id_impuesto = i.id_impuesto

                    WHERE p.id_pedido = :id";

            $stmt = $this->conexion->prepare($sql);

            $stmt->execute([
                ':id' => $idPedido
            ]);

        } else {

            // COMERCIALES SOLO SUS PEDIDOS

            $sql = "SELECT p.*,
                        c.nombreCliente,
                        u.nombre AS comercial,
                        ep.estado,
                        mp.metodo_pago,
                        i.impuesto AS tipo_de_impuesto

                    FROM Pedidos p

                    JOIN Clientes c
                        ON p.id_cliente = c.id_cliente

                    JOIN Usuarios u
                        ON p.id_usuario = u.id_usuario

                    JOIN Estado_pedido ep
                        ON p.id_estado_pedido = ep.id_estado_pedido

                    JOIN Metodo_pago mp
                        ON p.id_metodo_pago = mp.id_metodo_pago

                    JOIN Impuestos i
                        ON p.id_impuesto = i.id_impuesto

                    WHERE p.id_pedido = :id
                    AND p.id_usuario = :id_usuario";

            $stmt = $this->conexion->prepare($sql);

            $stmt->execute([
                ':id' => $idPedido,
                ':id_usuario' => $idUsuario
            ]);
        }

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
        public function getDetallePedido(int $id): array {

        $sql = "SELECT dp.*,
                    p.nombre AS nombre_producto,
                    p.sku as sku_producto
                FROM Detalle_pedidos dp

                JOIN Productos p
                    ON dp.id_productos = p.id_productos

                WHERE dp.id_pedido = :id";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Función para guardar o actualizar un pedido
        public function guardarPedido(array $data): bool {

        try {

            $this->conexion->beginTransaction();


            $fechaConfirmacion = null;
            $fechaPreparacion = null;
            $fechaCierre = null;
            $fechaEnvio = null;


            $pedidoActual =
                $this->getById($data['id_pedido'], $data['id_usuario'], $data['rol']);

            $fechaConfirmacion =
                $pedidoActual['fecha_confirmacion'];

            $fechaPreparacion =
                $pedidoActual['fecha_preparacion'];

            $fechaCierre =
                $pedidoActual['fecha_cierre'];

            $fechaEnvio =
                $pedidoActual['fecha_envio'];

                //añadimos la fecha segun su estado.

            if (
                $data['id_estado_pedido'] == 2
                && !$fechaConfirmacion
            ) {

                $fechaConfirmacion = date('Y-m-d');

            }

            // PREPARACIÓN

            if (
                $data['id_estado_pedido'] == 3
                && !$fechaPreparacion
            ) {

                $fechaPreparacion = date('Y-m-d');

            }

            // CERRADO

            if (
                $data['id_estado_pedido'] == 4
                && !$fechaCierre
            ) {

                $fechaCierre = date('Y-m-d');

            }

            // ENVIADO

            if (
                $data['id_estado_pedido'] == 5
                && !$fechaEnvio
            ) {

                $fechaEnvio = date('Y-m-d');

            }



            // ACTUALIZAR CABECERA PEDIDO

            $sql = "UPDATE Pedidos SET

                        id_cliente = :id_cliente,
                        id_usuario = :id_usuario,
                        id_estado_pedido = :id_estado_pedido,
                        id_metodo_pago = :id_metodo_pago,
                        id_impuesto = :id_impuesto,
                        fecha_pedido = :fecha_pedido,
                        notas = :notas,
                        bruto = :bruto,
                        descuento = :descuento,
                        total = :total,
                        fecha_confirmacion = :fecha_confirmacion,
                        fecha_preparacion = :fecha_preparacion,
                        fecha_cierre = :fecha_cierre,
                        fecha_envio = :fecha_envio

                    WHERE id_pedido = :id_pedido";

            $stmt = $this->conexion->prepare($sql);

            $stmt->execute([

                ':id_cliente' => $data['id_cliente'],
                ':id_usuario' => $data['id_usuario'],
                ':id_estado_pedido' => $data['id_estado_pedido'],
                ':id_metodo_pago' => $data['id_metodo_pago'],
                ':id_impuesto' => $data['id_impuesto'],
                ':fecha_pedido' => $data['fecha_pedido'],
                ':notas' => $data['notas'],
                ':bruto' => $data['bruto'],
                ':descuento' => $data['descuento'],
                ':total' => $data['total'],
                ':id_pedido' => $data['id_pedido'],
                ':fecha_confirmacion' => $fechaConfirmacion,
                ':fecha_preparacion' => $fechaPreparacion,
                ':fecha_cierre' => $fechaCierre,
                ':fecha_envio' => $fechaEnvio
            ]);

            // ACTUALIZAR LÍNEAS EXISTENTES

            foreach ($data['lineas'] as $linea) {

                $subtotal =
                    $linea['cantidad']
                    * $linea['precio_unitario'];

                $total =
                    $subtotal
                    - $linea['descuento'];


                if (!empty($linea['eliminada'])) {

                $sqlDelete = "
                    DELETE FROM Detalle_pedidos
                    WHERE id_detalle_pedido = :id
                ";

                $stmtDelete =
                    $this->conexion->prepare($sqlDelete);

                $stmtDelete->execute([
                    ':id' =>
                        $linea['id_detalle_pedido']
                ]);

                continue;
            }


            if (!empty($linea['nueva'])) {

                $subtotal =
                    $linea['cantidad']
                    * $linea['precio_unitario'];

                $total =
                    $subtotal
                    - $linea['descuento'];

                $sqlInsert = "

                    INSERT INTO Detalle_pedidos (

                        id_pedido,
                        id_productos,
                        cantidad,
                        cantidad_servida,
                        precio_unitario,
                        subtotal,
                        descuento,
                        total

                    ) VALUES (

                        :id_pedido,
                        :id_productos,
                        :cantidad,
                        :cantidad_servida,
                        :precio_unitario,
                        :subtotal,
                        :descuento,
                        :total
                    )
                ";

                $stmtInsert =
                    $this->conexion->prepare($sqlInsert);

                $stmtInsert->execute([

                    ':id_pedido' =>
                        $data['id_pedido'],

                    ':id_productos' =>
                        $linea['id_productos'],

                    ':cantidad' =>
                        $linea['cantidad'],

                    ':cantidad_servida' =>
                        $linea['cantidad_servida'],

                    ':precio_unitario' =>
                        $linea['precio_unitario'],

                    ':subtotal' =>
                        $subtotal,

                    ':descuento' =>
                        $linea['descuento'],

                    ':total' =>
                        $total
                ]);

                continue;
            }

                $sqlLinea = "UPDATE Detalle_pedidos SET

                                cantidad = :cantidad,
                                cantidad_servida = :cantidad_servida,
                                precio_unitario = :precio_unitario,
                                descuento = :descuento,
                                subtotal = :subtotal,
                                total = :total

                            WHERE id_detalle_pedido =
                                :id_detalle_pedido";

                $stmtLinea =
                    $this->conexion->prepare($sqlLinea);

                $stmtLinea->execute([

                    ':cantidad' =>
                        $linea['cantidad'],

                    ':cantidad_servida' =>
                        $linea['cantidad_servida'],

                    ':precio_unitario' =>
                        $linea['precio_unitario'],

                    ':descuento' =>
                        $linea['descuento'],

                    ':subtotal' =>
                        $subtotal,

                    ':total' =>
                        $total,

                    ':id_detalle_pedido' =>
                        $linea['id_detalle_pedido']
                ]);
            }

            $this->conexion->commit();

            return true;

        } catch (Throwable $e) {

            $this->conexion->rollBack();

            throw $e;
        }
    }
}
?> 