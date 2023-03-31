<?php

require '../../includes/app.php';
use App\Vendedor;
usuarioAutenticado();

// Validar que sea un id valido

$id = $_GET['id']; // toma el id de la url 
$id = filter_var($id, FILTER_VALIDATE_INT); // valida que sea un id y no otro código

if(!$id) {
    header('Location: /admin'); //redirecciona si no hay un id valido

}


// Obtener el registro del vendedor desde la DB

$vendedor = Vendedor::find($id);



// Array con mensajes de error para evitar el undefined
$errores = Vendedor::getErrores();

// Ejecutar el código despues de que el usuario envie el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Asignar los valores

    $args = $_POST['vendedor'];

    //Sincronizar objeto en memoria
    $vendedor->sincronizar($args);

    // Validacion
    $errores = $vendedor->validaciones();

    // Sanitizar - Guardar
    if(empty($errores)) {
        $vendedor->guardar(); // Como tiene asignado un id, el método ya puede identificar si debe actualizar o guardar
    }


  
    // debuguear($args);

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

    <form class="formulario" method="POST"> <!-- enctype="multipart/form-data" es para cargar imagenes -->
        <?php include '../../includes/templates/formulario_vendedores.php'; ?>

        <input type="submit" value="Guardar Cambios" class="boton boton-verde">
    </form> <!-- envio formulario al servidor -->
</main>

<?php incluirTemplate('footer'); ?>


<!-- Agregar imagenes de los Vendedores -->