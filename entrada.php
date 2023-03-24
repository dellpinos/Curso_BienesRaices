<?php
    require 'includes/app.php'; // incluye las funciones en este archivo
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Guia para la decoracion de tu hogar</h1>

        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpeg">
            <img src="build/img/destacada2.jpg" alt="Imagen de la Propiedad" loading="lazy">
        </picture>

        <p class="informacion-meta">Escrito el: <span>20/10/2023</span> por: <span>Admin</span> </p>
        <div class="resumen-propiedad">
            
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