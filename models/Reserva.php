<?php

include_once 'config/database.php';

class Reserva
{
    private $conexion;

    public function __construct()
    {
        $database = new Database();
        $this->conexion = $database->conectar();
    }

    public function obtenerTodos($campo = "todos", $busqueda = "")
    {
        if (!$this->conexion) {
            return array();
        }

        $busquedaLike = '%' . $busqueda . '%';
        //Sustituir * por el nombre de los campos que se vayan a utilizar
        $sql = "SELECT reservas.id, reservas.folio, reservas.cliente_id, habitaciones.hotel_id, 
        reservas.habitacion_id,fecha_entrada,fecha_salida,noches,adultos,
        ninos, reservas.precio_noche, subtotal, total, estado_reserva, observaciones, origen,
        clientes.nombres as nombre_cliente, clientes.apellidos, hoteles.nombre as nombre_hotel, habitaciones.tipo_habitacion 
          FROM reservas 
          INNER JOIN clientes on clientes.id = reservas.cliente_id 
          INNER JOIN habitaciones on habitaciones.id = reservas.habitacion_id
          INNER JOIN hoteles on hoteles.id = habitaciones.hotel_id  
          WHERE reservas.deleted_at IS NULL";

        if($busquedaLike != ""){//Solo se aplica el filtro si el usuario ingreso algo en el input
            if ($campo != 'todos') {
                $sql .= " AND ".$campo." LIKE :busqueda";
            } else {
                //Agregar campos adicionales donde se desee aplicar el filtro de busqueda
                $sql .= " AND (folio LIKE :busqueda)";
            }
        }
        

        $sql .= " ORDER BY reservas.id DESC";
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':busqueda', $busquedaLike);
        $consulta->execute();

        return $consulta->fetchAll();
    }
}
