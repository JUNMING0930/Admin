<?php
    if(!isset($_SESSION['AID']))
    {
        header("Location: login.php");
    }
?>