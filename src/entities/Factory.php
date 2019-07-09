<?php

require_once 'StorageInterface.php';
require_once 'DbStorage.php';
require_once 'JsonStorage.php';

abstract class Factory
{
   private $dataSource;

   public static function getDataSource(string $type) : StorageInterface {
      switch ($type) {
         case 'db':
            $dataSource = new DbStorage();
            break;
         case 'json':
            $dataSource = new JsonStorage();
            break;
         default:
            $dataSource = null;
            break;
      }
      return $dataSource;
   }
}
