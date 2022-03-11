<?php
require_once('../includes/config.php');        // Serverconfiguration that apply to the whole project
require_once('../includes/mysql-connect.php'); // Initializing the mysql database connection
require_once('../includes/functions.inc.php'); // for session_init() / session_check() and adminIdExists()

// ----- Users are allowed to see this content when logged in AND logged out: ----- //
session_start();
// --x-- Users are allowed to see this content when logged in AND logged out. --x-- // 

// -- Check if sign-in input is set... -- //
if (isset($_POST["admin-submit-sign-in"])) {

  // First we get the form data from the URL
  $adminname = $_POST["admin_name"];
	$adminemail = $_POST["admin_email"];
  $adminpwd = $_POST["admin_password"];

  if (emptyInputAdminLogin($adminname, $adminpwd) === true) {
    header("location: ../admin/login.php?error=emptyinputlogin");
		exit();
  }
 	// Now we insert the user into the database
  loginAdmin($conn, $adminname, $adminpwd);
 } 
 
// -- Function 1: Check for empty input sign-in -- //
function emptyInputAdminLogin($adminname, $adminpwd) {
	$result;
	if (empty($adminname) || empty($adminpwd)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

// -- Function 2: Check for empty input sign-in -- //
function loginAdmin($conn, $adminname, $adminpwd) {
	$adminIdExists = adminIdExists($conn, $adminname, $adminname); // Check if email OR username already exist in the database. Doubled means: we can handle that as true or false

	// Error handler. Check if the user does exist, $uidExists connects the $conn, username and email check (as shown above):
	if ($adminIdExists === false) {
		header("location: ../admin/login.php?error=wronglogin"); 
		exit();
	}
  // echo '<pre>';
	// print_r($adminIdExists);
	// echo '<pre>';

	$pwdHashed = $adminIdExists["admin_password"]; // usersPwd is the passwort field inside of our users table of our database
	$checkPwd = password_verify($adminpwd, $pwdHashed); // If it matches = true, if not = false, logically

	// echo '<pre>';
	// print_r($_checkPwd);
	// echo '<pre>';

	// Check if the entered password of the user does not match (is false) to its password in the database:
	if ($checkPwd === false) {
		header("location: ../admin/login.php?error=wronglogin");
		exit();
	}

	//...if it matches, the login can start with a SESSION START:
	else if ($checkPwd === true) {
		session_start();  
		$_SESSION["adminid"] = $adminIdExists["IDadmin"];
		$_SESSION["adminuid"] = $adminIdExists["admin_name"];
		$_SESSION['loginstatus'] = true; // logintsatus speichern
		$_SESSION['lastactivity'] = time(); // timestamp in session
		$_SESSION['login_useragent'] = $_SERVER['HTTP_USER_AGENT'];	

		header("location: ../admin/index.php"); // THAT's the possitive target! ✅
		// exit();
	}
}

// echo password_hash("adminPW1234!!", PASSWORD_DEFAULT); 
// IMPORTANT: to enter into your admin login, use: Sven Kamm OR sven0815@gmx.ch AND adminPW1234!!



?>

<!---------- Header + Navigation -------------------------------------------------------------------------------------------->
<?php include('html/start.php'); // Use of the html admin folder ?>
<!-----x---- Header + Navigation ----x--------------------------------------------------------------------------------------->


<section id="admin-login">

    <div class="center">
      <h1>Login</h1>

      <form method="post">
        <div class="txt_field">
          <input type="text" name="admin_name" id="fld_username" value="" required>
          <span></span>
          <label>*Username</label>
        </div>
        <div class="txt_field">
          <input type="password" name="admin_password" id="fld_pw" value="" required>
          <span></span>
          <label>*Password</label>
        </div>
        <div class="emptyspace"></div>
        <div class="buttonarea">
          <input type="submit" name="admin-submit-sign-in" value="Sign In" class="btn-special-sign-in"></input> <!-- For an input: "value" gives the text -->
          <a href="../index.php" name="admin-return" class="btn-special-return">Return</a>
        </div>
        </div>
      </form>
    </div>
</section>



<!------------ footer ----------------------------------------------------------------------------------------------------->
<?php include('html/end.php'); // Use of the html admin folder ?>
<!-----x---- footer ----x-------------------------------------------------------------------------------------------------->