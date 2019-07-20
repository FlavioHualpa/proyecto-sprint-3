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
      $errores['email'] = 'El email es requerido';
    }

    if (!isset($_POST['pass']) || empty(trim($_POST['pass']))) {
      $errores['pass'] = 'La contraseña es requerida';
    }

    return $errores;
  }

  function verificar_login($user, $pass) {

    $usuarios = leer_json('datos/usuarios.json');

    foreach ($usuarios as $usuario) {
      if ($usuario['email'] == $user && password_verify($pass, $usuario['password'])) {
        return $usuario;
      }
    }

    return null;
  }

  function existe_usuario($email, $usuario) {
    $usuarios = leer_json('datos/usuarios.json');

    if ($usuarios) {
      foreach ($usuarios as $valor) {
      if ($valor['email'] == $email /* || $valor['usuario'] == $usuario */) {
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

    if (!empty($_FILES) && !empty($_FILES['avatar']['name'])) {
      $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION); /*esto nos da la extension del archivo*/
      $hashed_name = md5($_FILES['avatar']['name'] . '-' . time()) . ".". $ext; /*esto genera una cadena de texto irrepetible, concatenado con la hora*/
      $path = 'uploads/' . $hashed_name; /*esto genera la ruta de guardado del archivo y su nombre*/
      move_uploaded_file($_FILES['avatar']['tmp_name'], $path); /*esto copia el directorio temporal en la ruta definida y con el nombre único generado*/
    } else {
      $hashed_name = '';
    }

    $usuario = [
      'id' => $id,
      'first_name' => $_POST['nombre'],
      'last_name' => $_POST['apellido'],
      'email' => $_POST['email'],
      'country_code' => $_POST['paisNacimiento'],
      'birth_date' => $_POST['nacimiento'],
      'sex' => $_POST['sexo'],
      'password' => password_hash($_POST['pass'], PASSWORD_DEFAULT),
      'avatar_url' => $hashed_name,
      'created_at' => date('Y-m-d')
    ];

    $usuarios[] = $usuario;
    guardar_json('datos/usuarios.json', $usuarios);
    return $usuario;
  }

  function set_session_data($usuario) {
    $_SESSION['id'] = $usuario['id'];
    $_SESSION['genero'] = $usuario['sex'];
    $_SESSION['nombre'] = $usuario['first_name'];
    $_SESSION['avatar'] = $usuario['avatar_url'];
  }

?>
