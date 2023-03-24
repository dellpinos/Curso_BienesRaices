<?php

define('TEMPLATES_URL', __DIR__ . '/templates');// definiendo una url
define('FUNCIONES_URL', __DIR__ . 'funciones.php');// misma carpeta



function incluirTemplate(string $nombre, bool $inicio = false) {
    include TEMPLATES_URL . "/{$nombre}.php";
}

// Inicio sesion
function usuarioAutenticado() : bool {  
session_start();
$auth = $_SESSION['login']; // agrego isset por warning de variable no definida en firefox
if($auth) {
    return true; //chequear esto  <<<<<<<
    
}
return false;
}

