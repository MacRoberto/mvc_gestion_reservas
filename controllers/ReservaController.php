<?php

include_once 'models/Reserva.php';

class ReservaController
{
    public function procesar($accion)
    {
        $reserva = new Reserva();
        switch ($accion) {
            case 'editar':
                
                break;
            case 'actualizar':
                
                break;
            default:
                $campo = isset($_GET['campo']) ? $_GET['campo'] : 'todos';
                $busqueda = isset($_GET['busqueda']) ? trim($_GET['busqueda']) : '';
                $reservas = $reserva->obtenerTodos($campo, $busqueda);
                
                $titulo = 'Lista de reservas';
                include 'views/reservas/index.php';
            break;
        }
    }
}
<?php

include_once 'models/Reserva.php';


class ReservaController
{
    public function procesar($accion)
    {
        $reservas = new Reserva();

        if ($accion == 'nuevo') {
            $reservas = new Reserva();
            $reservas = $Reserva->obtenerTodos();
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

            $reservas ->guardar($folio, $cliente_id, $habitacion_id, $fecha_entrada, $fecha_salida, $noches, $adultos,
            $ninos, $precio_noche, $subtotal, $total, $estado_reserva, $observaciones, $origen);
            
            header('location: reservas.php');
            exit;
            
        } elseif ($accion == 'editar') {
            $id = isset($_GET['id']) ? $_GET['id'] : 0;
            $reservasEditar = $reservas->obtenerPorId($id);
            $titulo = 'Editar reservas';
            include 'views/reservas/edit.php';
        } elseif ($accion == 'actualizar') {
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

            $reservas ->actualizar($folio, $cliente_id, $habitacion_id, $fecha_entrada, $fecha_salida, $noches, $adultos,
            $ninos, $precio_noche, $subtotal, $total, $estado_reserva, $observaciones, $origen);

            header('location: reservas.php');
            exit;

        } elseif ($accion == 'eliminar') {
            $id = isset($_GET['id']) ? $_GET['id'] : 0;

            $reservas->eliminar($id);
            header('Location: reservas.php');
            exit;
        } else {
            /*
            $campo = isset($_GET['campo']) ? $_GET['campo'] : 'todos';
            $busqueda = isset($_GET['busqueda']) ? trim($_GET['busqueda']) : '';
            $usuarios = $usuario->obtenerTodos($campo, $busqueda);//>Consultas
            $titulo = 'Lista de usuarios';

            $hotelId = isset($_GET['hotel_id']) ? (int) $_GET['hotel_id'] : 0;

            if ($hotelId > 0) {
                $hotel = new Hotel();
                $hotelInfo = $hotel->obtenerPorId($hotelId);
                $habitaciones = $habitacion->obtenerPorHotelId($hotelId);
                $titulo = 'Lista de habitaciones del hotel: ' . $hotelInfo['nombre'];
            } else {
                $hotelId = 0;
                $habitaciones = $habitacion->obtenerTodos();
                $titulo = 'Lista de habitaciones';
            }
            */
            include 'views/reservas/index.php';
        }
    }
}