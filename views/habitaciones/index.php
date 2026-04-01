<?php
include 'views/layouts/header.php';
include 'views/layouts/menu.php';
?>

<div class="contenedor">
    <h1><?php echo $titulo; ?></h1>
     <p><a class="boton" href="habitaciones.php?accion=nuevo">Nueva Habitacion</a></p>
    <p>Vista base del modulo de habitaciones.</p>

        <table>
        <tr>
            <th>idhabitacion</th>
            <th>Tipo de Habitación</th>
            <th>Descripción</th>
            <th>Capacidad de Adultos</th>
            <th>Capacidad de Niños</th>
            <th>Cantidad de Cama</th>
            <th>Precio por Noche</th>
            <th>Moneda</th>
            <th>Disponible General</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($habitaciones as $fila) { ?>
            <tr>
                <td><?php echo $fila['hotel_id']; //nombres que vienen de la bd ?></td>
                <td><?php echo $fila['tipo_habitacion']; ?></td>
                <td><?php echo $fila['descripcion']; ?></td>
                <td><?php echo $fila['capacidad_adultos']; ?></td>
                <td><?php echo $fila['capacidad_ninos']; ?></td>
                <td><?php echo $fila['cantidad_camas']; ?></td>
                <td><?php echo $fila['precio_noche']; ?></td>
                <td><?php echo $fila['moneda']; ?></td>
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
                    <a href="habitaciones.php?accion=editar&id=<?php echo $fila['id']; ?>">Editar</a>

                    <a href="habitaciones.php?accion=eliminar&id=<?php echo $fila['id']; ?>" onclick="return confirm('¿Deseas eliminar este hotel?');">Eliminar</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

<?php
include 'views/layouts/footer.php';
?>
