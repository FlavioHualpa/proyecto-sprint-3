<?php session_start(); ?>

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
            <?php if ($_SESSION['genero'] == "f") : ?>
              <span>Bienvenida,</span>
              <br>
              <span><?= $_SESSION['nombre'] ?></span>
            <?php else : ?>
              <span>Bienvenido,</span>
              <br>
              <span><?= $_SESSION['nombre'] ?></span>
            <?php endif; ?>
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
