<?php

class ClienteController
{
    public function procesar($accion)
    {
        $titulo = 'Clientes';
        include 'views/clientes/index.php';
    }
}
