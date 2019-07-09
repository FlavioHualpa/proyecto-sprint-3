<?php

require 'entities/DbStorage.php';
require 'entities/Pais.php';

if ($_POST) {

   require 'validation/FormValidation.php';
   require 'validation/DateFormField.php';
   require 'validation/StringFormField.php';
   require 'validation/EmailFormField.php';
   require 'validation/ConfirmFormField.php';
   require 'validation/OptionsFormField.php';
   require 'validation/FileFormField.php';
   require 'entities/User.php';

   $val = new FormValidation();

   $val->agregarValidacion(
     new StringFormField(
       'nombre',
       true
     )
   );
   $val->agregarValidacion(
     new StringFormField(
       'apellido',
       true
     )
   );
   $val->agregarValidacion(
     new EmailFormField(
       'email',
       true
     )
   );
   $val->agregarValidacion(
     new OptionsFormField(
       'pais',
       true
     )
   );
   $val->agregarValidacion(
     new DateFormField(
       'nacimiento',
       true,
       null,
       date('Y-m-d')
     )
   );
   $val->agregarValidacion(
     new OptionsFormField(
       'sexo',
       true,
       [ 'f', 'm' ]
     )
   );
   $val->agregarValidacion(
     new FileFormField(
       'avatar',
       false,
       [ 'jpg', 'jpeg', 'png', 'bmp' ]
     )
   );
   $val->agregarValidacion(
     new StringFormField(
       'pass',
       true,
       6,
       12
     )
   );
   $val->agregarValidacion(
     new ConfirmFormField(
       'passConf',
       true,
       'pass',
       'La confirmación no coincide con la contraseña'
     )
   );
   $val->agregarValidacion(
     new OptionsFormField(
       'terminos',
       true,
       [ 's' ],
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
