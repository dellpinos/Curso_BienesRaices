<?php
// Inicio sesion

require '../includes/app.php';
usuarioAutenticado();



//Escribir query
$query = "SELECT * FROM propiedades";

//Consultar DB

$resultadoConsulta = mysqli_query($db, $query); // cargo datos de la DB


// Muestra mensaje condicional
$resultado = $_GET['resultado'] ?? null; // cargo datos de la URL



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['eliminarId'];
    $id = filter_var($id, FILTER_VALIDATE_INT); // valida que no sea manipulado

    if($id) {

        // Eliminar la imagen
        $query = "SELECT imagen FROM propiedades WHERE id = {$id}";
        $resultado = mysqli_query($db, $query);
        $propiedad = mysqli_fetch_assoc($resultado);

        unlink('../imagenes/' . $propiedad['imagen']);

        // Eliminar el registro
        $query = "DELETE FROM propiedades WHERE id = {$id}";
        $resultado = mysqli_query($db, $query);

        if($resultado) {
            header('Location: /admin?resultado=3');
        }
    }
}




//Incluye template

incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Menú Administrador</h1>

    <?php if (intval($resultado) === 1) : ?> <!-- Evaluo si poner cartel de propiedad creada -->
        <p class="alerta exito">Anuncio creado correctamente</p>
    <?php elseif (intval($resultado) === 2) : ?>
        <p class="alerta exito">Anuncio actualizado correctamente</p>
    <?php elseif (intval($resultado) === 3) : ?>
        <p class="alerta exito">Anuncio eliminado correctamente</p>
    <?php endif ?>


    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva propiedad</a>

    <table class="propiedades">
        <thead>
            <tr> <!-- cabecera de la lista/ columnas de la DB -->
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <!-- Mostrar resultados de la DB -->

        <tbody>
            <?php while ($propiedad = mysqli_fetch_assoc($resultadoConsulta)) : ?>
                <tr>
                    <th><?php echo $propiedad['id']; ?></th> <!-- Proceso e imprimo -->
                    <th><?php echo $propiedad['titulo']; ?></th>
                    <th> <img src="/imagenes/<?php echo $propiedad['imagen']; ?>" class="imagen-tabla"> </th>
                    <th>$ <?php echo $propiedad['precio']; ?></th>
                    <th>
                        <form method="POST" class="w-100">

                            <input type="hidden" name="eliminarId" value="<?php echo $propiedad['id']; ?>">

                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="admin/propiedades/actualizar.php?id=<?php echo $propiedad['id'] ?>" class="boton-amarillo-block">Actualizar</a>
                    </th>
                </tr>
            <?php endwhile ?>
        </tbody>
    </table>
</main>

<!-- Cerrar la conexion   <?php  ?> -->

<?php mysqli_close($db) ?>

<?php incluirTemplate('footer'); ?>