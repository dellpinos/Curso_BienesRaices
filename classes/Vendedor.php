<?php

namespace App;

class Vendedor extends ActiveRecord {

    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono', 'email'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;
    public $email;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->email = $args['email'] ?? '';
    }


    public function validaciones()
    {
        // Validaciones
        if (!$this->nombre) {
            self::$errores[] = "El nombre es obligatorio";
        }
        if (!$this->apellido) {
            self::$errores[] = "El apellido es obligatorio";
        }
        if (!$this->telefono) {
            self::$errores[] = "El telefono es obligatorio";
        }
        if (!$this->email) {
            self::$errores[] = "Tenes que poner un email";
        }
        if(!preg_match('/[0-9]{8}/', $this->telefono)) { // caracteres del 0 al 9 y con una extension de 8
            self::$errores[] = "Formato no valido";
        }

        return self::$errores;
    }
}