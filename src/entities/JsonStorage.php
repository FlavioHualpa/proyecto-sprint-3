<?php

require_once 'StorageInterface.php';

class JsonStorage implements StorageInterface
{
   private $jsonFileUrl;
   private $jsonText;
   private $jsonArray;

   public function __construct()
   {
      $this->jsonFileUrl = null;
      $this->jsonText = null;
      $this->jsonArray = [];
   }

   public function connect() : bool {
      if (is_readable($this->jsonFileUrl)) {
         $this->jsonText = file_get_contents($this->jsonFileUrl);
         return true;
      }
      return false;
   }

   private function searchId(array $rows, int $id) : array {
      foreach ($rows as $row) {
         if ($row['id'] == $id) {
            return $row;
         }
      }
      return [];
   }

   public function select(array $datos = []) : array
   {
      if ($this->connect()) {
         $this->jsonArray = json_decode($this->jsonText, true);
         if ($this->jsonArray === null) {
            return [];
         }
         elseif (isset($datos['id'])) {
            return searchId($this->jsonArray, $datos['id']);
         }
         return $this->jsonArray;
      }
      return [];
   }

   public function insert(array $datos = []) : bool {
      if ($this->select()) {
         $this->jsonArray[] = $datos;
         $enc_result = json_encode($this->jsonArray);
         if ($enc_result == false) {
            return false;
         }
         $save_result = file_put_contents($this->jsonFileUrl, $enc_result);
         if ($save_result == false) {
            return false;
         }
         $this->jsonArray = $enc_result;
         return true;
      }
      return false;
   }

   public function update(array $datos = []) : bool {}

   public function getJsonFileUrl() : ?string {
      return $this->jsonFileUrl;
   }

   public function setJsonFileUrl(?string $url) {
      $this->jsonFileUrl = $url;
   }

   public function getLastInsertId() : int {
      if (count($this->jsonArray) > 0) {
         return end($this->jsonArray)['id'];
      }
      return -1;
   }
}
