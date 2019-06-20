<?php

   class Pais
   {
      private $id;
      private $nombre;
      private $codigo;

      public function __construct(int $id, string $nombre, string $codigo) {
         $this->id = $id;
         $this->nombre = $nombre;
         $this->codigo = $codigo;
      }

      public function getId() : int {
         return $this->id;
      }

      public function getNombre() : string {
         return $this->nombre;
      }

      public function getCodigo() : string {
         return $this->codigo;
      }
   }
