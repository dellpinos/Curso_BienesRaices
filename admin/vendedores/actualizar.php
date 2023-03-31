<?php

require '../../includes/app.php';

use App\Vendedor;

usuarioAutenticado();

$vendedor = new Vendedor();

// Array con mensajes de error para evitar el undefined
$errores = Vendedor::getErrores();

// Ejecutar el código despues de que el usuario envie el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {



}

incluirTemplate('header');
?>

<!-- Inicio del documento -->
<main class="contenedor seccion">
    <h1>Actualizar Empleado</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>
    <?php foreach ($errores as $error) : ?> <!-- busco errores en el array para mostrarlos -->
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/admin/vendedores/actualizar.php" > <!-- enctype="multipart/form-data" es para cargar imagenes -->
        <?php include '../../includes/templates/formulario_vendedores.php'; ?>

        <input type="submit" value="Guardar Cambios" class="boton boton-verde">
    </form> <!-- envio formulario al servidor -->
</main>

<?php incluirTemplate('footer'); ?>


<!-- Agregar imagenes de los Vendedores -->