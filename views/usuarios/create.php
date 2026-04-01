<?php
include 'views/layouts/header.php';
include 'views/layouts/menu.php';
?>

<div class="contenedor">
    <h1><?php echo $titulo; ?></h1>

    <form action="usuarios.php?accion=guardar" method="POST">
        <label>Nombre del usuario</label>
        <input type="text" name="nombre" required>

        <label>Telefono</label>
        <input type="number" name="numero" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Contraseña</label>
        <input type="password" name="contrasena" required>

        <label>Permiso</label>        
        <select name="permiso" >
        <option value="usuario">Usuario</option>
        <option value="admin">Admin</option>
        <option value="propietario">Propietario</option>
        <option value="IT">IT</option>
        </select>

        <label>Activo</label>        
        <select name="activo" >
        <option value="0">No</option>
        <option value="1">Si</option>
        </select>

        <button type="submit">Guardar</button>
    </form>
</div>

<?php
include 'views/layouts/footer.php';
?>