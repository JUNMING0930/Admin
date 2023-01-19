<?php
session_start();
if(isset($_POST['logout']))
{
    session_destroy();
    unset($_SESSION['Email']);
    header("location: login.php");
    exit;
}

?>