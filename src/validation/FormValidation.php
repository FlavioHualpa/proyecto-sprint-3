<?php

//define('TIPO_NUMERO', 0);

require 'FormField.php';

class FormValidation
{
   public const TIPO_NUMERO = 0;
   public const TIPO_STRING = 1;
   public const TIPO_EMAIL = 2;
   public const TIPO_OPCIONES = 3;
   public const TIPO_FILE = 4;
   public const VALOR_MIN = 5;
   public const VALOR_MAX = 6;
   public const VALOR_MIN_MAX = 7;
   public const VALOR_OPCION = 8;
   public const VALOR_EXTENSION = 9;
   public const TIPO_IGUALA = 10;
   public const TIPO_FECHA = 11;

   private $expected_fields;
   private $errores;

   public function __construct()
   {
      $this->expected_fields = [];
      $this->errores = [];
   }

   public function agregarValidacion(FormField $campo)
   {
      $this->expected_fields[] = $campo;
   }

   public function getError(string $campo) : string
   {
      return $this->errores[$campo] ?? null;
   }

   public function getErrores() : array
   {
      return $this->errores;
   }

   public function sinErrores() : bool
   {
      return empty($this->errores);
   }

   public function validar($valores)
   {
      $this->errores = [];

      if ($valores) {

         foreach ($this->expected_fields as $expected) {

            $nombre = $expected->getNombre();
            $mensaje = $expected->getMensaje();

            if (isset($valores[$nombre])) {
               $dato = $expected->getTipo() == FormValidation::TIPO_FILE ? $valores[$nombre]['name'] : $valores[$nombre];
               if ($expected->getObligatorio() && trim($dato) == '') {
                  $this->errores[$nombre] = 'Debe completar este campo';
               } elseif ($dato != '') {

                  $opciones = $expected->getValidacion();

                  switch ($expected->getTipo()) {

                     case FormValidation::TIPO_NUMERO:

                     if (!is_numeric($dato)) {
                        $this->errores[$nombre] = $mensaje ? $mensaje : 'Debe ingresar un valor numérico';
                     } else {

                        if ($opciones) {
                           switch ($opciones[0]) {
                              case FormValidation::VALOR_MIN:
                              if ($dato < $opciones[1]) {
                                 $this->errores[$nombre] = $mensaje ? $mensaje : 'Debe ingresar un número mayor o igual a ' . $opciones[1];
                              }
                              break;
                              case FormValidation::VALOR_MAX:
                              if ($dato > $opciones[1]) {
                                 $this->errores[$nombre] = $mensaje ? $mensaje : 'Debe ingresar un número menor o igual a ' . $opciones[1];
                              }
                              break;
                              case FormValidation::VALOR_MIN_MAX:
                              if ($dato < $opciones[1] || $dato > $opciones[2]) {
                                 $this->errores[$nombre] = $mensaje ? $mensaje : 'Debe ingresar un número entre ' . $opciones[1] . ' y ' . $opciones[2];
                              }
                              break;
                           }
                        }
                     }
                     break;

                     case FormValidation::TIPO_STRING:

                     if ($opciones) {
                        switch ($opciones[0]) {
                           case FormValidation::VALOR_MIN:
                           if (strlen($dato) < $opciones[1]) {
                              $this->errores[$nombre] = $mensaje ? $mensaje : 'Debe ingresar al menos ' . $opciones[1] . ' caracteres';
                           }
                           break;
                           case FormValidation::VALOR_MAX:
                           if (strlen($dato) > $opciones[1]) {
                              $this->errores[$nombre] = $mensaje ? $mensaje : 'Debe ingresar como máximo ' . $opciones[1] . ' caracteres';
                           }
                           break;
                           case FormValidation::VALOR_MIN_MAX:
                           if (strlen($dato) < $opciones[1] || strlen($dato) > $opciones[2]) {
                              $this->errores[$nombre] = $mensaje ? $mensaje : 'Debe ingresar entre ' . $opciones[1] . ' y ' . $opciones[2] . ' caracteres';
                           }
                           break;
                        }
                     }
                     break;

                     case FormValidation::TIPO_FECHA:

                     if ($opciones) {
                        switch ($opciones[0]) {
                           case FormValidation::VALOR_MIN:
                           if ($dato < $opciones[1]) {
                              $this->errores[$nombre] = $mensaje ? $mensaje : 'Debe ingresar una fecha mayor o igual al ' . $opciones[1];
                           }
                           break;
                           case FormValidation::VALOR_MAX:
                           if ($dato > $opciones[1]) {
                              $this->errores[$nombre] = $mensaje ? $mensaje : 'Debe ingresar una fecha menor o igual al ' . $opciones[1];
                           }
                           break;
                           case FormValidation::VALOR_MIN_MAX:
                           if ($dato < $opciones[1] || $dato > $opciones[2]) {
                              $this->errores[$nombre] = $mensaje ? $mensaje : 'Debe una fecha entre el ' . $opciones[1] . ' y el ' . $opciones[2];
                           }
                           break;
                        }
                     }
                     break;

                     case FormValidation::TIPO_EMAIL:

                     if (filter_var($dato, FILTER_VALIDATE_EMAIL) == false) {
                        $this->errores[$nombre] = $mensaje ? $mensaje : 'El email no provisto no es válido';
                     }
                     break;

                     case FormValidation::TIPO_OPCIONES:

                     if ($opciones) {
                        for ($i=1; $i < count($opciones); $i++) {
                           if ($dato == $opciones[$i])
                           break;
                        }
                        if ($i == count($opciones)) {
                           $this->errores[$nombre] = $mensaje ? $mensaje : 'El valor seleccionado no es válido';
                        }
                     }
                     break;

                     case FormValidation::TIPO_IGUALA:

                     if ($opciones) {
                        if ($dato != $valores[$opciones[0]]) {
                           $this->errores[$nombre] = $mensaje ? $mensaje : 'Debe reingresar el valor ingresado en ' . $opciones[0];
                        }
                     }
                     break;

                     case FormValidation::TIPO_FILE:

                     if ($valores[$nombre]['error'] == UPLOAD_ERR_OK) {
                        $archivo = $valores[$nombre]['name'];
                        $ext = pathinfo($archivo, PATHINFO_EXTENSION);
                        if ($opciones) {
                           for ($i = 1; $i < count($opciones); $i++) {
                              if ($ext == $opciones[$i])
                                 break;
                           }
                           if ($i == count($opciones)) {
                              $this->errores[$nombre] = $mensaje ? $mensaje : 'El archivo debe ser de tipo ';
                           }
                        }
                     } elseif ($valores[$nombre]['error'] == UPLOAD_ERR_INI_SIZE) {
                        $this->errores[$nombre] = 'El archivo no debe tener más de ' . upload_max_filesize . ' bytes';
                     } elseif ($valores[$nombre]['error'] == UPLOAD_ERR_FORM_SIZE) {
                        $this->errores[$nombre] = 'El archivo no debe tener más de ' . MAX_FILE_SIZE . ' bytes';
                     } else {
                        $this->errores[$nombre] = 'No se pudo cargar el archivo';
                     }
                  }
               }
            } else {
               if ($expected->getTipo() == FormValidation::TIPO_OPCIONES) {
                  $this->errores[$nombre] = $mensaje ? $mensaje : 'Debe seleccionar un valor';
               } else {
                  $this->errores[$nombre] = 'Error de programación. No se recibió el valor de este campo.';
               }
            }
         }
      }
   }
}
