<?php
// --- functions.inc.php has a bunch of different functions in it that we can reference to in order to do things in out website --- //
// This involves our login.inc.php AND signup.inc.php
// It's a pure php-document, there are no further closing php-tags
// We check as ERRORS first: "Does it NOT return us true?" TRUE means here: We made a mistake!

// ------------------------------------ SIGNUP STUFF ------------------------------------ //
// ---------------------- Function 1: Check for empty input signup ---------------------- //
function emptyInputSignup($name, $username, $car, $state, $email, $pwd, $pwdRepeat) {
	
	if (empty($name) || empty($username) || empty($car) || empty($state) || empty($email)  || empty($pwd) || empty($pwdRepeat)) {
		$result = true;		// We made a mistake
	}
	else {
		$result = false;  // No errors were done ( so: false is correct)
	}
	return $result;
}

// ---------------------- Function 2: Check invalid username ---------------------- //
function invalidUid($username) {
	
	if (!preg_match("/^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$/", $username)) { // CHECK if there are (as well if there are not) certain characters
		$result = true; 	// We made a mistake
	}
	else {
		$result = false;  // No errors were done
	}
	return $result;
}

// ---------------------- Function 3: Check invalid email ----------------------  //
function invalidEmail($email) {
	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //STATEMENT that we check as ERRORS first: "Does it NOT return us true?"
		$result = true;  // We made a mistake
	}
	else {
		$result = false; // No errors were done
	}
	return $result;
}

// ---------------------- Function 4: Check if passwords matches ---------------------- //
function pwdMatch($pwd, $pwdrepeat) {
	
	if ($pwd !== $pwdrepeat) { // CHECK if we made a mistake that the password is not equal to the repeated password
		$result = true;  // We made a mistake
	}
	else {
		$result = false; // No errors were done
	}
	return $result;
}

// ---------------------- Function 5.1: Check if username or email is in database, if so then return data and we can sign the user up at 5.2 ---------------------- //
/* 
	Note: ? is a placeholder because we used prepares statements ($sql line)
	Thats why we: 
		1) Send the SQL statement to the database first
		2) Fill in the ?-placeholders later on
		3) Adding prepared statements to make the forms secure (avoid writing code in an input field for example)

*/
function uidExists($conn, $username, $email) {
  $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;"; // Prepare Statement (CUDR Read Operator): (usersUid and usersEmail are field names (seen in phpmyadmin))
	$stmt = mysqli_stmt_init($conn); // Prepared statement: Iniitialize to the database = $conn
	if (!mysqli_stmt_prepare($stmt, $sql)) { //CHECK if the prepare statement will fail before we see that it will succeed
	 	header("location: ../login.php?error=stmtfailed");
		exit();
	}

	// Passing data from the user if it does not fail:
	mysqli_stmt_bind_param($stmt, "ss", $username, $email);
	mysqli_stmt_execute($stmt);

	// "Get result" returns the results from a prepared statement
	$resultData = mysqli_stmt_get_result($stmt); // $stmt = Our prepared statement / "ss" = Type of Data? Double string, username and email = basic text / 

	// fetching the data (if the columns are set to their names)
	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row; // This shows "true": $row will be executed, so if its true the fetch assoc will work and the process works
	}
	else {
		$result = false;
		return $result;
	}

	mysqli_stmt_close($stmt);
}

// ---------------------- Function 5.2: Sign up the user IF NO ERRORS OCCURE (5.2 is almost identical with 5.1) ---------------------- //

// FIXME: Romoved all the stuff to login.php


// --x--------------------------------- SIGNUP STUFF ---------------------------------x-- //
// ------------------------------------ LOGIN STUFF ------------------------------------- //


// ---------------------- Function 1: Check for empty input sign-in (SIGN IN SECTION) ---------------------- //
function emptyInputLogin($username, $pwd) {

	if (empty($username) || empty($pwd)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

// ---------------------- Function 2 : Login the user if everything matches ---------------------- //
function loginUser($conn, $username, $pwd) {
	$uidExists = uidExists($conn, $username, $username); // Check if email OR username already exist in the database. Doubled means: we can handle that as true or false

	// Error handler. Check if the user does exist, $uidExists connects the $conn, username and email check (as shown above):
	if ($uidExists === false) {
		header("location: ../login.php?error=wronglogin");
		exit();
	}

	$pwdHashed = $uidExists["usersPwd"]; // usersPwd is the passwort field inside of our users table of our database
	$checkPwd = password_verify($pwd, $pwdHashed); // If it matches = true, if not = false, logically

	
	// echo '<pre>';
	// print_r($_checkPwd);
	// echo '<pre>';



	// Check if the entered password of the user does not match (is false) to its password in the database:
	if ($checkPwd === false) {
		header("location: ../login.php?error=wronglogin");
		exit();
	}

	//...if it matches, the login can start with a SESSION START:
	else if ($checkPwd === true) {
		session_start();  
		$_SESSION["userid"] = $uidExists["usersId"];
		$_SESSION["useruid"] = $uidExists["usersUid"];
		$_SESSION['loginstatus'] = true; // logintsatus speichern
		$_SESSION['lastactivity'] = time(); // timestamp in session
		$_SESSION['login_useragent'] = $_SERVER['HTTP_USER_AGENT'];
		

		header("location: ../index.php"); // THAT's the possitive target! ✅
		// exit();
	}
}

function session_init(){
	// session_name(CUSTOM_SESSIONNAME); // Changes the name of the session cookie, not active here
	session_start();// Initialized a session_start
	// session_regenerate_id(); // Changes the value of the session ID and cookie each time, not active here
}


function sessioncheck(){
	$session_laufzeit = SESSION_EXPIRY*60; // config defined at 3*60 = 60 seconds timeout
	
	
	// prüfen, ob der User agent noch gleich ist wie beim Login
	if( $_SESSION['login_useragent'] !== $_SERVER['HTTP_USER_AGENT'] ){
		$_SESSION['loginstatus'] = false;
	}

	// prüfen, wann der user das letzte mal aktiv war
	if( $_SESSION['lastactivity'] < time()-$session_laufzeit ){
		$_SESSION['loginstatus'] = false;
	}

	// prüfen, ob der Besucher eingeloggt ist, nur dann darf die Seite angezeigt werden
	if( $_SESSION['loginstatus'] !== true ){
		// wenn die Session nicht existiert oder der timestamp weiter zurückliegt als die erlaubte laufzeit (= kein Zugriff)...
			
		// ausloggen (Session zurücksetzen)
		setcookie (session_name(), null, -1, '/');
		session_destroy();
		session_write_close();
		
		// auf das login umleiten
		return false;
	}
	
	session_regenerate_id(); // neue ID für meine Session - hacker kann die alte nun nicht mehr brauchen, falls er sie hat.
	$_SESSION['lastactivity'] = time(); // aktualisieren des Timestamp TODO: LASTACTIVITY
	return true; 
}

// --x--------------------------------- LOGIN STUFF ----------------------------------x-- //
// ------------------------------------ ADMIN LOGIN-STUFF ------------------------------------ //

/* SIDE NOTE: session_init() and session_check() from above is used for the admin login as well */
function adminIdExists($conn, $adminname, $adminemail) {
  $sql = "SELECT * FROM admin WHERE admin_name = ? OR admin_email = ?;"; // Prepare Statements = ?
	$stmt = mysqli_stmt_init($conn); // Prepared statement: Iniitialize to the database = $conn
	if (!mysqli_stmt_prepare($stmt, $sql)) { //CHECK if the prepare statement will fail before we see that it will succeed
	 	header("location: ../login.php?error=stmtfailed");
		exit();
	}

	// Passing data from the user if it does not fail:
	mysqli_stmt_bind_param($stmt, "ss", $adminname, $adminemail);
	mysqli_stmt_execute($stmt);

	// "Get result" returns the results from a prepared statement
	$resultData = mysqli_stmt_get_result($stmt); // $stmt = Our prepared statement / "ss" = Type of Data? Double string, username and email = basic text / 

	// fetching the data (if the columns are set to their names)
	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row; // This shows "true": $row will be executed, so if its true the fetch assoc will work and the process works
	}
	else {
		$result = false;
		return $result;
	}

	mysqli_stmt_close($stmt);
}

// --x--------------------------------- ADMIN LOGIN-STUFF ---------------------------------x-- //

?>