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

        <label>Ciudad</label>
        <input type="text" name="ciudad" value="<?php echo $HabitacionEditar['ciudad']; ?>" required>

        <label>Telefono</label>
        <input type="numero" name="telefono" value="<?php echo $HabitacionEditar['telefono']; ?>" required>

        <label>Correo electronico</label>
        <input type="email" name="email" value="<?php echo $HabitacionEditar['email']; ?>" required>

        <label>Descriocion</label>
        <input type="text" name="descripcion" value="<?php echo $HabitacionEditar['descripcion']; ?>" required>

        
        <label>categoria</label>
        <input type="text" name="categoria" value="<?php echo $HabitacionEditar['categoria']; ?>" required>


        <label>Hora check in </label>
        <input type="time" name="hora_checkin" value="<?php echo $HabitacionEditar['hora_checkin']; ?>" required>


        <label>Check out </label>
        <input type="time" name="hora_checkout" value="<?php echo $HabitacionEditar['hora_checkout']; ?>" required>


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






        <button type="submit">Actualizar</button>
    </form>
</div>

<?php
include 'views/layouts/footer.php';
?>