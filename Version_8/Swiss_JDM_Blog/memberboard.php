<?php
/* Redundancy Section (outsourcing repetitive elements */
include('includes/config.php'); // include the values that apply to the whole project
?>

<!---------- Header + Navigation -------------------------------------------------------------------------------------------->
<?php include(INCLUDE_FOLDER.'/header.html.php'); // Use of the constant defined in config.php ?>
<!-----x---- Header + Navigation ----x--------------------------------------------------------------------------------------->


<div class="blog-heading special" data-aos="fade-up" data-aos-delay="200">
  <span>Let's see</span>
  <h1>Our Members:</h1>
</div>

<section class="members"> 
  <div id="memberboard">
    <!-- 1ST FIRST - 1 Card with 3 Sections -->
    <div class="card" data-aos="fade-right" data-aos-delay="200">
      <div class="card-image1"></div>
      <div class="card-text">
        <span class="date">Member since: 08.05.2021</span>
        <h2>That's me:</h2>
        <p>Svendolin</p>
        <h2>My Car:</h2>
        <p>Nissan Skyline R33</p>
        <h2>I live in:</h2>
        <p>Aargau</p>
      </div>
      <div class="card-stats">
        <div class="stat">
          <h3>Admin</h3>
        </div>
      </div>
    </div>

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




<!------------ footer ----------------------------------------------------------------------------------------------------->
<?php include(INCLUDE_FOLDER.'/footer.html.php'); // Use of the constant defined in config.php ?>
<!-----x---- footer ----x-------------------------------------------------------------------------------------------------->