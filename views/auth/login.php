<h1 class="nombre-pagina">Login </h1>
<p class="descripcion-pagina">Inicia sesión con tus datos</p>

<?php include_once __DIR__ . "/../templates/alertas.php"  ?>

    <form  class="formulario" method="POST" action="/">
        <div class="campo">
            <label for="email">Email</label>
            <input 
               type="email"
               id="email"
               placeholder="Tu email"
               name="email"
            />
        </div>

        <div class="campo">
            <label for="password">Password</label>
            <input 
            type="password"
            id="password"
            placeholder="Tu Password"
            name="password"
            />
        </div>

        <input type="submit" class="boton" value="Inisiar Sesión">

    </form>

    <div class="acciones">
        <a href="/crear-cuenta">¿Si aun no tienes cuenta? crea una aqui </a>
        <a href="/olvide">¿Olvidaste tu Password?</a>
    </div>
