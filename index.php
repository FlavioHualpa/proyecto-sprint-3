<?php include('datos.php'); ?>
<?php include('funciones.php'); ?>

<!DOCTYPE html>
<html lang="es">
<?php include('head.php'); ?>

<body>
  <div id="contenedor">
    <?php include('header_full.php'); ?>
    <div class="banner">
    </div>
    <section class="tituloSection">
      <div class="separador">
      </div>
      <div class="viñeta">
      </div>
      <h3>
        NOVEDADES
      </h3>
      <div class="viñeta">
      </div>

      <div class="prodsSection">

        <?php foreach($novedades as $novedad) : ?>
        <article>
          <div class="fondo-con-sombra">
            <img src="<?= 'img/' . $novedad['imagenTapa'] ?>" alt="<?= $novedad['titulo'] ?>">
            <h4><?= $novedad['titulo'] ?></h4>
          </div>
          <div>
            <span><?= '$ ' . $novedad['precio'] ?></span>
            <a href="#">comprar</a>
          </div>
        </article>
        <?php endforeach ?>

      </div>
    </section>

        <!--
        <article class="libro2">
          <img src="img/gr_lavoz.png" alt="FOTO NO DISPONIBLE">
        </article>
        <article class="libro3">
          <img src="img/cfk_sinceramente.png" alt="FOTO NO DISPONIBLE">
        </article>
      </div>
    </section>
    -->

    <section class="tituloSection">
      <div class="separador">
      </div>
      <div class="viñeta">
      </div>
      <h3>
        LOS MÁS VENDIDOS
      </h3>
      <div class="viñeta">
      </div>

      <div class="prodsSection">

        <?php foreach($mas_vendidos_por_ranking as $libro) : ?>
        <article>
          <div class="fondo-con-sombra">
            <img src="<?= 'img/' . $libro['imagenTapa'] ?>" alt="<?= $libro['titulo'] ?>">
            <h4><?= $libro['titulo'] ?></h4>
          </div>
          <div>
            <span><?= '$ ' . $libro['precio'] ?></span>
            <a href="#">comprar</a>
          </div>
        </article>
        <?php endforeach ?>

      </div>
    </section>

        <!--
        <article class="libro1">
          <img src="img/dlr_equilibrio.png" alt="FOTO NO DISPONIBLE">
        </article>
        <article class="libro2">
          <img src="img/fb_comodios.png" alt="FOTO NO DISPONIBLE">
        </article>
        <article class="libro3">
          <img src="img/is_recuerdos.png" alt="FOTO NO DISPONIBLE">
        </article>
      </div>
    </section>
    -->

    <?php include('footer.php'); ?>
  </div>
</body>
</html>