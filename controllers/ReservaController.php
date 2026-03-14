<?php

class ReservaController
{
    public function procesar($accion)
    {
        $titulo = 'Reservas';
        include 'views/reservas/index.php';
    }
}
