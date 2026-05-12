<?php

class Comerciales {
    private PDO $conexion;

    public function __construct() {
        $this->conexion = Database::getConnection();
    }

    public function getByCommercial(): array {
        try {
            $sql = "SELECT id_usuario, nombre FROM usuarios WHERE id_rol = 3";
            $stmt = $this->conexion->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $e) {
            throw $e;
        }
    }
}