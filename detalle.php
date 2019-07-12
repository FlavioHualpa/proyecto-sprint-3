<?php
require 'funciones.php';
require_once 'DataSourceSetUp.php';
require_once 'src/entities/BookSearch.php';

if (isset($_GET['bookid'])) {
   $libro = BookSearch::select($storage, $_GET['bookid']);
}
else {
   header('location: .');
   exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<?php
   $styles = [
      'css/styles.css',
      'css/header.css',
      'css/detalle.css',
      'css/footer.css',
   ];
   require 'head.php';
?>

<body>
  <div id="contenedor_detalle">
    <?php require 'header_full.php'; ?>
    <section class="detalle_libro">
      <!--
      <php $mostrados = 0; ?>
      <php foreach($novedades as $libro) : ?>
      -->
      <div class="ruta_libro">
        <h4>
        Libros/<?= $libro->getTitle() ?>
        </h4>
      </div>
      <div class="detalle_principal">
        <div class="detalle_imagen">
          <img src="<?= 'img/' . $libro->getCoverImgUrl() ?>" alt="<?= $libro->getTitle() ?>">
        </div>
        <div class="detalle_lateral">
          <h3>
            <?= $libro->getTitle() ?>
          </h3>
          <h6>
            Ranking: # <?= 1 ?>
          </h6>
          <h5>
            $ <?= $libro->getPrice() ?>
          </h5>
          <div class="detalle_cantidad">
            <h6>
              Cantidad:
            </h6>
            <input type="number" data-hook="number-input-spinner-input" value="1">
            <div class="quantity_hook" data-hook="number-input-arrow-container">
              <span class="q_up_arrow" data-hook="number-input-spinner-up-arrow"></span>
              <span class="q_down_arrow" data-hook="number-input-spinner-down-arrow"></span>
            </div>
            <p>
              EN STOCK
            </p>
          </div>
          <h6>
            <button class="compra" data-hook="add-to-cart" type="submit">Agregar al carrito</button>
          </h6>
          <div class="viñeta">
          </div>
          <h6>
            Reseñas del libro:
          </h6>
          <p>
            <?= $libro->getResena() ?>
          </p>
          <h6>
            <button class="costos_envio" data-hook="costos_envio" type="submit">Costos de envío y tiempos de entrega</button>
          </h6>
        </div>
      </div>
      <div class="datos_detallados">
        <h6>
          Detalles del libro:
        </h6>
        <ul>
          <li>
            <b>Autor:</b> <?= $libro->getAuthor() ?>
          </li>
          <li>
            <b>Editorial:</b> <?= $libro->getPublisher() ?>
          </li>
          <li>
            <b>I.S.B.N.:</b> <?= $libro->getISBN() ?>
          </li>
          <li>
            <b>Géneros:</b> <?= $libro->getGenre() ?>
          </li>
          <li>
            <b>Páginas:</b> <?= $libro->getTotalPages() ?>
          </li>
          <li>
            <b>Publicación:</b> <?= $libro->getYearPublished() ?>
          </li>
          <li>
            <b>Idioma:</b> <?= $libro->getLanguage() ?>
          </li>
        </ul>
      </div>
      <!--
      <php
        $mostrados++;
        if ($mostrados == 6) {
          break;
        }
        endforeach;
      ?>
      -->
    </section>
    <?php require 'footer.php'; ?>
    <script src="scripts/header.js">
    </script>
  </div>
</body>
</html>
