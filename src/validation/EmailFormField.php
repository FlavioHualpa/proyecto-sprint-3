<?php

require_once 'FormField.php';

class EmailFormField extends FormField
{
   protected $longitudMinima;
   protected $longitudMaxima;

   public function __construct(string $nombre, bool $obligatorio, int $longitudMinima = null, int $longitudMaxima = 100, string $mensaje = null) {
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
         if (filter_var($valor, FILTER_VALIDATE_EMAIL) == false) {
            return $this->mensaje ? $this->mensaje : 'El formato del email no es válido';
         } elseif ($this->longitudMinima && $this->longitudMaxima) {
            if ($valor < $this->longitudMinima || $valor > $this->longitudMaxima) {
               return 'Debe ingresar entre ' . $this->longitudMinima . ' y ' . $this->longitudMaxima . ' caracteres';
            }
         } elseif ($this->longitudMinima) {
            if ($valor < $this->longitudMinima) {
               return 'Debe ingresar como mínimo ' . $this->valorMinimo . ' caracteres';
            }
         } elseif ($this->longitudMaxima) {
            if ($valor > $this->longitudMaxima) {
               return 'Debe ingresar como máximo ' . $this->valorMaximo . ' caracteres';
            }
         }
      }

      return null;
   }
}
