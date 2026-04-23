<?php

include_once 'config/database.php';

class Pago
{
    private $conexion;

    public function __construct()
    {
        $database = new Database();
        $this->conexion = $database->conectar();
    }

    //
    public function obtenerDetallePago($id)
    {
        if (!$this->conexion) {
            return array();
        }
        
        //Cambiar
        $sql = "SELECT id, reserva_id, metodo_pago, monto, moneda, referencia, estado, es_simulado, 
        fecha_pago, respuesta_pasarela FROM pagos WHERE deleted_at IS NULL AND reserva_id = :idReserva";
     
        //Esto siempre va cuando se ejecuta la consulta
        $consulta = $this->conexion->prepare($sql);
        //Aqui se pasan los parametros utilizados en la consulta
        $consulta->bindParam(':idReserva', $id);
        //Ejecuta la consulta
        $consulta->execute();
        //Regresar el resultado de la consulta
        return $consulta->fetchAll();
    }

}