<?php

interface StorageInterface
{
   public function connect() : bool;
   public function select(array $datos) : array;
   public function insert(array $datos) : bool;
   public function update(array $datos) : bool;
   public function getLastInsertId() : int;
}
