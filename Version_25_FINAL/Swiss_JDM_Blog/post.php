<?php
require_once('includes/config.php');        // Serverconfiguration that apply to the whole project
require_once('includes/mysql-connect.php'); // Initializing the mysql database connection
require_once('includes/functions.inc.php'); // functions which do include login and signup-functions

// ----- Users are allowed to see this content when logged in AND logged out: ----- //
session_start();
// --x-- Users are allowed to see this content when logged in AND logged out. --x-- // 

if (empty($_GET['article'])) {
  header("Location: index.php");
}


$urlparts = explode(':', $_GET['article']);
// print_r($urlparts);
$articleID = $urlparts[0];
$articleAlias = $urlparts[1];
if ((int)$articleID == 0) {
  header("Location: index.php");
}

// Daten auslesen
$query = "SELECT * FROM blogpost WHERE IDblogpost=" . $articleID;
$res = mysqli_query($conn, $query);
$post = mysqli_fetch_assoc($res);





?>

<!---------- Header + Navigation -------------------------------------------------------------------------------------------->
<?php include(INCLUDE_FOLDER . '/header.html.php'); // Use of the constant defined in config.php 
?>
<!-----x---- Header + Navigation ----x--------------------------------------------------------------------------------------->

<!-- Blog Section -->
<section id="blog">
  <!-- Blog-Heading -->
  <div class="blog-heading" data-aos="fade-up" data-aos-delay="200">
    <span>let's read</span>
    <h1>My Story</h1>
  </div>

  <?php if( isset($post) && is_array($post) ) { ?>

  <!-- Blog-Container and Boxes -->
  <div class="blog-container">
    <div class="blog-box" data-aos="zoom-in" data-aos-delay="300">
      <div class="blog-img">
        <?php if (!empty($post['post_image'])) { ?>
          <img src="<?php echo IMAGEFOLDER . '/' . $post['post_image']; ?>" />
        <?php } ?>
      </div>
      <div class="blog-text">
        <span><time><?php echo $post['post_created']; ?></time> by: <?php echo $post['post_author']; ?></span>
        <h2><?php echo stripslashes($post['post_title']); ?></h2>
        <p><?php echo stripslashes($post['post_longtext']); ?></p>
      </div>
      <a href="index.php" class="btn back">Return</a>
    </div>
  </div>

  <?php } ?>

</section>


<!------------ footer ----------------------------------------------------------------------------------------------------->
<?php include(INCLUDE_FOLDER . '/footer.html.php'); // Use of the constant defined in config.php 
?>
<!-------x---- footer ----x------------------------------------------------------------------------------------------------>