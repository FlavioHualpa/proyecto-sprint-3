<?php

  $mas_vendidos = leer_json('datos/masvendidos.json');
  $mas_vendidos_por_ranking = ordernar_por_ranking($mas_vendidos);

  $novedades = leer_json('datos/novedades.json');

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

  function leer_json($ruta) {

    $json = null;

    if (file_exists($ruta)) {
      $txt = file_get_contents($ruta);
      $json = json_decode($txt, true);
    }

    return $json;

  }

  function guardar_json($ruta, $usuario) {

    $txt = json_encode($usuario);
    $ok = file_put_contents($ruta, $txt);
    return $ok;

  }

  function validar_login() {
    $errores = [];

    if (!isset($_POST['email']) || empty(trim($_POST['email']))) {
      $errores['email'] = 'El email del usuario es requerido';
    } elseif (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false) {
      $errores['email'] = 'El email ingresado no es válido';
    }

    if (!isset($_POST['pass']) || empty(trim($_POST['pass']))) {
      $errores['pass'] = 'La contraseña es requerida';
    }

    return $errores;
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

  function existe_usuario($email, $usuario) {
    $usuarios = leer_json('datos/usuarios.json');

    if ($usuarios) {
      foreach ($usuarios as $valor) {
        if ($valor['email'] == $email || $valor['usuario'] == $usuario) {
          return true;
        }
      }
    }

    return false;
  }

  function usuario_por_id($id) {
    $usuarios = leer_json('datos/usuarios.json');

    if ($usuarios) {
      foreach ($usuarios as $usuario) {
        if ($usuario['id'] == $id) {
          return $usuario;
        }
      }
    }

    return null;
  }

  function guardar_usuario() {
    $usuarios = leer_json('datos/usuarios.json');
    if ($usuarios) {
      $id = $usuarios[count($usuarios)-1]['id'] + 1;
    } else {
      $id = 1;
      $usuarios = [];
    }

    if (isset($_FILES['avatar'])) {
      $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
      $url = md5($_FILES['avatar']['name'] . '-' . time()) . $ext;
    } else {
      $url = '';
    }

    $usuario = [
      'id' => $id,
      'nombre' => $_POST['nombre'],
      'apellido' => $_POST['apellido'],
      'usuario' => $_POST['usuario'],
      'email' => $_POST['email'],
      'paisNacimiento' => $_POST['paisNacimiento'],
      'nacimiento' => $_POST['nacimiento'],
      'sexo' => $_POST['sexo'],
      'pass' => password_hash($_POST['pass'], PASSWORD_DEFAULT),
      'avatar_url' => $url,
    ];

    $usuarios[] = $usuario;
    guardar_json('datos/usuarios.json', $usuarios);
  }

?>
