<?php  
session_start();
session_destroy();
session_unset();

setcookie('key', '', time() - 3600);
setcookie('code', '', time() - 3600);

header("Location: login.php?err=4");

?>