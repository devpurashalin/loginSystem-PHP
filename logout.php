<?php
setcookie("user", '', time() - 3600);

session_start();
$_SESSION = array();
session_destroy();

header("Location: index.php");
exit();
