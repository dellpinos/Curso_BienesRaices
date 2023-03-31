<?php
// Inicio sesion

require '../includes/app.php';
usuarioAutenticado();

use App\Propiedad;
use App\Vendedor;

// Implementar un metodo para obtener todas las Casas utilizando Active Record
$propiedades = Propiedad::all();
$vendedores = Vendedor::all();


// Muestra mensaje condicional
$resultado = $_GET['resultado'] ?? null; // cargo datos de la URL

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['eliminarId'];
    $id = filter_var($id, FILTER_VALIDATE_INT); // valida que no sea manipulado

    if ($id) {
        $tipo = $_POST['tipo'];
        if (validarTipoContenido($tipo)) {
            // Compara lo que vamos a eliminar
            if ($tipo === 'vendedor') {
                $vendedor = Vendedor::find($id);
                $vendedor->eliminar();
            } elseif ($tipo === 'propiedad') {
                $propiedad = Propiedad::find($id);
                $propiedad->eliminar();
            }
        }
    }
}

//Incluye template

incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Menú Administrador</h1>

    <?php if (intval($resultado) === 1) : ?> <!-- Evaluo si poner cartel de propiedad creada -->
        <p class="alerta exito">Creado correctamente</p>
    <?php elseif (intval($resultado) === 2) : ?>
        <p class="alerta exito">Actualizado correctamente</p>
    <?php elseif (intval($resultado) === 3) : ?>
        <p class="alerta exito">Eliminado correctamente</p>
    <?php endif ?>


    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva propiedad</a>
    <a href="/admin/vendedores/crear.php" class="boton boton-amarillo">Nuevo vendedor</a>

    <h2>Propiedades</h2>


    <table class="propiedades">
        <thead>
            <tr> <!-- cabecera de la lista/ columnas de la DB -->
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <!-- Mostrar resultados de la DB -->

        <tbody>
            <?php foreach ($propiedades as $propiedad) :  ?>
                <tr>

                    <th><?php echo $propiedad->id; ?></th> <!-- Proceso e imprimo -->
                    <th><?php echo $propiedad->titulo; ?></th>
                    <th> <img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla"> </th>
                    <th>$ <?php echo $propiedad->precio; ?></th>
                    <th>
                        <form method="POST" class="w-100">

                            <input type="hidden" name="eliminarId" value="<?php echo $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">

                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad->id ?>" class="boton-amarillo-block">Actualizar</a>
                    </th>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Vendedores</h2>

    <table class="propiedades">
        <thead>
            <tr> <!-- cabecera de la lista/ columnas de la DB -->
                <th>ID</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <!-- Mostrar resultados de la DB -->

        <tbody>
            <?php foreach ($vendedores as $vendedor) :  ?>
                <tr>

                    <th><?php echo $vendedor->id; ?></th> <!-- Proceso e imprimo -->
                    <th><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></th>
                    <th><?php echo $vendedor->telefono; ?></th>
                    <th><?php echo $vendedor->email; ?></th>
                    <th>
                        <form method="POST" class="w-100">

                            <input type="hidden" name="eliminarId" value="<?php echo $vendedor->id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">

                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/admin/vendedores/actualizar.php?id=<?php echo $vendedor->id ?>" class="boton-amarillo-block">Actualizar</a>
                    </th>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</main>


<?php incluirTemplate('footer'); ?>