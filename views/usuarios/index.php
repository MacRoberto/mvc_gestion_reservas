
<?php
include 'views/layouts/header.php';
include 'views/layouts/menu.php';
?>

<div class="contenedor">
    <div class="admin-header">
    <h1><?php echo $titulo; ?></h1>
            <?php
            //ADMIN, PROPIETARIO, IT
            if (isset($_SESSION['permiso']) && ($_SESSION['permiso'] == 'IT') || 
            $_SESSION['permiso'] == 'admin' || $_SESSION['permiso'] == 'propietario') {
                echo '<p><a class="boton" href="usuarios.php?accion=nuevo">Nuevo usuario</a></p>';
            }
        ?>
    </div>
    

    <form action="usuarios.php" method="GET" class="admin-buscador">
        <select name="campo">
            <option value="todos" <?php echo (isset($_GET['campo']) && $_GET['campo'] == 'todos') || !isset($_GET['campo']) ? 'selected' : ''; ?>>Todos</option>
            <option value="nombre" <?php echo isset($_GET['campo']) && $_GET['campo'] == 'nombre' ? 'selected' : ''; ?>>Nombre</option>
            <option value="telefono" <?php echo isset($_GET['campo']) && $_GET['campo'] == 'telefono' ? 'selected' : ''; ?>>Telefono</option>
            <option value="email" <?php echo isset($_GET['campo']) && $_GET['campo'] == 'email' ? 'selected' : ''; ?>>Correo electrónico</option>
        </select>
        <input type="text" name="busqueda" value="<?php echo isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : ''; ?>">
        <button type="submit">Buscar</button>
    </form>
    <div class="tabla-scroll">
        <table class="tabla-admin">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Email</th>
                <th>Contraseña</th>
                <th>Permiso</th>
                <th>Activo</th>
                <th>user_uuid</th>
                <th>Acciones</th>
            
            </tr>
            <?php foreach ($usuarios as $fila) { ?>
                <tr>
                    <td><?php echo $fila['id']; //nombres que vienen de la bd ?></td>
                    <td><?php echo $fila['nombre']; ?></td>
                    <td><?php echo $fila['telefono']; ?></td>
                    <td><?php echo $fila['email']; ?></td>
                    <td><?php echo $fila['contrasena']; ?></td>
                    <td><?php echo $fila['permiso']; ?></td>
                    <td>
                        <?php
                            if($fila['activo'] == 0){
                                echo 'No'; 
                            }else{
                                echo 'Si';
                            } 
                        ?>
                    </td>
                    <td><?php echo $fila['user_uuid']; ?></td>
                    <td>
                    <?php
                        if (isset($_SESSION['permiso']) && $_SESSION['permiso'] == 'admin' || $_SESSION['permiso'] == 'IT') {
                            echo ' <a href="usuarios.php?accion=editar&id=' .$fila['id']. ' ">Editar</a><br>';
                            echo '<a href="usuarios.php?accion=eliminar&id=' . $fila['id'] . '" onclick = "return confirm(\'¿Deseas eliminar este usuario?\')" >Eliminar</a><br>';
                        }
                    ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>

<?php
include 'views/layouts/footer.php';
?>