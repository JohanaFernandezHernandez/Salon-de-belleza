<h1 class="nombre-pagina">Nuevo Servicio</h1>
<p class="descripcion-pagina">llena toda la informacion en el formulario</p>

<?php 
include_once __DIR__ . '/../templates/barra.php';

?>

<div class="barra-servicios">
    <a class="boton" href="/admin">Ver Cita</a>
    <a class="boton" href="/servicios">Ver servicios</a>
    <a class="boton" href="/servicios/crear">Nuevo Servicio</a>
</div>

<?php 
include_once __DIR__ . '/../templates/alertas.php';

?>

<form action="/servicios/crear" method="POST" class="formulario">

<?php include_once __DIR__ . '/formulario.php' ?>

<input type="submit" class="boton" value="Guardar Servicio">
</form>