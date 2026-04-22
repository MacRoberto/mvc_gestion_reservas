<?php

include_once 'models/Reserva.php';
include_once 'models/Habitacion.php';
include_once 'services/VoucherMailer.php';


class ReservaController
{
    public function procesar($accion)
    {
        $reserva = new Reserva();
        $habitacion = new Habitacion();
        if ($accion == 'nuevo') {
            $reserva = new Reserva();
            $reserva = $Reserva->obtenerTodos();
            $titulo = 'Nuevo habitacion';
            include 'views/reservas/create.php';
        } elseif ($accion == 'guardar') {
            $folio = isset($_POST['folio']) ? $_POST['folio']: '';
            $cliente_id = isset($_POST['cliente_id']) ? $_POST['cliente_id']: '';
            $habitacion_id = isset($_POST['habitacion_id']) ? $_POST['habitacion_id']: '';
            $fecha_entrada = isset($_POST['fecha_entrada']) ? $_POST['fecha_entrada']: '';
            $fecha_salida = isset($_POST['fecha_salida']) ? $_POST['fecha_salida']: '';
            $noches = isset($_POST['noches']) ? $_POST['noches']: '';
            $adultos = isset($_POST['adultos']) ? $_POST['adultos']: '';
            $ninos = isset($_POST['ninos']) ? $_POST['ninos']: '';
            $precio_noche = isset($_POST['precio_noche']) ? $_POST['precio_noche']: '' ;
            $subtotal = isset($_POST['subtotal']) ? $_POST['subtotal'] : '' ;
            $total = isset($_POST['total']) ? $_POST['total'] : '';
            $estado_reserva = isset($_POST['estado_reserva']) ? $_POST['estado_reserva'] : '';
            $observaciones = isset($_POST[observaciones]) ? $_POST['observaciones'] : '';
            $origen = isset($_POST['origen']) ? $_POST['origen'] : '';

            $reserva->guardar($folio, $cliente_id, $habitacion_id, $fecha_entrada, $fecha_salida, $noches, $adultos,
            $ninos, $precio_noche, $subtotal, $total, $estado_reserva, $observaciones, $origen);
            
            header('location: reservas.php');
            exit;
            
        } elseif ($accion == 'editar') {
            $id = isset($_GET['id']) ? $_GET['id'] : 0;
            $reservasEditar = $reserva->obtenerPorId($id);
            $habitaciones = $habitacion->obtenerPorHotelId($reservasEditar[0]['hotel_id']);
            $titulo = 'Editar reservas';
            include 'views/reservas/edit.php';
        } elseif ($accion == 'actualizar') {
            $id_reserva = isset($_POST['id']) ? $_POST['id']: 0;
            $cliente_id = isset($_POST['cliente_id']) ? $_POST['cliente_id']: '';
            $nombre = isset($_POST['nombre_cliente']) ? $_POST['nombre_cliente']: '';
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos']: '';
            $habitacion_id = isset($_POST['tipo_habitacion']) ? $_POST['tipo_habitacion']: '';
            $fecha_entrada = isset($_POST['fecha_entrada']) ? $_POST['fecha_entrada']: '';
            $fecha_salida = isset($_POST['fecha_salida']) ? $_POST['fecha_salida']: '';
            $noches = isset($_POST['noches']) ? $_POST['noches']: '';
            $adultos = isset($_POST['adultos']) ? $_POST['adultos']: '';
            $ninos = isset($_POST['ninos']) ? $_POST['ninos']: '';
            $precio_noche = isset($_POST['precio_noche']) ? $_POST['precio_noche']: '' ;
            $subtotal = isset($_POST['subtotal']) ? $_POST['subtotal'] : '' ;
            $total = isset($_POST['total']) ? $_POST['total'] : '';

            //Invocar/llamar funcion
            $reserva->actualizar($id_reserva, $cliente_id,$nombre, $apellidos, $habitacion_id, 
            $fecha_entrada, $fecha_salida, $noches, $adultos, $ninos, $precio_noche, $subtotal, $total);

            header('location: reservas.php');
            exit;

        } elseif ($accion == 'eliminar') {
            $id = isset($_GET['id']) ? $_GET['id'] : 0;

            $reserva->eliminar($id);
            header('Location: reservas.php');
            exit;
        } elseif ($accion == 'enviar-voucher') {
            $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
            $detalleReserva = $reserva->obtenerDetalleVoucher($id);

            if (empty($detalleReserva)) {
                header('Location: reservas.php?mensaje=' . urlencode('No se encontro la reserva para generar el voucher.') . '&tipo=error');
                exit;
            }

            try {
                $voucherMailer = new VoucherMailer();
                $voucherMailer->enviarVoucherReserva($detalleReserva);

                header('Location: reservas.php?mensaje=' . urlencode('Voucher enviado a ' . $detalleReserva['email_cliente']) . '&tipo=ok');
                exit;
            } catch (RuntimeException $e) {
                header('Location: reservas.php?mensaje=' . urlencode($e->getMessage()) . '&tipo=error');
                exit;
            }
        } else {
            $campo = isset($_GET['campo']) ? $_GET['campo'] : 'todos';
            $busqueda = isset($_GET['busqueda']) ? trim($_GET['busqueda']) : '';
            $reservas = $reserva->obtenerTodos($campo, $busqueda);
            
            $titulo = 'Lista de reservas';
            include 'views/reservas/index.php';
        }
    }
}
