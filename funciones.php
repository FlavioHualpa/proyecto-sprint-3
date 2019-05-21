<?php

  $sesion_iniciada = false;
  $nombre_usuario = null;
  $genero_usuario = null;

  $mas_vendidos = leer_json('datos/masvendidos.json');
  $mas_vendidos_por_ranking = ordernar_por_ranking($mas_vendidos);

  /* esta función es para ordenar el array
  /* de libros por su ranking de ventas */
  function ordernar_por_ranking($array) {
    usort($array, 'comp_rank');
    return $array;
  }

  /* función de ayuda para que usort sepa
  /* cómo debe comparar los elementos del
  /* array para ordenarlos */
  function comp_rank($a, $b) {
    return $a["ranking"] - $b["ranking"];
  }

  /* iniciar_sesion recibe 3 parámetros:
  /* $usuarios: el array de usuarios registrados
  /* $usuario_ingresado: el usuario que intenta iniciar sesión
  /* $clave_ingresada: la clave del usuario
  /* Si la combinación de usuario y clave existe dentro de $usuarios
  /* se establece la variable $sesion_iniciada a true */
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

  /* se indica el cierre de una sesión estableciendo la variable
  /* $sesion_iniciada a false y $nombre_usuario a null */
  function cerrar_sesion() {

    global $sesion_iniciada;
    global $nombre_usuario;
    global $genero_usuario;

    $sesion_iniciada = false;
    $nombre_usuario = null;
    $genero_usuario = null;
  }

  function leer_json($ruta) {

    $json = null;

    if (file_exists($ruta)) {
      $txt = file_get_contents($ruta);
      $json = json_decode($txt, true);
    }

    return $json;

  }

  function guardar_json($ruta, $array) {

    $txt = json_encode($array);
    $ok = file_put_contents($ruta, $txt);
    return $ok;

  }

  function verificar_login($email, $pass) {

    $usuarios = leer_json('datos/usuarios.json');

    foreach ($usuarios as $usuario) {
      if ($usuario['email'] == $email && password_verify($pass, $usuario['pass'])) {
        return $usuario;
      }
    }

    return null;
  }

  /*
  if ($_POST) {
    iniciar_sesion($usuarios_registrados, $_POST['email'], $_POST['pass']);
  } else {
    cerrar_sesion();
  }
  */

?>
