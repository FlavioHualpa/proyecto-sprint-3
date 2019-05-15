<?php

require "datos.php";
require "funciones.php";

session_start();

$match = null;

if (isset($_REQUEST["email"]) && isset($_REQUEST["pass"])){

  foreach ($usuarios_registrados as $usuario) {

    if (($usuario["email"] == $_REQUEST["email"]) && ($usuario["pass"] == $_REQUEST["pass"])) {

      $match = $usuario;

      break;
    }
    
  }

  if (!$match) {
    
    $errors[]="El usuario y/o contraseña son incorrectos.";

  } else {

    $_SESSION["email"] = $usuario['email'];

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

      <div id="panel-form">
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
            </p>
            <div class="botones">
              <p>
                <input id="boton" type="submit" value="INGRESAR">
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
