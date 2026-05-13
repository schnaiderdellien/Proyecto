<?php

class RolesUser {
    private PDO $conexion;

    public function __construct() {
        $this->conexion = Database::getConnection();
    }

    public function getByRole(): array {
        try {
            $sql = "SELECT * FROM Rol";
            $stmt = $this->conexion->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $e) {
            throw $e;
        }
    }
}