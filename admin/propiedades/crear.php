<?php

require '../../includes/app.php';

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

usuarioAutenticado();


$propiedad = new Propiedad(); // nueva instancia vacia para evitar el undefined

// Consulta para obtener todos los vendedores
$vendedores = Vendedor::all();


// Array con mensajes de error para evitar el undefined
$errores = Propiedad::getErrores();


// Ejecutar el código despues de que el usuario envie el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /** Crea una nueva instancia  */
    $propiedad = new Propiedad($_POST['propiedad']); // almaceno el POST en memoria, utilizo la llave del array que utilizo para sincronizar


    /** SUBIDA DE ARCHIVOS */

    // Generar un nombre unico
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    // Setear la imagen
    if($_FILES['propiedad']['tmp_name']['imagen']) {
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600); // Realiza un resize a la imagen con intervention
        $propiedad->setImagen($nombreImagen);
    }

    // Validar datos
    $errores = $propiedad->validaciones();

    // Revisar que el array de errores este vacio
    if (empty($errores)) { // solo se ejecuta en caso de no haber errores

        //Crear la carpeta para las imagenes
        if (!is_dir(CARPETA_IMAGENES)) {
            mkdir(CARPETA_IMAGENES);
        }

        // Guarda la imagen en el servidor
        $image->save(CARPETA_IMAGENES . $nombreImagen);

        //Guarda en la base de datos
        $propiedad->guardar(); //almacena o no y devuelve un bool 

        // Mensaje de exito y error
        if ($resultado) {
            // Redireccionar al usuario
            header('location: /admin?resultado=1');
        }
    }
};


incluirTemplate('header');
?>

<!-- Inicio del documento -->
<main class="contenedor seccion">
    <h1>Crear</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>
    <?php foreach ($errores as $error) : ?> <!-- busco errores en el array para mostrarlos -->
        <div class="alerta error">
            <?php echo $error; ?>
        </div>

    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_propiedades.php'; ?>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form> <!-- envio formulario al servidor -->
</main>

<?php incluirTemplate('footer'); ?>