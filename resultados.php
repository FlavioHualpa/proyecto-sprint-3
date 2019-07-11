<?php

   require_once 'DataSourceSetUp.php';
   require_once 'src/entities/BookSearch.php';

   if (isset($_GET['keywords'])) {
      $keywords = $_GET['keywords'];
      $books = BookSearch::find($storage, $keywords);
   }
   else {
      $books = [];
   }

?>

<!DOCTYPE html>
<html lang="es">
<?php
   $styles = [
      'css/styles.css',
      'css/header.css',
      'css/resultados.css',
      'css/footer.css',
   ];
   require 'head.php';
?>

<body>
   <div id="contenedor">
      <?php require 'header_full.php'; ?>
      <section id="resultados">
         <h3>Resultados para '<?= $keywords ?>'</h3>

         <?php if (empty($books)) : ?>
            <div class="sin-resultados">
               <div>
                  <img src="img/no-results-1.png" alt="no se encontraron resultados">
                  <span>No hay resultados</span>
               </div>
               <p>
                  Intente repetir la búsqueda con otras palabras
                  <br>
                  O si prefiere puede regresar <a href=".">a la página principal</a>
               </p>
            </div>
         <?php else : ?>
         <?php foreach ($books as $book) : ?>
            <article class="item-resultado">
               <div>
                  <a href="detalles.php?bookid=<?= $book->getId() ?>">
                     <img src="img/mr_luciernagas.png" alt="">
                  </a>
                  <br>
                  <span>$ <?= number_format($book->getPrice(), 2) ?></span>
               </div>
               <p class="desc-1"><?= $book->getTitle() ?></p>
               <p class="desc-2"><?= $book->getAuthor() ?></p>
               <p class="desc-3"><?= $book->getPublisher() ?></p>
               <p class="desc-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
               <span>
                  <a href="#">
                     agregar al <i class="fas fa-shopping-cart"></i>
                  </a>
               </span>
               <br>
               <a href="#">
                  <i class="fas fa-bookmark"></i>
                  Agregar a mis libros
               </a>
            </article>
         <?php endforeach ?>
         <?php endif ?>
      </section>
   </div>
   <script src="scripts/header.js">
   </script>
</body>
</html>
