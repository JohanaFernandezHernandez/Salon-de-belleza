<div class="barra">
    <p>Hola: <?php echo $nombre ?? ''; ?></p>
    <a class="boton" href="/logout">Cerrar Sesión</a>
</div>

<?php 
  if(isset($_SESSION['admin'])){ ?>
  <div class="barra-servicios">
    <a class="boton" href="/admin">Ver Cita</a>
    <a class="boton" href="/servicios">Ver servicios</a>
    <a class="boton" href="/servicios/crear">Nuevo Servicio</a>
  </div>

<?php  } ?>

