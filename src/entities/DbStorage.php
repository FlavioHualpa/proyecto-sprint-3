<?php

require_once 'StorageInterface.php';
require_once 'Connection.php';

class DbStorage implements StorageInterface
{
   private $host;
   private $dbName;
   private $user;
   private $password;
   private $query;
   private $db;
   private $stmt;

   public function __construct()
   {
      $path = realpath(__DIR__ . '/../config/db.ini');
      $config = parse_ini_file($path);
      $this->host = $config['host'];
      $this->dbName = $config['dbName'];
      $this->user = $config['user'];
      $this->password = $config['password'];
      $this->query = null;
   }

   public function connect() : bool {
      $this->db = Connection::connect(
         $this->host,
         $this->dbName,
         $this->user,
         $this->password
      );
      return $this->db != null;
   }

   private function prepare(array $datos = []) : bool {
      if ($this->db) {
         try {
            $this->stmt = $this->db->prepare($this->query);
         }
         catch (\Exception $e) {
            return false;
         }

         foreach ($datos as $key => $value) {
            $this->stmt->bindValue(':' . $key, $value);
         }

         try {
            $this->stmt->execute();
         }
         catch (\Exception $e) {
            return false;
         }

         return true;
      }

      return false;
   }

   public function select(array $datos = []) : array {
      if ($this->prepare($datos)) {
         return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
      }
      return [];
   }

   public function insert(array $datos = []) : bool {
      return $this->prepare($datos);
   }

   public function update(array $datos = []) : bool {
      return $this->prepare($datos);
   }

   public function getQuery() : ?string {
      return $this->query;
   }

   public function setQuery(?string $query) {
      $this->query = $query;
   }

   public function getLastInsertId() : int {
      if ($this->db) {
         return $this->db->lastInsertId();
      }
      return -1;
   }
}

/*
$myStorage = new DbStorage();
if ($myStorage->connect()) {
   User::insert($myStorage,
      [
         'first_name' => 'Manuela',
         'last_name' => 'Echeverría',
         'email' => 'manu@speedy.com.ar',
         'country_code' => 'AR',
         'birth_date' => '1991-03-14',
         'sex' => 'f',
         'password' => password_hash('unodos34', PASSWORD_DEFAULT),
         'avatar_url' => '',
         'created_at' => time(),
      ]
   );
   var_dump(User::selectAll($myStorage));
   var_dump(User::select($myStorage, 2));
   var_dump(Book::selectAll($myStorage));
   var_dump(Book::select($myStorage, 2));
   var_dump(Pais::selectAll($myStorage));
   var_dump(Pais::select($myStorage, 2));
}
else {
   echo 'Oh no!';
}

/*
$myStorage = new JsonStorage();
$myStorage->setJsonFileUrl('../../datos/usuarios.json');
if ($myStorage->connect()) {
   var_dump(User::selectAll($myStorage));
   var_dump(User::select($myStorage, 2));
}
else {
   echo 'Oh no!';
}
*/
