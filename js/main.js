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
    '/assets/slider1.jpeg',
    '/assets/slider2.jpeg',
    '/assets/slider3.jpeg'
  ];
  var texts = [
    'Club La Mojonera',
    'Desde nivel Iniciación hasta Absoluto',
    'Más de 50 Gimnastas'
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
    $(".slide-right").css("background", "linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url(" + images[newIndex - 1] + ")");
    $(".slide-right").css("background-position", "center");
    $(".slide-right").css("background-size", "cover");
    $(".slide-right").css("background-repeat", "no-repeat");
    $(".slide-right").find("span").text(texts[newIndex - 1]);
    $(".slide-left").animate({ marginLeft: "-66.66%" }, 500, function(){
      $(".slide-main").css("background", "linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url(" + images[newIndex - 1] + ")");
      $(".slide-main").css("background-position", "center");
      $(".slide-main").css("background-size", "cover");
      $(".slide-main").css("background-repeat", "no-repeat");
      $(".slide-main").find("span").text(texts[newIndex - 1]);
      $(".slide-left").css("margin-left", "-33.33%");
      canClickSlideButton = true;
      imageInterval = setInterval(changeImg, 6000);
    });
  }

  // Deslizar slider hacia la izquierda
  // newIndex: indice de la nueva imagen
  // prevIndex: indice de la imagen previa
  function slideLeft(newIndex, prevIndex) {
    $(".slide-left").css("background", "linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url(" + images[newIndex - 1] + ")");
    $(".slide-left").css("background-position", "center");
    $(".slide-left").css("background-size", "cover");
    $(".slide-left").css("background-repeat", "no-repeat");
    $(".slide-left").find("span").text(texts[newIndex - 1]);
    $(".slide-left").animate({ marginLeft: "0%" }, 500, function(){
      $(".slide-main").css("background", "linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url(" + images[newIndex - 1] + ")");
      $(".slide-main").css("background-position", "center");
      $(".slide-main").css("background-size", "cover");
      $(".slide-main").css("background-repeat", "no-repeat");
      $(".slide-main").find("span").text(texts[newIndex - 1]);
      $(".slide-left").css("margin-left", "-33.33%");
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
  /********** Side Menu **********/
  $(".open-btn").click(function() {
    $(".side-menu").css("margin-left", "0");
    $(".title-row").css("margin-left", "200px");
  });

  $(".close-btn").click(function() {
    $(".side-menu").css("margin-left", "-200px");
    $(".title-row").css("margin-left", "0");
  });

  /********** Go back button **********/
  // When the user clicks on the button, scroll to the top of the document
  $("#goback-btn").click(function () {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
  });

  /********** Administrar usuarios, mostrar info **********/
  $(".trainer").click(function(){
    if ($(this).find(".hidden-content").hasClass("hidden")) {
      $(this).find(".hidden-content").removeClass("hidden");
    }
    else {
      $(this).find(".hidden-content").addClass("hidden");
    }
  });

  $(".gymnast").click(function(e){
    if (e.target.id == "payment") {
      return;
    }
    if ($(this).find(".hidden-content").hasClass("hidden")) {
      $(this).find(".hidden-content").removeClass("hidden");
    }
    else {
      $(this).find(".hidden-content").addClass("hidden");
    }
  });

  /********** Confirmación antes de borrar **********/
  $(".bin-img").on("click", function () {
    return confirm("¿Seguro que quieres realizar esta acción?");
  });

  /*********** Filtro ******************/
  $('.demo i').click(function() {  
    $(this).parent().find('input').click();  
  });  
  updateConfig();  

  function updateConfig() {  
    var options = {};  
    options.opens = "center";  
    options.ranges = {  
      'Hoy': [moment(), moment()],  
      'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],  
      'Últimos 7 Días': [moment().subtract(6, 'days'), moment()],  
      'Últimos 30 Días': [moment().subtract(29, 'days'), moment()],  
      'Este mes': [moment().startOf('month'), moment().endOf('month')],  
      'Último mes': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]  
    };  
    $('#config-demo').daterangepicker(options, function(start, end, label) {   
      var startDate = start.format('YYYY-MM-DD'); var endDate = end.format('YYYY-MM-DD');  
      passDate(startDate,endDate);      
    });  
        
  }  


  function passDate(startDate,endDate) {  
    $('.loader').show();  
    $.ajax({  
      type: 'POST', // define the type of HTTP verb we want to use (POST for our form)  
      url: 'date-filteration.php', // the url where we want to POST  
      data: 'startDate='+startDate+'&endDate='+endDate, // our data object  
    })  
    // using the done promise callback  
    .done(function(data) {  
      $('.loader').hide();  
      // log data to the console so we can see  
      $('.response').html(data);  
      // here we will handle errors and validation messages  
    });  
  }  
});
