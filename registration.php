<?php
session_start();
include('funciones.php');

$paises = leer_json('datos/paises.json');
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
    if (!isset($_POST["nacimiento"]) || empty($_POST["nacimiento"])) {
      $errores["nacimiento"][] = "La fecha de nacimiento es requerida";
    } else
      if ((time()-strtotime($_POST["nacimiento"]))/(60*60*24*365.25)<18) {
      $errores["nacimiento"][] = "El usuario debe tener al menos 18 años de edad.";
      }
    if (!isset($_POST["sexo"]) || empty($_POST["sexo"])) {
        $errores["sexo"][] = "Debe seleccionar una opción.";
      }
    if (isset($_FILES['avatar']) && $_FILES['avatar']['name'] != '') {
      $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
      if ($_FILES["avatar"]["error"] != 0){
        $errores["avatar"][] = "El archivo no se subió correctamente.";
      } else
      if ($ext != "jpg" && $ext != "png" && $ext != "gif" && $ext != "bmp") {
        $errores["avatar"][] = "El archivo debe ser del tipo '.jpg', '.png', '.bmp' o '.gif'.";
      } else
      if ($_FILES['avatar']['size'] > 10*1024*1024) {
        $errores["avatar"][] = "El tamaño del archivo no debe ser mayor a 10MB.";
      }
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
        $nuevo_usuario = guardar_usuario();
        set_session_data($nuevo_usuario);

        header('location: index.php');
        exit();
      }

    }
  }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <?php
    include('head.php');
    // include('datos.php');
  ?>
  <body>
    <div id="contenedor">
      <?php
        include('header_back.php');
      ?>
      <div class="fondoLogYReg">
      <div id="panel-form">
        <form class="registration" action="registration.php" method="post" enctype="multipart/form-data">
          <p class="error-regist"><?= $errores["submit"][0] ?? "" ?></p>
          <fieldset>
            <legend>Creá tu cuenta </legend>
              <p>
                <label for="nombre">Nombre:</label>
                <input id="nombre" type="text" name="nombre" value="<?= $_POST['nombre'] ?? '' ?>">
                <p class="error-regist"><?= $errores["nombre"][0] ?? "" ?></p>
              </p>
              <p>
                <label for="apellido">Apellido:</label>
                <input id="apellido" type="text" name="apellido" value="<?= $_POST['apellido'] ?? '' ?>">
                <p class="error-regist"><?= $errores["apellido"][0] ?? "" ?></p>
              </p>
              <p>
                <label for="usuario">Usuario:</label>
                <input id="usuario" type="text" name="usuario" value="<?= $_POST['usuario'] ?? '' ?>">
                <p class="error-regist"><?= $errores["usuario"][0] ?? "" ?></p>
              </p>
              <p>
                <label for="email">Email:</label>
                <input id="email" type="text" name="email" value="<?= $_POST['email'] ?? '' ?>">
                <p class="error-regist"><?= $errores["email"][0] ?? "" ?></p>
              </p>
              <p>
                <label for="paisNacimiento">País de Nacimiento:</label>
                <select name="paisNacimiento" id="paisNacimiento">
                  <?php foreach ($paises as $codigo => $pais):?>
                    <option value="<?= $codigo ?>" <?= isset($_POST['paisNacimiento']) && $_POST['paisNacimiento'] == $codigo ? 'selected' : '' ?>><?= $pais ?></option>
                  <?php endforeach ?>
                </select>
              </p>
              <p>
                <label for="nacimiento">Fecha de Nacimiento:</label>
                <input id="nacimiento" type="date" name="nacimiento" value="<?= $_POST['nacimiento'] ?? '' ?>">
                <p class="error-regist"><?= $errores["nacimiento"][0] ?? '' ?></p>
              </p>
              <p>
                <label>Sexo:</label>
                <div class="sexo">
                  <div class="sexo_fem">
                    <input id="mujer" type="radio" name="sexo" value="f" <?= isset($_POST['sexo']) && $_POST['sexo'] == 'f' ? 'checked' : '' ?>>
                    <label for="mujer">Femenino</label>
                  </div>
                  <div class="sexo_masc">
                    <input id="hombre" type="radio" name="sexo" value="m" <?= isset($_POST['sexo']) && $_POST['sexo'] == 'm' ? 'checked' : '' ?>>
                    <label for="hombre">Masculino</label>
                  </div>
                </div>
                <p class="error-regist"><?= $errores["sexo"][0] ?? "" ?></p>
              </p>
              <p>
                <!-- <div class="avatar_button"> -->
                  <label for="avatar">Subir una foto</label>
                  <br>
                  <!-- <div class="avatar_button_2"> -->
                    <input id="avatar" type="file" name="avatar">
                  <!-- </div> -->
                  <p class="error-regist"><?= $errores["avatar"][0] ?? "" ?></p>
                <!-- </div> -->
              </p>
              <p>
                <label for="pass">Ingresar Contraseña:</label>
                <input id="pass" type="password" name="pass" value="">
              </p>
              <p class="error-regist"><?= $errores["pass"][0] ?? "" ?></p>
              <p>
                <label for="pass2">Reingresar Contraseña:</label>
                <input id="pass2" type="password" name="pass2" value="">
                <p class="error-regist"><?= $errores["pass2"][0] ?? "" ?></p>
              </p>
              <p>
                <div class="terminos">
                  <input id="terms" type="checkbox" name="terms">
                  <label for="terms">Acepta <a href="#" id="link_hipervinculo">términos y condiciones</a></label>
                </div>
                <p class="error-regist"><?= $errores["terms"][0] ?? "" ?></p>
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
