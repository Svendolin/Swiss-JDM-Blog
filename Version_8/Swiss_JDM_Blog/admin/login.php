<?php
/* Redundancy Section (outsourcing repetitive elements */
?>

<!---------- Header + Navigation -------------------------------------------------------------------------------------------->
<?php include('html/start.php'); // Use of the html admin folder ?>
<!-----x---- Header + Navigation ----x--------------------------------------------------------------------------------------->


<section id="admin-login">

    <div class="center">
      <h1>Login</h1>
      <form method="post">
        <div class="txt_field">
          <input type="text" name="username" id="fld_username" value="" required>
          <span></span>
          <label>*Username</label>
        </div>
        <div class="txt_field">
          <input type="password" name="password" id="fld_pw" value="" required>
          <span></span>
          <label>*Password</label>
        </div>
        <div class="emptyspace"></div>
        <div class="buttonarea">
          <a href="index.php" class="btn-special-sign-in">Sign in</a>
          <a href="../index.php" class="btn-special-return">Return</a>
        </div>
        </div>
      </form>
    </div>

  <!-- <div class="admin-signin">
    <form action="" class="sign-in-form">
        <div class="input-field .admin">
          <i class="fas fa-user"></i>
          <input type="text" name="username" id="fld_username" value="" placeholder="Username">
        </div>
        <div class="input-field .admin">
          <i class="fas fa-lock"></i>
          <input type="password" name="password" id="fld_pw" value="" placeholder="Password">
        </div>
        <a href="#" class="btn solid">Sign in</a>
      <p class="social-text"></p>
    </form>
  </div> -->
</section>



<!------------ footer ----------------------------------------------------------------------------------------------------->
<?php include('html/end.php'); // Use of the html admin folder ?>
<!-----x---- footer ----x-------------------------------------------------------------------------------------------------->