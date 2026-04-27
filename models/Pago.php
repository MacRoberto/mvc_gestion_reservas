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

        $params = [];
        if($busquedaLike != ""){//Solo se aplica el filtro si el usuario ingreso algo en el input
            if ($campo != 'todos') {
                $sql .= " AND ".$campo." LIKE :busqueda";
                $params[':busqueda'] = $busquedaLike;
            } else {
                //Agregar campos adicionales donde se desee aplicar el filtro de busqueda
                if($id>0){
                    $sql .= " AND reserva_id = :id";
                    $params[':id'] = $id;
                }else{
                    $sql .= " AND ( reserva_id LIKE :busqueda or referencia LIKE :busqueda) ";
                    $params[':busqueda'] = $busquedaLike;
                }
            }
        }
        
        $sql .= " ORDER BY id DESC";
        //Esto siempre va cuando se ejecuta la consulta
        $consulta = $this->conexion->prepare($sql);
        //Ejecuta la consulta
        $consulta->execute($params);
        //Regresar el resultado de la consulta
        return $consulta->fetchAll();
    }

    public function guardar($reservaId, $metodoPago, $monto, $moneda, $referencia, $estado, $esSimulado, $fechaPago, $respuestaPasarela)
    {
        if (!$this->conexion) {
            return false;
        }

        $sql = "INSERT INTO pagos (reserva_id, metodo_pago, monto, moneda, referencia, estado, es_simulado, fecha_pago, respuesta_pasarela)
                VALUES (:reserva_id, :metodo_pago, :monto, :moneda, :referencia, :estado, :es_simulado, :fecha_pago, :respuesta_pasarela)";
        $consulta = $this->conexion->prepare($sql);

        $consulta->bindParam(':reserva_id', $reservaId, PDO::PARAM_INT);
        $consulta->bindParam(':metodo_pago', $metodoPago);
        $consulta->bindParam(':monto', $monto);
        $consulta->bindParam(':moneda', $moneda);
        $consulta->bindParam(':referencia', $referencia);
        $consulta->bindParam(':estado', $estado);
        $consulta->bindParam(':es_simulado', $esSimulado, PDO::PARAM_INT);
        $consulta->bindParam(':fecha_pago', $fechaPago);
        $consulta->bindParam(':respuesta_pasarela', $respuestaPasarela);

        return $consulta->execute();
    }

}
