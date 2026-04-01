<?php
include 'views/layouts/header.php';
include 'views/layouts/menu.php';
?>

<div class="contenedor">
    <h1><?php echo $titulo; ?></h1>

    <form action="habitaciones.php?accion=actualizar" method="POST">
        <input type="hidden" name="id" value="<?php echo $habitacionEditar['id']; ?>">

        <label>Tipo de habitación</label>
        <input type="text" name="tipo_habitacion" value="<?php echo $habitacionEditar['tipo_habitacion']; ?>" required>

        <label>Descripción</label>
        <input type="text" name="descripcion" value="<?php echo $habitacionEditar['descripcion']; ?>" required>

        <label>Capacidad de Adultos</label>
        <input type="numero" name="capacidad_adultos" value="<?php echo $habitacionEditar['capacidad_adultos']; ?>" required>

        <label>Capacidad de Niños</label>
        <input type="numero" name="capacidad_ninos" value="<?php echo $habitacionEditar['capacidad_ninos']; ?>" required>

        <label>Cantidad de Cama</label>
        <input type="numero" name="cantidad_camas" value="<?php echo $habitacionEditar['cantidad_camas']; ?>" required>

        
        <label>Precio por Noche</label>
        <input type="numero" name="precio_noche" value="<?php echo $habitacionEditar['precio_noche']; ?>" required>

        <label>Mondea</label>        
        <select name="moneda" >
        <option value="MXN">MXN</option>
        <option value="USD">USD</option>
        <option value="EUR">EUR</option>
        </select>


        <label>Disponible General</label>
        <select name="disponible">
            <option value="0" <?php echo $habitacionEditar['disponible_general'] == 0 ? 'selected' : ''; ?>>No</option>
            <option value="1" <?php echo $habitacionEditar['disponible_general'] == 1 ? 'selected' : ''; ?>>Si</option>
        </select>
        <button type="submit">Actualizar</button>

    </form>
</div>

<?php
include 'views/layouts/footer.php';
?>