<?php

class LoginController
{
    public function procesar($accion)
    {
        $titulo = 'Login';
        include 'views/auth/login.php';
    }
}
