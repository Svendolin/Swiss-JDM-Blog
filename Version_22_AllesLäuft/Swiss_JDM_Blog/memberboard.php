<?php
require_once('includes/config.php');        // Serverconfiguration that apply to the whole project
require_once('includes/mysql-connect.php'); // Initializing the mysql database connection
require_once('includes/functions.inc.php'); // functions which do include login and signup-functions
// ----- Users are allowed to see this content when logged in AND logged out: ----- //
session_start();
// --x-- Users are allowed to see this content when logged in AND logged out. --x-- //

// $query = "SELECT * FROM users WHERE user_state > 0 ORDER BY user_created DESC";
$query = "SELECT * FROM users ORDER BY userCreated ASC";
$res = mysqli_query($conn, $query);
$data = mysqli_fetch_all($res, MYSQLI_ASSOC);

// Important for the foreach...
// TODO: Variable which we need at the bottom of each card (user or admin)
// $membertype = $data["member_type"];

?>

<!---------- Header + Navigation -------------------------------------------------------------------------------------------->
<?php include(INCLUDE_FOLDER . '/header.html.php'); // Use of the constant defined in config.php 
?>
<!-----x---- Header + Navigation ----x--------------------------------------------------------------------------------------->


<div class="blog-heading special" data-aos="fade-up" data-aos-delay="200">
  <span>Let's see</span>
  <h1>Our Members:</h1>
</div>

<?php foreach ($data as $datapiece) { ?>
      <?php
      $ts = strtotime($datapiece['userCreated']);
      $created = strftime("%d.%m.%Y", $ts);
      $membertype = $datapiece['memberType'];
      ?>

<section class="members">
  <div id="memberboard">
    
      <!-- 1ST FIRST - 1 Card with 3 Sections -->
      <div class="card" data-aos="fade-right" data-aos-delay="200">
        <div class="card-image">
          <!-- IMAGE CONTAINER -->
          <?php if (!empty($datapiece['usersImage'])) { ?>
            <img src="<?php echo PROFILEIMAGEFOLDER . '/' . $datapiece['usersImage']; ?>" />
          <?php } ?>
        </div>
        <div class="card-text">
          <span class="date">Member since: <time><?php echo $created; ?></time></span>
          <h2>That's me:</h2>
          <p><?php echo $datapiece['usersUid']; ?></p>
          <h2>My Car:</h2>
          <p><?php echo $datapiece['usersCar']; ?></p>
          <h2>I live in:</h2>
          <p><?php echo $datapiece['usersState']; ?></p>
        </div>
        <!-- Membertype = 0 is an Admin / Membertype = 1 is a user (which is a default) -->
        <div class="card-stats">
          <div class="stat">
            <h3>
              <?php
              if ($membertype == 0) {
                echo 'Admin';
              } else {
                echo 'User';
              }
              ?>
            </h3>
          </div>
        </div>
      </div>
  </div>
</section>

<?php } ?>


<!-- Sakura Banner -->

<div id="sakura">
  <div class="sakura-container">
    <div class="sakura-title">
      <h3>Welcome to the<br>
        Swiss JDM Blog!
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





<!------------ footer ----------------------------------------------------------------------------------------------------->
<?php include(INCLUDE_FOLDER . '/footer.html.php'); // Use of the constant defined in config.php 
?>
<!-----x---- footer ----x-------------------------------------------------------------------------------------------------->