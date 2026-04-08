
<?php

include_once 'models/Usuario.php';

class UsuarioController
{
    public function procesar($accion)
    {
        $usuario = new Usuario();

        if ($accion == 'nuevo') {
            $titulo = 'Nuevo usuario';
            include 'views/usuarios/create.php';
        } elseif ($accion == 'guardar') {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
            $telefono = isset($_POST['numero']) ? $_POST['numero'] : '';
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : '';
            $permiso = isset($_POST['permiso']) ? $_POST['permiso'] : '';
            $estatus = isset($_POST['activo']) ? $_POST['activo'] : '';
           

            $usuario->guardar($nombre, $telefono, $email, $contrasena,
             $permiso, $estatus);

            header('Location: usuarios.php');
            exit;
        } elseif ($accion == 'editar') {
            $id = isset($_GET['id']) ? $_GET['id'] : 0;
            $usuarioEditar = $usuario->obtenerPorId($id);
            $titulo = 'Editar usuario';
            include 'views/usuarios/edit.php';
        } elseif ($accion == 'actualizar') {

            $id = isset($_GET['id']) ? $_GET['id'] : 1;
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
            $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : '';
            $permiso = isset($_POST['permiso']) ? $_POST['permiso'] : '';
            $activo = isset($_POST['activo']) ? $_POST['activo'] : '';
            $user_uuid = isset($_POST['user_uuid']) ? $_POST['user_uuid'] : '';


            $usuario->actualizar($id, $nombre, $telefono, $email, $contrasena,
             $permiso, $activo, $user_uuid);
            header('Location: usuarios.php');
            exit;
        } elseif ($accion == 'eliminar') {
            $id = isset($_GET['id']) ? $_GET['id'] : 0;

            $usuario->eliminar($id);
            header('Location: usuarios.php');
            exit;
        } else {

            $campo = isset($_GET['campo']) ? $_GET['campo'] : 'todos';
            $busqueda = isset($_GET['busqueda']) ? trim($_GET['busqueda']) : '';
            $usuarios = $usuario->obtenerTodos($campo, $busqueda);//>Consultas
            $titulo = 'Lista de usuarios';

            include 'views/usuarios/index.php';
        }
    }
}

            