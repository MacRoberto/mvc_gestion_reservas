<?php

class UsuarioController
{
    public function procesar($accion)
    {
        $titulo = 'Usuarios';
        include 'views/usuarios/index.php';
    }
}
