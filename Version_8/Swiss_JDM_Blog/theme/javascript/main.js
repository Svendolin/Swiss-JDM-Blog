/* ======================== index.php ======================== */

// Live Server autoscroll bug
// $(window).scroll (function(){
//   sessionStorage.scrollTop = $(this).scrollTop();
// });

// Variables:
const responsive = {
  0: {
    items: 1 // Bugfix (Avoid to see all 4 items in just 320px)
  },
  400: {
    items: 1 // At 320px vw we only see one carousel item
  }, 
  700: {
    items: 2 // At 700px vw we see two carousel items
  },
  1100: {
    items: 3 // At 1000px vw we see three carousel items
  }
}





$(document).ready(function(){

   /* CSS Scrollbug */
// $(window).on('unload', function() {
//   $(window).scrollTop(0); }); 
//     window.onunload = function(){ 
//       window.scrollTo(0,0); }; 
//       if ('scrollRestoration' in history) 
//       { history.scrollRestoration = 'manual'; };

  /* CSS Scrollbug */
  // if (sessionStorage.scrollTop != "undefined") {
  //   $(window).scrollTop(sessionStorage.scrollTop);
  // }


  /* --- definition of variables --- */
  $nav = $('.nav');
  $toggleCollapse = $('.toggle-collapse');
  $menuToggleBtn =  $('.menu-toggle-btn')

  /* --- click event to toggle the nav menu --- */
  $toggleCollapse.click(function(){
    $nav.toggleClass('collapse', 1000); /* we get a new collapse class especially made for toggeling */
  })

  /* --- click event to exchange the burgersymbol with the x of fa-times --- */
  $menuToggleBtn.click(function() {
    $(this).toggleClass('fa-times');
  })

  /* Attempt to hover out to remove the collapse*/
  // $("main").hover(
  //   function(){
  //       $('.collapse').fadeOut('slow', function(){
  //           console.log('Faded Out')
  //       });
  //   });
    

  // -- owl-crousel for blog -- //
  $('.owl-carousel').owlCarousel({
    loop: true,
    autoplay: false, // false to stop
    autoplayTimeout: 5000,
    dots: false,
    nav: true,
    navText: [$('.owl-navigation .owl-nav-prev'), $('.owl-navigation .owl-nav-next')],
    responsive: responsive // This defined variable (above) got a function
    
    });

    // --  click to scroll to top -- //
    $('.move-up span').click(function(){
      $('html, body').animate({
        scrollTop: 0
      }, 1000); // 1 Second duration to scroll up
    })

    // --  AOS Animation on scroll Instance -- //
    AOS.init()


   
    // --  SHOW and HIDE of the collapse infos -- //
    $(".btn1").click(function(){
      $(".blog1").show(900);
    });

    $(".return1").click(function(){
      $(".blog1").hide(900);
    });


  });
  
  /* ====x=================== index.php ===================x==== */
  /* ======================== login.php ======================== */

  const sign_in_btn = document.querySelector("#sign-in-btn");
  const sign_up_btn = document.querySelector("#sign-up-btn");
  const login_container = document.querySelector(".login-container");

  sign_up_btn.addEventListener('click', () => {
    login_container.classList.add("sign-up-mode");
  });

  sign_in_btn.addEventListener('click', () => {
    login_container.classList.remove("sign-up-mode");
  });



  /* ====x=================== login.php ===================x==== */