<?php 
include "check_login.php";

echo "<pre>";
print_r($_SESSION);
echo "</pre>";
?>
<button onclick="window.location.href='logout.php'">Logout</button>