<?php
// --- config.php = SQL Serverconfiguration to PHPMyAdmin (dbh - Databasehandler) --- //


// SQL define() configurations
define( 'DBSERVER', 'localhost' );
define( 'DBUSER', 'root' ); 
define( 'DBPASSWORT', '' ); // ('root' for MAMP)
define( 'DBNAME', 'swiss_jdm_blog' );  // Adjusted data (Name of database must be equal in PHPMyAdmin)

define( 'SQLDEBUG', true ); 

define( 'SESSION_EXPIRY', 15 );  // 15*60 seconds (in functions.inc.php)
// define( 'CUSTOM_SESSIONNAME', 'jdmsessioncookie' ); // Not needed


// Defined main-path to the blog
define('INCLUDE_FOLDER', 'includes/html'); // Folder of the HTML includes
define( 'LIVE_SITE', 'Swiss_JDM_Blog' ); // IMPORTANT: SPECIFY ORDERNAME (PATH) EXACTLY from htdocs (without htdocs as first instance) otherwhise the file_sites wont work!


define( 'IMAGEFOLDER', 'blogpost_images' );
define( 'IMAGEFOLDERPATH', $_SERVER['DOCUMENT_ROOT'].'/'.LIVE_SITE.'/'.IMAGEFOLDER ); // diesen Ordner musst du anpassen {GEHT NICHT}

define( 'PROFILEIMAGEFOLDER', 'user_images' );
define( 'PROFILEIMAGEFOLDERPATH', $_SERVER['DOCUMENT_ROOT'].'/'.LIVE_SITE.'/'.PROFILEIMAGEFOLDER );

define( 'HTMLFOLDER', $_SERVER['DOCUMENT_ROOT'].'/'.LIVE_SITE.'/includes/html' ); // diesen Ordner musst du anpassen {GEHT NICHT}


?>