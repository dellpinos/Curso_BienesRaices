<?php

require 'includes/app.php';
use App\Propiedad;

// Validacion del id dentro de la url

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: /admin');
}

$propiedad = Propiedad::find($id);


incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad->titulo; ?></h1>

    <img loading="lazy" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="anuncio">

    <div class="resumen-propiedad">
        <p class="precio">$ <?php echo $propiedad->precio; ?></p>
        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                <p><?php echo $propiedad->wc; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                <p><?php echo $propiedad->estacionamiento; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                <p><?php echo $propiedad->habitaciones; ?></p>
            </li>

        </ul>

        <p>
            <?php echo $propiedad->descripcion; ?>
        </p>
        <p>
            Vivamus ut porta lacus, in finibus lorem. Aenean nibh felis, pulvinar quis nisl et, porta eleifend nisl. Sed pharetra rutrum sodales. Sed nibh sem, tincidunt sed venenatis in, ultrices et ligula. Phasellus volutpat non nisl consectetur dignissim.
        </p>
    </div>
</main>

<?php

incluirTemplate('footer');
?>