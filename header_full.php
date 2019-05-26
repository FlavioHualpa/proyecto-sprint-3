<?php

  session_start();

  if (isset($_COOKIE['id'])) {
    $usuario = usuario_por_id($_COOKIE['id']);
    if ($usuario) {
      $_SESSION['id'] = $usuario['id'];
      $_SESSION['genero'] = $usuario['sexo'];
      $_SESSION['nombre'] = $usuario['nombre'];
    }
  }

  if (isset($_SESSION['genero'])) {
    if ($_SESSION['genero'] == 'f') {
      $saludo = 'Bienvenida,';
    } else {
      $saludo = 'Bienvenido,';
    }
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
            <span><?= $saludo ?></span>
            <br>
            <span><?= $_SESSION['nombre'] ?></span>
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
