<?php

require 'app.php';


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

