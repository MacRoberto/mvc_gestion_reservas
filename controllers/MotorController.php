<?php

include_once 'models/Hotel.php';
include_once 'models/Habitacion.php';
include_once 'models/Reserva.php';
include_once 'models/Cliente.php';
include_once 'models/Usuario.php';

class MotorController
{
    public function procesar($accion)
    {
        $hotel = new Hotel();
        $habitacion = new Habitacion();
        $reserva = new Reserva();
        $cliente = new Cliente();
        $usuario = new Usuario();
        switch ($accion) {
            case 'paso2':
                $fechaBase = new DateTimeImmutable('today');
                $checkinDefault = $fechaBase->modify('+1 day')->format('Y-m-d');
                $checkoutDefault = $fechaBase->modify('+2 day')->format('Y-m-d');

                $destinoBusqueda = isset($_GET['destino']) ? trim((string) $_GET['destino']) : '';
                $checkin = isset($_GET['checkin']) ? trim((string) $_GET['checkin']) : $checkinDefault;
                $checkout = isset($_GET['checkout']) ? trim((string) $_GET['checkout']) : $checkoutDefault;
                $huespedes = isset($_GET['huespedes']) ? trim((string) $_GET['huespedes']) : '1 adulto, 1 habitacion';

                if ($checkout === '' && strpos($checkin, ' - ') !== false) {
                    $fechas = explode(' - ', $checkin, 2);
                    $checkin = trim($fechas[0]);
                    $checkout = trim($fechas[1]);
                }

                $checkinTimestamp = strtotime($checkin);
                $checkoutTimestamp = strtotime($checkout);
                $rangoFechas = $this->formatearFechaCorta($checkinTimestamp, $checkin)
                    . ' - '
                    . $this->formatearFechaCorta($checkoutTimestamp, $checkout);
                $noches = 1;

                if ($checkinTimestamp && $checkoutTimestamp && $checkoutTimestamp > $checkinTimestamp) {
                    $nochesCalculadas = (int) round(($checkoutTimestamp - $checkinTimestamp) / 86400);
                    $noches = $nochesCalculadas > 0 ? $nochesCalculadas : 1;
                }

                if ($destinoBusqueda !== '') {
                    $hotelesResultados = $hotel->buscarDisponiblesAjax($destinoBusqueda);
                } else {
                    $hotelesResultados = array_values(array_filter(
                        $hotel->obtenerTodosConImagenPrincipal(),
                        function ($hotelItem) {
                            return isset($hotelItem['disponible_general']) && (int) $hotelItem['disponible_general'] === 1;
                        }
                    ));
                }

                $habitacionesResultados = array();
                foreach ($hotelesResultados as $hotelItem) {
                    $hotelId = isset($hotelItem['id']) ? (int) $hotelItem['id'] : 0;
                    if ($hotelId <= 0) {
                        continue;
                    }

                    $habitacionesHotel = $habitacion->obtenerPorHotelId($hotelId);
                    foreach ($habitacionesHotel as $habitacionItem) {
                        if (!isset($habitacionItem['disponible_general']) || (int) $habitacionItem['disponible_general'] !== 1) {
                            continue;
                        }

                        $imagenesHabitacion = $habitacion->obtenerImagenes((int) $habitacionItem['id']);
                        $imagenHabitacion = !empty($imagenesHabitacion)
                            ? $imagenesHabitacion[0]['url_imagen']
                            : (isset($hotelItem['imagen_principal']) ? $hotelItem['imagen_principal'] : null);

                        $precioNoche = isset($habitacionItem['precio_noche']) ? (float) $habitacionItem['precio_noche'] : 0;
                        $subtotal = $precioNoche * $noches;
                        $impuestos = round($subtotal * 0.16, 2);
                        $total = $subtotal + $impuestos;

                        $habitacionesResultados[] = array(
                            'id' => (int) $habitacionItem['id'],
                            'hotel_id' => $hotelId,
                            'hotel_nombre' => isset($hotelItem['nombre']) ? $hotelItem['nombre'] : 'Hotel disponible',
                            'hotel_ciudad' => isset($hotelItem['ciudad']) ? $hotelItem['ciudad'] : '',
                            'hotel_direccion' => isset($hotelItem['direccion']) ? $hotelItem['direccion'] : '',
                            'hotel_categoria' => isset($hotelItem['categoria']) ? (int) $hotelItem['categoria'] : 0,
                            'imagen_principal' => $imagenHabitacion,
                            'tipo_habitacion' => isset($habitacionItem['tipo_habitacion']) ? $habitacionItem['tipo_habitacion'] : 'Habitacion disponible',
                            'descripcion' => isset($habitacionItem['descripcion']) ? $habitacionItem['descripcion'] : '',
                            'capacidad_adultos' => isset($habitacionItem['capacidad_adultos']) ? (int) $habitacionItem['capacidad_adultos'] : 0,
                            'capacidad_ninos' => isset($habitacionItem['capacidad_ninos']) ? (int) $habitacionItem['capacidad_ninos'] : 0,
                            'cantidad_camas' => isset($habitacionItem['cantidad_camas']) ? (int) $habitacionItem['cantidad_camas'] : 0,
                            'precio_noche' => $precioNoche,
                            'moneda' => isset($habitacionItem['moneda']) && $habitacionItem['moneda'] !== '' ? $habitacionItem['moneda'] : 'MXN',
                            'subtotal' => $subtotal,
                            'impuestos' => $impuestos,
                            'total' => $total
                        );
                    }
                }

                usort($habitacionesResultados, function ($a, $b) {
                    return ($a['precio_noche'] <=> $b['precio_noche']);
                });

                include 'views/x_motor_de_busqueda/pagina-II.php';
                break;
            case 'formulario':
                $fechaBase = new DateTimeImmutable('today');
                $checkinDefault = $fechaBase->modify('+1 day')->format('Y-m-d');
                $checkoutDefault = $fechaBase->modify('+2 day')->format('Y-m-d');

                $hotelId = isset($_GET['hotel_id']) ? (int) $_GET['hotel_id'] : 0;
                $habitacionId = isset($_GET['habitacion_id']) ? (int) $_GET['habitacion_id'] : 0;
                $destinoBusqueda = isset($_GET['destino']) ? trim((string) $_GET['destino']) : '';
                $checkin = isset($_GET['checkin']) ? trim((string) $_GET['checkin']) : $checkinDefault;
                $checkout = isset($_GET['checkout']) ? trim((string) $_GET['checkout']) : $checkoutDefault;
                $huespedes = isset($_GET['huespedes']) ? trim((string) $_GET['huespedes']) : '1 adulto, 1 habitacion';

                if ($checkout === '' && strpos($checkin, ' - ') !== false) {
                    $fechas = explode(' - ', $checkin, 2);
                    $checkin = trim($fechas[0]);
                    $checkout = trim($fechas[1]);
                }

                $checkinTimestamp = strtotime($checkin);
                $checkoutTimestamp = strtotime($checkout);
                $noches = 1;
                if ($checkinTimestamp && $checkoutTimestamp && $checkoutTimestamp > $checkinTimestamp) {
                    $nochesCalculadas = (int) round(($checkoutTimestamp - $checkinTimestamp) / 86400);
                    $noches = $nochesCalculadas > 0 ? $nochesCalculadas : 1;
                }

                $hotelSeleccionado = $hotelId > 0 ? $hotel->obtenerPorId($hotelId) : null;
                if ($hotelSeleccionado) {
                    $imagenesHotel = $hotel->obtenerImagenes($hotelId);
                    $hotelSeleccionado['imagen_principal'] = !empty($imagenesHotel) ? $imagenesHotel[0]['url_imagen'] : null;
                }

                $habitacionSeleccionada = $habitacionId > 0 ? $habitacion->obtenerPorId($habitacionId) : null;
                if ($habitacionSeleccionada) {
                    $habitacionSeleccionada['id'] = $habitacionId;
                    $imagenesHabitacion = $habitacion->obtenerImagenes($habitacionId);
                    $habitacionSeleccionada['imagen_principal'] = !empty($imagenesHabitacion)
                        ? $imagenesHabitacion[0]['url_imagen']
                        : ($hotelSeleccionado && isset($hotelSeleccionado['imagen_principal']) ? $hotelSeleccionado['imagen_principal'] : null);

                    $precioNoche = isset($habitacionSeleccionada['precio_noche']) ? (float) $habitacionSeleccionada['precio_noche'] : 0;
                    $subtotal = $precioNoche * $noches;
                    $impuestos = round($subtotal * 0.16, 2);
                    $total = $subtotal + $impuestos;

                    $habitacionSeleccionada['subtotal'] = $subtotal;
                    $habitacionSeleccionada['impuestos'] = $impuestos;
                    $habitacionSeleccionada['total'] = $total;
                }

                include 'views/x_motor_de_busqueda/pagina-formulario.php';
                break;
            case 'guardar':
                $nombre = isset($_POST['nombres']) ?  $_POST['nombres'] : '' ;
                $apellidos = isset($_POST['apellidos']) ?  $_POST['apellidos'] : '' ;
                $telefono = isset($_POST['telefono']) ?  $_POST['telefono'] : '' ;
                $correo = isset($_POST['correo']) ?  $_POST['correo'] : '' ;

                //En este punto ya se generó la reserva, se muestra el resumen de la reserva y el formulario de pago
                //Recuperar params del formulario para info del cliente
                //Guardar info de cliente y recuperar de la consulta de guardar cliente
                $clienteId = $cliente->guardar($nombre, $apellidos, $telefono, $correo);
                //Recuperar valores del formulario
                $habitacionId = isset($_POST['habitacion_id']) ? (int) $_POST['habitacion_id'] : 0;
                $fechaEntrada = isset($_POST['checkin']) ? trim((string) $_POST['checkin']) : '';
                $fechaSalida = isset($_POST['checkout']) ? trim((string) $_POST['checkout']) : '';
                $noches = isset($_POST['noches']) ? (int) $_POST['noches'] : 1;
                $adultos = isset($_POST['adultos']) ? (int) $_POST['adultos'] : 1;
                $ninos = isset($_POST['ninos']) ? (int) $_POST['ninos'] : 0;
                $precioNoche = isset($_POST['precio_noche']) ? (float) $_POST['precio_noche'] : 0;
                $subtotal = isset($_POST['subtotal']) ? (float) $_POST['subtotal'] : 0;
                $total = isset($_POST['total']) ? (float) $_POST['total'] : 0;
                
                $observaciones = isset($_POST['solicitudes_especiales']) ? trim((string) $_POST['solicitudes_especiales']) : null;
                //Guardar reserva y obtener ID de reserva generada
                $reservaID = $reserva->guardar($clienteId, $habitacionId, $fechaEntrada, $fechaSalida, $noches, $adultos, $ninos, $precioNoche, $subtotal, $total, 'pendiente', $observaciones, 'web');
                
                header("Location: motor_busqueda.php?accion=pago&folio=".$reservaID);
                exit();
                break;
            case 'pago':
                $reservaID = isset($_GET['folio']) ? (int) $_GET['folio'] : 0;
                $correo_cliente = isset($_GET['correo']) ? trim($_GET['correo']) : '';
                $identificador = isset($_GET['identificador']) ? trim($_GET['identificador']) : '';
                
                $reservaInfo = $reserva->obtenerDetalleVoucher($reservaID, $correo_cliente, $identificador);
                $reservaInfo['fecha_entrada_formateada'] = $this->formatearFechaLarga(strtotime($reservaInfo['fecha_entrada']), $reservaInfo['fecha_entrada']);
                $reservaInfo['fecha_salida_formateada'] = $this->formatearFechaLarga(strtotime($reservaInfo['fecha_salida']), $reservaInfo['fecha_salida']);
                if ($reservaInfo['estado_pago'] == 'aprobado') {
                    include 'views/voucher/index.php';    
                }else{
                    include 'views/x_motor_de_busqueda/pagina-pago.php';
                }
                
            break;
            case 'consulta-reserva':
                include 'views/x_motor_de_busqueda/consulta-reserva.php';
            break;
            case 'login': //Aquí se muestra el formulario de login
                include 'views/x_motor_de_busqueda/login.php';
            break;
            case 'registro'://Aquí se muestra el formulario de registro
                include 'views/x_motor_de_busqueda/registro.php';
            break;
            case 'logout'://Aquí se procesa el logout
                @session_start();
                session_destroy();
                header("Location: motor_busqueda.php");
            break;
            case 'create-account'://Aquí se procesa el formulario de registro
                $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
                $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
                $email = isset($_POST['email']) ? $_POST['email'] : '';
                $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : '';
                $permiso = '';//Sin permisos para usuarios que se registran desde el motor de búsqueda
                $estatus = 1;//Activo por default al crear cuenta desde el motor de búsqueda
                $usuario->guardar($nombre, $telefono, $email, $contrasena,
                $permiso, $estatus);
                header("Location: motor_busqueda.php?accion=login&registro=1");
            break;
            case 'signin'://Aquí se procesa el formulario de login
                @session_start();
                $param_usuario = isset($_POST['correo']) ? trim((string) $_POST['correo']) : '';
                $param_password = isset($_POST['password']) ? trim((string) $_POST['password']) : '';
                #llamar funcion de validarContraseña y pasar params
                
                $user_login = $usuario->validarContrasena(0, $param_usuario, $param_password);
                if($user_login && $user_login['permiso'] === ''){//Solo se permite el acceso a usuarios sin permisos (usuarios registrados desde el motor de búsqueda)
                    $_SESSION['nombre'] = $user_login["nombre"];
                    $_SESSION['email'] = $user_login["email"];
                    header("Location: motor_busqueda.php");
                }else{
                    header("Location: motor_busqueda.php?accion=login&error=1");
                }
            break;
            default:
                $fechaBase = new DateTimeImmutable('today');
                $checkinDefault = $fechaBase->modify('+1 day')->format('Y-m-d');
                $checkoutDefault = $fechaBase->modify('+2 day')->format('Y-m-d');
                $hotels = $hotel->obtenerTodosConImagenPrincipal();
                include 'views/x_motor_de_busqueda/index.php';
                break;
        }
    }

    public function formatearFechaCorta($timestamp, $fallback)
    {
        if (!$timestamp) {
            return $fallback;
        }

        $meses = array(
            1 => 'ene',
            2 => 'feb',
            3 => 'mar',
            4 => 'abr',
            5 => 'may',
            6 => 'jun',
            7 => 'jul',
            8 => 'ago',
            9 => 'sep',
            10 => 'oct',
            11 => 'nov',
            12 => 'dic'
        );

        return date('d', $timestamp) . ' ' . $meses[(int) date('n', $timestamp)] . ' ' . date('Y', $timestamp);
    }

    public function formatearFechaLarga($timestamp, $fallback)
    {
        if (!$timestamp) {
            return $fallback;
        }

        $meses = array(
            1 => 'enero',
            2 => 'febrero',
            3 => 'marzo',
            4 => 'abril',
            5 => 'mayo',
            6 => 'junio',
            7 => 'julio',
            8 => 'agosto',
            9 => 'septiembre',
            10 => 'octubre',
            11 => 'noviembre',
            12 => 'diciembre'
        );

        return date('d', $timestamp) . ' de ' . $meses[(int) date('n', $timestamp)] . ' de ' . date('Y', $timestamp);
    }
}
