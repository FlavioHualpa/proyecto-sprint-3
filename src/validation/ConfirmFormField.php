<?php

require_once 'FormField.php';

class ConfirmFormField extends FormField
{
   protected $elOtroCampo;

   public function __construct(string $nombre, bool $obligatorio, string $elOtroCampo, string $mensaje = null) {
      parent::__construct($nombre, $obligatorio, $mensaje);
      $this->elOtroCampo = $elOtroCampo;
   }

   public function getElOtroCampo() : ?string {
      return $this->elOtroCampo;
   }

   public function validar(string $valor) : ?string {
      if ($this->esObligatorio() && $valor == '') {
         return 'Debe reingresar el valor ingresado en ' . $this->elOtroCampo;
      } elseif ($valor != '') {
         if ($valor != $this->formValidator->getValor($this->elOtroCampo)) {
            return $this->mensaje ? $this->mensaje : 'El valor ingresado no coincide con el del campo ' . $this->nombre;
         }
      }

      return null;
   }
}
