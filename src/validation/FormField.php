<?php

class FormField
{
   private $nombre;
   private $tipo;
   private $obligatorio;
   private $validacion;
   private $mensaje;

   public function __construct(string $nombre, int $tipo, bool $obligatorio, array $validacion = [], string $mensaje = null) {
      $this->nombre = $nombre;
      $this->tipo = $tipo;
      $this->obligatorio = $obligatorio;
      $this->validacion = $validacion;
      $this->mensaje = $mensaje;
   }

   public function getNombre() : string {
      return $this->nombre;
   }

   public function getTipo() : int {
      return $this->tipo;
   }

   public function getObligatorio() : bool {
      return $this->obligatorio;
   }

   public function getValidacion() : array {
      return $this->validacion;
   }

   public function getMensaje() {
      return $this->mensaje;
   }
}
