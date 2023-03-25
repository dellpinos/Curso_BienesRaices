<?php

namespace App;


class Propiedad { // sintaxis anterior

    //DB
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedores_id']; // este array me permite mapear y unir todos los atributos del POST en un array iterable

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedores_id;


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? ''; 
        $this->titulo = $args['titulo'] ?? ''; 
        $this->precio = $args['precio'] ?? ''; 
        $this->imagen = $args['imagen'] ?? 'imagen.jpg'; 
        $this->descripcion = $args['descripcion'] ?? ''; 
        $this->habitaciones = $args['habitaciones'] ?? ''; 
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedores_id = $args['vendedores_id'] ?? '';
    }

    

    public static function setDB($database){
        self::$db = $database;
    }

    public function guardar(){
        
        // Sanitizar entrada de datos
        $atributos = $this->sanitizarDatos();

        //Insetar en la DB

        // $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedores_id) VALUES ('$this->titulo', '$this->precio', '$this->imagen', '$this->descripcion', '$this->habitaciones', '$this->wc', '$this->estacionamiento', '$this->creado', '$this->vendedores_id')";

        $query = "INSERT INTO propiedades (";
        $query .= join(', ', array_keys($atributos));  // acumuladores de strings en la misma variable
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') " ;

        $resultado = self::$db->query($query);

        
    }
    // Identificar y unir los atributos de la DB
    public  function atributos() { //itera
        $atributos = [];
        foreach(self::$columnasDB as $row) {
            if($row === 'id') continue;
            $atributos[$row] = $this->$row;
        }
        return $atributos;
    }
    public function sanitizarDatos() { //sanitiza
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    //definir la conexion a la DB

    
}