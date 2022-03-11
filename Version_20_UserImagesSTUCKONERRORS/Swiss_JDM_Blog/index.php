<?php
require_once('includes/config.php');        // Serverconfiguration that apply to the whole project
require_once('includes/mysql-connect.php'); // Initializing the mysql database connection
require_once('includes/functions.inc.php'); // functions which do include login and signup-functions

// ----- Users are allowed to see this content when logged in AND logged out. ----- //
session_init();
// --x-- Users are allowed to see this content when logged in AND logged out. --x-- //
?>

<?php
/* Sessioncheck to see if the uid actually returns something */
// function sessioncheck(){
//   if (isset($_SESSION["useruid"])){
//     return true;
//   }
// }


// Daten auslesen
$query = "SELECT * FROM blogpost ORDER BY post_created DESC";
$res = mysqli_query($conn, $query);
$daten = mysqli_fetch_all($res, MYSQLI_ASSOC);


/* Not needed because the user should stay logged in */
// Timeout funktioneirt nach 1 min 
// $isLoggedIn = sessioncheck();
//   if($isLoggedIn == false){ 
// 	// schüztt dieses Script vor Zurgriff ohne Login
// 	header("location: login.php"); 
// 	exit;
//   }
?>

<!---------- Header + Navigation -------------------------------------------------------------------------------------------->
<?php include(INCLUDE_FOLDER . '/header.html.php'); // Use of the constant defined in config.php 
?>
<!-----x---- Header + Navigation ----x--------------------------------------------------------------------------------------->



<!-------- MAIN SITE SECTION ------------------------------------------------------------------------------------>

<main>
  <section class="index-intro">
    <?php
    // Check if this session variable exist (which is logically only, if the user is logged in):  
    if (isset($_SESSION["useruid"])) {
      echo "<p><i class='fas fa-check-circle'></i>  こんにちは! Welcome, " . filter_var($_SESSION["useruid"], FILTER_SANITIZE_STRING) . "!</p>"; // echo "" shows stuff, ".." in between rewrites PHP stuff
    }
    ?>
  </section>
  <!---------- Site Title ------------->
  <section class="site-title">
    <div class="site-background" data-aos="fade-up" data-aos-delay="200">
      <span>Where JDM enthusiasts come together</span>
      <h1>Tell your story</h1>
      <?php
      // Is the user LOGGED IN? Show this: 
      if (isset($_SESSION["useruid"])) {
        echo '<a href="tellyourstory.php" class="btn">Explore</a>';
      }
      // Is the user NOT LOGGED IN? Show THIS INSTEAD:
      else {
        echo '<a href="login.php" class="btn">Explore</a>';
      }
      ?>
    </div>
  </section>

  <!-----x---- Site Title ----x-------->
  <!---------- Blog Carousel (Newsflash) ------------->

  <section>
    <div class="blog">
      <!-- All the carousel content -->
      <h2 class="title">Newsflash</h2>
      <div class="container">
        <!-- Container for the items -->
        <div class="owl-carousel owl-theme blog-post">
          <!-- 3 Classes: Owl items + theme + blog posts -->
          <div class="blog-content" data-aos="fade-right" data-aos-delay="200">


            <img src="images/newsflash/JDM1.jpg" alt="post 1">
            <div class="blog-title">
              <h3>"Godzilla has arrived!"</h3>
              <button class="btn" role="fadeWhenHover" aria-label="Hover to read more">Hover to read more</button>
              <span>9th of June 2021</span>
            </div>
            <div class="overlay">
              <div class="text"><h3>It took almost half an eternity, but finally it's here!
                Now it just needs to get on the road legally... *Sigh*</h3></div>
            </div>
          </div>

          <div class="blog-content" data-aos="fade-in" data-aos-delay="200">
            <img src="images/newsflash/JDM2.jpg" alt="post 2">
            <div class="blog-title">
              <h3>"Slapsticker time!"</h3>
              <button class="btn" role="fadeWhenHover" aria-label="Hover to read more">Hover to read more</button>
              <span>17th of July 2021</span>
            </div>
            <div class="overlay">
              <div class="text"><h3>Hurray, the Slapstickers from Saitoworks.com arrived!
                <br>--<br>
                Check out their website for tons of JDM-Stuff such as Window Decals,
                Caps, Air Fresheners, Tsurikawas and more!</h3>
              </div>
            </div>
          </div>

          <div class="blog-content" data-aos="fade-left" data-aos-delay="200">
            <img src="images/newsflash/JDM3.jpg" alt="post 3">
            <div class="blog-title">
              <h3>"Visited his Brother!"</h3>
              <button class="btn" role="fadeWhenHover" aria-label="Hover to read more">Hover to read more</button>
              <span>30th of September 2021</span>
            </div>
            <div class="overlay">
              <div class="text"><h3>In order to adapt the car to Swiss standards, a conversion is necessary.
                <br>--<br>
                It's insane what other cars come along! :D </h3>
              </div>
            </div>
          </div>

          <div class="blog-content" data-aos="fade-right" data-aos-delay="200">
            <img src="images/newsflash/JDM4.jpg" alt="post 4">
            <div class="blog-title">
              <h3>"Time for some NOS ;)"</h3>
              <button class="btn" role="fadeWhenHover" aria-label="Hover to read more">Hover to read more</button>
              <span>5th of November 2021</span>
            </div>
            <div class="overlay">
              <div class="text"><h3>Since nitromethane gas cylinders (NOS) are of course illegal in Switzerland 
                for road traffic, the somewhat cuddlier plush version will have to do! ;)</h3>
              </div>
            </div>
          </div>


        </div>
        <div class="owl-navigation">
          <span class="owl-nav-prev" role="slider" aria-label="true"><i class="fas fa-long-arrow-alt-left"></i></span>
          <span class="owl-nav-next" role="slider" aria-label="true"><i class="fas fa-long-arrow-alt-right"></i></span>
        </div>
      </div>
    </div>
  </section>


  <!-----x---- Blog Carousel (Newsflash) ----x-------->
  <!---------- Site Content (Blog) + Sidebar ------------->


  <section class="container">
    <!-- Blog Container -->
    <div class="site-content">
      <!-- Gets displayed with grid -->
      <div class="posts">
        <h2 class="title-main">Featured Blog Posts</h2>


        <?php foreach ($daten as $datapiece) { ?>
          <?php
          $ts = strtotime($datapiece['post_created']);
          $created = strftime("%d.%m.%Y", $ts);
          $alias = strtolower(filter_var($datapiece['post_title'], FILTER_SANITIZE_URL)); //Affenschwanz zweite Sicherheitsstufe
          $alias = preg_replace('/[^a-zA-Z0-9_-]+/', '-', strtolower($datapiece['post_title']));
          $slug = $datapiece['IDblogpost'] . ':' . $alias;
          ?>
          <!-- Post 1 -->
          <div class="post-content" data-aos="zoom-in" data-aos-delay="200">
            <!-- Whole Content post per post -->
            <div class="post-image">
              <!-- Image of the post for PHP and post information -->
              <div class="imagecontainer">
                <?php if (!empty($datapiece['post_image'])) { ?>
                  <img src="<?php echo IMAGEFOLDER . '/' . $datapiece['post_image']; ?>" />
                <?php } ?>
              </div>
              <div class="post-info flex-row">
                <!-- Post infobox -->
                <span><i class="fas fa-user text-gray"></i>&nbsp;&nbsp;<?php echo $datapiece['post_author']; ?></span>
                <span><i class="fas fa-calendar-alt text-gray"></i>&nbsp;&nbsp;<time><?php echo $created; ?></time></span>
                <!-- <span>2 Comments</span> -->
              </div>
            </div>
            <div class="post-title">
              <!-- Title and textbox of each post -->
              <a href="post.php?article=<?php echo $slug; ?>"><?php echo $datapiece['post_title']; ?></a>
              <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Laboriosam, expedita qui explicabo sit iure neque autem nulla totam adipisci
                voluptates laudantium itaque possimus ipsam ut obcaecati rem ab debitis
                asperiores reprehenderit. Modi error nobis nesciunt dolor aspernatur neque
                dolores adipisci.</p> -->
              <a class="btn post-btn" href="post.php?article=<?php echo $slug; ?>">Read me &nbsp;<i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        <?php } ?>

        <hr>

        <div class="post-content" data-aos="zoom-in" data-aos-delay="200">
          <!-- Whole Content post per post -->
          <div class="post-image">
            <!-- Image of the post for PHP and post information -->
            <div>
              <img class="img" src="./images/blog-posts/180sx.jpg" alt="Silvan's Nissan 180sx"> <!-- TEST ME PLS -->
            </div>
            <div class="post-info flex-row">
              <!-- Post infobox -->
              <span><i class="fas fa-user text-gray"></i>&nbsp;&nbsp;Sillest</span>
              <span><i class="fas fa-calendar-alt text-gray"></i>&nbsp;&nbsp;September 3, 2021</span>
              <!-- <span>2 Comments</span> -->
            </div>
          </div>
          <div class="post-title">
            <!-- Title and textbox of each post -->
            <a href="post.php">When was the last time we met each other?!? </a>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
              Laboriosam, expedita qui explicabo sit iure neque autem nulla totam adipisci
              voluptates laudantium itaque possimus ipsam ut obcaecati rem ab debitis
              asperiores reprehenderit. Modi error nobis nesciunt dolor aspernatur neque
              dolores adipisci.</p>
            <a href="post.php" class="btn post-btn">Read More &nbsp;<i class="fas fa-arrow-right"></i></a>
            <!-- <button class="btn post-btn" role="button" aria-label="read more">Read More &nbsp;<i class="fas fa-arrow-right"></i></button> -->
          </div>
        </div>

        <hr>

        <!-- Post 2 -->
        <div class="post-content" data-aos="zoom-in" data-aos-delay="200">
          <div class="post-image">
            <div>
              <img class="img" src="./images/blog-posts/supra.jpg" alt="Two Supras and Switzerland">
            </div>
            <div class="post-info flex-row">
              <span><i class="fas fa-user text-gray"></i>&nbsp;&nbsp;Oli_Supra</span>
              <span><i class="fas fa-calendar-alt text-gray"></i>&nbsp;&nbsp;October 18, 2021</span>
              <!-- <span>6 Comments</span> -->
            </div>
          </div>
          <div class="post-title">
            <a href="#">Would you add the Mount Fuji in the background? ;) </a>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
              Laboriosam, expedita qui explicabo sit iure neque autem nulla totam adipisci
              voluptates laudantium itaque possimus ipsam ut obcaecati rem ab debitis
              asperiores reprehenderit. Modi error nobis nesciunt dolor aspernatur neque
              dolores adipisci.</p>
            <a href="post.php" class="btn post-btn">Read More &nbsp;<i class="fas fa-arrow-right"></i></a>
            <!-- <button class="btn post-btn" role="button" aria-label="read more">Read More &nbsp;<i class="fas fa-arrow-right"></i></button> -->
          </div>
        </div>

        <hr>

        <!-- Post 3 -->
        <div class="post-content" data-aos="zoom-in" data-aos-delay="200">
          <div class="post-image">
            <div>
              <img class="img" src="./images/blog-posts/rx7.jpg" alt="Madza RX7 on the streets">
            </div>
            <div class="post-info flex-row">
              <!-- Post infobox -->
              <span><i class="fas fa-user text-gray"></i>&nbsp;&nbsp;swiss__rx7</span>
              <span><i class="fas fa-calendar-alt text-gray"></i>&nbsp;&nbsp;September 17, 2021</span>
              <!-- <span>8 Comments</span> -->
            </div>
          </div>
          <div class="post-title">
            <a href="#">Ready for 2022! What about you? </a>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
              Laboriosam, expedita qui explicabo sit iure neque autem nulla totam adipisci
              voluptates laudantium itaque possimus ipsam ut obcaecati rem ab debitis
              asperiores reprehenderit. Modi error nobis nesciunt dolor aspernatur neque
              dolores adipisci.</p>
            <a href="post.php" class="btn post-btn">Read More &nbsp;<i class="fas fa-arrow-right"></i></a>
            <!-- <button class="btn post-btn" role="button" aria-label="read more">Read More &nbsp;<i class="fas fa-arrow-right"></i></button> -->
          </div>
        </div>
        <!-- Blogpost page dial -->
        <div class="pagination flex-row">
          <a href="#" role="menuitem"><i class="fas fa-chevron-left" aria-label="previous"></i></a>
          <a class="pages" href="#" role="menuitem" aria-label="page 1">1</a>
          <a class="pages" href="#" role="menuitem" aria-label="page 2">2</a>
          <a class="pages" href="#" role="menuitem" aria-label="page 3">3</a>
          <a href="#" role="menuitem" aria-label="next"><i class="fas fa-chevron-right"></i></a>
        </div>

      </div>
      <aside class="sidebar">
        <!-- All the content in the sidebar -->
        <h2 class="title-sidebar">Categories</h2>
        <div class="category">
          <ul class="category-list">

            <li class="list-items" data-aos="fade-left" data-aos-delay="100">
              <a href="#">Group-Meets</a>
            </li>

            <li class="list-items" data-aos="fade-left" data-aos-delay="200">
              <a href="#">Event-Meets</a>
            </li>

            <li class="list-items" data-aos="fade-left" data-aos-delay="300">
              <a href="#">"Me and you"-Meets</a>
            </li>

            <li class="list-items" data-aos="fade-left" data-aos-delay="400">
              <a href="#">Rideout</a>
            </li>

            <li class="list-items" data-aos="fade-left" data-aos-delay="500">
              <a href="#">Customizing</a>
            </li>

            <li class="list-items" data-aos="fade-left" data-aos-delay="600">
              <a href="#">Random and Others</a>
            </li>

          </ul>
        </div>
        <div class="popular-post">
          <!-- All the popular posts -->
          <h2 class="title-sidebar">Popular Posts</h2>

          <!-- Popular Post 1 -->
          <div class="post-content" data-aos="flip-up" data-aos-delay="200">
            <div class="post-image">
              <div>
                <img class="img" src="./images/popular-blogposts/sushitime.jpg" alt="Sushi and Modelcar">
              </div>
              <div class="post-info flex-row">
                <!-- Post infobox -->
                <!-- <span><i class="fas fa-user text-gray"></i>&nbsp;&nbsp;swiss__rx7</span> -->
                <span><i class="fas fa-calendar-alt text-gray"></i>&nbsp;&nbsp;November 2, 2021</span>
                <!-- <span>9 Comments</span> -->
              </div>
            </div>
            <div class="post-title">
              <a href="#">Super delicious, no matter which size...</a>
            </div>
          </div>
          <hr class="sideline">

          <!-- Popular Post 2 -->
          <div class="post-content" data-aos="flip-up" data-aos-delay="300">
            <div class="post-image">
              <div>
                <img class="img" src="./images/popular-blogposts/JDM-Meet_Ace.jpg" alt="Ace Cafe Lucerne Meet">
              </div>
              <div class="post-info flex-row">
                <!-- Post infobox -->
                <!-- <span><i class="fas fa-user text-gray"></i>&nbsp;&nbsp;swiss__rx7</span> -->
                <span><i class="fas fa-calendar-alt text-gray"></i>&nbsp;&nbsp;November 20, 2021</span>
                <!-- <span>14 Comments</span> -->
              </div>
            </div>
            <div class="post-title">
              <a href="#">Ace Cafe JDM Meet 2021 - What was going on?</a>
            </div>
          </div>
          <hr class="sideline">

          <!-- Popular Post 3 -->
          <div class="post-content" data-aos="flip-up" data-aos-delay="400">
            <div class="post-image">
              <div>
                <img class="img" src="./images/popular-blogposts/keytosuccess.jpg" alt="R33 with keychain">
              </div>
              <div class="post-info flex-row">
                <!-- Post infobox -->
                <!-- <span><i class="fas fa-user text-gray"></i>&nbsp;&nbsp;swiss__rx7</span> -->
                <span><i class="fas fa-calendar-alt text-gray"></i>&nbsp;&nbsp;November 20, 2021</span>
                <!-- <span>10 Comments</span> -->
              </div>
            </div>
            <div class="post-title">
              <a href="#">Can you tell which Japanese province this belongs to?</a>
            </div>
          </div>
          <hr class="sideline">

        </div>
        <div class="newsletter" data-aos="fade-up" data-aos-delay="300">
          <!-- Newsletter part -->
          <h2 class="title-sidebar">Newsletter</h2>
          <div class="form-element">
            <!-- <input type="text" name="email" id="fld_email" value="" placeholder="Email">   -->
            <input type="email" name="email" class="input-element" label="email" value="" placeholder="Email">
            <button class="btn form-btn" role="button" aria-label="subscribe">Subscribe</button>
          </div>
        </div>

        <div class="popular-tags">
          <!-- Popular tags section -->
          <h2 class="title-sidebar">Popular Tags</h2>
          <div class="tags flex-row">
            <span class="tag" data-aos="flip-up" data-aos-delay="100">JDM</span>
            <span class="tag" data-aos="flip-up" data-aos-delay="200">JDMSwitzerland</span>
            <span class="tag" data-aos="flip-up" data-aos-delay="300">GTR</span>
            <span class="tag" data-aos="flip-up" data-aos-delay="400">R33</span>
            <span class="tag" data-aos="flip-up" data-aos-delay="500">JDMLove</span>
            <span class="tag" data-aos="flip-up" data-aos-delay="600">JDMNation</span>
            <span class="tag" data-aos="flip-up" data-aos-delay="700">lowlife</span>
            <span class="tag" data-aos="flip-up" data-aos-delay="800">rideout</span>
            <span class="tag" data-aos="flip-up" data-aos-delay="900">isthatasupra</span>
          </div>
        </div>
      </aside>
    </div>
  </section>
  <!-----x---- Site Content (Blog) ----x-------->

</main>
<!---x---- MAIN SITE SECTION ----x------------------------------------------------------------------------------>


<!---------- footer ----------------------------------------------------------------------------------------------------->
<?php include(INCLUDE_FOLDER . '/footer.html.php'); // Use of the constant defined in config.php 
?>
<!-----x---- footer ----x------------------------------------------------------------------------------------------------>