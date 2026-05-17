<?php

class Cliente {
    private PDO $conexion;

    public function __construct() {
        $this->conexion = Database::getConnection();
    }

    public function getByUsuario(int $idUsuario, int $rol): array {
        try {
    
            // Ver todo
            if ($rol == 3 || $rol == 4) {
                //$sql = "SELECT * FROM clientes c JOIN usuarios u ON c.id_usuario = u.id_usuario ORDER BY id_cliente ASC";
                $sql = "SELECT c.*, u.nombre as nombre_comercial, i.impuesto as nombre_impuesto, p.metodo_pago as nombre_metodo_pago 
                        FROM clientes c 
                        JOIN usuarios u ON c.id_usuario = u.id_usuario
                        JOIN Impuestos i ON c.id_impuesto = i.id_impuesto
                        JOIN Metodo_pago p ON c.id_metodo_pago = p.id_metodo_pago
                        ORDER BY c.id_cliente ASC";
                        
                $stmt = $this->conexion->query($sql);
            } else {
                // Comercial
                $sql = "SELECT c.*, 
                        u.nombre as nombre_comercial,
                        i.impuesto as nombre_impuesto,
                        p.metodo_pago as nombre_metodo_pago
                    FROM clientes c
                    JOIN usuarios u ON c.id_usuario = u.id_usuario
                    JOIN Impuestos i ON c.id_impuesto = i.id_impuesto
                    JOIN Metodo_pago p ON c.id_metodo_pago = p.id_metodo_pago
                    WHERE c.id_usuario = :id
                    ORDER BY c.id_cliente ASC";

                $stmt = $this->conexion->prepare($sql);
                $stmt->execute([':id' => $idUsuario]);
            }
    
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        } catch (Throwable $e) {
            throw $e;
        }
    }

    public function update(int $id, array $datos): void {
        try {
            $sql = "UPDATE clientes SET 
                        nombreCliente = :nombre,
                        apellido1 = :apellido1,
                        apellido2 = :apellido2,
                        emailCliente = :email,
                        documento = :documento,
                        telefono = :telefono,
                        direccion = :direccion,
                        cp = :cp,
                        ciudad = :ciudad,
                        pais = :pais,
                        fecha_de_nacimiento = :fecha_nacimiento,
                        id_metodo_pago = :id_metodo_pago,
                        id_impuesto = :id_impuesto,
                        credito = :credito,
                        id_estado = :id_estado,
                        fecha_de_alta = :fecha_alta,
                        fecha_de_baja = :fecha_baja,
                        id_usuario = :id_usuario
                    WHERE id_cliente = :id";

            $stmt = $this->conexion->prepare($sql);
            $stmt->execute([
                ':nombre'        => $datos['nombre'],
                ':apellido1'     => $datos['apellido1'],
                ':apellido2'     => $datos['apellido2'],
                ':email'         => $datos['email'],
                ':documento'     => $datos['documento'],
                ':telefono'      => $datos['telefono'],
                ':direccion'     => $datos['direccion'],
                ':cp'            => $datos['cp'],
                ':ciudad'        => $datos['ciudad'],
                ':pais'          => $datos['pais'],
                ':fecha_nacimiento' => $datos['fecha_nacimiento'] === '-' ? null : $datos['fecha_nacimiento'],
                ':id_metodo_pago'=> $datos['id_metodo_pago'],
                ':id_impuesto'   => $datos['id_impuesto'],
                ':credito'       => $datos['credito'],
                ':id_estado'     => $datos['id_estado'],
                ':fecha_alta'    => $datos['fecha_alta'] === '-' ? null : $datos['fecha_alta'],
                ':fecha_baja' => $datos['id_estado'] == 2 ? date('Y-m-d') : null,
                ':id_usuario'    => $datos['id_usuario'],
                ':id'            => $id
            ]);
        } catch (Throwable $e) {
            throw $e;
        }
    }

    // Método para insertar un nuevo cliente

    public function insert(array $datos): void {
        try {

            $sql = "INSERT INTO clientes (
                        nombreCliente,
                        apellido1,
                        apellido2,
                        documento,
                        emailCliente,
                        telefono,
                        fecha_de_nacimiento,
                        direccion,
                        cp,
                        ciudad,
                        pais,
                        id_metodo_pago,
                        id_impuesto,
                        credito,
                        id_estado,
                        fecha_de_alta,
                        fecha_de_baja,
                        id_usuario
                    ) VALUES (
                        :nombre,
                        :apellido1,
                        :apellido2,
                        :documento,
                        :email,
                        :telefono,
                        :fecha_nacimiento,
                        :direccion,
                        :cp,
                        :ciudad,
                        :pais,
                        :id_metodo_pago,
                        :id_impuesto,
                        :credito,
                        :id_estado,
                        :fecha_alta,
                        :fecha_baja,
                        :id_usuario
                    )";

            $stmt = $this->conexion->prepare($sql);

            $stmt->execute([
                ':nombre'            => $datos['nombre'],
                ':apellido1'         => $datos['apellido1'],
                ':apellido2'         => $datos['apellido2'],
                ':documento'         => $datos['documento'],
                ':email'             => $datos['email'],
                ':telefono'          => $datos['telefono'],
                ':fecha_nacimiento'  => $datos['fecha_nacimiento'],
                ':direccion'         => $datos['direccion'],
                ':cp'                => $datos['cp'],
                ':ciudad'            => $datos['ciudad'],
                ':pais'              => $datos['pais'],
                ':id_metodo_pago'    => $datos['id_metodo_pago'],
                ':id_impuesto'       => $datos['id_impuesto'],
                ':credito'           => $datos['credito'],
                ':id_estado'         => $datos['id_estado'],
                ':fecha_alta'        => $datos['fecha_alta'],
                ':fecha_baja'        => $datos['fecha_baja'],
                ':id_usuario'        => $datos['id_usuario']
            ]);

        } catch (Throwable $e) {
            throw $e;
        }
    }

    // Método para obtener el total de clientes
        public function totalClientes(): int {

        $sql = "SELECT COUNT(*) as total FROM clientes WHERE id_estado = 1";

        $stmt = $this->conexion->query($sql);

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return (int)$resultado['total'];
    }
        // Método para obtener el total de clientes inactivos
        public function totalClientesInactivos(): int {

        $sql = "SELECT COUNT(*) as totalInactivos FROM clientes WHERE id_estado = 2";

        $stmt = $this->conexion->query($sql);

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return (int)$resultado['totalInactivos'];
    }

}

