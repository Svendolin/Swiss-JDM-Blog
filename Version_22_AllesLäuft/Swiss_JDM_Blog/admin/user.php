<?php
require_once('../includes/config.php');        // Serverconfiguration that apply to the whole project
require_once('../includes/mysql-connect.php'); // Initializing the mysql database connection
require_once('../includes/functions.inc.php'); // functions which refers to session_init() and session_check()

// ----- Users are allowed to see this content when they're logged in ONLY ----- //
session_init();
// $usertype = $_POST["admin_usertype"];
$isLoggedIn = sessioncheck();
  if($isLoggedIn == false){ 
    // if($usertype !== 1)
	// schüztt dieses Script vor Zurgriff ohne Login
	header("location: ../admin/login.php"); 
	exit;
  }
  // --x-- Users are allowed to see this content when they're logged in ONLY --x-- // 
?>

<!---------- Header + Navigation -------------------------------------------------------------------------------------------->
<?php include('html/start-logout.php'); // Use of the html admin folder ?>
<!-----x---- Header + Navigation ----x--------------------------------------------------------------------------------------->


<section id="admin-control">

    

</section>


<!------------ footer ----------------------------------------------------------------------------------------------------->
<?php include('html/end-clean-end.php'); // Use of the html admin folder ?>
<!-----x---- footer ----x-------------------------------------------------------------------------------------------------->