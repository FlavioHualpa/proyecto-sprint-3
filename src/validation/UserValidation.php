<?php

  class UserValidation
  {
    private $errores;
    private $datos;

    public function __construct($datos)
    {
      $this->datos = $datos;
      $this->errores = [];
    }

    public function getError($campo) : string
    {
       return $this->errores[$campo] ?? null;
    }

    public function sinErrores() : bool
    {
      return empty($this->errores);
    }

    public function validar()
    {

      if ($this->datos) {

        $this->errores = [];

         if (isset($this->datos['nombre'])) {
            if (trim($this->datos['nombre']) == '') {
               $this->errores['nombre'] = 'Debe completar este campo';
            }
         } else {
            $this->errores['nombre'] = 'Error de programación. No se recibió el valor de este campo.';
         }

         if (isset($this->datos['apellido'])) {
            if (trim($this->datos['apellido']) == '') {
               $this->errores['apellido'] = 'Debe completar este campo';
            }
         } else {
            $this->errores['apellido'] = 'Error de programación. No se recibió el valor de este campo.';
         }

         if (isset($this->datos['email'])) {
            if (trim($this->datos['email']) == '') {
               $this->errores['email'] = 'Debe completar este campo';
            } elseif (filter_var($this->datos['email'], FILTER_VALIDATE_EMAIL) == false) {
               $this->errores['email'] = 'El email ingresado no es válido';
            }
         } else {
            $this->errores['email'] = 'Error de programación. No se recibió el valor de este campo.';
         }

         if (isset($this->datos['nacimiento'])) {
            if (!is_numeric($this->datos['nacimiento']) || $this->datos['nacimiento'] < 0) {
               $this->errores['nacimiento'] = 'La fecha ingresada no es válida';
            } elseif ((time() - $this->datos['nacimiento']) / (60*60*24*365.25) < 18) {
               $this->errores['nacimiento'] = 'Debe tener al menos 18 años de edad para registrarse';
            }
         } else {
            $this->errores['nacimiento'] = 'Error de programación. No se recibió el valor de este campo.';
         }

        if (isset($this->datos['paisNacimiento'])) {
           if (trim($this->datos['paisNacimiento']) == '') {
              $this->errores['paisNacimiento'] = 'Debe completar este campo';
           }
        } else {
           $this->errores['paisNacimiento'] = 'Error de programación. No se recibió el valor de este campo.';
        }

        if (isset($this->datos['sexo'])) {
           if ($this->datos['sexo'] != 'f' && $this->datos['sexo'] != 'm') {
              $this->errores['sexo'] = 'El valor seleccionado no es válido';
           }
        } else {
           $this->errores['sexo'] = 'Error de programación. No se recibió el valor de este campo.';
        }

        if (isset($this->datos['pass'])) {
           if (trim($this->datos['pass']) == '') {
              $this->errores['pass'] = 'Por favor ingrese una contraseña';
           } elseif (strlen($this->datos['pass']) < 6 || strlen($this->datos['pass']) > 12) {
              $this->errores['pass'] = 'La contraseña debe tener entre 6 y 12 caracteres';
           }
        } else {
           $this->errores['pass'] = 'Error de programación. No se recibió el valor de este campo.';
        }

        if (isset($this->datos['pass2'])) {
           if (trim($this->datos['pass2']) == '') {
              $this->errores['pass2'] = 'Por favor reingrese la contraseña';
           }
         } else {
           $this->errores['pass2'] = 'Error de programación. No se recibió el valor de este campo.';
        }

      }
    }
  }
