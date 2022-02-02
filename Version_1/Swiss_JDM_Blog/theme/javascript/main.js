// Live Server autoscroll bug
$(window).scroll (function(){
  sessionStorage.scrollTop = $(this).scrollTop();
});

// Variables:
const responsive = {
  0: {
    items: 1 // Bugfix (Avoid to see all 4 items in just 320px)
  },
  320: {
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
$(window).on('unload', function() {
  $(window).scrollTop(0); }); 
    window.onunload = function(){ 
      window.scrollTo(0,0); }; 
      if ('scrollRestoration' in history) 
      { history.scrollRestoration = 'manual'; };

  /* CSS Scrollbug */
  if (sessionStorage.scrollTop != "undefined") {
    $(window).scrollTop(sessionStorage.scrollTop);
  }


  /* --- definition of variables --- */
  $nav = $('.nav');
  $toggleCollapse = $('.toggle-collapse')

  /* --- click event on toggle menu --- */
  $toggleCollapse.click(function(){
    $nav.toggleClass('collapse'); /* we get a new collapse class especially made for toggeling */
  })

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
      }, 2000); // 2 Second duration to scroll up
    })

    // --  AOS Animation on scroll Instance -- //
    AOS.init()



  });