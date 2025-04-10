<?php //Logout the user from the website
session_start();
session_destroy();
header("Location: login.php");
exit;
?>