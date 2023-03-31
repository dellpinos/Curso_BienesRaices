<fieldset>
    <legend>Informacion General</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre del empleado" value="<?php echo s($vendedor->nombre); ?>">

    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Apellido del empleado" value="<?php echo s($vendedor->apellido); ?>">

</fieldset>

<fieldset>
    <legend>Contacto</legend>
    <label for="telefono">Telefono:</label>
    <input type="tel" id="telefono" name="vendedor[telefono]" placeholder="Telefono" value="<?php echo s($vendedor->telefono); ?>">

    <label for="email">Email:</label>
    <input type="tel" id="email" name="vendedor[email]" placeholder="Email" value="<?php echo s($vendedor->email); ?>">
</fieldset>

<!-- Agregar email -->