<?php

require 'User.php';
require_once 'DbInteract.php';

class UserDbInteract extends DbInteract
{
   public function insertarUsuario(array $datos) : ?User
   {
      if ($this->db) {
         $query = 'INSERT INTO users
            (first_name, last_name, email, country_code,
               birth_date, sex, password, created_at)
            VALUES (:nombre, :apellido, :email, :pais,
               :nacimiento, :sexo, :pass, :creado)';

         $parametros = [
            ':nombre' => $datos['nombre'],
            ':apellido' => $datos['apellido'],
            ':email' => $datos['email'],
            ':pais' => $datos['pais'],
            ':nacimiento' => $datos['nacimiento'],
            ':sexo' => $datos['sexo'],
            ':pass' => password_hash($datos['pass'], PASSWORD_DEFAULT),
            ':creado' => date('Y-m-d H:i:s')
         ];

         $this->setInsertQuery($query);
         $exito = $this->executeInsertQuery($parametros);

         if ($exito) {
            $id = $this->db->lastInsertId();
            $usuario = new User(
               $id,
               $parametros[':nombre'],
               $parametros[':apellido'],
               $parametros[':email'],
               $parametros[':pais'],
               $parametros[':nacimiento'],
               $parametros[':sexo'],
               '',
               $parametros[':pass'],
               $parametros[':creado']
            );
            return $usuario;
         }
      }

      return null;
   }

   public function traerUsuarioPorId($id) : ?User
   {
      if ($this->db) {
         $query = 'SELECT *
            FROM users
            WHERE id = :id';

         $parametros = [
            ':id' => $id
         ];

         $this->setSelectQuery($query);
         $exito = $this->executeSelectQuery($parametros);

         if ($exito) {
            $row = $this->getNextRow();
            if ($row) {
               $usuario = new User(
                  $row['id'],
                  $row['first_name'],
                  $row['last_name'],
                  $row['email'],
                  $row['country_code'],
                  $row['birth_date'],
                  $row['sex'],
                  $row['avatar_url'],
                  $row['password'],
                  $row['created_at']
               );
               return $usuario;
            }
         }
      }

      return null;
   }
}
