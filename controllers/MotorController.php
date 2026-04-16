<?php

include_once 'models/Hotel.php';

class MotorController
{
    public function procesar($accion)
    {
        $hotel = new Hotel();
        switch ($accion) {
            case 'paso2':
                $destinoBusqueda = isset($_GET['destino']) ? trim($_GET['destino']) : '';
                if ($destinoBusqueda !== '') {
                    $hotelesResultados = $hotel->buscarDisponiblesAjax($destinoBusqueda, 50);
                } else {
                    $hotelesResultados = array_values(array_filter(
                        $hotel->obtenerTodosConImagenPrincipal(),
                        function ($hotelItem) {
                            return isset($hotelItem['disponible_general']) && (int) $hotelItem['disponible_general'] === 1;
                        }
                    ));
                }
                include 'views/x_motor_de_busqueda/pagina-II.php';
                break;
            case 'formulario':
                include 'views/x_motor_de_busqueda/pagina-formulario.php';
                break;
            case 'pago'://En este punto ya se generó la reserva, se muestra el resumen de la reserva y el formulario de pago
                include 'views/x_motor_de_busqueda/pagina-pago.php';
                break;
            default:
                $hotels = $hotel->obtenerTodosConImagenPrincipal();
                include 'views/x_motor_de_busqueda/index.php';
                break;
        }
    }
}
