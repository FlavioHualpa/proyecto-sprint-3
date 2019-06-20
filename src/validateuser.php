<?php

require 'entities/PaisDbInteract.php';

if ($_POST) {

   require 'validation/FormValidation.php';
   require 'entities/UserDbInteract.php';

   $val = new FormValidation();

   $val->agregarValidacion(
     new FormField(
       'nombre',
       FormValidation::TIPO_STRING,
       true
     )
   );
   $val->agregarValidacion(
     new FormField(
       'apellido',
       FormValidation::TIPO_STRING,
       true
     )
   );
   $val->agregarValidacion(
     new FormField(
       'email',
       FormValidation::TIPO_EMAIL,
       true
     )
   );
   $val->agregarValidacion(
     new FormField(
       'pais',
       FormValidation::TIPO_OPCIONES,
       true
     )
   );
   $val->agregarValidacion(
     new FormField(
       'nacimiento',
       FormValidation::TIPO_FECHA,
       true,
       [ FormValidation::VALOR_MAX, date('Y-m-d') ]
     )
   );
   $val->agregarValidacion(
     new FormField(
       'sexo',
       FormValidation::TIPO_OPCIONES,
       true,
       [ FormValidation::VALOR_OPCION, 'f', 'm' ]
     )
   );
   $val->agregarValidacion(
     new FormField(
       'avatar',
       FormValidation::TIPO_FILE,
       false,
       [ FormValidation::VALOR_EXTENSION, 'jpg', 'jpeg', 'png', 'bmp' ]
     )
   );
   $val->agregarValidacion(
     new FormField(
       'pass',
       FormValidation::TIPO_STRING,
       true,
       [ FormValidation::VALOR_MIN_MAX, 6, 12 ]
     )
   );
   $val->agregarValidacion(
     new FormField(
       'passConf',
       FormValidation::TIPO_IGUALA,
       true,
       [ 'pass' ],
       'La confirmación no coincide con la contraseña'
     )
   );
   $val->agregarValidacion(
     new FormField(
       'terminos',
       FormValidation::TIPO_OPCIONES,
       true,
       [ FormValidation::VALOR_OPCION, 's' ],
       'Debe aceptar los términos y condiciones'
     )
   );

   $datos = $_POST;
   if (isset($_FILES['avatar'])) {
      $datos['avatar'] = $_FILES['avatar'];
   }
   $val->validar($datos);

   if ($val->sinErrores()) {
      $dbi = new UserDbInteract();
      $dbi->connect('test.05.25');
      $usuario = $dbi->insertarUsuario($datos);
      header('location: registrationResult.php?id=' . ($usuario ? $usuario->getId() : 0));
      exit;
   }

   $errores = $val->getErrores();
   // var_dump($val);

}
