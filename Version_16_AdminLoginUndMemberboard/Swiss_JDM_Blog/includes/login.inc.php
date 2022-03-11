<?php
// --- login.inc.php is the included php-information concerning to our login.php, which is in our case: login.php (One file for two purposes) --- //
// Over here we define the input name=""s in their respective $variables and also define the functions, which will be used later at functions.inc.php
// (Actually the process after we have pushed the submit-sing-in button)
// Additionally we make all the SIGN IN DATABASE STUFF READY:

if (isset($_POST["submit-sign-in"])) {

  // First we get the form data from the URL
  $username = $_POST["uid"];
  $pwd = $_POST["pwd"];

  // echo '<pre>';
	// print_r($username);
	// echo '<pre>';

  // echo '<pre>';
	// print_r($pwd);
	// echo '<pre>';
  

  // Then we run a bunch of error handlers to catch any user mistakes we can (you can add more than I did)
  // These functions can be found in functions.inc.php

  require_once('config.php'); // Formerly "dbh.inc.php"
  require_once('mysql-connect.php');
  require_once('functions.inc.php');

 // Such as the one from functions.inc.php, but simpler with "emptyInputLogin" instead of "emptyInputSignup"
  if (emptyInputLogin($username, $pwd) === true) {
    header("location: ../login.php?error=emptyinputlogin");
		exit();
  }

  // If we get to here, it means there are no user errors

  // Now we insert the user into the database
  loginUser($conn, $username, $pwd);
  

} else {
	header("location: ../login.php");
  // exit();
}















?>