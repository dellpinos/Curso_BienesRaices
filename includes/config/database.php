<?php

function conectarDB() : mysqli {
    $db = mysqli_connect('localhost', 'root', '', 'bienesraices_crud');

    if(!$db) {
        echo "No puede realizarce la conexion a la base de datos";
        exit;
    }

    return $db;
}