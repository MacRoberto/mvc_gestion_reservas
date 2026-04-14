<?php
include 'views/layouts/header.php';
include 'views/layouts/menu.php';
?>

<div class="contenedor">
    <h1><?php echo $titulo; ?></h1>
     <p><a class="boton" href="habitaciones.php?accion=nuevo&hotel_id=<?php echo $hotelId; ?>">Nueva Habitacion</a></p>
    <?php if (isset($_GET['hotel_id']) && (int) $_GET['hotel_id'] > 0) { ?>
        <p><a class="boton" href="habitaciones.php">Ver todas las habitaciones</a></p>
    <?php } ?>

    <form action="habitaciones.php" method="GET" class="admin-buscador">
        <select name="campo">
            <option value="todos" <?php echo (isset($_GET['campo']) && $_GET['campo'] == 'todos') || !isset($_GET['campo']) ? 'selected' : ''; ?>>Todos</option>
            <option value="habitacion" <?php echo isset($_GET['campo']) && $_GET['campo'] == 'habitacion' ? 'selected' : ''; ?>>Habitacíon</option>
            <option value="precio_noche" <?php echo isset($_GET['campo']) && $_GET['campo'] == 'precio_noche' ? 'selected' : ''; ?>>Precio</option>
            <option value="disponible_general" <?php echo isset($_GET['campo']) && $_GET['campo'] == 'disponible_general' ? 'selected' : ''; ?>>Disponible</option>
        </select>
        <input type="text" name="busqueda" value="<?php echo isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : ''; ?>">
        <button type="submit">Buscar</button>
    </form>
     
    <div class="tabla-scroll">
    <table class="tabla-admin">
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
                <td><?php echo $fila['id']; //nombres que vienen de la bd ?></td>
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
                    <?php
                        //admin, propietario, IT, usuario
                        if (isset($_SESSION['permiso']) && ($_SESSION['permiso'] == 'IT') 
                            || $_SESSION['permiso'] == 'admin') {
                            echo '<a href="habitaciones.php?accion=editar&id=' . $fila['id'] . '">Editar</a>';
                            echo '<a href="hoteles.php?accion=eliminar&id=' . $fila['id'] . '" onclick = "return confirm(\'¿Deseas eliminar este hotel?\')" >Eliminar</a>';
                        }
                        
                    ?>
                    
                    <!-- <a href="habitaciones.php?accion=editar&id=<?php echo $fila['id']; ?>">Editar</a> -->
                    <a href="habitaciones.php?accion=imagenes&id=<?php echo $fila['id']; ?>">Imágenes</a>
                    <a href="habitaciones.php?accion=eliminar&id=<?php echo $fila['id']; ?>" onclick="return confirm('¿Deseas eliminar este hotel?');">Eliminar</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

<?php
include 'views/layouts/footer.php';
?>
