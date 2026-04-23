<?php
include 'views/layouts/header.php';
include 'views/layouts/menu.php';
?>

<div class="contenedor">
    <div class="admin-header">
        <h1><?php echo $titulo; ?></h1>
    </div>
    <form action="reservas.php" method="GET" class="admin-buscador">
        <select name="campo">
            <option value="todos" <?php echo (isset($_GET['campo']) && $_GET['campo'] == 'todos') || !isset($_GET['campo']) ? 'selected' : ''; ?>>Todos</option>
            <option value="folio" <?php echo isset($_GET['campo']) && $_GET['campo'] == 'folio' ? 'selected' : ''; ?>>Folio</option>
            <option value="clientes.nombres" <?php echo isset($_GET['campo']) && $_GET['campo'] == 'clientes.nombres' ? 'selected' : ''; ?>>Nombre del cliente</option>
             <option value="apellidos" <?php echo isset($_GET['campo']) && $_GET['campo'] == 'apellidos' ? 'selected' : ''; ?>>Apellidos</option>
            <option value="clientes.email" <?php echo isset($_GET['campo']) && $_GET['campo'] == 'clientes.email' ? 'selected' : ''; ?>>Correo del cliente</option>
        </select>
        <input type="text" name="busqueda" value="<?php echo isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : ''; ?>">
        <button type="submit">Buscar</button>
    </form>

    <div class="tabla-scroll">
    <table class="tabla-admin">
        <tr>
            <th>ID</th>
            <th>Folio</th>
            <th>Cliente</th>
            <th>Correo</th>
            <th>Hotel</th>
            <th>Habitacion</th>
            <th>Fecha de Llegada</th>
            <th>Fecha de Salida</th>
            <th>Cantidad de Noches</th>
            <th>Cantidad de adultos</th>
            <th>Cantidad de niños</th>
            <th>Precio por Noche</th>
            <th>Subtotal</th>
            <th>Total</th>
            <th>Estado de reserva</th>
            <th>Observaciones</th>
            <th>Origen</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($reservas as $fila) { ?>
            <tr>
                <td><?php echo $fila['id']; //nombres que vienen de la bd ?></td>
                <td><?php echo $fila['folio']; ?></td>
                <td><?php echo $fila['nombre_cliente']." ".$fila['apellidos'];; ?></td>
                <td><?php echo $fila['email'] ?></td>
                <td><?php echo $fila['nombre_hotel'] ?></td>
                <td><?php echo $fila['tipo_habitacion']; ?></td>
                <td><?php echo $fila['fecha_entrada']; ?></td>
                <td><?php echo $fila['fecha_salida']; ?></td>
                <td><?php echo $fila['noches']; ?></td>
                <td><?php echo $fila['adultos']; ?></td>
                <td><?php echo $fila['ninos']; ?></td>
                <td><?php echo $fila['precio_noche']; ?></td>
                <td><?php echo $fila['subtotal']; ?></td>
                <td><?php echo $fila['total']; ?></td>
                <td><?php echo $fila['estado_reserva']; ?></td>
                <td><?php echo $fila['observaciones']; ?></td>
                <td><?php echo $fila['origen']; ?></td>
                <td>
                    <?php
                        //admin
                        if (isset($_SESSION['permiso']) && $_SESSION['permiso'] == 'admin') {
                            echo '<a href="reservas.php?accion=editar&id=' . $fila['id'] . '">Editar</a><br>';
                            echo '<a href="reservas.php?accion=enviar-voucher&id=' . $fila['id'] . '">Reenviar voucher</a><br>';
                            echo '<a href="reservas.php?accion=historial&id=' . $fila['id'].'">Historial de pago</a><br>';
                         
                        }
                        //propietario
                        if (isset($_SESSION['permiso']) && $_SESSION['permiso'] == 'propietario') {
                            echo '<a href="reservas.php?accion=historial&id=' . $fila['id'].'">Historial de pago</a><br>';
                            echo '<a href="reservas.php?accion=estatus&id=' . $fila['id'].'">Cambio de estatus</a>';
                        }
                        //IT
                        if (isset($_SESSION['permiso']) && $_SESSION['permiso'] == 'IT') {
                            echo '<a href="reservas.php?accion=editar&id=' . $fila['id'] . '">Editar</a><br>';
                            echo '<a href="reservas.php?accion=historial&id=' . $fila['id'].'">Historial de pago</a><br>';
                            echo '<a href="reservas.php?accion=estatus&id=' . $fila['id'].'">Cambio de estatus</a>';
                        }
                        //usuario
                        if (isset($_SESSION['permiso']) && $_SESSION['permiso'] == 'usuario') {
                            echo '<a href="reservas.php?accion=editar&id=' . $fila['id'] . '">Editar</a><br>';
                            echo '<a href="reservas.php?accion=estatus&id=' . $fila['id'].'">Cambio de estatus</a>';
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