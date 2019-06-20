<?php

require 'Pais.php';
require_once 'DbInteract.php';

class PaisDbInteract extends DbInteract
{
   public function insertarPais(array $datos) : ?Pais
   {
      if ($this->db) {
         $query = 'INSERT INTO paises
            (nombre, codigo)
            VALUES (:nombre, :codigo)';

         $parametros = [
            ':nombre' => $datos['nombre'],
            ':codigo' => $datos['codigo']
         ];

         $this->setInsertQuery($query);
         $exito = $this->executeInsertQuery($parametros);

         if ($exito) {
            $id = $this->db->lastInsertId();
            $pais = new Pais(
               $id,
               $parametros[':nombre'],
               $parametros[':codigo']
            );
            return $pais;
         }
      }

      return null;
   }

   public function traerPaises()
   {
      if ($this->db) {
         $query = 'SELECT *
            FROM paises';

         $this->setSelectQuery($query);
         $exito = $this->executeSelectQuery([]);
      }
   }

   public function siguientePais() : ?Pais
   {
      if ($this->db) {
         $datos = $this->getNextRow();
         if ($datos) {
            $pais = new Pais(
               $datos['id'],
               $datos['nombre'],
               $datos['codigo']
            );
            return $pais;
         }
      }

      return null;
   }
}
