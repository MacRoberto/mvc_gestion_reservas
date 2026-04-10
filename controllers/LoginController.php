<?php
include_once 'models/Usuario.php';

class LoginController
{
    public function procesar($accion)
    {
        $usuario = new Usuario();//Se crea una instancia del modelo Usuario
        if ($accion == "login") {
            //Recibir parametros del formulario
            $param_usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
            $param_password = isset($_POST['password']) ? $_POST['password'] : '';
            #llamar funcion de validarContraseña y pasar params
            if($usuario->validarContrasena(0, $param_usuario, $param_password)){
                echo "Bienvenido";   
            }else{
                echo "Acceso denegado";
            }
        }else {
            $titulo = 'Login';
            include 'views/auth/login.php';
        }
    }
}
