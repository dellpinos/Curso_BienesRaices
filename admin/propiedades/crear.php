<?php
// Base de datos

require '../../includes/config/database.php';

$db = conectarDB();

// Array con mensajes de error
$errores = [];

$titulo = '';
$precio = '';  // inicia como string pero cambia a numero cuando se le ingresa un valor
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedores_id = '';


// Ejecutar el código despues de que el usuario envie el formulario

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titulo = $_POST['titulo'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $habitaciones = $_POST['habitaciones'];
    $wc = $_POST['wc'];
    $estacionamiento = $_POST['estacionamiento'];
    $vendedores_id = $_POST['vendedor'];

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

    // echo "<pre>";
    //     var_dump($errores);
    // echo "</pre>";

    // Revisar que el array de Errores este vacio

    if (empty($errores)) {

        // Insertar en la base de datos
        $query = "INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, vendedores_id) VALUES ('$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$vendedores_id')";

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            echo 'Insertado Correctamente';
        }
    }
};

require '../../includes/funciones.php'; // incluye las funciones en este archivo
incluirTemplate('header');
?>


<main class="contenedor seccion">
    <h1>Crear</h1>


    <a href="/admin" class="boton boton-verde">Volver</a>
    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>

    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/admin/propiedades/crear.php">
        <fieldset>
            <legend>Informacion General</legend>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png">

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
            <select name="vendedor">
                <option value="">-- Seleccione --</option>
                <option value="1">Martin</option>
                <option value="3">Sofia</option>
            </select>
        </fieldset>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>


<?php incluirTemplate('footer'); ?>