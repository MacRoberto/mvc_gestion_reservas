<?php
include 'views/layouts/header.php';
include 'views/layouts/menu.php';
?>

<div class="contenedor">
    <h1><?php echo $titulo; ?></h1>

    <form action="habitaciones.php?accion=guardar" method="POST">
        <label>Tipo de habitación</label>
        <input type="text" name="habitacion_tipo" required>

        <label>Descripción</label>
        <input type="text" name="descripcion" required>

        <label>Capacidad de Adultos</label>
        <input type="numero" name="num_adultos" required>

        <label>Capacidad de Niños</label>
        <input type="numbero" name="num_niños" required>

        <label>Cantidad de Cama</label>
        <input type="numero" name="num_cama" required>

        <label>Precio por Noche</label>
        <input type="numero" name="precio" required>
        
        <label>Moneda</label>
        <input type="numero" name="precio" required>

        <label>Disposición General </label>
        <input type="text" name="disposicion_general" required>

        <imput>disponible</imput>        
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