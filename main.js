$(document).ready(function() {
  /********** Menu responsive **********/
  $(".dropdown-icon").click(function(){
    var x = $(".topnav");
    if (x.attr('class') === "col-11 topnav") {
      x.addClass("responsive");
    } else {
      x.removeClass("responsive");
    }
  });

  /********** Slider */
  var images = [];
  images[0] = 'assets/slider1.jpeg';
  images[1] = 'assets/slider2.jpeg';
  images[2] = 'assets/slider3.jpeg';

  /********** Slideshow **********/
  canClickSlideButton = true;
  var imageInterval = setInterval(changeImg, 6000);

  function slideRight(newIndex, prevIndex) {
    $("#last-img").attr("src", images[newIndex - 1]);
    $(".first-slide").animate({marginLeft: "-66.66%"},1000,
      function(){
        $("#main-img").attr("src", images[newIndex - 1]);
        $(".first-slide").animate({marginLeft: "-33.33%"},0);
        canClickSlideButton = true;
      }
    );
  }

  function slideLeft(newIndex, prevIndex) {
    $("#first-img").attr("src", images[newIndex - 1]);
    $(".first-slide").animate({marginLeft: "0%"},1000,
      function(){
        $("#main-img").attr("src", images[newIndex - 1]);
        $(".first-slide").animate({marginLeft: "-33.33%"},0);
        canClickSlideButton = true;
      }
    );
  }

  $(".slide-btn").click(function(){
    if (!canClickSlideButton) {
      return;
    }
    canClickSlideButton = false

    var prevIndex = parseInt($("#main-img").attr("src").charAt(13));
    var newIndex = parseInt($(this).attr("id").charAt(10));

    $("#slide-btn-" + prevIndex).css("background", "transparent");
    $("#slide-btn-" + newIndex).css("background", "#40d3dc");
    if (newIndex === prevIndex) {
      canClickSlideButton = true;
    }
    else if (newIndex > prevIndex) {
      slideRight(newIndex, prevIndex);
    }
    else {
      slideLeft(newIndex, prevIndex);
    }
    clearInterval(imageInterval);
    imageInterval = setInterval(changeImg, 6000);
  });

  $(".slider-arrow").click(function(){
    if (!canClickSlideButton) {
      return;
    }
    canClickSlideButton = false

    var arrow = $(this).attr("id").substring(13);
    var prevIndex = parseInt($("#main-img").attr("src").charAt(13));

    $("#slide-btn-" + prevIndex).css("background", "transparent");

    if (arrow === "right") {
      var newIndex = (prevIndex + 1 === 4) ? 1 : prevIndex + 1;
      $("#slide-btn-" + newIndex).css("background", "#40d3dc");
      slideRight(newIndex, prevIndex);
    } else if (arrow === "left") {
      var newIndex = (prevIndex - 1 === 0) ? 3 : prevIndex - 1;
      $("#slide-btn-" + newIndex).css("background", "#40d3dc");
      slideLeft(newIndex, prevIndex);
    }

    clearInterval(imageInterval);
    imageInterval = setInterval(changeImg, 6000);
  });

  function changeImg(){
    if (!canClickSlideButton) {
      return;
    }
    canClickSlideButton = false

    var prevIndex = parseInt($("#main-img").attr("src").charAt(13));
    var newIndex = (prevIndex + 1 === 4) ? 1 : prevIndex + 1;

    $("#slide-btn-" + prevIndex).css("background", "transparent");
    $("#slide-btn-" + newIndex).css("background", "#40d3dc");

    slideRight(newIndex, prevIndex);
  }

  $(".slider").hover(function(){
    clearInterval(imageInterval);
  }, function(){
    imageInterval = setInterval(changeImg, 6000);
  });
  
});

/********** Go back button **********/
mybutton = document.getElementById("goback-btn");

// When the user clicks on the button, scroll to the top of the document
function goBack() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
} 