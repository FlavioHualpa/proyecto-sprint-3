<?php

//conectarnos a My SQL //
//pasar de base de datos a json//
function ExportarAJson() {
   try {
     $db = get_connection();
     if ($db) {
       $query = 'SELECT * from users';
     	 $stmt = $db->prepare($query);
       $stmt->execute();
       $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

       $txt = json_encode($usuarios);
       $result = file_put_contents('../datos/usuarios.json', $txt);
       echo 'Usuarios exportados a archivo json.';
     }
   }
   catch (PDOException $e) {
       echo $e->getMessage();
   }
}

//pasar de json a base de datos//
function ImportarDeJson() {
   try {
    if (file_exists('../datos/usuarios.json')){
      $txt = file_get_contents('../datos/usuarios.json');
      $usuarios = json_decode($txt, true);

      $db = get_connection();
      if($db) {
        foreach ($usuarios as $usuario) {
          $query = "INSERT into ´users´
            (id, first_name, last_name, email, country_code,
            birth_date, sex, password, avatar_url)
            VALUES (" . $usuario['id'] . ", '" . $usuario['first_name'] . "')";
          $stmt = $db->prepare($query);
          $stmt->execute();
        }
      }
    }
   } catch (PDOException $e) {
      echo $e->getMessage();
   }
}

function testTables(PDO $db, array $tables) : array {
   $results = [];

   foreach ($tables as $table) {
      $query = 'SELECT * FROM ' . $table;
      try {
         $stmt = $db->prepare($query);
         $results[$table] = $stmt->execute();
      } catch (\Exception $e) {
         $results[$table] = false;
      }
   }

   return $results;
}

function allTablesOk(array $tables) : bool {
   foreach ($tables as $table) {
      if ($table == false) {
         return false;
      }
   }

   return true;
}

function get_connection(string $dbName = null) : ?PDO {
   try {
      $config = parse_ini_file('../src/config/db.ini');
   }
   catch (\Exception $e) {
      $config = null;
   }

   $db = null;

   if ($config) {
      $dsn = 'mysql:host=' . $config['host'] . ';dbname=' . ($dbName === null ? $config['dbName'] : $dbName);
      $user = $config['user'];
      $pass = $config['password'];
      try {
         $db = new PDO($dsn, $user, $pass);
         $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch (\Exception $e) {
      }
   }

   return $db;
}
