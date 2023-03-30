<?php

namespace App;

class Propiedad extends ActiveRecord
{ 
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedores_id']; // este array me permite mapear y unir todos los atributos del POST en un array iterable

    protected static $tabla = 'propiedades';

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
        $this->id = $args['id'] ?? null;
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

    public function validaciones()
    {
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
