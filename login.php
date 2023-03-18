<?php

require 'includes/config/database.php';
$db = conectarDB();

// Autenticar el usuario
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // este código se ejecuta una vez enviado el formulario


    // Validaciones

    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if(!$email) {
        $errores[] = "El email no es válido";
    }
    if(!$password) {
        $errores[] = "El password es obligatorio";
    }

    if(empty($errores)) {
        // Comprobar si existe el usuario

        $query = "SELECT * FROM usuarios WHERE email = '{$email}' ";
        $resultado = mysqli_query($db, $query);

        if($resultado->num_rows) {

            //el usuario existe, comprobar password
            $usuario = mysqli_fetch_assoc($resultado);

            // Verificar si el password es correcto
            $auth = password_verify($password, $usuario['password']);  

            if($auth) {
                session_start();
                // Usuario autenticado
                // llenar el array de la session
                $_SESSION['usuario'] = $usuario['email'];
                $_SESSION['login'] = true;
                header('Location: /admin');
                
            } else {
                $errores[] = "El password es incorrecto";
            }
        } else {
            $errores[] = "El usuario no existe";
        }
       
    }

}


// Incluye el header
require 'includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>

    <?php endforeach ?>

    <form class="formulario" method="POST"> <!-- Si no incluyo un action envia los datos a este mismo archivo -->
        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">E-mail</label>
            <input type="email" placeholder="Ingresa tu e-mail" id="email" name="email" required>

            <label for="telefono">Password</label>
            <input type="password" placeholder="Ingresa tu Password" id="Password" name="password" required>

        </fieldset>

        <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
    </form>

</main>

<?php
incluirTemplate('footer');
?>