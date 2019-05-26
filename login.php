<?php

session_start();
require 'funciones.php';
$match = null;
$errores = [];

if ($_POST) {
  $errores = validar_login();

  //if (isset($_REQUEST["email"]) && isset($_REQUEST["pass"])){
  //var_dump($errores);
  if (empty($errores)) {

    $match = verificar_login($_REQUEST['email'], $_REQUEST['pass']);

    if (!$match) {

      $errores['login'] = 'El usuario y/o contraseña son incorrectos.';

    } else {

      $_SESSION["id"] = $match['id'];
      $_SESSION["nombre"] = $match['nombre'];
      $_SESSION["genero"] = $match['sexo'];

      if (isset($_POST['recordar'])) {
        setcookie('id', $match['id'], time() + 60*60*24*7);
      }

      header("location: index.php");

    }
  }
}

?>

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
      <div class="fondoLogYReg">
      <div id="panel-form">
        <p class="texto-registration">¿No estás registrado? Ingresá tus datos en <a href="registration.php">esta página</a></p>
        <p class="error-usuario"><?= $errores['login'] ?? '' ?></p>
        <form class="login" action="login.php" method="post">
          <fieldset>
            <legend>Ingresá tus datos</legend>
            <p>
              <label for="email">Usuario</label>
              <input id="email" type="text" name="email" value="<?= $_POST['email'] ?? '' ?>" placeholder="user@email.com">
              <p class="error-login"><?= $errores['email'] ?? '' ?></p>
            </p>
            <p>
              <label for="pass">Contraseña</label>
              <input id="pass" type="password" name="pass" value="<?= $_POST['pass'] ?? '' ?>" placeholder="Ingresar Contraseña">
              <p class="error-login"><?= $errores['pass'] ?? '' ?></p>
            </p>
            <p>
              <input type="checkbox" name="recordar" value="si" id="recordar">
              <label for="recordar">Recordame</label>
            </p>
            <div class="botones">
              <p>
                <input id="boton" type="submit" value="INGRESAR">
              </p>
            </div>
          </fieldset>
        </form>
      </div>
      </div>

      <?php
        include('footer.php');
      ?>
    </div>
  </body>
</html>
