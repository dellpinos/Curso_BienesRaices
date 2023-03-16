<?php

// Importar conexion

require '../includes/config/database.php';
$db = conectarDB();

//Escribir query
$query = "SELECT * FROM propiedades";

//Consultar DB

$resultadoConsulta = mysqli_query($db, $query);


// Muestra mensaje condicional
$resultado = $_GET['resultado'] ?? null;

//Incluye template
require '../includes/funciones.php'; // incluye las funciones en este archivo
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>

    <?php if (intval($resultado) === 1) : ?>
        <p class="alerta exito">Anuncio creado correctamente</p>
    <?php endif ?>


    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva propiedad</a>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <!-- Mostrar resultados de la DB -->

        <tbody>
            <?php while( $propiedad = mysqli_fetch_assoc($resultadoConsulta)) : ?>
            <tr>
                <th><?php echo $propiedad['id']; ?></th>  
                <th><?php echo $propiedad['titulo']; ?></th>
                <th> <img src="/imagenes/<?php echo $propiedad['imagen']; ?>" class="imagen-tabla"> </th>
                <th>$ <?php echo $propiedad['precio']; ?></th>
                <th>
                    <a href="#" class="boton-rojo-block">Eliminar</a>
                    <a href="#" class="boton-amarillo-block">Actualizar</a>
                </th>
            </tr>
            <?php endwhile ?> 
        </tbody>
    </table>
</main>

<!-- Cerrar la conexion   <?php  ?> -->

<?php mysqli_close($db) ?>

<?php incluirTemplate('footer'); ?>