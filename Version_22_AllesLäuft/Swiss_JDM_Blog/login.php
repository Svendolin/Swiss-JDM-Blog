<?php
require_once('includes/config.php');        // Serverconfiguration that apply to the whole project
require_once('includes/mysql-connect.php'); // Initializing the mysql database connection
require_once('includes/functions.inc.php'); // functions which do include login and signup-functions

// ----- Users are allowed to see this content when logged in AND logged out: ----- //
session_start();
// --x-- Users are allowed to see this content when logged in AND logged out. --x-- //  

$hasError = false;
$errorMsg = array();

$ID = '';
$name = '';
$username = '';
$car = '';
$state = '';
$email = '';
$pwd = '';
$pwdRepeat = '';
$usersImage = '';

// ID Variable out of GET
if (isset($_GET['id'])) {
  $ID = $_GET['id'];
}


if (!empty($ID)) {
  $getquery = "SELECT * FROM users WHERE usersId =".$ID;
  $res = mysqli_query($conn, $getquery);
  $datapieces = mysqli_fetch_assoc($res);


  $name = $datapieces["name"];
  $username = $datapieces["uid"];
  $car = $datapieces["car"];
  $state = $datapieces["state"];
  $email = $datapieces["email"];
  $pwd = $datapieces["pwd"];
  $pwdRepeat = $datapieces["pwdrepeat"];
  $usersImage = $datapieces["users_image"];
}

  // echo '<pre>';
  // print_r($_POST);
  // echo '</pre>';

// Check if data was sent via POST (from the form)
if (isset($_POST['name']) && isset($_POST['uid']) && isset($_POST['car']) && isset($_POST['state']) && isset($_POST['email']) && isset($_POST['pwd']) && isset($_POST['pwdrepeat'])) {



  // strip_tags prevents code injection by removing all tags.
  // mysqli_real_escape_string prevents problems with inverted commas in the string by escaping, as for example with 'That's it!
  // $title = strip_tags(mysqli_real_escape_string($conn, $_POST['post_title']));
  // $created = (empty($_POST['post_created'])) ? strftime("%d-%m-%Y um %H:%M:%S") : strip_tags(mysqli_real_escape_string($conn, $_POST['post_created']));
  // $author = strip_tags(mysqli_real_escape_string($conn, $_POST['post_author']));
  // $text = strip_tags(mysqli_real_escape_string($conn, $_POST['post_longtext']), $erlaubte_tags); // hier werden alle vom Editor angebotenen Tags vom entfernen ausgeschlossen...
  $ID = (int)$_POST['ID'];
  $name = $_POST["name"];
  $username = $_POST["uid"];
  $car = $_POST["car"];
  $state = $_POST["state"];
  $email = $_POST["email"];
  $pwd = $_POST["pwd"];
  $pwdRepeat = $_POST["pwdrepeat"];

  // echo '<pre>';
  // echo $username;
  // echo '</pre>';

  
  
  // Error functions seperately defined at functions.inc.php

  // Check if: EmptyInput is not equal to false (in our function.inc.php = false is correct, with !== we check if the false statement is wrong)
  if (emptyInputSignup($name, $username, $car, $state, $email, $pwd, $pwdRepeat) !== false) {
    header("location: login.php?error=emptyinput");
    exit();
  }

  // Proper username chosen
  if (invalidUid($username) !== false) {
    header("location: login.php?error=invaliduid");
    exit();
  }
  // Proper email chosen
  if (invalidEmail($email) !== false) {
    header("location: login.php?error=invalidemail");
    exit();
  }
  // Do the two passwords match?
  if (pwdMatch($pwd, $pwdRepeat) !== false) {
    header("location: login.php?error=passwordsdontmatch");
    exit();
  }
  // Is the username taken already?
  if (uidExists($conn, $username, $email) !== false) {
    header("location: login.php?error=usernametaken");
    exit();
  // } else {
  //   header("location: login.php"); // If the user submitted the WRONG way, we send him BACK...
  //   exit();
  }



  // --- IMAGEUPLOAD-PART --- //
  if (isset($_FILES['users_image']) && !empty($_FILES['users_image']['tmp_name'])) {
    // get / move from tmp folder
    // print_r($_FILES['users_image']);
    $newImage = 'profileimage_' . time() . '.jpg'; // Single image name (for DB entry)
    $src = $_FILES['users_image']['tmp_name']; // Temporary path
    $dest = PROFILEIMAGEFOLDERPATH . '/' . $newImage; // Destination path (defined in Config)

    // Move the file to the destination path
    $hochgeladen = move_uploaded_file($src, $dest);
    // var_dump($hochgeladen);

    // Delete old image
    if (!empty($image)) {
      unlink(PROFILEIMAGEFOLDERPATH . '/' . $image); // Destination path (defined in Config)
    }
  }




  if (!$hasError) {

    // Saving the data to the database
    if (empty($ID)) {
      $addImageField = empty($newImage) ? "" : ", usersImage"; // Addition for image, only if image has been uploaded
      $addImageValue = empty($newImage) ? "" : ", ?"; // Addition for image, only if image has been uploaded

      $sql = "INSERT INTO users (usersName, usersUid, usersCar, usersState, usersEmail, usersPwd {$addImageField})
         VALUES 
         (?, ?, ?, ?, ?, ? {$addImageValue})";


      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        // echo 'sql prepare error';
        // echo mysqli_stmt_error($stmt); // MOST EFFECTIVE SOLUTION TO FIND ERRORS MORE PRECISELY!
      } else {

      // $stmt = mysqli_prepare($conn, $query);

      $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT); // (*)

      if (empty($newImage)) {
        // Falls ohne Bild:
        mysqli_stmt_bind_param($stmt, 'ssssss', $name, $username, $car, $state, $email, $hashedPwd); // send the data to the server
      } else {
        // Falls mit Bild:
        mysqli_stmt_bind_param($stmt, 'sssssss', $name, $username, $car, $state, $email, $hashedPwd, $newImage); // send the data to the server
      }
      mysqli_stmt_execute($stmt); // Execute command with the sent data
      $result = mysqli_stmt_get_result($stmt); // Result object "pick up

    }
    
      
      // Send command and check...
      // $res = mysqli_query($connection, $query);
      $newID = mysqli_insert_id($conn);
    } else { // edit
      $sql = "UPDATE `users` 
         SET 
         `usersName` = '{$name}',
         `usersUid` = '{$username}',
         `usersCar` = '{$car}',
         `usersState` = '{$state}',
         `usersEmail` = '{$email}',
         `usersPwd` = '{$hashedPwd}',
         
         
         
         ";

      // only if image has been uploaded
      if (!empty($newImage)) {
        $sql.= ",
           `users_image` = '{$newImage}'";
      }
      $sql.= " WHERE `usersId` = {$ID}";
      $stmt = mysqli_query($conn, $sql);
    }
    // die($query);

    if (!empty($newImage)) {
      $image = $newImage;
    }
    header("location: login.php?error=none_successfullogin"); // The user returns back to sign.up , the page reloads new, the fields are empty again and the successmessage will follow up :D
	  exit();
  }
}



?>

<!---------- Header + Navigation -------------------------------------------------------------------------------------------->
<?php include(INCLUDE_FOLDER . '/header.html.php'); // Use of the constant defined in config.php 
?>
<!-----x---- Header + Navigation ----x--------------------------------------------------------------------------------------->




<div class="login-container">
  <!-- Whole login section as a container -->
  <div class="forms-container">
    <!------------ [A] SIGN-IN FORM (AKA as login.php in usual projects) ---------------------------------->
    <div class="signin-signup">
      <form action="includes/login.inc.php" class="sign-in-form" method="post">
        <!-- NEW: action="" => The page where the user is going to be directed / method = "" set to POST (no visible data in the url) -->

        <!------------ [B] SIGN-UP (Registration) ERROR MESSAGE field ---------------------------------->
        <div class="error-message-sign-up">
          <?php
          // TODO: Define a propper ERROR / SUCCESS PLACE for your messages
          // PHP Error Input Messages connected to signup.inc.php -->
          if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {             // "emptyinput" is defined at signup.inc.php combined with the function at functions.inc.php
              echo "<p><i class='fas fa-exclamation-circle'></i>  Please fill in all sign-up fields!<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Click 'Join us' and try again!</p>";
            } else if ($_GET["error"] == "invaliduid") {        // "invaliduid" is defined at signup.inc.php combined with the function at functions.inc.php
              echo "<p><i class='fas fa-exclamation-circle'></i>  Choose another username to sign-up!<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Click 'Join us' to try again!</p>";
            } else if ($_GET["error"] == "invalidemail") {      // "invalidemail" is defined at signup.inc.php combined with the function at functions.inc.php
              echo "<p><i class='fas fa-exclamation-circle'></i>  Choose another email to sign-up!<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Click 'Join us' to try again!</p>";
            } else if ($_GET["error"] == "passwordsdontmatch") { // "passwordsdontmatch" is defined at signup.inc.php combined with the function at functions.inc.php
              echo "<p><i class='fas fa-exclamation-circle'></i>  Passwords doesn't match to sign-up!<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Click 'Join us' to try again!</p>";
            } else if ($_GET["error"] == "stmtfailed") {         // SPECIAL: "stmtfailed" is directly defined at functions.inc.php
              echo "<p><i class='fas fa-exclamation-circle'></i>  Whoops, something went wrong with your sign-up!<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Click 'Join us' to try again!</p>";
            } else if ($_GET["error"] == "usernametaken") {      // "usernametaken" is defined at signup.inc.php combined with the function at functions.inc.php
              echo "<p><i class='fas fa-exclamation-circle'></i>  Sorry, Username is already taken!<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Click 'Join us' to try again!</p>";
            } else if ($_GET["error"] == "none_successfullogin") {               // "none" is the POSITIVE STATEMENT
              echo "<p class='successfulsignup'>You have sucessfully signed up!</p>";
            }
          }
          ?>
        </div>
        <!--x--------- [B] SIGN-UP (Registration) ERROR MESSAGE field -------------------------------x-->
        <h2 class="title">Sign in</h2>

        <div class="input-field">
          <i class="fas fa-user"></i>
          <!-- <label for="fld_username">Username:</label> -->
          <input type="text" name="uid" id="fld_uid" value="" placeholder="Username"> <!-- User should be able to type in either USERNAME or EMAIL (both possibilities) -->
        </div>

        <div class="input-field">
          <i class="fas fa-lock"></i>
          <!-- <label for="fld_pw">Passwort:</label> -->
          <input type="password" name="pwd" id="fld_pwd" value="" placeholder="Password">
        </div>
        <input type="submit" name="submit-sign-in" value="Sign In" class="btn solid sign-in"> <!-- IMPORTANT: name="" isnt just submit due to the reason we got two different submit buttons (sign-in VS sign-up) -->
        <!------------ [A] SIGN-IN ERROR MESSAGE field ---------------------------------->
        <div class="error-message-log-in">
          <?php
          // PHP Error Input Messages connected to login.inc.php -->
          if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinputlogin") {
              echo "<p><i class='fas fa-exclamation-circle'></i>  Please fill all sign-in fields!</p>";
            } else if ($_GET["error"] == "wronglogin") { // Error handler in functions.inc.php
              echo "<p><i class='fas fa-exclamation-circle'></i>  Sign-in information is incorrect!</p>";
            } // NOTE: Positive feedback will be directly shown at index.php
          }
          ?>
        </div>
        <!--x--------- [A] SIGN-IN ERROR MESSAGE field -------------------------------x-->
      </form>







      <!------------ [B] SIGN-UP (Join us) form (AKA as signup.php in usual projects) -------------------------------->

      <form action="" class="sign-up-form" method="POST" enctype="multipart/form-data">
        <!-- NEW: action="" => The page where the user is going to be directed / method = "" set to POST (no visible data in the url) -->
        <h2 class="title">Sign up</h2>

        <!-- NAME INPUT FIELD -->
        <div class="input-field">
          <i class="fas fa-file-signature"></i>
          <!-- <label for="fld_name">Familyname and Surename:</label> -->
          <input type="text" name="name" id="fld_name" value="" placeholder="Full Name (e.g. Ralf Random)"> <!-- The name decides what this input type does for the user -->
        </div>

        <!-- USERNAME INPUT FIELD -->
        <div class="input-field">
          <i class="fas fa-user"></i>
          <!-- <label for="fld_uid">Username:</label> -->
          <input type="text" name="uid" id="fld_uid" value="" placeholder="Username">
        </div>


        <!-- <div class="input-field">
            <label for="img">Select image:</label>
            <input type="file" id="img" name="img" accept="image/*">
            <input type="submit">
          </div> -->

        <!-- CAR INPUT FIELD -->
        <div class="input-field">
          <i class="fas fa-car"></i>
          <!-- <label for="fld_car">Car:</label> -->
          <input type="text" name="car" id="fld_car" value="" placeholder="Your Car">
        </div>

        <!-- IMAGE INPUT FIELD -->
        <label for="fld_image">Select an image for your memberboard profile:</label>
        <div class="input-field">
          <i class="fas fa-image"></i>
          <?php if (!empty($image)) { ?>
            <img src="../user_images/<?php echo $image; ?>" style="max-height:100px;" /><br><br>
          <?php } ?>

          <input type="file" name="users_image" id="fld_image" value="" placeholder="Your Car">
        </div>

        <!-- STATE INPUT FIELD -->
        <div class="input-field">
          <i class="fas fa-house"></i>
          <!-- <label for="fld_state">State:</label> -->
          <input type="text" name="state" id="fld_state" value="" placeholder="Your State (e.g. Aargau)">
        </div>

        <!-- EMAIL INPUT FIELD -->
        <div class="input-field">
          <i class="fas fa-envelope"></i>
          <!-- <label for="fld_email">Email:</label> -->
          <input type="text" name="email" id="fld_email" value="" placeholder="Email">
        </div>

        <!-- PASSWORD INPUT FIELD -->
        <div class="input-field">
          <i class="fas fa-lock"></i>
          <!-- <label for="fld_pwd">Passwort:</label> -->
          <input type="password" name="pwd" id="fld_pwd" value="" placeholder="Password">
        </div>

        <!-- PASSWORD-REPEAT INPUT FIELD -->
        <div class="input-field">
          <i class="fas fa-lock"></i>
          <!-- <label for="fld_pwdrepeat">Repeat Passwort:</label> -->
          <input type="password" name="pwdrepeat" id="fld_pwdrepeat" value="" placeholder="Repeat Password">
        </div>

        <input type="submit" name="submit-sign-up" value="Sign Up" class="btn solid sign-up"> <!-- IMPORTANT: name="" isnt just submit due to the reason we got two different submit buttons (sign-in VS sign-up) -->
        <!--CHECK THIS: -->
        <input type="hidden" name="ID" value="<?php echo $ID; ?>">
      </form>
    </div>
  </div>

  <!-- The panel  -->
  <div class="panels-container">
    <div class="panel left-panel">
      <div class="content">
        <h3>New here?</h3>
        <p>Be a part of our community, unleash your passion for JDM cars together and tell us your story!</p>
        <button class="btn transparent" id="sign-up-btn">Join us</button>
      </div>
      <img src="images/login/jdmlogin.png" alt="toyota supra vector" class="image">
    </div>

    <div class="panel right-panel">
      <div class="content">
        <h3>One of us?</h3>
        <p>Let's share what's on your mind, you are just a few clicks away!</p>
        <button class="btn transparent" id="sign-in-btn">Sign in</button>
      </div>
      <img src="images/login/jdmsignin.png" alt="nissan silvia vector" class="image">
    </div>
  </div>
</div>


<!------------ footer ----------------------------------------------------------------------------------------------------->
<?php include(INCLUDE_FOLDER . '/footer.html.php'); // Use of the constant defined in config.php 
?>
<!-----x------ footer -----x------------------------------------------------------------------------------------------------>