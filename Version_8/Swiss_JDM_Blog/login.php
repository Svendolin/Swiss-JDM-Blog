<?php
/* Redundancy Section (outsourcing repetitive elements */
require_once('includes/config.php'); // TODO: CHECK if that is even needed! include the values that apply to the whole project
// require_once('includes/mysql-connect.php'); // funktionen für das Projekt
?>

<!---------- Header + Navigation -------------------------------------------------------------------------------------------->
<?php include(INCLUDE_FOLDER.'/header.html.php'); // Use of the constant defined in config.php ?>
<!-----x---- Header + Navigation ----x--------------------------------------------------------------------------------------->

<div class="login-container"> <!-- Formerly "container" -->
  <div class="forms-container">



  <!------------ SIGN-IN form (AKA as login.php in usual projects) ---------------------------------->
    <div class="signin-signup">
      <form action="includes/login.inc.php" class="sign-in-form" method="post"> <!-- NEW: action="" => The page where the user is going to be directed / method = "" set to POST (no visible data in the url) -->
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
          <input type="submit" name="submit-sign-in" value="Sign In" class="btn solid"> <!-- IMPORTANT: name="" isnt just submit due to the reason we got two different submit buttons (sign-in VS sign-up) -->

          <?php
          // TODO: Define a propper ERROR / SUCCESS PLACE for your messages
          // PHP Error Input Messages connected to login.inc.php -->
           if (isset($_GET["error"])) {
             if ($_GET["error"] == "emptysignininput") {
               echo "<p>Fill in all fields!</p>";
             }
             else if ($_GET["error"] == "wronglogin") {
               echo "<p>Login information is incorrect!</p>";
             }
           }
         ?>
      </form>



      <!------------ SIGN-UP (Join us) form (AKA as signup.php in usual projects) -------------------------------->
      <form action="includes/signup.inc.php" class="sign-up-form" method="post"> <!-- NEW: action="" => The page where the user is going to be directed / method = "" set to POST (no visible data in the url) -->
         <h2 class="title">Sign up</h2>

          <div class="input-field">
            <i class="fas fa-file-signature"></i>
            <!-- <label for="fld_name">Username:</label> -->
            <input type="text" name="name" id="fld_name" value="" placeholder="Full Name (e.g. Ralf Random)"> <!-- The name decides what this input type does for the user -->
          </div>

          <div class="input-field">
            <i class="fas fa-user"></i>
            <!-- <label for="fld_uid">Username:</label> -->
            <input type="text" name="uid" id="fld_uid" value="" placeholder="Username">
          </div>

          <!-- TODO: IMAGE UPLOAD -->
          <!-- <div class="input-field">
            <label for="img">Select image:</label>
            <input type="file" id="img" name="img" accept="image/*">
            <input type="submit">
          </div> -->

          <div class="input-field">
            <i class="fas fa-car"></i>
            <!-- <label for="fld_car">Car:</label> -->
            <input type="text" name="car" id="fld_car" value="" placeholder="Your Car">
          </div>

          <div class="input-field">
            <i class="fas fa-house"></i>
            <!-- <label for="fld_state">Car:</label> -->
            <input type="text" name="state" id="fld_state" value="" placeholder="Your State (e.g. Aargau)">
          </div>

          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <!-- <label for="fld_email">Email:</label> -->
            <input type="text" name="email" id="fld_email" value="" placeholder="Email">
          </div>

          <div class="input-field">
            <i class="fas fa-lock"></i>
            <!-- <label for="fld_pwd">Passwort:</label> -->
            <input type="password" name="pwd" id="fld_pwd" value="" placeholder="Password">
          </div>

          <div class="input-field">
            <i class="fas fa-lock"></i>
            <!-- <label for="fld_pwdrepeat">Passwort:</label> -->
            <input type="password" name="pwdrepeat" id="fld_pwdrepeat" value="" placeholder="Repeat Password">
          </div>

          <input type="submit" name="submit-sign-up" value="Sign Up" class="btn solid"> <!-- IMPORTANT: name="" isnt just submit due to the reason we got two different submit buttons (sign-in VS sign-up) -->
        <?php
        // TODO: Define a propper ERROR / SUCCESS PLACE for your messages
        // PHP Error Input Messages connected to signup.inc.php -->
          if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {             // "emptyinput" is defined at signup.inc.php combined with the function at functions.inc.php
              echo "<p>Please fill in all fields!</p>";
            }
            else if ($_GET["error"] == "invaliduid") {        // "invaliduid" is defined at signup.inc.php combined with the function at functions.inc.php
              echo "<p>Choose another username!</p>";
            }
            else if ($_GET["error"] == "invalidemail") {      // "invalidemail" is defined at signup.inc.php combined with the function at functions.inc.php
              echo "<p>Choose another email!</p>";
            }
            else if ($_GET["error"] == "passwordsdontmatch") { // "passwordsdontmatch" is defined at signup.inc.php combined with the function at functions.inc.php
              echo "<p>Passwords doesn't match!</p>";
            }
            else if ($_GET["error"] == "stmtfailed") {         // SPECIAL: "stmtfailed" is directly defined at functions.inc.php
              echo "<p>Whoops, something went wrong!</p>";
            }
            else if ($_GET["error"] == "usernametaken") {      // "usernametaken" is defined at signup.inc.php combined with the function at functions.inc.php
              echo "<p>Sorry, Username is already taken!</p>";
            }
            else if ($_GET["error"] == "none") {               // "none" is defined at signup.inc.php combined with the function at functions.inc.php
              echo "<p>You have signed up!</p>";
            }
          }

        ?>
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
<?php include(INCLUDE_FOLDER.'/footer.html.php'); // Use of the constant defined in config.php ?>
<!-----x------ footer -----x------------------------------------------------------------------------------------------------>
















