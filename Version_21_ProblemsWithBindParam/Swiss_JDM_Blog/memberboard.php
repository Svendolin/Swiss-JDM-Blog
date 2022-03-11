<?php
  require_once('includes/config.php');        // Serverconfiguration that apply to the whole project
  require_once('includes/mysql-connect.php'); // Initializing the mysql database connection
  require_once('includes/functions.inc.php'); // functions which do include login and signup-functions
  // ----- Users are allowed to see this content when logged in AND logged out: ----- //
  session_start();
  // --x-- Users are allowed to see this content when logged in AND logged out. --x-- //

  // $query = "SELECT * FROM users WHERE user_state > 0 ORDER BY user_created DESC";
  $query = "SELECT * FROM users ORDER BY user_created DESC";
  $res = mysqli_query($conn, $query);
  $data = mysqli_fetch_all($res, MYSQLI_ASSOC);

  // FIXME: Variable which we need at the bottom of each card (user or admin)
  // $membertype = $data["member_type"];

?>

<!---------- Header + Navigation -------------------------------------------------------------------------------------------->
<?php include(INCLUDE_FOLDER.'/header.html.php'); // Use of the constant defined in config.php ?>
<!-----x---- Header + Navigation ----x--------------------------------------------------------------------------------------->


<div class="blog-heading special" data-aos="fade-up" data-aos-delay="200">
  <span>Let's see</span>
  <h1>Our Members:</h1>
</div>

<?php if( isset($data) && count($data)>0 ) { ?>
			<?php foreach($data as $datapiece) { ?>
        <?php
        $ts = strtotime($datapiece['user_created']);
				$created = strftime("%d.%m.%Y", $ts );
        $membertype = $datapiece['member_type'];
        ?>

<section class="members"> 
  <div id="memberboard">
    <!-- 1ST FIRST - 1 Card with 3 Sections -->
    <div class="card" data-aos="fade-right" data-aos-delay="200">
      <div class="card-image"> <!-- IMAGE CONTAINER -->
        <?php if( !empty($datapiece['usersImage']) ) { ?>
					<img src="<?php echo IMAGEFOLDER.'/'.$datapiece['usersImage'];?>" />
				<?php } ?>
      </div>
      <div class="card-text">
        <span class="date">Member since: <time><?php echo $created; ?></time></span>
        <h2>That's me:</h2>
        <p><?php echo $datapiece['usersUid'];?></p>
        <h2>My Car:</h2>
        <p><?php echo $datapiece['usersCar'];?></p>
        <h2>I live in:</h2>
        <p><?php echo $datapiece['usersState'];?></p>
      </div>
      <!-- Membertype = 0 is an Admin / Membertype = 1 is a user (which is a default) -->
      <div class="card-stats">
        <div class="stat">
          <h3>
          <?php 
            if ($membertype == 0) {
             echo 'Admin';
            }
            else {
             echo 'User';
            }
          ?>
          </h3>
        </div>
      </div>
    </div>


  <?php } ?>
<?php } ?>

    <!-- 2ND SECOND - 1 Card with 3 Sections -->
    <div class="card" data-aos="fade-in" data-aos-delay="200">
      <div class="card-image2"></div>
      <div class="card-text">
        <span class="date">Member since: 09.06.2021</span>
        <h2>That's me:</h2>
        <p>Sillest</p>
        <h2>My Car:</h2>
        <p>Nissan 200sx S13</p>
        <h2>I live in:</h2>
        <p>Nidwalden</p>
      </div>
      <div class="card-stats">
        <div class="stat">
          <h3>User</h3>
        </div>
      </div>
    </div>

    <!-- 3RD THIRD - 1 Card with 3 Sections -->
    <div class="card" data-aos="fade-left" data-aos-delay="200">
      <div class="card-image3"></div>
      <div class="card-text">
        <span class="date">Member since: 11.06.2021</span>
        <h2>That's me:</h2>
        <p>Oli_Supra</p>
        <h2>My Car:</h2>
        <p>Toyota Supra MK4</p>
        <h2>I live in:</h2>
        <p>Aargau</p>
      </div>
      <div class="card-stats">
        <div class="stat">
          <h3>User</h3>
        </div>
      </div>
    </div>

  </div>
  
</section>
<div id="sakura">
  
</div>





<!------------ footer ----------------------------------------------------------------------------------------------------->
<?php include(INCLUDE_FOLDER.'/footer.html.php'); // Use of the constant defined in config.php ?>
<!-----x---- footer ----x-------------------------------------------------------------------------------------------------->