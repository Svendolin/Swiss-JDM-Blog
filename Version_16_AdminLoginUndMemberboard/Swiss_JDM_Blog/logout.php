<?php
  require_once('includes/config.php');        // Serverconfiguration that apply to the whole project
  require_once('includes/mysql-connect.php'); // Initializing the mysql database connection
  require_once('includes/functions.inc.php'); // functions which do include login and signup-functions 

  session_start();
  session_unset();
  session_destroy();

  // Redirect to login.php if the user wants to logout:
  header('location: index.php');
  exit();
?>
