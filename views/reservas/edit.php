<?php
include 'views/layouts/header.php';
include 'views/layouts/menu.php';
?>

<div class="contenedor">
    <h1><?php echo $titulo; ?></h1>

    <form action="reservas.php?accion=actualizar" method="POST">
        <input type="hidden" name="id" value="<?php echo $hotelEditar['id']; ?>">

        <label></label>
        <input type="text" name="nombre" value="<?php echo $hotelEditar['nombre']; ?>" required>

        <label>Ciudad</label>
        <input type="text" name="ciudad" value="<?php echo $hotelEditar['ciudad']; ?>" required>

        <label>Direccion</label>
        <input type="text" name="direccion" value="<?php echo $hotelEditar['direccion']; ?>" required>

        <label>Telefono</label>
        <input type="numero" name="telefono" value="<?php echo $hotelEditar['telefono']; ?>" required>

        <label>Correo electronico</label>
        <input type="email" name="email" value="<?php echo $hotelEditar['email']; ?>" required>

        <label>Descripcion</label>
        <input type="text" name="descripcion" value="<?php echo $hotelEditar['descripcion']; ?>" required>

        
        <label>categoria</label>
        <input type="text" name="categoria" value="<?php echo $hotelEditar['categoria']; ?>" required>


        <label>Hora check in </label>
        <input type="time" name="hora_checkin" value="<?php echo $hotelEditar['hora_checkin']; ?>" required>


        <label>Check out </label>
        <input type="time" name="hora_checkout" value="<?php echo $hotelEditar['hora_checkout']; ?>" required>

        <label>Disponible</label>
        <select name="disponible">
            <option value="0" <?php echo $hotelEditar['disponible_general'] == 0 ? 'selected' : ''; ?>>No</option>
            <option value="1" <?php echo $hotelEditar['disponible_general'] == 1 ? 'selected' : ''; ?>>Si</option>
        </select>
        <button type="submit">Actualizar</button>
    </form>
</div>
<?php
include 'views/layouts/header.php';
include 'views/layouts/menu.php';
?>

<div class="contenedor">
    <h1><?php echo $titulo; ?></h1>

    <form action="reservas.php?accion=guardar" method="POST">
        <label>Folio</label>
        <input type="number" name="folio" required>

        <label>ID Cliente</label>
        <input type="number" name="cliente_id" required>

        <label>ID Habitación</label>
        <input type="number" name="habitacion_id" required>

        <label>Fecha de Llegada</label>
        <input type="date" name="fecha_llegada" required>

        <label>Fecha de Salida</label>
        <input type="date" name="fecha_salida" required>

        <label>Cantidad de Noches</label>
        <input type="number" name="noches" required>

        <label>Cantidad de Adultos</label>
        <input type="number" name="adultos" required>

        <label>Cantidad de Niños</label>
        <input type="number" name="niños" required>
        
        <label>Precio por Noche</label>
        <input type="number" name="precio_noche" required>

        <label>Subtotal</label>
        <input type="number" name="subtotal" required>

        <label>Total</label>
        <input type="number" name="total" required>

        <label>Estado de la Reserva</label>
        <input type="text" name="estado_reserva" required>

        <label>observaciones</label>
        <input type="text" name="observaciones" required>

        <label>Origen</label>
        <input type="text" name="origen" required>

        <button type="submit">Guardar</button>
    </form>
</div>

<?php
include 'views/layouts/footer.php';
?>

<?php
include 'views/layouts/footer.php';
?>
