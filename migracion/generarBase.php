<?php

require 'funciones.php';

$db = get_connection('');

if ($db) {
   $query = 'CREATE DATABASE queleo CHARACTER SET = utf8';
   $stmt = $db->prepare($query);
   $stmt->execute();
}

header('location: migracion.php');
exit();
