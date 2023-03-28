<?php

use App\Propiedad;

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
$errores = [];



// Ejecutar el código despues de que el usuario envie el formulario

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";


    // Asignar files hacia una variable
    $imagen = $_FILES['imagen'];

    // Sanitizacion
    $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
    $wc = mysqli_real_escape_string($db, $_POST['wc']);
    $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
    $vendedores_id = mysqli_real_escape_string($db, $_POST['vendedor']);


    // Validaciones
    if (!$titulo) {
        $errores[] = "Debes añadir un titulo"; //añade este valor al final del arreglo
    }
    if (!$precio) {
        $errores[] = "Debes colocar un precio";
    }
    if (strlen($descripcion) < 50 || strlen($descripcion) > 255) { //evalua cantidad de caracteres
        $errores[] = "La descripcion debe contener entre 50 y 255 caracteres.";
    }
    if (!$habitaciones) {
        $errores[] = "El numero de habitaciones es obligatorio";
    }
    if (!$wc) {
        $errores[] = "El numero de baños es obligatorio";
    }
    if (!$estacionamiento) {
        $errores[] = "El numero de espacios de estacionamiento es obligatorio";
    }
    if (!$vendedores_id) {
        $errores[] = "Elige un vendedor";
    }


    // Validar por tamaño (1Mb maximo)

    $medida = 1000 * 1000; // Mb a bytes

    if ($imagen['size'] > $medida) {
        $errores[] = "La imagen es demasiado grande";
    }

    // Revisar que el array de errores este vacio

    if (empty($errores)) {

        // //Crear una carpeta
        $carpetaImagenes = '../../imagenes/'; //url donde almacenar las imagenes

        if (!is_dir($carpetaImagenes)) {  // controlo si la carpeta esta creada
            mkdir($carpetaImagenes); // creo la carpeta
        }

        // /** SUBIDA DE ARCHIVOS */

        $nombreImagen = '';

        if ($imagen['name']) {

            // Eliminar imagen anterior
            unlink($carpetaImagenes . $propiedad['imagen']);

            // Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            // Subir imagen
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
        } else {
            $nombreImagen = $propiedad['imagen'];
        }


        /**  Insertar en la base de datos */

        // Sentencia SQL
        $query = "UPDATE propiedades SET titulo = '{$titulo}', precio = {$precio}, imagen = '{$nombreImagen}', descripcion = '{$descripcion}', habitaciones = {$habitaciones}, wc = {$wc}, estacionamiento = {$estacionamiento}, vendedores_id = {$vendedores_id} WHERE id = {$id} ";

        // Consulta
        $resultado = mysqli_query($db, $query);

        // Redireccionar al usuario
        if ($resultado) {

            header('location: /admin?resultado=2');
            echo 'Insertado Correctamente';
        }
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