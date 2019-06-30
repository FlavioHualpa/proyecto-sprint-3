<?php

require_once 'FormField.php';

class NumberFormField extends FormField
{
   protected $valorMinimo;
   protected $valorMaximo;

   public function __construct(string $nombre, bool $obligatorio, float $valorMinimo = null, float $valorMaximo = null, string $mensaje = null) {
      parent::__construct($nombre, $obligatorio, $mensaje);
      $this->valorMinimo = $valorMinimo;
      $this->valorMaximo = $valorMaximo;
   }

   public function getValorMinimo() : ?float {
      return $this->valorMinimo;
   }

   public function getValorMaximo() : ?float {
      return $this->valorMaximo;
   }

   public function validar(string $valor) : ?string {
      if ($this->esObligatorio() && $valor == '') {
         return 'Debe completar este campo';
      } elseif ($valor != '') {
         if (!is_numeric($valor)) {
            return $this->mensaje ? $this->mensaje : 'Debe ingresar un valor numérico';
         } elseif ($this->valorMinimo && $this->valorMaximo) {
            if ($valor < $this->valorMinimo || $valor > $this->valorMaximo) {
               return 'Debe ingresar un valor numérico entre ' . $this->valorMinimo . ' y ' . $this->valorMaximo;
            }
         } elseif ($this->valorMinimo) {
            if ($valor < $this->valorMinimo) {
               return 'Debe ingresar un valor numérico mayor o igual a ' . $this->valorMinimo;
            }
         } elseif ($this->valorMaximo) {
            if ($valor > $this->valorMaximo) {
               return 'Debe ingresar un valor numérico menor o igual a ' . $this->valorMaximo;
            }
         }
      }

      return null;
   }
}
