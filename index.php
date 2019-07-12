<?php

require 'funciones.php';
require_once 'DataSourceSetUp.php';

?>

<!DOCTYPE html>
<html lang="es">
<?php
   $styles = [
      'css/styles.css',
      'css/header.css',
      'css/article.css',
      'css/footer.css',
   ];
   require 'head.php';
?>

<body>
  <div id="contenedor">
    <?php require 'header_full.php'; ?>
    <div class="banner">
    </div>
    <section class="tituloSection">
      <div class="separador">
      </div>
      <div class="viñeta">
      </div>
      <h3>
        Novedades
      </h3>
      <div class="viñeta">
      </div>
    </section>
    <div class="prodsSectionPrincipal">
    <section class="prodsSection">
      <?php $mostrados = 0; ?>
      <?php foreach($novedades as $libro) : ?>
      <article>
        <div class="fondo-con-sombra">
          <div class="tapaYTitulo">
            <div class="tapa">
              <img src="<?= 'img/' . $libro['imagenTapa'] ?>" alt="<?= $libro['titulo'] ?>">
            </div>
            <h4><?= $libro['titulo'] ?></h4>
          </div>
          <div class="ver-mas">
            <a href="detalle.php?bookid=<?= $libro['id'] ?>">
               <i class="fas fa-eye"></i>
               <span>
                  VER DETALLES
               </span>
            </a>
          </div>
        </div>
        <div class="pie-de-articulo">
          <span><?= '$ ' . $libro['precio'] ?></span>
          <a href="#">agregar al <i class="fas fa-shopping-cart"></i></a>
        </div>
      </article>
      <?php
        $mostrados++;
        if ($mostrados == 6) {
          break;
        }
        endforeach;
      ?>
    </section>
    </div>

    <section class="tituloSection">
      <div class="separador">
      </div>
      <div class="viñeta">
      </div>
      <h3>
        Los más vendidos
      </h3>
      <div class="viñeta">
      </div>
    </section>
    <div class="prodsSectionPrincipal">
    <section class="prodsSection">
      <?php $mostrados = 0; ?>
      <?php foreach($mas_vendidos_por_ranking as $libro) : ?>
      <article>
        <div class="fondo-con-sombra">
          <img src="<?= 'img/' . $libro['imagenTapa'] ?>" alt="<?= $libro['titulo'] ?>">
          <h4><?= $libro['titulo'] ?></h4>
          <div class="ver-mas">
             <a href="detalle.php?bookid=<?= $libro['id'] ?>">
                <i class="fas fa-eye"></i>
                <span>
                   VER DETALLES
                </span>
             </a>
          </div>
        </div>
        <div class="pie-de-articulo">
          <span><?= '$ ' . $libro['precio'] ?></span>
          <a href="#">agregar al <i class="fas fa-shopping-cart"></i></a>
        </div>
      </article>
      <?php
        $mostrados++;
        if ($mostrados == 6) {
          break;
        }
        endforeach;
      ?>
    </section>
    </div>

    <?php require 'footer.php'; ?>
  </div>
  <script src="scripts/header.js">
  </script>
</body>
</html>
