<?php

session_start();
require 'funciones.php';
$match = null;
$errores = [];

if ($_POST) {
  $errores = validar_login();
  var_dump($errores);

  //if (isset($_REQUEST["email"]) && isset($_REQUEST["pass"])){
  //var_dump($errores);
  if (empty($errores)) {

    $match = verificar_login($_REQUEST['email'], $_REQUEST['pass']);

    if (!$match) {

      $errores['login'] = 'El usuario y/o contraseña son incorrectos.';

    } else {

      set_session_data($match);

      if (isset($_POST['recordar'])) {
        setcookie('usuario', $match['email'], time() + 60*60*24*7);
      } else {
        setcookie('usuario', '', -1);
      }
      header("location: index.php");
      exit;
    }
  }
} else {
  if (isset($_COOKIE['usuario'])) {
    $_POST['email'] = $_COOKIE['usuario'];
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
        <p class="texto-registration">¿No estás registrado? Ingresá tus datos en este <a href="registration.php" id="link_hipervinculo">link</a></p>
        <p class="error-usuario"><?= $errores['login'] ?? '' ?></p>
        <form class="login" action="login.php" method="post">
          <fieldset>
            <legend>Ingresá tus datos</legend>
            <p>
              <label for="email">Email</label>
              <input id="email" type="text" name="email" value="<?= $_POST['email'] ?? '' ?>" placeholder="user@email.com">
              <p class="error-login"><?= $errores['email'] ?? '' ?></p>
            </p>
            <p>
              <label for="pass">Contraseña</label>
              <input id="pass" type="password" name="pass" value="<?= $_POST['pass'] ?? '' ?>" placeholder="Ingresar Contraseña">
              <p class="error-login"><?= $errores['pass'] ?? '' ?></p>
            </p>
            <p>
              <input type="checkbox" name="recordar" value="si" id="recordar" <?= isset($_COOKIE['usuario']) ? 'checked' : '' ?>
              >
              <label for="recordar">Recordarme</label>
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
