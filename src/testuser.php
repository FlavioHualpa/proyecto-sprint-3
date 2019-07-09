<?php

   $paises = [
      'ar' => 'Argentina',
      'bo' => 'Bolivia',
      'br' => 'Brasil',
      'ch' => 'Chile',
      'py' => 'Paraguay',
      'uy' => 'Uruguay',
   ];

   require 'validateuser.php';

   $storage = new DbStorage();
   $storage->connect();
   $paises = Pais::selectAll($storage);

   /*
   $dbi_paises = new PaisDbInteract();
   $dbi_paises->connect('test.05.25');
   $dbi_paises->traerPaises();
   */

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/testuser.css">
	<script src="https://kit.fontawesome.com/487b4db8ef.js"></script>
	<title>Agregar Usuario</title>
</head>

<body>
	<div class="contenedor">
		<h1>Registración de usuarios</h1>
		<form method="post" enctype="multipart/form-data">
			<div class="campo-form">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" value="<?= $_POST['nombre'] ?? '' ?>">
				<?php if (isset($errores['nombre'])) : ?>
				<p><i class="fas fa-exclamation-circle"></i><?= $errores['nombre'] ?></p>
				<?php endif ?>
			</div>
			<div class="campo-form">
				<label for="apellido">Apellido</label>
				<input type="text" name="apellido" id="apellido" value="<?= $_POST['apellido'] ?? '' ?>">
				<?php if (isset($errores['apellido'])) : ?>
				<p><i class="fas fa-exclamation-circle"></i><?= $errores['apellido'] ?></p>
				<?php endif ?>
			</div>
			<div class="campo-form">
				<label for="email">Email</label>
				<input type="text" name="email" id="email" value="<?= $_POST['email'] ?? '' ?>">
				<?php if (isset($errores['email'])) : ?>
				<p><i class="fas fa-exclamation-circle"></i><?= $errores['email'] ?></p>
				<?php endif ?>
			</div>
			<div class="campo-form">
				<label for="pais">País</label>
            <select name="pais" id="pais" class="pais">
               <?php foreach ($paises as $pais) : ?>
                  <option value="<?= $pais->getCodigo() ?>" <?= isset($_POST['pais']) && $_POST['pais'] == $pais->getCodigo() ? 'selected' : '' ?>><?= $pais->getNombre() ?></option>
               <?php endforeach ?>
            </select>
				<?php if (isset($errores['pais'])) : ?>
				<p><i class="fas fa-exclamation-circle"></i><?= $errores['pais'] ?></p>
				<?php endif ?>
			</div>
			<div class="campo-form">
				<label for="nacimiento">Fecha de nacimiento</label>
				<input type="date" name="nacimiento" id="nacimiento" value="<?= $_POST['nacimiento'] ?? '' ?>">
				<?php if (isset($errores['nacimiento'])) : ?>
				<p><i class="fas fa-exclamation-circle"></i><?= $errores['nacimiento'] ?></p>
				<?php endif ?>
			</div>
			<div class="campo-form">
				<label>Sexo</label>
				<input type="radio" name="sexo" id="mujer" value="f" <?= isset($_POST['sexo']) && $_POST['sexo'] == 'f' ? 'checked' : '' ?>>
            <label for="mujer">Mujer</label>
				<input type="radio" name="sexo" id="hombre" value="m" <?= isset($_POST['sexo']) && $_POST['sexo'] == 'm' ? 'checked' : '' ?>>
            <label for="hombre">Hombre</label>
				<?php if (isset($errores['sexo'])) : ?>
				<p><i class="fas fa-exclamation-circle"></i><?= $errores['sexo'] ?></p>
				<?php endif ?>
			</div>
         <div class="campo-form">
				<label for="avatar">Foto del perfil</label>
				<input type="file" name="avatar" id="avatar" value="<?= $_POST['avatar'] ?? '' ?>" accept=".jpg,.jpeg,.png,.bmp">
				<?php if (isset($errores['avatar'])) : ?>
				<p><i class="fas fa-exclamation-circle"></i><?= $errores['avatar'] ?></p>
				<?php endif ?>
			</div>
			<div class="campo-form">
				<label for="pass">Contraseña</label>
				<input type="password" name="pass" id="pass" value="<?= $_POST['pass'] ?? '' ?>">
				<?php if (isset($errores['pass'])) : ?>
				<p><i class="fas fa-exclamation-circle"></i><?= $errores['pass'] ?></p>
				<?php endif ?>
			</div>
			<div class="campo-form">
				<label for="passConf">Confirme la contraseña</label>
				<input type="password" name="passConf" id="passConf" value="<?= $_POST['passConf'] ?? '' ?>">
				<?php if (isset($errores['passConf'])) : ?>
				<p><i class="fas fa-exclamation-circle"></i><?= $errores['passConf'] ?></p>
				<?php endif ?>
			</div>
         <div class="campo-form">
				<input type="checkbox" name="terminos" id="terminos" value="s">
            <label for="terminos">He leído y acepto los términos de uso</label>
				<?php if (isset($errores['terminos'])) : ?>
				<p><i class="fas fa-exclamation-circle"></i><?= $errores['terminos'] ?></p>
				<?php endif ?>
			</div>
			<div class="campo-form">
				<button type="submit">Registrarme</button>
			</div>
		</form>
	</div>
</body>

</html>
