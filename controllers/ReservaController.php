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
