<?php
include 'views/layouts/header.php';
include 'views/layouts/menu.php';
?>

<div class="contenedor">
    <h1><?php echo $titulo; ?></h1>

    <form action="reservas.php?accion=actualizar" method="POST">
        <input type="hidden" name="id" value="<?php echo $hotelEditar['id']; ?>">
        <!-- ,fecha_salida,noches,adultos,
        ninos, reservas.precio_noche, subtotal, total,observaciones,
         habitaciones.tipo_habitacion-->

        <label>Nombre del Cliente</label>
        <input type="text" name="nombre_cliente" value="<?php echo $hotelEditar['cliente_i']; ?>" required>

        <label>Apellidos</label>
        <input type="text" name="apellidos" value="<?php echo $hotelEditar['cliente_i']; ?>" required>

        <label>Correo</label>
        <input type="email" name="correo" value="<?php echo $hotelEditar['cliente_i']; ?>" required>

        <label>Telefono</label>
        <input type="number" name="telefono_cliente" value="<?php echo $hotelEditar['cliente_i']; ?>" required>
        
        <label>Fecha de Salida</label>
        <input type="date" name="fecha_entrada" value="<?php echo $hotelEditar['cliente_i']; ?>" required>

        <label>Noches</label>
        <input type="number" name="noches" value="<?php echo $hotelEditar['cliente_i']; ?>" required>

        <label>Tipo de Habitación</label>
        <select name="tipo_habitacion">
            <option value="0" <?php echo $hotelEditar['disponible_general'] == 0 ? 'selected' : ''; ?>>No</option>
            <option value="1" <?php echo $hotelEditar['disponible_general'] == 1 ? 'selected' : ''; ?>>Si</option>
        </select>
        <!-- select -->

        <label>Precio por  Noche</label>
        <input type="number" name="fecha_entrada" value="<?php echo $hotelEditar['cliente_i']; ?>" required>

        <label>Subtotal</label>
        <input type="number" name="fecha_entrada" value="<?php echo $hotelEditar['cliente_i']; ?>" required>

        <label>Total</label>
        <input type="number" name="fecha_entrada" value="<?php echo $hotelEditar['cliente_i']; ?>" required>

        <label>Habitación</label>
        <input type="number" name="fecha_entrada" value="<?php echo $hotelEditar['cliente_i']; ?>" required>




        <button type="submit">Actualizar</button>
    </form>
</div>

<?php
include 'views/layouts/footer.php';
?>

        <label>Fecha de entrada</label>
        <input type="date" name="fecha_entrada" value="<?php echo $hotelEditar['cliente_i']; ?>" required>
        