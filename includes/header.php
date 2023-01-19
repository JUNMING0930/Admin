<?php include("Functions/Getdatafunction.php")?>
<?php session_start()?>
<?php include("security.php")?>
<!DOCTYPE html>
<html lang="en">
  <head>


<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<title>

<?php
if(isset($page_title))
{
  echo "$page_title";
}
else
{
  echo "error!";
}
?>
  
</title>



<!--     Fonts and icons     -->
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

<!-- Nucleo Icons -->
<link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
<link href="./assets/css/nucleo-svg.css" rel="stylesheet" />

<!-- Font Awesome Icons -->
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

<!-- Material Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

<!-- CSS Files -->



<link id="pagestyle" href="assets/css/material-dashboard.min.css" rel="stylesheet" />





  </head>


  <body class="g-sidenav-show  bg-gray-100">
   <?php include('slidebar.php') ?> 
  <main class="main-content border-radius-lg ">
  <?php include('navigationbar.php') ?> 
  