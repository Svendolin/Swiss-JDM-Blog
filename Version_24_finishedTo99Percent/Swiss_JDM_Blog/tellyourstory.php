<?php
require_once('includes/config.php');        // Serverconfiguration that apply to the whole project
require_once('includes/mysql-connect.php'); // Initializing the mysql database connection
require_once('includes/functions.inc.php'); // functions which do include login and signup-functions

// ----- Users are allowed to see this content when logged in AND logged out: ----- //
session_start();
// --x-- Users are allowed to see this content when logged in AND logged out. --x-- //

// BUT ADDITIONALLY: If the session doesn't run (isnt "setted": don't show "tellyourstory.php and fallback to index.php instead")
if (!isset($_SESSION['loginstatus'])) {
  header("location: index.php");
  exit();
}

// $isLoggedIn = sessioncheck();
// if($isLoggedIn == false){ 
// header("location: index.php"); 
// // header("Refresh:0");
// exit;
// }

// ----- PHP AREA to create NEW BLOG ENTRIES ----- //



$hasError = false;
$errorMsg = array();

$ID = '';
$title = '';
$author = '';
$text = '';
$image = '';

// ID Variable out of GET
if (isset($_GET['id'])) {
  $ID = $_GET['id'];
}

// MySQL Operation: Time to read what belongs to this database
if (!empty($ID)) {
  $query = "SELECT * FROM blogpost WHERE IDblogpost=" . $ID;
  $res = mysqli_query($conn, $query);
  $datapieces = mysqli_fetch_assoc($res);

  $title = $datapieces['post_title'];
  // $created = $datapieces['post_created'];
  $author = $datapieces['post_author'];
  $text = $datapieces['post_longtext'];
  $image = $datapieces['post_image'];
}



// Check if data was sent via POST (from the form / post_image will be involved later on)
if (isset($_POST['post_title']) && isset($_POST['post_author']) && isset($_POST['post_longtext'])) { // && isset($_POST['post_created'])

 


  // strip_tags prevents code injection by removing all tags.
  // (((mysqli_real_escape_string))) prevents problems with inverted commas in the string by escaping, as for example with "That's it!"
  $title = strip_tags(mysqli_real_escape_string($conn, $_POST['post_title']));
  // $created = (empty($_POST['post_created'])) ? strftime("%d.%m.%Y %H:%M:%S") : strip_tags(mysqli_real_escape_string($conn, $_POST['post_created']));
  $author = strip_tags($_POST['post_author']);
  $text = strip_tags( mysqli_real_escape_string($conn, $_POST['post_longtext'])); // All tags offered by the editor are excluded from removing...
  $ID = (int)$_POST['ID'];
  
  // echo '<pre>';
  // print_r ($_POST);
  // echo '</pre>';

  //  Mandatory field Validation with error handlers:
  if (empty($title)) {
    $errorMsg[] = 'Please enter a title';
    $hasError = true;
  }
  if (empty($author)) {
    $errorMsg[] = 'Please enter name of the author';
    $hasError = true;
  }
  // if ($author !== $_SESSION["useruid"]) {
  //   $errorMsg[] = '(Wrong Username)';
  //   $hasError = true;
  // }

  // --- IMAGEUPLOAD-PART --- //
  if (isset($_FILES['post_image']) && !empty($_FILES['post_image']['tmp_name'])) {
    // get / move from tmp folder
    // print_r($_FILES['post_image']);
    $newImage = 'postimage_' . time() . '.jpg'; // Single image name (for DB entry)
    $src = $_FILES['post_image']['tmp_name']; // Temporary path
    $dest = IMAGEFOLDERPATH . '/' . $newImage; // Destination path (defined in Config)

    // Move the file to the destination path
    $hochgeladen = move_uploaded_file($src, $dest);
    // var_dump($hochgeladen);

    // Delete old image
    if (!empty($image)) {
      unlink(IMAGEFOLDERPATH . '/' . $image); // Destination path (defined in Config)
    }
  }




  if (!$hasError) {

    // Saving the data to the database
    if (empty($ID)) {
      $addImageField = empty($newImage) ? "" : ", post_image"; // Addition for image, only if image has been uploaded
      $addImageValue = empty($newImage) ? "" : ", ?"; // Addition for image, only if image has been uploaded

      /*
      Basic sequence with prepared statements '?'

      The execution of a prepared instruction consists of two phases: 
      1) preparation and 2) execution. 
      
      1)In the preparation phase, a statement template is sent to the database server. 
      The server performs a syntax check and initialises server-internal resources for later use.
      The MySQL server supports the use of the anonymous, position-related placeholder ?

      2) Preparation is followed by execution. 
      During execution, the client binds the parameter values and sends them to the server. 
      The server executes the statement with the bound values using the previously created internal resources.

      So we should be safe from SQL-Injections now :D
      */

      $query = "INSERT INTO blogpost (post_title, post_author, post_longtext {$addImageField})
         VALUES 
         (?, ?, ? {$addImageValue})"; // (MINUS one '?')

      $res = mysqli_prepare($conn, $query); // Prepare the server for the command to be executed (without data)

      if (empty($newImage)) {
        // WITHOUT image (but that wont actually happen due to required input):
        mysqli_stmt_bind_param($res, 'sss', $title, $author, $text); // send the data to the server // ($created and 's')
      } else {
        // WITH image:
        mysqli_stmt_bind_param($res, 'ssss', $title, $author, $text, $newImage); // send the data to the server // ($created and 's')
      }
      mysqli_stmt_execute($res); // Execute command with the sent data
      $result = mysqli_stmt_get_result($res); // Result object "pick up


      // Send command and check...
      $newID = mysqli_insert_id($conn);
    } else { // The place to EDIT a blogpost:
      $query = "UPDATE `blogpost` 
         SET 
         `post_title` = '{$title}',
         `post_author` = '{$author}',
         `post_longtext` = '{$text}'";

      // --  `post_created` = '{$created}',
      // only if image has been uploaded
      if (!empty($newImage)) {
        $query .= ",
           `post_image` = '{$newImage}'";
      }
      $query .= " WHERE `IDBlogpost` = {$ID}";
      $res = mysqli_query($conn, $query);
    }
    // die($query);

    if (!empty($newImage)) {
      $image = $newImage;
    }

    //FIXME: We got an ERROR HERE 
    if (!$res) {
      $hasError = true;
      $dbgmsg = '';
      if (SQLDEBUG == true) {
        $dbgmsg = mysqli_error($conn);
      }
      $errorMsg[] = 'Saving failed.' . $dbgmsg;
    }
  }

  // has worked (so: if hasError wrong...then..)
  if (!$hasError) {
    $successMsg = "Hurray! Your post is successfully published!";
  }
}
// --X-- PHP AREA to create NEW BLOG ENTRIES --X-- //

?>

<!---------- Header + Navigation -------------------------------------------------------------------------------------------->
<?php include(INCLUDE_FOLDER . '/header.html.php'); // Use of the constant defined in config.php 
?>
<!-----x---- Header + Navigation ----x--------------------------------------------------------------------------------------->

<div class="blog-heading special" data-aos="fade-up" data-aos-delay="200">
  <hr class="upperline">
  <span>let's hear</span>
  <h1>Your Story:</h1>
  <hr class="lowerline-one">
  <hr class="lowerline-two">
</div>


<!----- BLOG ENTRY INPUT FORM ------------------------------------------------------------------------->

<section id="storytellingform">
  <!--IMPORTANT: Be sure to specify method="POST" (hidden from URL) or "GET" (shown in the url), otherwhise nothing will work propperly -->
  <form action="" method="POST" class="write-a-post" enctype="multipart/form-data">
    <!-- DONT FORGET THE ENCTYPE(*) (otherwhise the image ipload wont work!) -->
    <!-- (*) The enctype attribute specifies how the form-data should be encoded when submitting it to the server. -->

    <!----- BLOG ENTRY ERROR MESSAGES ------------------------------------>

    <?php if ($hasError == true) { ?>
      <div class="error-message-publish">
        <p><i class='fas fa-exclamation-circle'></i> <?php echo implode('<br>', $errorMsg); ?></p>
      </div>
    <?php } ?>

    <?php if (isset($successMsg)) { ?>
      <div class="successfulpublish">
        <p><i class="fas fa-paper-plane"></i> <?php echo  $successMsg; ?></p>
      </div>
    <?php } ?>


    <!--x--- BLOG ENTRY ERROR MESSAGES ---------------------------------x-->

    <!-- TITLE INPUT FIELD -->
    <label class="label-story" for="fld_title">Describe your story with a meaningful title:</label>
    <div class="input-field-story">
      <i class="fas fa-highlighter"></i>
      <input type="text" name="post_title" id="fld_title" value="<?php echo $title; ?>" placeholder="*Add your title here...">
    </div>

    <!-- IMAGE INPUT FIELD -->
    <label class="label-story" for="fld_image">
      Upload a picture to show your experience visually:<br>
      (Get the best result if you select an image with landscape ratio)
    </label>
    <div class="input-field-story">
      <i class="fas fa-image"></i>
      <input type="file" name="post_image" id="fld_image" value="<?php echo $image; ?>">
    </div>
    <?php if (!empty($image)) { ?>
      <img src="blogpost_images/<?php echo $image; ?>" style="max-height:100px;" /><br><br>
    <?php } ?>

    <!-- TIME INPUT FIELD -->
    <label class="label-story" for="fld_time">Your creation date:</label>
    <div class="input-field-story">
      <i class="fas fa-clock"></i>
      <input type="text" name="post_created" id="fld_time" value="" placeholder="<?php echo strftime("%d.%m.%Y %H:%M:%S"); ?>">
    </div>

    <!-- NOT NEEDED HERE: AUTHOR INPUT FIELD -->
    <!-- <label class="label-story" for="fld_author">You are logged in as: <?php // echo ($_SESSION["useruid"]); 
      
    ?></label> -->
    <label class="label-story" for="fld_author">
      Confirm with your username:
    </label>
    <div class="input-field-story">
      <i class="fas fa-user"></i>
      <input name="post_author" id="fld_author" value="<?php echo $author; ?>" placeholder="*username">
    </div>

    <!-- TEXT TEXTAREA -->
    <label class="label-story" for="fld_author">
      Lets share what you have to say here:
    </label>
    <div class="input-field-story textarea">
      <i class="fas fa-book"></i>
      <textarea id="editor" name="post_longtext" placeholder="*Dear diary..."><?php echo $text; ?></textarea>
    </div>
    <label class="label-mandatory" for="editor">*These are mandatory fields</label>

    <!-- BUTTONS -->
    <div class="buttonsection">
      <input class="btn solid special publish" type="submit" value="Publish">
      <a class="btn solid special return" href="index.php">Return</a>
    </div>

    <!--CHECK THIS: -->
    <input type="hidden" name="ID" value="<?php echo $ID; ?>"> <!-- Für Postbearbeitung -->
  </form>
</section>

<!-- Sakura Banner -->
<div id="sakura">
  <div class="sakura-container">
    <div class="sakura-title">
      <h3>Thank you for sharing
        your story with us!
      </h3>
    </div>
    <img class="firstLeaf" src="images/sakura/b1.png" alt="First Sakura Leave">
    <img class="secondLeaf" src="images/sakura/b2.png" alt="Second Sakura Leave">
    <img class="thirdLeaf" src="images/sakura/b3.png" alt="Third Sakura Leave">
    <img class="fourthLeaf" src="images/sakura/b4.png" alt="Fourth Sakura Leave">
    <img class="fifthLeaf" src="images/sakura/b5.png" alt="Fifth Sakura Leave">

    <img class="tree" src="images/sakura/SakuraTree.png" alt="Sakura Tree">
    <img class="banner" src="images/sakura/BannerBorder900x500.jpg" alt="Cherry Blossom Banner">
  </div>
</div>

<!--x-- BLOG ENTRY INPUT FORM ------------------------------------------------------------------------x-->


<!------------ footer ----------------------------------------------------------------------------------------------------->
<?php include(INCLUDE_FOLDER . '/footer.html.php'); // Use of the constant defined in config.php 
?>
<!-----x---- footer ----x-------------------------------------------------------------------------------------------------->