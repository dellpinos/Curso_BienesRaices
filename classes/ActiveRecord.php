<?php

namespace App;

class ActiveRecord {
    // sintaxis anterior

    //DB
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';

    // Errores
    protected static $errores = [];

    //** Metodos */

    public static function setDB($database)
    {
        self::$db = $database; //aqui se mantiene un self ya que se hace una sola conexión a la db y no se instancia cada vez
    }
    public function guardar()
    {
        if (!is_null($this->id)) {
            //actualizar
            $this->actualizar();
        } else {
            // Creando nuevo regsitro
            $this->crear();
        }
    }

    public function crear()
    {
        // Sanitizar entrada de datos
        $atributos = $this->sanitizarDatos();

        $query = "INSERT INTO " . static::$tabla . " (";
        $query .= join(', ', array_keys($atributos));  // acumuladores de strings en la misma variable
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        $resultado = self::$db->query($query);

        // Redireccionar al usuario
        if ($resultado) {
            header('location: /admin?resultado=1');
        }
    }
    public function actualizar()
    {
        $atributos = $this->sanitizarDatos(); // este metodo ya trae consigo los valores de los atributos de la instancia sanitizados

        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key} = '{$value}'";
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = ' " . self::$db->escape_string($this->id) . "' "; // sanitizo el di que ingresara a la DB
        $query .= "LIMIT 1 ";

        $resultado = self::$db->query($query);

        // Redireccionar al usuario
        if ($resultado) {
            header('location: /admin?resultado=2');
        }
    }

    // Eliminar un registro
    public function eliminar()
    {
        $query = "DELETE FROM " . static::$tabla . " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= "LIMIT 1 ";
        $resultado = self::$db->query($query);
        if ($resultado) {
            $this->borrarImagen();
            header('location: /admin?resultado=3');
        }
    }

    // Identificar y unir los atributos de la DB
    public  function atributos()
    { //itera
        $atributos = [];
        foreach (static::$columnasDB as $row) {
            if ($row === 'id') continue;
            $atributos[$row] = $this->$row;
        }
        return $atributos;
    }

    public function sanitizarDatos()
    { //sanitiza
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    // Subida de archivos
    public function setImagen($imagen)
    {
        // Elimina imagen anterior
        if (!is_null($this->id)) {
            $this->borrarImagen();
        }
        //asignar al atributo de imagen el nombre de la imagen
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }
    // Eliminar imagen del servidor
    public function borrarImagen()
    {
        //Comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    // Este método evita el undefined antes de que haya un POST
    public static function getErrores()
    {   
        return static::$errores;
    }
    public function validaciones()
    {
        static::$errores = []; // Vacia el array de errores cada vez que se llama el metodo
        return static::$errores;
    }

    // Listar todos los registros

    public static function all()
    {

        $query = "SELECT * FROM " . static::$tabla;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    // Busca un registro por su id
    public static function find($id)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = {$id}";

        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }


    public static function consultarSQL($query)
    {
        // consultar la base de datos
        $resultado = self::$db->query($query);
        // iterar resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }
        // liberar la memoria
        $resultado->free();
        //retornar los resultados
        return $array;
    }
    protected static function crearObjeto($registro)
    {
        $objeto = new static;
        foreach ($registro as $key => $value) { // por cada elemento del array leo su llave
            if (property_exists($objeto, $key)) { //si contiene la propiedad que corresponde a $key
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    // Sincroniza el objeto en memoria con los cambios realizados por el usuario, en memoria puedo validarlo y luego insertarlo en la DB

    public function sincronizar($args = [])
    {

        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}