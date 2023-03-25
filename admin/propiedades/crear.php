<?php

require '../../includes/app.php';

use App\Propiedad;


usuarioAutenticado();

// Base de datos
$db = conectarDB();

// Consultar DB para obtener vendedores

$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

// Array con mensajes de error
$errores = [];

$titulo = '';
$precio = '';  // inicia como string pero cambia a numero cuando se le ingresa un valor
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedores_id = '';
$creado = date('Y/m/d');


// Ejecutar el código despues de que el usuario envie el formulario

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $propiedad = new Propiedad($_POST);
    $propiedad->guardar();

    debuguear($propiedad);


    

    // Asignar files hacia una variable
    $imagen = $_FILES['imagen'];

    // Sanitizacion
    $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
    $wc = mysqli_real_escape_string($db, $_POST['wc']);
    $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
    $vendedores_id = mysqli_real_escape_string($db, $_POST['vendedores_id']);

    
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
    if (!$imagen['name'] || $imagen['error']) {
        $errores[] = "Debes añadir una imagen";
    }

    // Validar por tamaño (1Mb maximo)

    $medida = 1000 * 1000; // Mb a bytes

    if($imagen['size'] > $medida) {
        $errores[] = "La imagen es demasiado grande";
    }

    // Revisar que el array de errores este vacio

    if (empty($errores)) {

        /** SUBIDA DE ARCHIVOS */

        //Crear una carpeta
        $carpetaImagenes = '../../imagenes/'; //url donde almacenar las imagenes

        if(!is_dir($carpetaImagenes)) {  // controlo si la carpeta esta creada
            mkdir($carpetaImagenes); // creo la carpeta
        }

        // Generar un nombre unico

        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

        // Subir imagen

        move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
        

        /**  Insertar en la base de datos */
        
        // Sentencia SQL
        

        // Consulta
        $resultado = mysqli_query($db, $query);

        // Redireccionar al usuario
        if ($resultado) {
            

            header('location: /admin?resultado=1');
            echo 'Insertado Correctamente';
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
        <fieldset>
            <legend>Informacion General</legend>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>"> <!-- php para no tener q escribir dos veces en caso de error -->

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen" >

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" placeholder="Escriba una descripcion"><?php echo $descripcion; ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Información de la Popiedad</legend>

            <label for="habitaciones">Habitaciones: </label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones; ?>">

            <label for="wc">Baños: </label>
            <input type="number" id="wc" name="wc" placeholder="Ej: 2" min="1" max="6" value="<?php echo $wc; ?>">

            <label for="estacionamiento">Estacionamiento: </label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 2" min="1" max="4" value="<?php echo $estacionamiento; ?>" >
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>
            <select name="vendedores_id">
                <option value="">-- Seleccione --</option> 
                <?php while($row = mysqli_fetch_assoc($resultado) ) : ?> <!-- cargo un array con la consulta a la DB, dentro de while para que lo haga una vez por registro -->
                    <option <?php echo $vendedores_id === $row['id'] ? 'selected' : ''; ?> value="<?php echo $row['id'] ?>"> <?php echo $row['nombre'] . " " . $row['apellido']; ?></option>

                <?php endwhile ?>

            </select>
        </fieldset>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form> <!-- envio formulario al servidor -->
</main>

<?php incluirTemplate('footer'); ?>