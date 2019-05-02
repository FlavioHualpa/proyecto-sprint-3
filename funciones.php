<?php

  $sesion_iniciada = false;
  $nombre_usuario = null;
  $genero_usuario = null;
  $mas_vendidos_por_ranking = ordernar_por_ranking($mas_vendidos);

  function ordernar_por_ranking($array) {
    usort($array, 'comp_rank');
    return $array;
  }

  function comp_rank($a, $b) {
    return $a["ranking"] - $b["ranking"];
  }

  function iniciar_sesion($usuarios, $usuario_ingresado, $clave_ingresada) {

    global $sesion_iniciada;
    global $nombre_usuario;
    global $genero_usuario;

    foreach ($usuarios as $usuario) {
      if ($usuario["usuario"] == $usuario_ingresado && $usuario["contraseña"] == $clave_ingresada) {
        $sesion_iniciada = true;
        $nombre_usuario = $usuario["nombre"];
        $genero_usuario = $usuario["genero"];
        break;
      }
    }
    return $sesion_iniciada;
  }

  function cerrar_sesion() {

    global $sesion_iniciada;
    global $nombre_usuario;
    global $genero_usuario;

    $sesion_iniciada = false;
    $nombre_usuario = null;
    $genero_usuario = null;
  }

  /* iniciar_sesion($usuarios_registrados, "FlavioH", "abcd"); */
?>
