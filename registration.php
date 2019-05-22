<?php
include('funciones.php');

$errores = [];

  if ($_POST) {
    if (!isset($_POST["nombre"]) || empty($_POST["nombre"])) {
      $errores["nombre"][] = "El nombre es requerido";
    } else
    if (strpbrk($_POST["nombre"], "0123456789")) {
      $errores["nombre"][] = "El nombre no debe contener números";
    }
    if (!isset($_POST["apellido"]) || empty($_POST["apellido"])) {
      $errores["apellido"][] = "El apellido es requerido";
    } else
    if (strpbrk($_POST["apellido"], "0123456789")) {
      $errores["apellido"][] = "El apellido no debe contener números";
    } 
    if (!isset($_POST["usuario"]) || empty($_POST["usuario"])) {
      $errores["usuario"][] = "El usuario es requerido";
    } else
    if (strlen($_POST["usuario"]) < 6 || strlen($_POST["usuario"]) > 12) {
      $errores["usuario"][] = "El usuario debe contener entre 6 y 12 caracteres";
    }
    if (!isset($_POST["email"]) || empty($_POST["email"])) {
      $errores["email"][] = "El email es requerido";
    } else 
      if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) == false) {
      $errores["email"][] = "El email ingresado no es válido";
      }
    if (!isset($_POST["pass"]) || empty($_POST["pass"])) {
        $errores["pass"][] = "La contraseña es requerida";
      } else
      if (strlen($_POST["pass"]) < 6 || strlen($_POST["pass"]) > 12) {
        $errores["pass"][] = "La contraseña debe contener entre 6 y 12 caracteres";
      }
    if (!isset($_POST["pass2"]) || empty($_POST["pass2"])) {
        $errores["pass2"][] = "Debe reingresar la contraseña";
      } else
      if ($_POST["pass2"] != $_POST["pass"]) {
        $errores["pass2"][] = "Las contraseñas no coinciden";
      }
    if (!isset($_POST["terms"])) {
        $errores["terms"][] = "Debe aceptar los términos y condiciones";
      }
    if(empty($errores)) {
      if (existe_usuario($_POST['email'], $_POST['usuario'])) {
        $errores["submit"][] = "El usuario/email ya existe.";
      } else {
        $usuario = crear_usuario($_POST);
        guardar_json("datos/usuarios.json", $usuario);
      }

    }
  }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <?php
    include('head.php');
    include('datos.php');
  ?>
  <body>
    <div id="contenedor">
      <?php
        include('header_back.php');
      ?>
      <div class="fondoLogYReg">
      <div id="panel-form">
        <form class="registration" action="registration.php" method="post" enctype="multipart/form-data  ">
          <fieldset>
          <?= $errores["submit"][0] ?? "" ?>
            <legend>Crea tu cuenta</legend>
              <p>
                <label for="nombre">Nombre:</label>
                <input id="nombre" type="text" name="nombre" value="<?= $_POST['nombre'] ?? "" ?>">
                <?= $errores["nombre"][0] ?? "" ?>
              </p>
              <p>
                <label for="apellido">Apellido:</label>
                <input id="apellido" type="text" name="apellido" value="">
                <?= $errores["apellido"][0] ?? "" ?>
              </p>
              <p>
                <label for="usuario">Usuario:</label>
                <input id="usuario" type="text" name="usuario" value="">
                <?= $errores["usuario"][0] ?? "" ?>
              </p>
              <p>
                <label for="email">Email:</label>
                <input id="email" type="text" name="email" value="">
                <?= $errores["email"][0] ?? "" ?>
              </p>
              <p>
                <label for="paisNacimiento">País de Nacimiento:</label>
                <select name="paisNacimiento" id="paisNacimiento">
                  <?php foreach ($paises as $codigo => $pais):?>
                  <option value="<?= $codigo ?>"><?= $pais ?></option> 
                  <?php endforeach ?>
                </select>
              </p>
              <p>
                <label for="nacimiento">Fecha de Nacimiento:</label>
                <input id="nacimiento" type="date" name="nacimiento" value="">
              </p>
              <p>
                <label>Sexo:</label>
                <input id="mujer" type="radio" name="sexo" value="f">
                <label for="mujer">Femenino</label>
                <input id="hombre" type="radio" name="sexo" value="m">
                <label for="hombre">Masculino</label>
              </p>
              <p>
                <label for="avatar">Sube una foto:</label>
                <input id="avatar" type="file" name="avatar" value="">
              </p>
              <p>
                <label for="pass">Ingresar Contraseña:</label>
                <input id="pass" type="password" name="pass" value="">
              </p>
              <?= $errores["pass"][0] ?? "" ?>
              <p>
                <label for="pass2">Reingresar Contraseña:</label>
                <input id="pass2" type="password" name="pass2" value="">
                <?= $errores["pass2"][0] ?? "" ?>
              </p>
              <p>
                <input id="terms" type="checkbox" name="terms">
                <label for="terms">Acepta <a href="#">términos y condiciones</a></label>
                <?= $errores["terms"][0] ?? "" ?>
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
      </div>

      <?php
        include('footer.php');
      ?>
    </div>
  </body>
</html>
