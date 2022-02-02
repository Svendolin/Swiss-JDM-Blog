<?php
// --- functions.inc.php has a bunch of different functions in it that we can reference to in order to do things in out website --- //
// This involves our login.inc.php AND signup.inc.php
// It's a pure php-document, there are no further closing php-tags
// We check as ERRORS first: "Does it NOT return us true?" TRUE means here: We made a mistake!

// ------------------------------------ SIGNUP STUFF ------------------------------------ //
// ---------------------- Function 1: Check for empty input signup ---------------------- //
function emptyInputSignup($name, $username, $car, $state, $email, $pwd, $pwdRepeat) {
	$result;
	if (empty($name) || empty($username) || empty($car) || empty($state) || empty($email)  || empty($pwd) || empty($pwdRepeat)) {
		$result = true;		// We made a mistake
	}
	else {
		$result = false;  // No errors were done
	}
	return $result;
}

// ---------------------- Function 2: Check invalid username ---------------------- //
function invalidUid($username) {
	$result;
	if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) { // CHECK if there are (as well if there are not) certain characters
		$result = true; 	// We made a mistake
	}
	else {
		$result = false;  // No errors were done
	}
	return $result;
}

// ---------------------- Function 3: Check invalid email ----------------------  //
function invalidEmail($email) {
	$result;
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
	$result;
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
function createUser($conn, $name, $username, $car, $state, $email, $pwd) {
  $sql = "INSERT INTO users (usersName, usersUid, usersCar, usersState, usersEmail, usersPwd) VALUES (?, ?, ?, ?, ?, ?);"; // Prepare Statement (CUDR CREATE Operator):

	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../login.php?error=stmtfailed");
		exit();
	}

	$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT); // (*)

	mysqli_stmt_bind_param($stmt, "ssssss", $name, $username, $car, $state, $email, $hashedPwd); // (*) Changed variable $pwd to $hashedPwd here for extra safety
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	// Direction to the user if he SIGNED UP CORRECTLY (with a successmessage)
	header("location: ../login.php?error=none"); // The user returns back to sign.up , the page reloads new, the fields are empty again and the successmessage will follow up :
	exit();
}

// --x--------------------------------- SIGNUP STUFF ---------------------------------x-- //
// ------------------------------------ LOGIN STUFF ------------------------------------- //


// ---------------------- Function 1: Check for empty input sign-in (SIGN IN SECTION) ---------------------- //
function emptyInputLogin($username, $pwd) {
	$result;
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

	// Check if the entered password of the user does not match (is false) to its password in the database:
	if ($checkPwd === false) {
		header("location: ../login.php?error=wronglogin");
		exit();
	}
	//...if it matches, the login can start with a SESSION START:
	elseif ($checkPwd === true) {
		session_start();
		$_SESSION["userid"] = $uidExists["usersId"];
		$_SESSION["useruid"] = $uidExists["usersUid"];
		header("location: ../index.php");
		exit();
	}
}

// --x--------------------------------- LOGIN STUFF ----------------------------------x-- //
