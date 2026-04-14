<?php
//Agregar sesion_start para poder usar $_SESSION y hacer validaciones de permisos
@session_start();
include 'views/layouts/header.php';
include 'views/layouts/menu.php';
?>

<div class="contenedor">
    <div class="admin-header">
        <h1><?php echo $titulo; ?></h1>
        <?php
            //ADMIN, PROPIETARIO, IT
            if (isset($_SESSION['permiso']) && ($_SESSION['permiso'] == 'IT') || 
            $_SESSION['permiso'] == 'admin' || $_SESSION['permiso'] == 'propietario') {
                echo '<p><a class="boton" href="hoteles.php?accion=nuevo">Nuevo hotel</a></p>';
            }
        ?>
    </div>
    <form action="hoteles.php" method="GET" class="admin-buscador">
        <select name="campo">
            <option value="todos" <?php echo (isset($_GET['campo']) && $_GET['campo'] == 'todos') || !isset($_GET['campo']) ? 'selected' : ''; ?>>Todos</option>
            <option value="nombre" <?php echo isset($_GET['campo']) && $_GET['campo'] == 'nombre' ? 'selected' : ''; ?>>Nombre</option>
            <option value="ciudad" <?php echo isset($_GET['campo']) && $_GET['campo'] == 'ciudad' ? 'selected' : ''; ?>>Ciudad</option>
            <option value="direccion" <?php echo isset($_GET['campo']) && $_GET['campo'] == 'direccion' ? 'selected' : ''; ?>>Dirección</option>
        </select>
        <input type="text" name="busqueda" value="<?php echo isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : ''; ?>">
        <button type="submit">Buscar</button>
    </form>

    <div class="tabla-scroll">
    <table class="tabla-admin">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Ciudad</th>
            <th>Direccion</th>
            <th>Telefono</th>
            <th>Email</th>
            <th>Descripción</th>
            <th>Categoría</th>
            <th>Hora Check In</th>
            <th>Hora Check Out</th>
            <th>Diponible General</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($hoteles as $fila) { ?>
            <tr>
                <td><?php echo $fila['id']; //nombres que vienen de la bd ?></td>
                <td><?php echo $fila['nombre']; ?></td>
                <td><?php echo $fila['ciudad']; ?></td>
                <td><?php echo $fila['direccion']; ?></td>
                <td><?php echo $fila['telefono']; ?></td>
                <td><?php echo $fila['email']; ?></td>
                <td><?php echo $fila['descripcion']; ?></td>
                <td><?php echo $fila['categoria']; ?></td>
                <td><?php echo $fila['hora_checkin']; ?></td>
                <td><?php echo $fila['hora_checkout']; ?></td>
                <td>
                    <?php
                        if($fila['disponible_general'] == 0){
                            echo 'No'; 
                        }else{
                            echo 'Si';
                        } 
                    ?>
                </td>

                <td>
                    <?php
                        //ADMIN, PROPIETARIO, IT
                        if (isset($_SESSION['permiso']) && ($_SESSION['permiso'] == 'IT') 
                            || $_SESSION['permiso'] == 'admin') {
                            echo '<a href="hoteles.php?accion=editar&id=' . $fila['id'] . '">Editar</a>';
                        }
                        
                    ?>
                    
                    <a href="habitaciones.php?hotel_id=<?php echo $fila['id']; ?>">Habitaciones</a>
                    <a href="hoteles.php?accion=imagenes&id=<?php echo $fila['id']; ?>">Imágenes</a>
                    <?php

                        if (isset($_SESSION['permiso']) && ($_SESSION['permiso'] == 'IT') 
                            || $_SESSION['permiso'] == 'admin') {
                            echo '<a href="hoteles.php?accion=eliminar&id=' . $fila['id'] . '" onclick = "return confirm(\'¿Deseas eliminar este hotel?\')" >Eliminar</a>';
                        }
                        
                    ?>
                </td>
            </tr>
        <?php } ?>
    </table>
    </div>
</div>

<?php
include 'views/layouts/footer.php';
?>
