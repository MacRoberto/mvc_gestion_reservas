<?php
include_once 'models/Usuario.php';
session_start();
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
            $user_login = $usuario->validarContrasena(0, $param_usuario, $param_password);
            if($user_login){
                $_SESSION['nombre'] = $user_login["nombre"];
                $_SESSION['email'] = $user_login["email"];
                $_SESSION['permiso'] = $user_login["permiso"];
                header("Location: index.php");
            }else{
                $titulo = 'Login';
                include 'views/auth/login.php';
            }
        }else {
            session_destroy();
            $titulo = 'Login';
            include 'views/auth/login.php';
        }
    }
}
