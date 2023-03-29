<?php

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;

require '../../includes/app.php';
usuarioAutenticado();

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

// Validacion del id dentro de la url
if (!$id) {
    header('Location: /admin');
}

$propiedad = Propiedad::find($id);

// Consultar DB para obtener vendedores

$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

// Array con mensajes de error
$errores = Propiedad::getErrores();



// Ejecutar el código despues de que el usuario envie el formulario

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Asignar los atributos
    $args = $_POST['propiedad'];

    $propiedad->sincronizar($args); // no creando una nueva instancia, estoy modificando la que esta en memoria


    // Validacion
    $errores = $propiedad->validaciones();

    //** Subida de archivos */


    // Generar un nombre unico
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    // Resize y carga de imagen en la instancia actual
    if ($_FILES['propiedad']['tmp_name']['imagen']) {
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600); // Realiza un resize a la imagen con intervention
        $propiedad->setImagen($nombreImagen);
    }

    if (empty($errores)) {

        if ($_FILES['propiedad']['tmp_name']['imagen']) { // <<<<<<< agrego este IF por el undefined
        $image->save(CARPETA_IMAGENES . $nombreImagen);
    }
        /**  Insertar en la base de datos */
        $resultado = $propiedad->guardar();

    }
};

incluirTemplate('header');
?>

<!-- Inicio del documento -->
<main class="contenedor seccion">
    <h1>Actualizar información de la Propiedad</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>
    <?php foreach ($errores as $error) : ?> <!-- busco errores en el array para mostrarlos -->
        <div class="alerta error">
            <?php echo $error; ?>
        </div>

    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_propiedades.php'; ?>

        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
    </form> <!-- envio formulario al servidor -->
</main>

<?php incluirTemplate('footer'); ?>