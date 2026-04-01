<?php
include 'views/layouts/header.php';
include 'views/layouts/menu.php';
?>

<div class="contenedor">
    <h1><?php echo $titulo; ?></h1>

    <form action="habitaciones.php?accion=guardar" method="POST">
        <label>Hotel</label>
        <select name="hotel_id" required>
            <option value="">Seleccione un hotel</option>
            <?php foreach ($hoteles as $h) { ?>
                <option value="<?php echo $h['id']; ?>"><?php echo $h['nombre']; ?></option>
            <?php } ?>
        </select>

        <label>Tipo de habitación</label>
        <input type="text" name="tipo_habitacion" required>

        <label>Descripción</label>
        <input type="text" name="descripcion" required>

        <label>Capacidad de Adultos</label>
        <input type="numero" name="capacidad_adultos" required>

        <label>Capacidad de Niños</label>
        <input type="numbero" name="capacidad_ninos" required>

        <label>Cantidad de Cama</label>
        <input type="numero" name="cantidad_camas" required>

        <label>Precio por Noche</label>
        <input type="numero" name="precio_noche" required>
        
        <label>Mondea</label>        
        <select name="moneda" >
        <option value="MXN">MXN</option>
        <option value="USD">USD</option>
        <option value="EUR">EUR</option>
        </select>
        
        <label>disponible</label>        
        <select name="disponible" >
        <option value="0">No</option>
        <option value="1">Si</option>
        </select>

        <button type="submit">Guardar</button>
    </form>
</div>

<?php
include 'views/layouts/footer.php';
?>