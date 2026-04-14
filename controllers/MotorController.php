<?php

include_once 'models/Hotel.php';

class MotorController
{
    public function procesar($accion)
    {
        $hotel = new Hotel();
        switch ($accion) {
            case 'paso2':

                break;
            case 'paso3':

                break;
            default:
                $hotels = $hotel->obtenerTodosConImagenPrincipal();
                include 'views/x_motor_de_busqueda/index.php';
                break;
        }
    }
}
