<?php

require 'funciones.php';
session_start();
$match = null;

if (isset($_REQUEST["email"]) && isset($_REQUEST["pass"])){

  $match = verificar_login($_REQUEST['email'], $_REQUEST['pass']);

  if (!$match) {

    $errors[]="El usuario y/o contraseña son incorrectos.";

  } else {

    $_SESSION["id"] = $usuario['id'];
    $_SESSION["nombre"] = $usuario['nombre'];
    $_SESSION["genero"] = $usuario['genero'];

    header("location: index.php");

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
        <p><?= $errors[0] ?? '' ?></p>
        <form class="login" action="login.php" method="post">
          <fieldset>
            <legend>Ingresá tus datos</legend>
            <p>
              <label for="email">Usuario</label>
              <input id="email" type="email" name="email" value="" placeholder="user@email.com">
            </p>
            <p>
              <label for="pass">Contraseña</label>
              <input id="pass" type="password" name="pass" value="" placeholder="Ingresar Contraseña">
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
