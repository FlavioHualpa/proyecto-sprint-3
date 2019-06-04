<?php

session_start();
$_SESSION = [];
//setcookie('usuario', '', -1);

session_destroy();
header('location: index.php');

?>
