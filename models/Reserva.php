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

    public function obtenerPorId($reservaId)
    {
        if (!$this->conexion) {
            return array();
        }

        $sql = "SELECT reservas.id, reservas.folio, reservas.cliente_id, habitaciones.hotel_id, 
        reservas.habitacion_id,fecha_entrada,fecha_salida,noches,adultos,
        ninos, reservas.precio_noche, subtotal, total, estado_reserva, observaciones, origen,
        clientes.nombres as nombre_cliente, clientes.apellidos, hoteles.nombre as nombre_hotel, habitaciones.tipo_habitacion 
          FROM reservas 
          INNER JOIN clientes on clientes.id = reservas.cliente_id 
          INNER JOIN habitaciones on habitaciones.id = reservas.habitacion_id
          INNER JOIN hoteles on hoteles.id = habitaciones.hotel_id  
          WHERE reservas.deleted_at IS NULL AND reservas.id= :reserva_id";
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':reserva_id', $reservaId, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetchAll();
    }

    public function obtenerDetalleVoucher($reservaId)
    {
        if (!$this->conexion) {
            return array();
        }

        $sql = "SELECT
                    reservas.id,
                    reservas.folio,
                    reservas.fecha_entrada,
                    reservas.fecha_salida,
                    reservas.noches,
                    reservas.adultos,
                    reservas.ninos,
                    reservas.precio_noche,
                    reservas.subtotal,
                    reservas.total,
                    reservas.estado_reserva,
                    reservas.observaciones,
                    reservas.origen,
                    clientes.nombres AS nombre_cliente,
                    clientes.apellidos,
                    clientes.email AS email_cliente,
                    clientes.telefono AS telefono_cliente,
                    hoteles.nombre AS nombre_hotel,
                    hoteles.ciudad,
                    hoteles.direccion,
                    hoteles.telefono AS telefono_hotel,
                    hoteles.email AS email_hotel,
                    hoteles.hora_checkin,
                    hoteles.hora_checkout,
                    habitaciones.tipo_habitacion,
                    habitaciones.capacidad_adultos,
                    habitaciones.capacidad_ninos,
                    habitaciones.cantidad_camas,
                    habitaciones.moneda
                FROM reservas
                INNER JOIN clientes ON clientes.id = reservas.cliente_id
                INNER JOIN habitaciones ON habitaciones.id = reservas.habitacion_id
                INNER JOIN hoteles ON hoteles.id = habitaciones.hotel_id
                WHERE reservas.deleted_at IS NULL
                  AND reservas.id = :reserva_id";

        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':reserva_id', $reservaId, PDO::PARAM_INT);
        $consulta->execute();

        $resultado = $consulta->fetch();

        return $resultado ? $resultado : array();
    }

    public function actualizar($id_reserva, $cliente_id, $habitacion_id, $fecha_entrada, $fecha_salida, $noches, $adultos,
            $ninos, $precio_noche, $subtotal, $total)
    {
        if (!$this->conexion) {
            return false;
        }

        $sql = "UPDATE habitaciones SET nombre = :nombre,   
          ninos = :ninos, precio_noche = :precio_noche, subtotal = :dsubtotal, total = :total WHERE id = :id AND deleted_at IS NULL";
        $consulta = $this->conexion->prepare($sql);

        $sql = "UPDATE reservas SET  cliente_id = :cliente_id, habitacion_id =:habitacion_id, fecha_entrada = :fecha_entrada,
         fecha_salida = :fecha_salida, noches = :noches, adultos = :adultos, ninos = :ninos, precio_noche = :precio_noche, subtotal = :dsubtotal, total = :total WHERE id = :id AND deleted_at IS NULL";
        $consulta = $this->conexion->prepare($sql);

        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->bindParam(':id', $id_reserva);
        $consulta->bindParam(':cliente_id', $cliente_id);
        $consulta->bindParam(':habitacion_id', $habitacion_id);
        $consulta->bindParam(':fecha_entrada', $fecha_entrada);
        $consulta->bindParam(':fecha_salida', $fecha_salida);
        $consulta->bindParam(':noches', $noches);
        $consulta->bindParam(':adultos', $adultos);
        $consulta->bindParam(':ninos', $ninos);
        $consulta->bindParam(':precio_noche', $precio_noche);
        $consulta->bindParam(':subtotal', $subtotal);
        $consulta->bindParam(':total', $total);

        return $consulta->execute();
    }

}
