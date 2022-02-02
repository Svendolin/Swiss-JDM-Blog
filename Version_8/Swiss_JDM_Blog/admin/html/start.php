<?php
// HTML output of the header without a dynamic navigation state
?>

<!DOCTYPE html>
<html lang="en">
<head> <!-- close here to clean the code visually -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-------------------------------------- BASIC HTML5 TAG FOR RESPONSIVENESS -------------------------------------->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-------------------------------------- META TAG -------------------------------------->
  <meta name="keywords" content="JDM Blog Website using PHP and MySQL">
  <meta name="description" content="This SAE Modul Project needs to be build up with PHP and MySQL so here we go :D">
  <meta name="author" content="Svendolin">
  <title>Swiss JDM Blog</title>
  <!-------------------------------------- CDN FONTAWESOME ICONS (Keep me updated) -------------------------------------->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-------------------------------------- GOOGLE FONTS LINK -------------------------------------->
  <link href="https://fonts.googleapis.com/css2?family=Abel&family=Lexend:wght@200;300;400;500;700&family=Nunito:wght@300;400;600;700;800&family=Permanent+Marker&display=swap" rel="stylesheet">
  <!-------------------------------------- OWL-CAROUSEL -------------------------------------->
  <link rel="stylesheet" type="text/css" media="screen" href="../theme/css/owl.carousel.min.css">
  <link rel="stylesheet" type="text/css" media="screen" href="../theme/css/owl.theme.default.min.css">
  <!-------------------------------------- AOS Library CSS ---------------------------------->
  <!-- (Animate on scroll) https://michalsnik.github.io/aos/ > download > dist > copy aos.js and aos.css -->
  <link rel="stylesheet" href="../theme/css/aos.css">
  <!-------------------------------------- CSS LINKS -------------------------------------->
  <link rel="stylesheet" type="text/css" media="screen" href="../theme/css/variables.css">
  <link rel="stylesheet" type="text/css" media="screen" href="../theme/css/style.css">
  
  <!-------------------------------------- CSS LINK TO SEPERATE MEDIA QUERY PAGE -------------------------------------->
  <link rel="stylesheet" type="text/css" media="screen" href="../theme/css/mediaqueries.css">
  <!-------------------------------------- Favicon -------------------------------------->
  <link rel="apple-touch-icon" sizes="57x57" href="../favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="../favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="../favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="../favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="../favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="../favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="../favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="../favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="../favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="../favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <!-------------------------------------- JQUERY / JAVASCRIPT CONNECTION -------------------------------------->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
  <!-------------------------------------- OWL-CAROUSEL JQUERY -------------------------------------->
  <script src="../theme/javascript/owl.carousel.min.js" defer></script>
  <!-------------------------------------- AOS Library JS -------------------------------------->
  <script src="../theme/javascript/aos.js" defer></script>
  <!-------------------------------------- JS CONNECTION -------------------------------------->
  <script src="../theme/javascript/main.js" defer></script>
</head>
<body>
  <!--------- NAVIGATION ------------------------------------------------------------------------------------------>
  
  <nav class="nav">
    <div class="nav-menu flex-row">
      <div class="nav-brand">
        <a href="../index.php">Swiss JDM Blog</a> <!-- text or image -->
      </div>
      <!-- toggle burger -->
      <!-- <div class="toggle-collapse">
        <div class="toggle-icons">
          <i class="menu-toggle-btn fas fa-bars"></i> 
        </div>
      </div> -->
      <!-- <div>
        <ul class="nav-items">
          <li class="nav-link">
            <a href="../index.php" class="home">Return to main page</a>
          </li>
          <li class="nav-link">
            <a href="blogposts.php">Blogposts</a>
          </li>
          <li class="nav-link">
            <a href="../memberboard.php" class="member">Memberboard</a>
          </li>
        </ul>
      </div> -->
      
      <!-- <div class="login text-gray">
        <a href="../login.php">Login</a>
      </div> -->
    </div>
  </nav>

  <!---x---- NAVIGATION ----x-------------------------------------------------------------------------------------->