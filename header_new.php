<?php

   $avatar_url = 'uploads/generic_male_avatar.png';

?>

<!DOCTYPE html>
<html lang="es">
<?php require 'head.php'; ?>

<body>
   <div id="contenedor">
      <header id="navegador">
         <div id="boton-generos">
            <span>
               <i class="fas fa-list"></i>
               géneros
            </span>
            <i class="fas fa-arrow-down"></i>
         </div>
         <div id="buscador">
            <form action="resultados.php" method="post">
               <input type="text" name="keywords" placeholder="busque por título, autor o editorial">
               <button type="submit"><i class="fas fa-search"></i></button>
            </form>
         </div>
         <?php if (!isset($_SESSION['id'])) : ?>
            <div>
               <div id="user-options">
                  <div class="avatar" style="background-image: url('<?= $avatar_url ?>')">
                  </div>
                  <span>
                     <?= $_SESSION['nombre'] ?? 'usuario' ?>
                  </span>
               </div>
               <div id="cart">
                  <i class="fas fa-shopping-cart"></i>
                  <!--
                       en próximas versiones aquí vamos a consultar
                       el carrito del usuario en la base de datos
                       y traer la cantidad de productos guardados
                       en el carrito de compras
                  -->
                  <span>0</span>
               </div>
            </div>
         <?php else : ?>
            <div id="user">
               <a href="login.php" class="user-login">
                  <i class="fas fa-sign-in-alt"></i>
                  ingresar
               </a>
               <a href="login.php" class="user-register">
                  <i class="fas fa-user-plus"></i>
                  crear cuenta
               </a>
            </div>
         <?php endif ?>

         <!--
            El listado de géneros se va a traer
            de la base de datos luego
         -->
         <ul id="menu-generos">
            <li>
               <a href="porgenero.php?genderid=1">
                  <i class="fas fa-list"></i>
                  arte y diseño
               </a>
            </li>
            <li>
               <a href="porgenero.php?genderid=1">
                  <i class="fas fa-list"></i>
                  autoayuda
               </a>
            </li>
            <li>
               <a href="porgenero.php?genderid=1">
                  <i class="fas fa-list"></i>
                  ciencias
               </a>
            </li>
            <li>
               <a href="porgenero.php?genderid=1">
                  <i class="fas fa-list"></i>
                  computación
               </a>
            </li>
            <li>
               <a href="porgenero.php?genderid=1">
                  <i class="fas fa-list"></i>
                  ficción y literatura
               </a>
            </li>
            <li>
               <a href="porgenero.php?genderid=1">
                  <i class="fas fa-list"></i>
                  gastronomía
               </a>
            </li>
            <li>
               <a href="porgenero.php?genderid=1">
                  <i class="fas fa-list"></i>
                  infantil y juvenil
               </a>
            </li>
            <li>
               <a href="porgenero.php?genderid=1">
                  <i class="fas fa-list"></i>
                  turismo
               </a>
            </li>
         </ul>

         <ul id="menu-usuario">
            <li>
               <a href="editarPerfil.php?userid=1">
                  <i class="fas fa-edit"></i>
                  edite su perfil
               </a>
            </li>
            <li>
               <a href="misLibros.php?userid=1">
                  <i class="fas fa-bookmark"></i>
                  mis libros
               </a>
            </li>
            <li>
               <a href="cerrar.php?userid=1">
                  <i class="fas fa-sign-out-alt"></i>
                  cerrar sesión
               </a>
            </li>
         </ul>
      </header>
      <header id="encabezado">
         <h1>¿Qué Leo?</h1>
      </header>
   </div>

   <script src="scripts/header.js">
   </script>
</body>
