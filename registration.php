<!DOCTYPE html>
<html lang="en" dir="ltr">
  <?php
    include('head.php');
  ?>
  <body>
    <div id="contenedor">
      <?php
        include('header_back.php');
      ?>
      <div id="panel-form">
        <form class="registration" action="index.php" method="post">
          <fieldset>
            <legend>Crea tu cuenta</legend>
              <p>
                <label for="nombre">Nombre:</label>
                <input id="nombre" type="text" name="nombre" value="">
              </p>
              <p>
                <label for="apellido">Apellido:</label>
                <input id="apellido" type="text" name="apellido" value="">
              </p>
              <p>
                <label for="nacimiento">Fecha de Nacimiento:</label>
                <input id="nacimiento" type="date" name="nacimiento" value="">
              </p>
              <p>
                <label for="email">Email:</label>
                <input id="email" type="email" name="email" value="">
              </p>
              <p>
                <label for="pass">Ingresar Contraseña:</label>
                <input id="pass" type="password" name="pass" value="">
              </p>
              <p>
                <label for="pass">Reingresar Contraseña:</label>
                <input id="pass" type="password" name="pass" value="">
              </p>
              <div class="botones">
                <p>
                  <input id="boton" type="submit" value="CREAR CUENTA">
                </p>
                <p>
                  <input id="boton" type="reset" value="REINICIAR FORMULARIO">
                </p>
              </div>
            </fieldset>
          </form>
        </div>
      <?php
        include('footer.php');
      ?>
    </div>
  </body>
</html>
