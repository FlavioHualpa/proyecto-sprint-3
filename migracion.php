<?php

require 'funciones.php';
//conectarnos a My SQL //
//pasar de base de datos a json//
try {
  $db = get_connection();
  if ($db) {
    $query = 'SELECT * from users';
  	$stmt = $db->prepare($query);
    $stmt->execute();
    $usuarios = $stmt->fetchAll();

    $txt = json_encode($usuarios);
    $result = file_put_contents(datos/usuarios.json, $txt);
    return $result;
  } catch (PDOException $e) {
  return $e=getMessage();
  }


  //pasar de json a base de datos//
  try {
    if (file_exists(datos/usuarios.json)){
      $txt = file_get_contents(datos/usuarios.json);
      $usuarios = json_decode($txt, true);

      $db = get_connection();
      if($db) {
        foreach ($usuarios as $usuario) {
          $query = 'INSERT into ´users´(id, nombre, apellido, usuario, email, paisNacimiento, nacimiento, sexo, pass)';
          $stmt = $db->prepare($query);
          $stmt->execute();
        } endforeach;
      }
    }
  } catch (PDOException $e) {
  return $e=getMessage();
  }
