<?php 

include 'includes/templates/header.php';
?>

    <main class="contenedor seccion">
        <h1>Conoce Sobre Nosotros</h1>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img src="build/img/nosotros.jpg" loading="lazy" alt="Sobre Nosotros">
                </picture>
            </div>
                <div class="texto-nosotros">
                    <blockquote>
                        25 años de experiencia
                    </blockquote>
                    <p>
                        Phasellus rhoncus, dui in mattis blandit, diam libero condimentum nibh, id dignissim ex erat sit amet orci. Suspendisse quis diam nec ante suscipit dictum ut pellentesque diam. Integer eget dolor facilisis, maximus justo fringilla, consectetur orci. Mauris sodales libero ac leo porttitor, non vulputate mauris interdum. Nullam ultricies vel neque vel aliquam. Integer vel orci ut diam tempor rhoncus at sit amet turpis. Mauris vulputate lobortis velit ut viverra.
                    </p>
                    <p>
                        Vivamus ut porta lacus, in finibus lorem. Aenean nibh felis, pulvinar quis nisl et, porta eleifend nisl. Sed pharetra rutrum sodales. Sed nibh sem, tincidunt sed venenatis in, ultrices et ligula. Phasellus volutpat non nisl consectetur dignissim.
                    </p>
                </div>
        </div>
    </main>
    <section class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono Seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa, hic quis, debitis sequi rem nulla ipsam error ducimus minus dolor fuga harum tempore. Ab facilis eius error, ut consequatur fuga!</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa, hic quis, debitis sequi rem nulla ipsam error ducimus minus dolor fuga harum tempore. Ab facilis eius error, ut consequatur fuga!</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa, hic quis, debitis sequi rem nulla ipsam error ducimus minus dolor fuga harum tempore. Ab facilis eius error, ut consequatur fuga!</p>
            </div>
        </div>
    </section>

    <?php 
include 'includes/templates/footer.php';
?>
