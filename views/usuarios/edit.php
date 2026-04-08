<?php
include 'views/layouts/header.php';
include 'views/layouts/menu.php';
?>

<div class="contenedor">
    <h1><?php echo $titulo; ?></h1>

    <form action="usuarios.php?accion=actualizar" method="POST">
        <input type="hidden" name="id" value="<?php echo $usuarioEditar['id']; ?>">

        <div class="usuario-form-row usuario-form-row-2">
            <div class="usuario-form-col">
                <label>Nombre del usuario</label>
                <input type="text" name="nombre" value="<?php echo $usuarioEditar['nombre']; ?>" required>
            </div>
            <div class="usuario-form-col">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo $usuarioEditar['email']; ?>" required>
            </div>
        </div>

        <div class="usuario-form-row usuario-form-row-3">
            <div class="usuario-form-col">
                <label>telefono</label>
                <input type="number" name="telefono" value="<?php echo $usuarioEditar['telefono']; ?>" required>
            </div>
            <div class="usuario-form-col">
                <label>Permiso</label>        
                <select name="permiso" >
                <option value="usuario" <?php echo $usuarioEditar['permiso'] == "usuario" ? 'selected' : ''; ?>>Usuario</option>
                <option value="admin" <?php echo $usuarioEditar['permiso'] == "admin" ? 'selected' : ''; ?>>Admin</option>
                <option value="propietario" <?php echo $usuarioEditar['permiso'] == "propietario" ? 'selected' : ''; ?>>Propietario</option>
                <option value="IT" <?php echo $usuarioEditar['permiso'] == "IT" ? 'selected' : ''; ?>>IT</option>
                </select>
            </div>
            <div class="usuario-form-col">
                <label>Activo</label>
                <select name="activo">
                    <option value="0" <?php echo $usuarioEditar['activo'] == 0 ? 'selected' : ''; ?>>No</option>
                    <option value="1" <?php echo $usuarioEditar['activo'] == 1 ? 'selected' : ''; ?>>Si</option>
                    if()
                </select>
            </div>
        </div>

        <div class="usuario-form-row">
            <div class="usuario-form-col usuario-check-line">
                <input type="checkbox" id="toggle-change-password" name="cambiar_password" value="1">
                <label for="toggle-change-password">Cambiar contraseña</label>
            </div>
        </div>

        <div class="usuario-form-row usuario-form-row-3">
            <div class="usuario-form-col">
                <label>Contraseña Actual</label>
                <input type="password" id="current-pwd" name="contrasena" value="<?php echo $usuarioEditar['contrasena']; ?>" disabled>
            </div>
            <div class="usuario-form-col">
                <label>Nueva Contraseña</label>
                <input type="password" id="pwd1" name="contrasena-nueva" disabled>
            </div>
            <div class="usuario-form-col">
                <label>Repetir Nueva Contraseña</label>
                <input type="password" id="pwd2" name="contrasena-nueva2" disabled>
            </div>
        </div>

        <p id="mensaje-password" style="color: red; margin-top: 5px;"></p>

        <button type="submit" id="btn-check-pwd">Actualizar</button>
    </form>
</div>

<?php
include 'views/layouts/footer.php';
?>
