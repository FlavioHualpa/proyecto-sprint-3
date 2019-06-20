<?php

  require 'src/entities/User.php';
  require 'src/validation/UserValidation.php';
  require 'src/validation/FormValidation.php';

  $user = new User(1, 'Flavio', 'Hualpa', 'fh@gmail.com', 'ar', strtotime('1972-3-5'), 'm', '', 'abc', time());

  $val = new UserValidation(
    [
      'nombre' => $user->getFirstName(),
      'apellido' => $user->getLastName(),
      'email' => $user->getEmail(),
      'paisNacimiento' => $user->getCountryCode(),
      'nacimiento' => $user->getBirthDate(),
      'sexo' => $user->getSex(),
      'avatar' => $user->getAvatarUrl(),
      'pass' => $user->getPassword(),
      'createdAt' => $user->getCreationDate(),
    ]
  );
  $val->validar();

  $val = new FormValidation();
  $val->agregarValidacion(
    new FormField(
      'nombre',
      TIPO_STRING,
      true,
      []
    )
  );
  $val->agregarValidacion(
    new FormField(
      'apellido',
      TIPO_STRING,
      true,
      [ VALOR_MAX, 10 ]
    )
  );
  $val->agregarValidacion(
    new FormField(
      'email',
      TIPO_EMAIL,
      true,
      []
    )
  );
  $val->agregarValidacion(
    new FormField(
      'edad',
      TIPO_NUMERO,
      false,
      [ VALOR_MIN_MAX, 0, 50 ]
    )
  );
  $val->validar(
    [
      'nombre' => 'Flavio',
      'apellido' => 'Hualpa',
      'email' => 'docs@mail.com',
      'edad' => 35
    ]
  );

  var_dump($val);

?>
