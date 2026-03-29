<?php
include 'views/layouts/header.php';
include 'views/layouts/menu.php';
?>

<div class="contenedor">
    <h1><?php echo $titulo; ?></h1>

    <form action="habitaciones.php?accion=actualizar" method="POST">
        <input type="hidden" name="id" value="<?php echo $HabitacionEditar['id']; ?>">

        <label>Tipo de habitación</label>
        <input type="text" name="habitacion_tipo" value="<?php echo $HabitacionEditar['habitacion_tipo']; ?>" required>

        <label>Descripción</label>
        <input type="text" name="descripcion" value="<?php echo $HabitacionEditar['descripcion']; ?>" required>

        <label>Capacidad de Adultos</label>
        <input type="numero" name="capacidad_adultos" value="<?php echo $HabitacionEditar['capacidad_adultos']; ?>" required>

        <label>Capacidad de Niños</label>
        <input type="numero" name="capacidad_ninos" value="<?php echo $HabitacionEditar['capacidad_ninos']; ?>" required>

        <label>Cantidad de Cama</label>
        <input type="numero" name="cantidad_camas" value="<?php echo $HabitacionEditar['cantidad_camas']; ?>" required>

        
        <label>Precio por Noche</label>
        <input type="numero" name="precio_noche" value="<?php echo $HabitacionEditar['precio_noche']; ?>" required>


        <label>Moneda</label>
        <input type="numero" name="moneda" value="<?php echo $HabitacionEditar['moneda']; ?>" required>


        <label>Disponible General</label>
        <select name="disponible">
            <option value="0" <?php echo $hotelEditar['disponible_general'] == 0 ? 'selected' : ''; ?>>No</option>
            <option value="1" <?php echo $hotelEditar['disponible_general'] == 1 ? 'selected' : ''; ?>>Si</option>
        </select>
        <button type="submit">Actualizar</button>

    </form>
</div>

<?php
include 'views/layouts/footer.php';
?>