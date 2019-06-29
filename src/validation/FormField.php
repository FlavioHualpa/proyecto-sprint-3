<?php

abstract class FormField
{
   protected $nombre;
   protected $obligatorio;
   protected $mensaje;
   protected $formValidator;

   public function __construct(string $nombre, bool $obligatorio, string $mensaje = null) {
      $this->nombre = $nombre;
      $this->obligatorio = $obligatorio;
      $this->mensaje = $mensaje;
   }

   public function getNombre() : string {
      return $this->nombre;
   }

   public function esObligatorio() : bool {
      return $this->obligatorio;
   }

   public function getMensaje() : ?string {
      return $this->mensaje;
   }

   public function getFormValidator() : FormValidation {
      return $this->formValidator;
   }

   public function setFormValidator(FormValidation $formValidator) {
      $this->formValidator = $formValidator;
   }

   public abstract function validar(string $valor) : ?string;
}
