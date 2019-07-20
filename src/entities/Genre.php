<?php

class Genre
{
   private $id;
   private $name;

   public function __construct(int $id, string $name) {
      $this->id = $id;
      $this->name = $name;
   }

   public function getId() : int {
      return $this->id;
   }

   public function getName() : string {
      return $this->name;
   }

   private static function createInstance(array $row) : Genre {
      $genre = new Genre(
         $row['id'],
         $row['name']
      );
      return $genre;
   }

   private static function createArray(array $rows) : array {
      $genres = [];
      foreach ($rows as $row) {
         $genres[] = self::createInstance($row);
      }
      return $genres;
   }

   public static function selectAll(StorageInterface $storage) : array {
      if ($storage instanceof DbStorage) {
         $storage->setQuery('SELECT * FROM genres ORDER BY name');
         $rows = $storage->select();
      }
      elseif ($storage instanceOf JsonStorage) {
         $rows = $storage->select();
      }
      else {
         $rows = [];
      }

      $genres = self::createArray($rows);
      return $genres;
   }

   public static function select(StorageInterface $storage, int $id) : ?Genre {
      if ($storage instanceof DbStorage) {
         $storage->setQuery('SELECT * FROM genres WHERE id = :id');
         $rows = $storage->select([ 'id' => $id ]);
      }
      elseif ($storage instanceOf JsonStorage) {
         $rows = $storage->select([ 'id' => $id ]);
      }
      else {
         $rows = [];
      }

      if ($rows) {
         $genre = self::createInstance($rows[0]);
         return $genre;
      }
      return null;
   }

   public static function insert(StorageInterface $storage, array $datos) : ?Genre {
      if ($storage instanceof DbStorage) {
         $storage->setQuery('INSERT INTO genres
            (name)
            VALUES (:name)'
         );
         $exito = $storage->insert($datos);
      }
      elseif ($storage instanceOf JsonStorage) {
         $exito = $storage->insert($datos);
      }
      else {
         $exito = false;
      }

      if ($exito) {
         $datos['id'] = $storage->getLastInsertId();
         $genre = self::createInstance($datos);
         return $genre;
      }
      return null;
   }
}
