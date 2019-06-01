<?php

  session_start();

  if (isset($_COOKIE['id'])) {
    $usuario = usuario_por_id($_COOKIE['id']);
    if ($usuario) {
      set_session_data($usuario);
    }
  }

  if (isset($_SESSION['id'])) {

    if (isset($_SESSION['genero'])) {
      if ($_SESSION['genero'] == 'f') {
        $saludo = 'Bienvenida,';
      } else {
        $saludo = 'Bienvenido,';
      }
    }

    if (isset($_SESSION['avatar']) && !empty($_SESSION['avatar'])) {
      $avatar_url = 'uploads/' . $_SESSION['avatar'];
    } else {
      if ($_SESSION['genero'] == 'f') {
        $avatar_url = 'uploads/generic_female_avatar.png';
      } else {
        $avatar_url = 'uploads/generic_male_avatar.png';
      }
    }

    $avatar_style = "width: 40px; height: 40px; background-image: url('" . $avatar_url . "'); background-size: 38px; background-repeat: no-repeat; background-position: center; border: 1px solid #b09090; border-radius: 50%; margin-right: 6px; margin-top: 2px;";
  }

?>

<header id="encabezado">
  <h1>¿Qué Leo?</h1>
  <nav>
    <ul>
      <li>
        <div>
          <i class="fas fa-home"></i>
          <a href="index.php">Inicio</a>
        </div>
      </li>
      <li>
        <div>
          <?php if (isset($_SESSION['id'])) : ?>
            <div style="display: inline-block;">
              <div style="<?= $avatar_style ?>">
              </div>
            </div>
            <div style="display: inline-block; vertical-align: top;">
              <span><?= $saludo ?></span>
              <br>
              <span><?= $_SESSION['nombre'] ?></span>
            </div>
          <?php else : ?>
            <i class="fas fa-sign-in-alt"></i>
            <a href="login.php">Ingresar</a>
          <?php endif; ?>
        </div>
      </li>
      <li>
        <div>
          <?php if (isset($_SESSION['id'])) : ?>
            <i class="fas fa-sign-out-alt"></i>
            <a href="cerrar.php">Cerrar Sesión</a>
          <?php else : ?>
            <i class="fas fa-user-plus"></i>
            <a href="registration.php">Crear una cuenta</a>
          <?php endif; ?>
        </div>
      </li>
    </ul>
  </nav>
</header>
