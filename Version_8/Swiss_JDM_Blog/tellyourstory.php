<?php
/* Redundancy Section (outsourcing repetitive elements */
include('includes/config.php'); // include the values that apply to the whole project
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
    <!-- SIGN-UP (Join us) form -->
    <form action="" class="wite-a-post">


        <div class="input-field">
        <i class="fas fa-highlighter"></i>
          <!-- <label for="fld_username">Username:</label> -->
          <input type="text" name="post_title" id="fld_title" value="" placeholder="Add your title here..." required> <!-- FIXME: Fixed this one, but pls fix the others  -->
        </div>

        <div class="input-field">
        <i class="fas fa-image"></i>
          <!-- <label for="fld_username">Car:</label> -->
          <input type="file" name="post_image" id="fld_image" value="">
        </div>

        <div class="input-field">
          <i class="fas fa-house"></i>
          <!-- <label for="fld_username">Car:</label> -->
          <input type="text" name="state" id="fld_state" value="" placeholder="TEST">
        </div>

        <div class="input-field">
          <i class="fas fa-envelope"></i>
          <!-- <label for="fld_username">Email:</label> -->
          <input type="text" name="email" id="fld_email" value="" placeholder="TEST">
        </div>

        <div class="input-field">
          <i class="fas fa-lock"></i>
          <!-- <label for="fld_pw">Passwort:</label> -->
          <input type="password" name="password" id="fld_pw" value="" placeholder="TEST">
        </div>

        <input type="submit" value="Publish" class="btn solid special">
        <input type="submit" value="Return" class="btn solid special">

      <p class="social-text"></p>
    </form>
  </section>

  <!-- TODO: Compare the Terry stuff -->
				
				




<!------------ footer ----------------------------------------------------------------------------------------------------->
<?php include(INCLUDE_FOLDER.'/footer.html.php'); // Use of the constant defined in config.php ?>
<!-----x---- footer ----x-------------------------------------------------------------------------------------------------->