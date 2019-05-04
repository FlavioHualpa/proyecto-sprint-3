<!DOCTYPE html>
<html lang="en" dir="ltr">
  <?php
    include('head.php');
  ?>
  <body>
  <?php
    include('header_back.php');
  ?>
  <form class="login" action="index.php" method="post">
    <fieldset>
      <legend>Ingresar</legend>
      <p>
        <input id="email" type="email" name="email" value="" placeholder="user@email.com">
      </p>
      <p>
        <input id="pass" type="password" name="pass" value="" placeholder="Ingresar Contraseña">
      </p>
      <p>
        <input id="boton" type="submit" value="INGRESAR">
      </p>
    </fieldset>
  </form>
  <?php
    include('footer.php');
  ?>
  </body>
</html>
