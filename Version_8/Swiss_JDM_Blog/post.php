<?php
/* Redundancy Section (outsourcing repetitive elements */
include('includes/config.php'); // include the values that apply to the whole project
?>

<!---------- Header + Navigation -------------------------------------------------------------------------------------------->
<?php include(INCLUDE_FOLDER.'/header.html.php'); // Use of the constant defined in config.php ?>
<!-----x---- Header + Navigation ----x--------------------------------------------------------------------------------------->

<!-- Blog Section -->
<section id="blog">
<!-- Blog-Heading -->
  <div class="blog-heading" data-aos="fade-up" data-aos-delay="200">
    <span>let's read</span>
    <h1>My Story</h1>
  </div>
<!-- Blog-Container and Boxes -->
  <div class="blog-container">
    <div class="blog-box" data-aos="zoom-in" data-aos-delay="300">
      <div class="blog-img">
        <img src="./images/blog-posts/180sx.jpg" alt="Silvan's Nissan 180sx">
      </div>
      <div class="blog-text">
      <span>September 3, 2021 by: Sillest</span>
      <h2>When was the last time we met each other?!?</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
        Dicta quibusdam ducimus libero ut provident, tempore ullam temporibus repellendus corporis omnis.
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
        Dicta quibusdam ducimus libero ut provident, tempore ullam temporibus repellendus corporis omnis.
        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
      </p>
      </div>
      <a href="index.php" class="btn back">Return</a>
    </div>
  </div>

</section> 


<!------------ footer ----------------------------------------------------------------------------------------------------->
<?php include(INCLUDE_FOLDER.'/footer.html.php'); // Use of the constant defined in config.php ?>
<!-------x---- footer ----x------------------------------------------------------------------------------------------------>