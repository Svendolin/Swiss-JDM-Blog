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





$(document).ready(function () {

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
  $menuToggleBtn = $('.menu-toggle-btn')

  /* --- click event to toggle the nav menu --- */
  $toggleCollapse.click(function () {
    $nav.toggleClass('collapse', 1000); /* we get a new collapse class especially made for toggeling */
  })

  /* --- click event to exchange the burgersymbol with the x of fa-times --- */
  $menuToggleBtn.click(function () {
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
    autoplay: false, // false to stop the carousel from spinning :D
    autoplayTimeout: 10000, // = 10 Seconds
    dots: false,
    nav: true,
    navText: [$('.owl-navigation .owl-nav-prev'), $('.owl-navigation .owl-nav-next')],
    responsive: responsive // This defined variable (above) got a function

  });

  // --  click to scroll to top -- //
  $('.move-up span').click(function () {
    $('html, body').animate({
      scrollTop: 0
    }, 1000); // 1 Second duration to scroll up
  })

  // --  AOS Animation on scroll Instance -- //
  AOS.init()


  // -- ERROR-MESSAGES login and signup -- //
  // $('btn solid sign-in').click(function(){
  //   $('error-message').show(900);

  // })


});

/* ====x=================== index.php ===================x==== */
/* ======================== login.php ======================== */

const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const login_container = document.querySelector(".login-container");

if (sign_up_btn != null) { // Needs to be done because this function is null (an empty or non-existent value) on all the other files EXCEPT at the login...
  sign_up_btn.addEventListener('click', () => {
    login_container.classList.add("sign-up-mode");
  });
}
if (sign_up_btn != null) { // ...Same here because the event will only happen at login.php. Javascript tries to set the function on every existing sub-page
  sign_in_btn.addEventListener('click', () => {
    login_container.classList.remove("sign-up-mode");
  });
}


/* ====x=================== login.php ===================x==== */