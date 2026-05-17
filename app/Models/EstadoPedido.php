<?php

class EstadoPedido {

    private PDO $conexion;

    public function __construct() {
        $this->conexion = Database::getConnection();
    }

    public function getAll(): array {

        $sql = "SELECT *
                FROM Estado_pedido
                ORDER BY id_estado_pedido ASC";

        $stmt = $this->conexion->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}