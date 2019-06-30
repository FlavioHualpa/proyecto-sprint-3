<?php

require_once 'FormField.php';

class OptionsFormField extends FormField
{
   protected $opcionesValidas;

   public function __construct(string $nombre, bool $obligatorio, array $opcionesValidas = [], string $mensaje = null) {
      parent::__construct($nombre, $obligatorio, $mensaje);
      $this->opcionesValidas = $opcionesValidas;
   }

   public function getOpcionesValidas() : array {
      return $this->opcionesValidas;
   }

   public function validar(string $valor) : ?string {
      if ($this->esObligatorio() && $valor == '') {
         return 'Debe completar este campo';
      } elseif ($valor != '') {
         if ($this->opcionesValidas) {
            for ($i = 0; $i < count($this->opcionesValidas); $i++) {
               if ($valor == $this->opcionesValidas[$i])
               break;
            }
            if ($i == count($this->opcionesValidas)) {
               return $this->mensaje ? $this->mensaje : 'El valor seleccionado no es válido';
            }
         }
      }

      return null;
   }
}
