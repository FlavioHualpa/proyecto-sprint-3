<?php

abstract class DbInteract
{
   protected $db;
   protected $cmd;
   private $selectQuery;
   private $insertQuery;

   public function connect(string $dbname) : bool
   {
      $dsn = 'mysql:host=localhost;port=3316;dbname=' . $dbname;
      $user = 'root';
      $pass = 'digitalhouse';

      try {
         $this->db = new PDO($dsn, $user, $pass);
         $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (Exception $e) {
         $this->db = null;
      }

      return $this->db != null;
   }

   public function getSelectQuery() : string
   {
      return $this->$selectQuery;
   }

   public function setSelectQuery(string $query)
   {
      $this->selectQuery = $query;
   }

   public function getInsertQuery() : string
   {
      return $this->$insertQuery;
   }

   public function setInsertQuery(string $query)
   {
      $this->insertQuery = $query;
   }

   public function executeSelectQuery(array $parametros) : bool
   {
      if ($this->db && $this->selectQuery) {
         try {
            $this->cmd = $this->db->prepare($this->selectQuery);
            $this->cmd->execute($parametros);
            return true;
         } catch (\Exception $e) {
         }
      }
      return false;
   }

   public function executeInsertQuery(array $parametros) : bool
   {
      if ($this->db && $this->insertQuery) {
         try {
            $this->cmd = $this->db->prepare($this->insertQuery);
            $this->cmd->execute($parametros);
            return true;
         } catch (\Exception $e) {
         }
      }
      return false;
   }

   public function getNextRow() : ?array
   {
      if ($this->cmd) {
         $row = $this->cmd->fetch(PDO::FETCH_ASSOC);
         if ($row) {
            return $row;
         }
      }
      return null;
   }
}
