<?php
session_start();


$_SESSION = array();


session_destroy();


header('Location: index.php');
exit();

/// cited from https://www.studentstutorial.com/php/login-logout-with-session
?>
