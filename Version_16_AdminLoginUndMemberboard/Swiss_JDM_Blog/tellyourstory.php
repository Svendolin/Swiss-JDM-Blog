<?php
  require_once('includes/config.php');        // Serverconfiguration that apply to the whole project
  require_once('includes/mysql-connect.php'); // Initializing the mysql database connection
  require_once('includes/functions.inc.php'); // functions which do include login and signup-functions

  // ----- Users are allowed to see this content when logged in AND logged out: ----- //
  session_start();
  // --x-- Users are allowed to see this content when logged in AND logged out. --x-- //

  // BUT ADDITIONALLY: If the session doesn't run (isnt "setted": don't show "tellyourstory.php and fallback to index.php instead")
  if( !isset($_SESSION['loginstatus'])){ 
    header("location: index.php"); 
    exit(); 
  }

  // $isLoggedIn = sessioncheck();
  // if($isLoggedIn == false){ 
	// header("location: index.php"); 
  // // header("Refresh:0");
	// exit;
  // }
?>

<!---------- Header + Navigation -------------------------------------------------------------------------------------------->
<?php include(INCLUDE_FOLDER.'/header.html.php'); // Use of the constant defined in config.php ?>
<!-----x---- Header + Navigation ----x--------------------------------------------------------------------------------------->

<div class="blog-heading special" data-aos="fade-up" data-aos-delay="200">
  <span>let's hear</span>
  <h1>Your Story:</h1>
</div>


<!-- TODO: Compare the Terry stuff (ABGLEICHEN) -->

  <section id="storytellingform">
    <form action="" class="write-a-post">

      <!-- TITLE INPUT FIELD -->
        <div class="input-field-story">
        <i class="fas fa-highlighter"></i>
          <input type="text" name="post_title" id="fld_title" value="" placeholder="Add your title here..." required> <!-- FIXME: Fixed this one, but pls fix the others too  -->
        </div>

      <!-- IMAGE INPUT FIELD -->
        <div class="input-field-story">
        <i class="fas fa-image"></i>
          <input type="file" name="post_image" id="fld_image" value="">
        </div>

        <!-- TODO: No status -->

      <!-- TIME INPUT FIELD -->  
        <div class="input-field-story">
          <i class="fas fa-clock"></i>
          <input type="text" name="post_created" id="fld_time" value="" placeholder="<?php echo strftime("%d-%m-%Y %H:%M:%S"); ?>">
        </div>

      <!-- AUTHOR INPUT FIELD -->
        <div class="input-field-story">
          <i class="fas fa-user"></i>
          <input type="text" name="post_author" id="fld_author" value="" placeholder="<?php echo($_SESSION["useruid"]); ?>">
        </div>

        <!-- TODO: No Category -->
        <!-- TODO: No Shorttext -->

      <!-- TEXT TEXTAREA -->
        <div class="input-field-story textarea">
        <i class="fas fa-book"></i>
          <textarea id="editor" name="post_longtext" placeholder="Dear Diary"></textarea>
        </div>

        <!-- AUTHOR INPUT FIELD -->
        <div class="buttonsection">
          <a class="btn solid special publish" href="">Publish</a> <!-- THIS will publish the post! -->
          <a class="btn solid special return" href="index.php">Return</a>
          <!-- <input type="submit" value="Publish" class="btn solid special publish">
          <input type="submit" value="Return" class="btn solid special return"> -->
        </div>

        <!--CHECK THIS: -->
        <input type="hidden" name="ID" value="<?php echo $ID; ?>">
    </form>
  </section>

  <!-- TODO: Compare the Terry stuff -->
				
				




<!------------ footer ----------------------------------------------------------------------------------------------------->
<?php include(INCLUDE_FOLDER.'/footer.html.php'); // Use of the constant defined in config.php ?>
<!-----x---- footer ----x-------------------------------------------------------------------------------------------------->