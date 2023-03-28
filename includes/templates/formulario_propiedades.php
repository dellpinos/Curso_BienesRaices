<fieldset>
            <legend>Informacion General</legend>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo s($propiedad->titulo); ?>"> <!-- php para no tener q escribir dos veces en caso de error -->

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo s($propiedad->precio); ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

            <?php if($propiedad->imagen) :  ?>
                <img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-pequeña" >

                <?php endif; ?>

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" placeholder="Escriba una descripcion"><?php echo s($propiedad->descripcion); ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Información de la Popiedad</legend>

            <label for="habitaciones">Habitaciones: </label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->habitaciones); ?>">

            <label for="wc">Baños: </label>
            <input type="number" id="wc" name="wc" placeholder="Ej: 2" min="1" max="6" value="<?php echo s($propiedad->wc); ?>">

            <label for="estacionamiento">Estacionamiento: </label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 2" min="1" max="4" value="<?php echo s($propiedad->estacionamiento); ?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>
            <!-- <select name="vendedores_id">
                <option value="">-- Seleccione --</option>
                <?php while ($row = mysqli_fetch_assoc($resultado)) : ?> --><!-- cargo un array con la consulta a la DB, dentro de while para que lo haga una vez por registro 
                    <option <?php echo $vendedores_id === $row['id'] ? 'selected' : ''; ?> value="<?php echo s($propiedad->row['id']); ?>"> <?php echo $row['nombre'] . " " . $row['apellido']; ?></option>

                <?php endwhile ?>

            </select> -->
        </fieldset>