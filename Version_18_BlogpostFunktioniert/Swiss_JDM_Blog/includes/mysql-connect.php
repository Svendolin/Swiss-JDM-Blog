<?php
// --- mysql-connect.php = SQL Serverconfiguration to PHPMyAdmin (CONNECTED TO config.php) --- //

// SQL Conncection
if( defined('DBSERVER') && defined('DBUSER') && defined('DBPASSWORT') && defined('DBNAME') ){
	$conn = mysqli_connect(DBSERVER, DBUSER, DBPASSWORT, DBNAME); // $conn = Connection to our Database with this mysqli function ($conn will appear all over this file)
	
	if ($conn == false){
		$dbgmsg = '';
		if(SQLDEBUG == true){ 
			$dbgmsg = 'MySQL server said: '.mysqli_connect_error(); // mysqli error-function
		}
		die('Connection to Database wasnt successful. '.$dbgmsg);
	}
}else{
	die('Data of configuration not found or login data is missing'); 
}
?>