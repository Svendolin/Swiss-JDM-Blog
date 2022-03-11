<?php
// --- signup.inc.php is the included php-information concerning to our signup.php, which is in our case: login.php (One file for two purposes) --- //
// Over here we define the input name=""s in their respective $variables and also define the functions, which will be used later at functions.inc.php
// Additionally we make all the SIGN UP DATABASE STUFF READY:

if (isset($_POST["submit-sign-up"])) { // If the user submitted the RIGHT way, we send him FURTHER...

  // First we get the form data from the URL
  $name = $_POST["name"];
  $username = $_POST["uid"];
  $car = $_POST["car"];
  $state = $_POST["state"];
  $email = $_POST["email"];
  $pwd = $_POST["pwd"];
  $pwdRepeat = $_POST["pwdrepeat"];

  // Then we run a bunch of error handlers to catch any user mistakes we can (you can add more than I did)
  // These functions can be found in functions.inc.php

  require_once('config.php'); // Formerly "dbh.inc.php"
  require_once('mysql-connect.php'); 
  require_once('functions.inc.php');

  // --- This section will do some ERROR HANDLING --- //
  // (We set the functions "!== false (not equal value or same type" since "=== true" has a risk of giving us the wrong outcome)
  // IMPORTANT: All the functions are defined seperately at functions.in.php
  
  if (emptyInputSignup($name, $username, $car, $state, $email, $pwd, $pwdRepeat) !== false) {
    header("location: ../login.php?error=emptyinput");
		exit();
  }

  // TODO: Check about $car and $state (if there is a CONTROL needed)


	// Proper username chosen
  if (invalidUid($username) !== false) {
    header("location: ../login.php?error=invaliduid");
		exit();
  }
  // Proper email chosen
  if (invalidEmail($email) !== false) {
    header("location: ../login.php?error=invalidemail");
		exit();
  }
  // Do the two passwords match?
  if (pwdMatch($pwd, $pwdRepeat) !== false) {
    header("location: ../login.php?error=passwordsdontmatch");
		exit();
  }
  // Is the username taken already?
  if (uidExists($conn, $username, $email) !== false) {
    header("location: ../login.php?error=usernametaken");
		exit();
  }

  // If we get to here, it means there are no user errors

  // Now we insert the user into the database
  createUser($conn, $name, $username, $car, $state, $email, $pwd);

} else {
	header("location: ../login.php"); // If the user submitted the WRONG way, we send him BACK...
    exit();
}

?>

