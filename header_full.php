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
          <?php if ($sesion_iniciada) : ?>
            <?php if ($genero_usuario == "f") : ?>
              <span>Bienvenida,</span>
              <br>
              <span><?= $nombre_usuario ?></span>
            <?php else : ?>
              <span>Bienvenido,</span>
              <br>
              <span><?= $nombre_usuario ?></span>
            <?php endif; ?>
          <?php else : ?>
            <i class="fas fa-sign-in-alt"></i>
            <a href="login.php">Ingresar</a>
          <?php endif; ?>
        </div>
      </li>
      <li>
        <div>
          <?php if ($sesion_iniciada) : ?>
            <i class="fas fa-sign-out-alt"></i>
            <a href="index.php">Cerrar Sesión</a>
          <?php else : ?>
            <i class="fas fa-user-plus"></i>
            <a href="registration.php">Crear una cuenta</a>
          <?php endif; ?>
        </div>
      </li>
    </ul>
  </nav>
</header>
