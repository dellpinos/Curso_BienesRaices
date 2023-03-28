<?php

define('TEMPLATES_URL', __DIR__ . '/templates');// definiendo una url
define('FUNCIONES_URL', __DIR__ . 'funciones.php');// misma carpeta
define('CARPETA_IMAGENES', __DIR__ . '/../imagenes/');







function incluirTemplate(string $nombre, bool $inicio = false) {
    include TEMPLATES_URL . "/{$nombre}.php";
}

// Inicio sesion
function usuarioAutenticado() : void {  
session_start();

if(!$_SESSION['login']) {
    header ('Location: /');
}

}

function debuguear($parametro){

    echo "<pre>";
        var_dump($parametro);
    echo "</pre>";

    exit;
}