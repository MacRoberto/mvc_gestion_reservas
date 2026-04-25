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
    public function obtenerDetallePago($id, $campo, $busqueda)
    {
               
        if (!$this->conexion) {
            return array();
        }
        
        $busquedaLike = '%' . $busqueda . '%';
        
        //Cambiar
        $sql = "SELECT id, reserva_id, metodo_pago, monto, moneda, referencia, estado, es_simulado, 
        fecha_pago, respuesta_pasarela FROM pagos WHERE deleted_at IS NULL ";

        if($busquedaLike != ""){//Solo se aplica el filtro si el usuario ingreso algo en el input
            if ($campo != 'todos') {
                $sql .= " AND ".$campo." LIKE :busqueda";
            } else {
                //Agregar campos adicionales donde se desee aplicar el filtro de busqueda
                $sql .= " AND ( id LIKE :busqueda)";
            }
        }
        
        $sql .= " ORDER BY id DESC";
        //Esto siempre va cuando se ejecuta la consulta
        $consulta = $this->conexion->prepare($sql);
        //Aqui se pasan los parametros utilizados en la consulta
        $consulta->bindParam(':busqueda', $busquedaLike);
        //Ejecuta la consulta
        $consulta->execute();
        //Regresar el resultado de la consulta
        return $consulta->fetchAll();
    }

}