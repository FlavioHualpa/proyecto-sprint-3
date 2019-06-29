<?php

require_once 'FormField.php';

class DateFormField extends FormField
{
   protected $valorMinimo;
   protected $valorMaximo;

   public function __construct(string $nombre, bool $obligatorio, string $valorMinimo = null, string $valorMaximo = null, string $mensaje = null) {
      parent::__construct($nombre, $obligatorio, $mensaje);
      $this->valorMinimo = $valorMinimo;
      $this->valorMaximo = $valorMaximo;
   }

   public function getValorMinimo() : ?string {
      return $this->valorMinimo;
   }

   public function getValorMaximo() : ?string {
      return $this->valorMaximo;
   }

   public function validar(string $valor) : ?string {
      if ($this->esObligatorio() && $valor == '') {
         return 'Debe completar este campo';
      } elseif ($valor != '') {
         if (strtotime($valor) == false) {
            return $this->mensaje ? $this->mensaje : 'Debe ingresar una fecha válida';
         } elseif ($this->valorMinimo && $this->valorMaximo) {
            if ($valor < $this->valorMinimo || $valor > $this->valorMaximo) {
               return 'Debe ingresar una fecha entre ' . $this->valorMinimo . ' y ' . $this->valorMaximo;
            }
         } elseif ($this->valorMinimo) {
            if ($valor < $this->valorMinimo) {
               return 'Debe ingresar una fecha mayor o igual a ' . $this->valorMinimo;
            }
         } elseif ($this->valorMaximo) {
            if ($valor > $this->valorMaximo) {
               return 'Debe ingresar una fecha menor o igual a ' . $this->valorMaximo;
            }
         }
      }

      return null;
   }
}
