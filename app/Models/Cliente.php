<?php

class Cliente {
    private PDO $conexion;

    public function __construct() {
        $this->conexion = Database::getConnection();
    }

    public function getByUsuario(int $idUsuario, int $rol): array {
        try {
    
            // Ver todo
            if ($rol == 1 || $rol == 2) {
                $sql = "SELECT * FROM clientes ORDER BY id_cliente ASC";
                $stmt = $this->conexion->query($sql);
            } else {
                // Comercial
                $sql = "SELECT * FROM clientes WHERE id_usuario = :id ORDER BY id_cliente ASC";
                $stmt = $this->conexion->prepare($sql);
                $stmt->execute([':id' => $idUsuario]);
            }
    
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        } catch (Throwable $e) {
            throw $e;
        }
    }

}