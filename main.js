$(document).ready(function () {
  /********** Menu responsive **********/
  $(".dropdown-icon").click(function () {
    var x = $("#nav-col");
    if (!x.hasClass("responsive")) {
      x.addClass("responsive");
    }
    else {
      x.removeClass("responsive");
    }
  });

  /********** Slider ***********/
  var images = [
    "assets/slider1.jpeg",
    "assets/slider2.jpeg",
    "assets/slider3.jpeg"
  ];
  var prevIndex = 1;
  var newIndex = 1;

  canClickSlideButton = true;
  var imageInterval = setInterval(changeImg, 6000);

  // Funcion para cambiar de imagen cuando clicamos un boton
  $(".slide-btn").click(function () {
    if (!canClickSlideButton) {
      return;
    }
    canClickSlideButton = false;
    clearInterval(imageInterval);

    prevIndex = newIndex;
    switch($(this).attr("id")){
      case "slide-btn-1":
        newIndex = 1;
        break;
      case "slide-btn-2":
        newIndex = 2;
        break;
      case "slide-btn-3":
        newIndex = 3;
        break;
      default:
        return;
    }

    $("#slide-btn-" + prevIndex).css("background", "transparent");
    $("#slide-btn-" + newIndex).css("background", "#40d3dc");

    if (newIndex === prevIndex) {
      canClickSlideButton = true;
      imageInterval = setInterval(changeImg, 6000);
    }
    else if (newIndex > prevIndex) {
      slideRight(newIndex, prevIndex);
    }
    else {
      slideLeft(newIndex, prevIndex);
    }
  });

  // Deslizar slider hacia la derecha
  // newIndex: indice de la nueva imagen
  // prevIndex: indice de la imagen previa
  function slideRight(newIndex, prevIndex) {
    $("#last-img").attr("src", images[newIndex - 1]);
    $(".first-slide").animate({ marginLeft: "-66.66%" }, 500, function(){
      $("#main-img").attr("src", images[newIndex - 1]);
      $(".first-slide").css("margin-left", "-33.33%");
      canClickSlideButton = true;
      imageInterval = setInterval(changeImg, 6000);
    });
  }

  // Deslizar slider hacia la izquierda
  // newIndex: indice de la nueva imagen
  // prevIndex: indice de la imagen previa
  function slideLeft(newIndex, prevIndex) {
    $("#first-img").attr("src", images[newIndex - 1]);
    $(".first-slide").animate({ marginLeft: "0%" }, 500, function(){
      $("#main-img").attr("src", images[newIndex - 1]);
      $(".first-slide").css("margin-left", "-33.33%");
      canClickSlideButton = true;
      imageInterval = setInterval(changeImg, 6000);
    });
  }

  // Funcion que cambia de imagen automaticamente cada cierto tiempo
  function changeImg() {
    if (!canClickSlideButton) {
      return;
    }
    canClickSlideButton = false;
    clearInterval(imageInterval);

    prevIndex = newIndex;
    newIndex = prevIndex + 1 === 4 ? 1 : prevIndex + 1;

    $("#slide-btn-" + prevIndex).css("background", "transparent");
    $("#slide-btn-" + newIndex).css("background", "#40d3dc");

    slideRight(newIndex, prevIndex);
  }

  // Codigo para que la imagen no cambie si el raton esta encima del slider
  // $(".slider").hover(
  //   function () {
  //     clearInterval(imageInterval);
  //   },
  //   function () {
  //     imageInterval = setInterval(changeImg, 6000);
  //   }
  // );
});

/********** Go back button **********/
mybutton = document.getElementById("goback-btn");

// When the user clicks on the button, scroll to the top of the document
function goBack() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
