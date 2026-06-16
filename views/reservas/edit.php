<?php
include 'views/layouts/header.php';
include 'views/layouts/menu.php';
?>

<div class="contenedor">
    <h1><?php echo $titulo; ?></h1>

    <form action="reservas.php?accion=actualizar" method="POST">
        <input type="hidden" name="id" value="<?php echo $reservasEditar[0]['id'];?>" >
        <input type="hidden" name="cliente_id" value="<?php echo $reservasEditar[0]['cliente_id'];?>" >
        <!-- ,fecha_salida,noches,adultos,
        ninos, reservas.precio_noche, subtotal, total,observaciones,
         habitaciones.tipo_habitacion-->

        <label>Nombre del Cliente</label>
        <input type="text" name="nombre_cliente" value="<?php echo $reservasEditar[0]['nombre_cliente']; ?>" required>

        <label>Apellidos</label>
        <input type="text" name="apellidos" value="<?php echo $reservasEditar[0]['apellidos']; ?>" required>

        <label>Fecha de entrada</label>
        <input type="date" name="fecha_entrada" value="<?php echo $reservasEditar[0]['fecha_entrada']; ?>" required>


        <label>Fecha de Salida</label>
        <input type="date" name="fecha_salida" value="<?php echo $reservasEditar[0]['fecha_salida']; ?>" required>


        <label>Noches</label>
        <input type="number" name="noches" value="<?php echo $reservasEditar[0]['noches']; ?>" required>


        <label>Adultos</label>
        <input type="number" name="adultos" value="<?php echo $reservasEditar[0]['adultos']; ?>" required>


        <label>Niños</label>
        <input type="number" name="ninos" value="<?php echo $reservasEditar[0]['ninos']; ?>" required>


        <label>Tipo de Habitación</label>

        <select name="tipo_habitacion">
            <?php foreach ($habitaciones as $fila) { ?>
            <option value="<?php echo $fila['id']; ?>" <?php echo $reservasEditar[0]['habitacion_id'] == $fila['id'] ? 'selected' : ''; ?> ><?php echo $fila['tipo_habitacion']; ?></option>   
            <?php } ?>
        </select>
        <!-- select -->

        <label>Precio por  Noche</label>
        <input type="number" name="precio_noche" value="<?php echo $reservasEditar[0]['precio_noche']; ?>" required>

        <label>Subtotal</label>
        <input type="number" name="subtotal" value="<?php echo $reservasEditar[0]['subtotal']; ?>" required>

        <label>Total</label>
        <input type="number" name="total" value="<?php echo $reservasEditar[0]['total']; ?>" required>

        <button type="submit">Actualizar</button>
    </form>
</div>

<?php
include 'views/layouts/footer.php';
?>


        