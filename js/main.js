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

  $(".gymnast").click(function(){
    if ($(this).find(".hidden-content").hasClass("hidden")) {
      $(this).find(".hidden-content").removeClass("hidden");
    }
    else {
      $(this).find(".hidden-content").addClass("hidden");
    }
  });

  /************** Prefijo ****************/
  $(".ibacor_fi").focus(function(){
    var a=$(this).data("prefix"),ibacor_currentId=$(this).attr('id'),ibacor_val=$(this).val();
    if(ibacor_val==''){
      $(this).val(a)
    }
    ibacor_fi(a.replace('ibacorat',''),ibacor_currentId);
    return false
  });
  function ibacor_fi(d,e){
    $('#'+e).keydown(function(c){
      setTimeout(function(){
        var a=bcr_riplis($('#'+e).val()),qq=bcr_riplis(d),ibacor_jumlah=qq.length,ibacor_cek=a.substring(0,ibacor_jumlah);
        if(a.match(new RegExp(qq))&&ibacor_cek==qq){
          $('#'+e).val(bcr_unriplis(a))
        }else{
          if(c.key=='Control'||c.key=='Backspace'||c.key=='Del'){
            $('#'+e).val(bcr_unriplis(qq))
          }else{
            var b=bcr_unriplis(qq)+c.key;$('#'+e).val(b.replace("undefined",""))
          }
        }
      },50)
    })
  }function bcr_riplis(a){
    var f=['+','$','^','*','?'];
    var r=['ibacorat','ibacordolar','ibacorhalis','ibacorkali','ibacortanya'];
    $.each(f,function(i,v){
      a=a.replace(f[i],r[i])
    });
    return a
  }function bcr_unriplis(a){
    var f=['+','$','^','*','?'];
    var r=['ibacorat','ibacordolar','ibacorhalis','ibacorkali','ibacortanya'];
    $.each(f,function(i,v){
      a=a.replace(r[i],f[i])
    });
    return a
  }

});
