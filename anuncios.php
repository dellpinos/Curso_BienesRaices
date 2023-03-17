<?php
    require 'includes/funciones.php'; // incluye las funciones en este archivo
    incluirTemplate('header');
?>

    <main class="contenedor seccion">

        <h2>Casas y Departamentos en venta</h2>

        <?php
            $limite = 20;
            include 'includes/templates/anuncios.php'
        ?>
    </main>

    <?php 
incluirTemplate('footer');
?>