<h1 class="nombre-pagina">Olvide Password</h1>
<p class="descripcion-pagina">Reestable tu Password escribiendo tu email a continuacion</p>

<form action="/olvide" class="formulario" method="POST">
    
<div class="campo">
    <label for="email">E-mail</label>
    <input 
       type="email"
       id= "email"
       name="email"
       placeholder="Tu E-mail"
    />
 </div>

 <input type="submit" class="boton" value="Enviar Instrucciones">
</form>

<div class="acciones">
        <a href="/">!ya tienes una cuenta! Inicia sesión </a>
        <a href="/crear-cuenta">¿Aun no tienes una cuenta? Crea Una </a>

</div>