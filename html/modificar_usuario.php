<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Editar usuario</title>

  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/administrador.css" />
  <link rel="stylesheet" href="/css/modificar_usuario.css" />
</head>

<body>
  <?php
  // Comienza la sesión
  session_start();

  if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true && $_SESSION["tipo_usuario"] === "administrador") {
    echo "<p style='float: right'>";
    print_r($_SESSION);
    echo "</p>";
  } else {
    header("location: /html/login.php");
  }
  ?>

  <?php
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/header_admin.php");

  $crumbs = array("Usuarios", "Modificar usuario");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title_admin.php");

  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/side_menu_admin.php");
  ?>

  <!-- Content Start -->
  <div class="main">
    <div class="content-container">
      <h1>Modificar datos de entrenador</h1>
      <div class="form-container">
        <form action="#" method="POST">
          <div class="form-field">
            <label for="name" class="field-title">Nombre completo</label><br />
            <input type="text" id="name" name="name" autocomplete="off" /><br />
          </div>

          <div class="form-field">
            <label for="birthdate" class="field-title">Fecha de nacimiento</label><br />
            <input type="date" id="birthdate" name="birthdate" autocomplete="off" /><br />
          </div>

          <div class="form-field">
            <p class="field-title">Entrena:</p><br>
            <input type="radio" id="grupo-a" name="group" autocomplete="off" />
            <label for="grupo-a">Grupo A</label><br />
            <input type="radio" id="grupo-b" name="group" autocomplete="off" />
            <label for="grupo-b">Grupo B</label><br />
            <input type="radio" id="grupo-c" name="group" autocomplete="off" />
            <label for="grupo-c">Grupo C</label><br />
          </div>

          <div class="form-field">
            <label for="email" class="field-title">Correo eléctronico</label><br />
            <input type="email" id="email" name="email" autocomplete="off" /><br />
          </div>

          <div class="form-field">
            <label for="main-phone" class="field-title">Teléfono</label><br />
            <input type="text" id="main-phone" name="main-phone" autocomplete="off" /><br />
          </div>

          <div class="form-field">
            <label for="secondary-phone" class="field-title">Teléfono secundario</label><br />
            <input type="text" id="secondary-phone" name="secondary-phone" autocomplete="off" /><br />
          </div>

          <div class="form-field">
            <label for="dni" class="field-title">D.N.I</label><br />
            <input type="text" id="dni" name="dni" autocomplete="off" /><br />
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