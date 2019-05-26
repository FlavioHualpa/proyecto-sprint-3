<?php

session_start();
$_SESSION = [];
setcookie('id', '', -1);

session_destroy();
header('location: index.php');

?>
