<?php
class Impuestos {
    private PDO $conexion;

    public function __construct(){
        $this->conexion = Database::getConnection();
        
    }

    public function getByImpuestos(): array {
        try{
            $sql = "SELECT id_impuesto, impuesto AS 'tipo_de_impuesto' FROM Impuestos ";
            $stmt = $this->conexion->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        }catch(Throwable $e){
            throw $e;
        }
        
    }
}





?>