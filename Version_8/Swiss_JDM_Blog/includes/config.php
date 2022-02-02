<?php
// --- config.php = SQL Serverconfiguration to PHPMyAdmin (dbh - Databasehandler) --- //


// SQL define() configurations
define( 'DBSERVER', 'localhost' );
define( 'DBUSER', 'root' ); 
define( 'DBPASSWORT', '' ); // ('root' for MAMP)
define( 'DBNAME', 'swiss_jdm_blog' );  // Adjusted data (Name of database must be equal in PHPMyAdmin)

define( 'SQLDEBUG', true ); 


define( 'SESSION_EXPIRY', 15 );
define( 'CUSTOM_SESSIONNAME', 'myOwnSessionCookieKey' );

// Defined main-path to the blog
define('INCLUDE_FOLDER', 'includes/html'); // Folder of the HTML includes
define( 'LIVE_SITE', 'Swiss_JDM_Blog' ); // IMPORTANT: SPECIFY ORDERNAME (PATH) EXACTLY from htdocs (without htdocs as first instance)

// TODO: Not proven! (Take care)
define( 'IMAGEFOLDER', 'user-images' );
define( 'IMAGEFOLDERPATH', $_SERVER['DOCUMENT_ROOT'].'/'.LIVE_SITE.'/'.IMAGEFOLDER ); // diesen Ordner musst du anpassen {GEHT NICHT}

define( 'HTMLFOLDER', $_SERVER['DOCUMENT_ROOT'].'/'.LIVE_SITE.'/includes/html' ); // diesen Ordner musst du anpassen {GEHT NICHT}


?>