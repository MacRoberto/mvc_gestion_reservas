<?php
include 'views/layouts/header.php';
include 'views/layouts/menu.php';
?>

<div class="contenedor">
    <h1><?php echo $titulo; ?></h1>

    <p><a class="boton" href="hoteles.php?accion=nuevo">Nuevo hotel</a></p>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Ciudad</th>
            <th>Direccion</th>
            <th>Telefono</th>
            <th>Email</th>
            <th>Descripción</th>
            <th>Categoría</th>
            <th>Hora Check In</th>
            <th>Hora Check Out</th>
            <th>Diponible General</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($hoteles as $fila) { ?>
            <tr>
                <td><?php echo $fila['id']; //nombres que vienen de la bd ?></td>
                <td><?php echo $fila['nombre']; ?></td>
                <td><?php echo $fila['ciudad']; ?></td>
                <td><?php echo $fila['direccion']; ?></td>
                <td><?php echo $fila['telefono']; ?></td>
                <td><?php echo $fila['email']; ?></td>
                <td><?php echo $fila['descripcion']; ?></td>
                <td><?php echo $fila['categoria']; ?></td>
                <td><?php echo $fila['hora_checkin']; ?></td>
                <td><?php echo $fila['hora_checkout']; ?></td>
                <td>
                    <?php
                        if($fila['disponible_general'] == 0){
                            echo 'No'; 
                        }else{
                            echo 'Si';
                        } 
                    ?>
                </td>

                <td>
                    <a href="hoteles.php?accion=editar&id=<?php echo $fila['id']; ?>">Editar</a>
                    <a href="hoteles.php?accion=imagenes&id=<?php echo $fila['id']; ?>">Imágenes</a>
                    <a href="hoteles.php?accion=eliminar&id=<?php echo $fila['id']; ?>" onclick="return confirm('¿Deseas eliminar este hotel?');">Eliminar</a>

                </td>
            </tr>
        <?php } ?>
    </table>
</div>

<?php
include 'views/layouts/footer.php';
?>
