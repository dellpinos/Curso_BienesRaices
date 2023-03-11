<?php
    require 'includes/funciones.php'; // incluye las funciones en este archivo
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Casa en Venta frente al bosque</h1>

        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.jpg" type="image/jpeg">
            <img src="build/img/destacada.jpg" alt="Imagen de la Propiedad" loading="lazy">
        </picture>
        <div class="resumen-propiedad">
            <p class="precio">$3.000.000</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                    <p>4</p>
                </li>

            </ul>

            <p>
                Phasellus rhoncus, dui in mattis blandit, diam libero condimentum nibh, id dignissim ex erat sit amet orci. Suspendisse quis diam nec ante suscipit dictum ut pellentesque diam. Integer eget dolor facilisis, maximus justo fringilla, consectetur orci. Mauris sodales libero ac leo porttitor, non vulputate mauris interdum. Nullam ultricies vel neque vel aliquam. Integer vel orci ut diam tempor rhoncus at sit amet turpis. Mauris vulputate lobortis velit ut viverra.
            </p>
            <p>
                Vivamus ut porta lacus, in finibus lorem. Aenean nibh felis, pulvinar quis nisl et, porta eleifend nisl. Sed pharetra rutrum sodales. Sed nibh sem, tincidunt sed venenatis in, ultrices et ligula. Phasellus volutpat non nisl consectetur dignissim.
            </p>
        </div>
    </main>

    <?php 
incluirTemplate('footer');
?>