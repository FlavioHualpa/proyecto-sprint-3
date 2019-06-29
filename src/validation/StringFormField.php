<?php

require_once 'FormField.php';

class StringFormField extends FormField
{
   protected $longitudMinima;
   protected $longitudMaxima;

   public function __construct(string $nombre, bool $obligatorio, int $longitudMinima = null, int $longitudMaxima = null, string $mensaje = null) {
      parent::__construct($nombre, $obligatorio, $mensaje);
      $this->longitudMinima = $longitudMinima;
      $this->longitudMaxima = $longitudMaxima;
   }

   public function getLongitudMinima() : ?int {
      return $this->longitudMinima;
   }

   public function getLongitudMaxima() : ?int {
      return $this->longitudMaxima;
   }

   public function validar(string $valor) : ?string {
      if ($this->esObligatorio() && $valor == '') {
         return 'Debe completar este campo';
      } elseif ($valor != '') {
         if ($this->longitudMinima && $this->longitudMaxima) {
            if (strlen($valor) < $this->longitudMinima || strlen($valor) > $this->longitudMaxima) {
               return 'Debe ingresar entre ' . $this->longitudMinima . ' y ' . $this->longitudMaxima . ' caracteres';
            }
         } elseif ($this->longitudMinima) {
            if (strlen($valor) < $this->longitudMinima) {
               return 'Debe ingresar como mínimo ' . $this->valorMinimo . ' caracteres';
            }
         } elseif ($this->longitudMaxima) {
            if (strlen($valor) > $this->longitudMaxima) {
               return 'Debe ingresar como máximo ' . $this->valorMaximo . ' caracteres';
            }
         }
      }

      return null;
   }
}
