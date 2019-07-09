<?php require 'funciones.php'; ?>

<!DOCTYPE html>
<html lang="es">
<?php require 'head.php'; ?>

<body>
  <div id="contenedor_detalle">
    <?php require 'header_full.php'; ?>
    <section class="detalle_libro">
      <?php $mostrados = 0; ?>
      <?php foreach($novedades as $libro) : ?>
      <div class="ruta_libro">
        <h4>
        Libros/<?= $libro['titulo'] ?>
        </h4>
      </div>
      <div class="detalle_principal">
        <div class="detalle_imagen">
          <img src="<?= 'img/' . $libro['imagenTapa'] ?>" alt="<?= $libro['titulo'] ?>">
        </div>
        <div class="detalle_lateral">
          <h3>
            <?= $libro['titulo'] ?>
          </h3>
          <h6>
            Ranking: # <?= $libro['ranking'] ?>
          </h6>
          <h5>
            $ <?= $libro['precio'] ?>
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
            <?= $libro['reseña'] ?>
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
            <b>Autor:</b> <?= $libro['autor'] ?>
          </li>
          <li>
            <b>Editorial:</b> <?= $libro['editorial'] ?>
          </li>
          <li>
            <b>I.S.B.N.:</b> <?= $libro['isbn'] ?>
          </li>
          <li>
            <b>Géneros:</b> <?= $libro['generos'] ?>
          </li>
          <li>
            <b>Páginas:</b> <?= $libro['paginas'] ?>
          </li>
          <li>
            <b>Publicación:</b> <?= $libro['año_publicacion'] ?>
          </li>
          <li>
            <b>Idioma:</b> <?= $libro['idioma'] ?>
          </li>
        </ul>
      </div>
      <?php
        $mostrados++;
        if ($mostrados == 6) {
          break;
        }
        endforeach;
      ?>
    </section>
    <?php require 'footer.php'; ?>
  </div>
</body>
</html>
