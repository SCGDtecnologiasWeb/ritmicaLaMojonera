<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Matriculación</title>

  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/matriculacion.css" />
</head>

<body>
  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/menu.php");

  $crumbs = array("Inicio", "Matriculación");
  $links = array("/html/index.php", "/html/matriculacion.php");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title.php");
  ?>

  <!-- Content Start -->
  <div class="main">
    <div class="content-container">
      <h1>Matriculación</h1>
      <div class="form-container">
        <form action="/php/matriculacion.php" method="POST" enctype="multipart/form-data">
          <div class="form-field">
            <label for="name" class="field-title">Nombre completo</label><br />
            <input type="text" id="name" name="name" autocomplete="off" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,96}" required /><br />
          </div>

          <div class="form-field">
            <label for="birthdate" class="field-title">Fecha de nacimiento</label><br />
            <input type="date" id="birthdate" name="birthdate" autocomplete="off" required /><br />
          </div>

          <div class="form-field">
            <label for="dni" class="field-title">DNI/NIE</label><br />
            <input type="text" id="dni" name="dni" autocomplete="off" pattern="((([x-zX-Z])|([lmLM])|[0-9]){1}([ ]?)(([0-9]){7})([-]?)([a-zA-Z]{1}))" minlength="9" maxlength="11" required /><br />
          </div>

          <div class="form-field">
            <label for="parent" class="field-title">Nombre del padre, madre o tutor/a legal</label><br />
            <input type="text" id="parent" name="parent" autocomplete="off" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,96}" /><br required />
          </div>

          <div class="form-field">
            <label for="whatsapp" class="field-title">Teléfono (Whatsapp)</label><br />
            <script src="/js/main.js"></script>
            <label id="tlf-prefijo">
              <input type="text" id="whatsapp" name="whatsapp" class="ibacor_fi" data-prefix="" autocomplete="off" pattern="(((([6]{1})([0-9]{2}))|(([7]{1})([1-4]{1})([0-9]{1})))([ ]?)((([0-9]{2})([ ]?)([0-9]{2})([ ]?)([0-9]{2}))|(([0-9]{3})([ ]?)([0-9]{3}))))" required style="padding-left: 48px;" /><br />
            </label>
          </div>

          <div class="form-field">
            <p class="field-title">Nivel de la gimnasta</p><br>
            <input type="radio" id="escuela" name="level" autocomplete="off" value="Escuela" required checked />
            <label for="escuela">Escuela</label><br>
            <input type="radio" id="federada" name="level" autocomplete="off" value="Federada" />
            <label for="federada">Federada</label><br>
          </div>

          <div class="form-field">
            <label for="allergies" class="field-title">Alergias o enfermedades (Opcional, indicar cuál/es)</label><br />
            <input type="text" id="allergies" name="allergies" autocomplete="off" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,1000}" /><br />
          </div>

          <div class="form-field">
            <p class="field-title">Consentimiento a subir fotos en las redes sociales</p><br>
            <input type="radio" id="si-consentimiento" name="consent" autocomplete="off" value="Si" required checked />
            <label for="si-consentimiento">Si</label><br />
            <input type="radio" id="no-consentimiento" name="consent" autocomplete="off" value="No" />
            <label for="no-consentimiento">No</label><br />
          </div>

          <div class="form-field">
            <label for="payment" class="field-title">Adjuntar justificante de pago (Opcional: Ponerse en contacto para realizar el
              pago)</label><br />
            <input type="file" id="payment" name="payment" autocomplete="off" accept="image/*" /><br />
          </div>

          <input type="submit" value="Enviar" />
      </div>
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
</body>

</html>