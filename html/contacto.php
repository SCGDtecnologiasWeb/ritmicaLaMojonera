<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contacto</title>

  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/contacto.css" />
</head>

<body>
  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/menu.php");

  $crumbs = array("Inicio", "Contacto");
  $links = array("/html/index.php", "/html/contacto.php");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title.php");
  ?>

  <!-- Content Start -->
  <div class="content-container">
    <h1>Información de contacto</h1>
    <p>
      Email: cdrlamojonera@gmail.com<br />
      Whatsapp: +34 621 013 265<br />
      Telefono: 621 013 265<br />
      Facebook:
      <a href="https://www.facebook.com/ritmicalamojonera">https://www.facebook.com/ritmicalamojonera</a>
    </p>
    <h1>Nuestra ubicación</h1>
    <div class="iframe-wrapper">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3196.7081663755785!2d-2.6863952961698434!3d36.75357542073728!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xd3985bd74c8246c1!2sCD%20Gimnasia%20Ritmica%20La%20Mojonera!5e0!3m2!1ses!2ses!4v1604785551581!5m2!1ses!2ses" width="100%" height="550" frameborder="0" style="border: 0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>
    <h1>Mandanos un mensaje</h1>
    <div class="form-container">
      <form action="/php/contacto.php" method="POST" id="formulario">
        <label for="name">Nombre</label>
        <input type="text" id="name" name="name" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,96}" required /><br />
        <label for="email">Correo electrónico</label>
        <input type="email" id="email" name="email" pattern="([a-zA-Z0-9.-_]{1,}@[a-zA-Z.-]{2,}[.]{1}[a-zA-Z]{2,})" required /><br />
        <label for="subject">Asunto</label>
        <input type="text" id="subject" name="subject" required /><br />
        <label for="message">Mensaje</label>
        <textarea id="message" name="message" required></textarea><br />
        <span id="test"></span>
        <input type="submit" value="Enviar" />
      </form>
    </div>
  </div>
  <!-- Content End -->

  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/footer.php");
  ?>

  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="/js/main.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {

      $("#formulario").submit(function(event) {
        event.preventDefault();

        $.ajax({
          type: 'POST',
          url: '/php/contacto.php',
          data: {
            name: $("#name").val(),
            email: $("#email").val(),
            subject: $("#subject").val(),
            message: $("#message").val(),
          },
          success: function(response) {
            if (response === "Tu mensaje ha sido enviado con éxito") {
              $("#test").css("color", "green");
            } else if (response === "Ha habido un problema, tu mensaje no ha podido ser enviado") {
              $("#test").css("color", "red");
            }
            $("#test").html(response);
          }
        });

        console.log(getFormData($(this)));
      });

    });

    function getFormData($form) {
      var unindexed_array = $form.serializeArray();
      var indexed_array = {};

      $.map(unindexed_array, function(n, i) {
        indexed_array[n['name']] = n['value'];
      });

      return indexed_array;
    }
  </script>
</body>

</html>