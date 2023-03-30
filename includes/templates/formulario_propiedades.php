<fieldset>
            <legend>Informacion General</legend>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Titulo Propiedad" value="<?php echo s($propiedad->titulo); ?>"> <!-- php para no tener q escribir dos veces en caso de error -->

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio Propiedad" value="<?php echo s($propiedad->precio); ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]">

            <?php if($propiedad->imagen) :  ?>
                <img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-pequeña" >

                <?php endif; ?>

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="propiedad[descripcion]" placeholder="Escriba una descripcion"><?php echo s($propiedad->descripcion); ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Información de la Popiedad</legend>

            <label for="habitaciones">Habitaciones: </label>
            <input type="number" id="habitaciones" name="propiedad[habitaciones]" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->habitaciones); ?>">

            <label for="wc">Baños: </label>
            <input type="number" id="wc" name="propiedad[wc]" placeholder="Ej: 2" min="1" max="6" value="<?php echo s($propiedad->wc); ?>">

            <label for="estacionamiento">Estacionamiento: </label>
            <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="Ej: 2" min="1" max="4" value="<?php echo s($propiedad->estacionamiento); ?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>


            <label for="vendedor"></label>
            <select name="propiedad[vendedores_id]" id="vendedor">
                <option selected value=""> --Seleccione-- </option>
                <?php foreach ($vendedores as $row) : ?>
                    <option <?php echo $propiedad->vendedores_id === $row->id ? 'selected' : ''; ?> value="<?php echo s($row->id); ?>" > <?php echo s($row->nombre) . " " . s($row->apellido); ?> </option>
                <?php endforeach ?>

            </select>
        </fieldset>