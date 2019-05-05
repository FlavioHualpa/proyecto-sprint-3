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
        <form class="login" action="index.php" method="post">
          <fieldset>
            <legend>Ingresá tus datos</legend>
            <p>
              <label for="email">Usuario</label>
              <input id="email" type="email" name="email" value="" placeholder="user@email.com">
            </p>
            <p>
              <label for="pass">Contraseña</label>
              <input id="pass" type="password" name="pass" value="" placeholder="Ingresar Contraseña">
            </p>
            <p>
              <input id="boton" type="submit" value="INGRESAR">
            </p>
          </fieldset>
        </form>
      </div>

      <?php
        include('footer.php');
      ?>
    </div>
  </body>
</html>
