<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Modificar datos</title>

  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/entrenador.css" />
  <link rel="stylesheet" href="/css/entrenador_datos.css" />
</head>

<body>
  <?php
  // Comienza la sesión
  session_start();

  if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true && $_SESSION["tipo_usuario"] === "entrenador") {
    echo "<p style='float: right'>";
    print_r($_SESSION);
    echo "</p>";
  } else {
    header("location: /html/login.php");
  }
  ?>

  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/header_entrenador.php");

  $crumbs = array("Perfil", "Modificar datos personales");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title_entrenador.php");

  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/side_menu_entrenador.php");
  ?>

  <?php
  $idEntrenador = $_SESSION["id"];
  include_once($_SERVER['DOCUMENT_ROOT'] . '/php/config.php');
  $sql = "SELECT * FROM `Entrenador` WHERE idEntrenador= $idEntrenador";
  $resultado = $link->query($sql);
  mysqli_close($link);
  ?>

  <!-- Content Start -->
  <div class="main">
    <div class="content-container">
      <h1>Modificar datos de entrenador</h1>
      <div class="form-container">
        <form action="/php/entrenador_datos.php" method="POST">
          <div class="form-field">
            <label for="email" class="field-title">Correo electronico *</label><br />
            <input type="email" value="<?php $resultado["correoEntrenador"] ?>" id="email" name="email" pattern="([a-zA-Z0-9.-_]{1,}@[a-zA-Z.-]{2,}[.]{1}[a-zA-Z]{2,})" required />
            <input typer="text" hidden value="<?php $idEntrenador ?>" id="idEntrenador" name="idEntrenador"><br />
          </div>

          <div class="form-field">
            <label for="password" class="field-title">Contraseña *</label><br />
            <input type="text" value="<?php $resultado["claveAcceso"] ?>" id="password" name="password" pattern="([a-zA-Z0-9.-_]{1,}@[a-zA-Z.-]{2,}[.]{1}[a-zA-Z]{2,})" required /><br />
          </div>

          <div class="form-field">
            <label for="name" class="field-title">Nombre completo</label><br />
            <input type="text" value="<?php $resultado["nombreCompleto"] ?>" id="name" name="name" autocomplete="off" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,96}" /><br />
          </div>

          <div class="form-field">
            <label for="dni" class="field-title">DNI/NIE</label><br />
            <input type="text" value="<?php $resultado["DNI"] ?>" id="dni" name="dni" autocomplete="off" pattern="((([x-zX-Z])|([lmLM])|[0-9]){1}([ ]?)(([0-9]){7})([-]?)([a-zA-Z]{1}))" minlength="9" maxlength="11" /><br />
          </div>

          <div class="form-field">
            <label for="whatsapp" class="field-title">Teléfono (Whatsapp)</label><br />
            <script src="/js/main.js"></script>
            <label id="tlf-prefijo">
              <input type="text" value="<?php $resultado["telefono"] ?>" id="whatsapp" name="whatsapp" class="ibacor_fi" data-prefix="" autocomplete="off" pattern="(((([6]{1})([0-9]{2}))|(([7]{1})([1-4]{1})([0-9]{1})))([ ]?)((([0-9]{2})([ ]?)([0-9]{2})([ ]?)([0-9]{2}))|(([0-9]{3})([ ]?)([0-9]{3}))))" style="padding-left: 48px;" /><br />
            </label>
          </div>

          <div class="form-field">
            <label for="perfil" class="field-title">Foto perfil</label><br />
            <input type="file" id="perfil" name="perfil" autocomplete="off" accept="image/*" /><br />
          </div>
          <input type="submit" value="Enviar" />
      </div>
      </form>
    </div>
  </div>
  <!-- Content End -->


  <!-- JQuery -->
  <script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="/js/main.js"></script>
</body>

</html>