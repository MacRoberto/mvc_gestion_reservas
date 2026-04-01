
<?php
include 'views/layouts/header.php';
include 'views/layouts/menu.php';
?>

<div class="contenedor">
    <h1><?php echo $titulo; ?></h1>
    <p>Vista base del modulo de usuarios.</p>

    <p><a class="boton" href="usuarios.php?accion=nuevo">Nuevo usuario</a></p>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Telefono</th>
            <th>Email</th>
            <th>Contraseña</th>
            <th>Permiso</th>
            <th>Activo</th>
            <th>user_uuid</th>
           
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
                    <a href="usuarios.php?accion=editar&id=<?php echo $fila['id']; ?>">Editar</a>

                    <a href="usuarios.php?accion=eliminar&id=<?php echo $fila['id']; ?>" onclick="return confirm('¿Deseas eliminar este hotel?');">Eliminar</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

<?php
include 'views/layouts/footer.php';
?>