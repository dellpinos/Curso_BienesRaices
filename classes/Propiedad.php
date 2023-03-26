<?php

namespace App;

class Propiedad { // sintaxis anterior

    //DB
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedores_id']; // este array me permite mapear y unir todos los atributos del POST en un array iterable

    // Errores
    protected static $errores = [];

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
        $this->imagen = $args['imagen'] ?? ''; 
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

        return $resultado;
        
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

    // Subida de archivos
    public function setImagen($imagen) {
        //asignar al atribuito de imagen el nombre de la imagen
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    // Este método evita el undefined antes de que haya un POST
    public static function getErrores(){
        return self::$errores;

    }

    public function validaciones(){
        // Validaciones
    if (!$this->titulo) {
        self::$errores[] = "Debes añadir un titulo"; 
    }
    if (!$this->precio) {
        self::$errores[] = "Debes colocar un precio";
    }
    if (strlen($this->descripcion) < 50 || strlen($this->descripcion) > 255) { //evalua cantidad de caracteres
        self::$errores[] = "La descripcion debe contener entre 50 y 255 caracteres.";
    }
    if (!$this->habitaciones) {
        self::$errores[] = "El numero de habitaciones es obligatorio";
    }
    if (!$this->wc) {
        self::$errores[] = "El numero de baños es obligatorio";
    }
    if (!$this->estacionamiento) {
        self::$errores[] = "El numero de espacios de estacionamiento es obligatorio";
    }
    if (!$this->vendedores_id) {
        self::$errores[] = "Elige un vendedor";
    }
    if (!$this->imagen) {
        self::$errores[] = "Debes añadir una imagen";
    }

    return self::$errores;
    }
    
}