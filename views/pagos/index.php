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

            }
        ?>
    </div>
    <form action="reservas.php" method="GET" class="admin-buscador">
        <input type="hidden" name="accion" value="historial">
        <select name="campo">
            <option value="todos" <?php echo (isset($_GET['campo']) && $_GET['campo'] == 'todos') || !isset($_GET['campo']) ? 'selected' : ''; ?>>Todos</option>
            <option value="referencia" <?php echo isset($_GET['campo']) && $_GET['campo'] == 'referencia' ? 'selected' : ''; ?>>Referencia</option>
            <option value="reserva_id" <?php echo isset($_GET['campo']) && $_GET['campo'] == 'reserva_id' ? 'selected' : ''; ?>>ID Reserva</option>
        </select>
        <input type="text" name="busqueda" value="<?php echo isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : ''; ?>">
        <button type="submit">Buscar</button>
    </form>

    <div class="tabla-scroll">
    <table class="tabla-admin">
        <tr>
            <th>ID Reserva<d/th>
            <th>Metodo de Pago</th>
            <th>Monto</th>
            <th>Moneda</th>
            <th>Referencia</th>
            <th>Estado</th>
            <th>Est. Simulado</th>
            <th>Fecha de Pago</th>
            <th>Referencia</th>

        </tr>
        <?php foreach ($detallePago as $fila) { ?>
            <tr>
                <td><?php echo $fila['reserva_id']; //nombres que vienen de la bd ?></td>
                <td><?php echo $fila['metodo_pago']; ?></td>
                <td><?php echo $fila['monto']; ?></td>
                <td><?php echo $fila['moneda']; ?></td>
                <td><?php echo $fila['referencia']; ?></td>
                <td><?php echo $fila['estado']; ?></td>
                <td><?php echo $fila['es_simulado']; ?></td>
                <td><?php echo $fila['fecha_pago']; ?></td>
                <td><?php echo $fila['respuesta_pasarela']; ?></td>
            </tr>
        <?php } ?>
    </table>
    </div>
</div>

<?php
include 'views/layouts/footer_pago.php';
?>