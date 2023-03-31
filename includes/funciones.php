<?php

//** Constantes */
define('TEMPLATES_URL', __DIR__ . '/templates');// definiendo una url
define('FUNCIONES_URL', __DIR__ . 'funciones.php');// misma carpeta
define('CARPETA_IMAGENES', __DIR__ . '/../imagenes/');

//** Funciones */
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

// dev
function debuguear($parametro){

    echo "<pre>";
        var_dump($parametro);
    echo "</pre>";

    exit;
}

// Escapar / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

// Validar tipo de contenido
function validarTipoContenido($tipo){
    $tipos = ['vendedor', 'propiedad'];
    return in_array($tipo, $tipos);  // busca un string o un valor dentro de un array, toma dos valores 1_lo que busca y 2_donde buscarlo
}

