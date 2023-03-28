<?php

require '../../includes/app.php';

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;

usuarioAutenticado();

// Base de datos
$db = conectarDB();

$propiedad = new Propiedad(); // nueva instancia vacia para evitar el undefined

// Consultar DB para obtener vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);


// Array con mensajes de error para evitar el undefined
$errores = Propiedad::getErrores();


// Ejecutar el código despues de que el usuario envie el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /** Crea una nueva instancia  */
    $propiedad = new Propiedad($_POST); // almaceno el POST en memoria


    /** SUBIDA DE ARCHIVOS */

    // Generar un nombre unico
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    // Setear la imagen
    if ($_FILES['imagen']['tmp_name']) {
        $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600); // Realiza un resize a la imagen con intervention
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
        $resultado = $propiedad->guardar(); //almacena o no y devuelve un bool 

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