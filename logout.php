<?php   
session_start();
session_destroy();
unset($_SESSION['AID']);
unset($_SESSION['message']);
header("location: login.php");
exit;


?>