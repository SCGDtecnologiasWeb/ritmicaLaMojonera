<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Inscripciones</title>

  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/administrador.css" />
  <link rel="stylesheet" href="/css/administrar_inscripciones.css" />
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

  $crumbs = array("Usuarios", "Inscripciones");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title_admin.php");

  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/side_menu_admin.php");
  ?>

  <!-- Content Start -->
  <div class="content-container">
    <div class="gymnast-container">
      <div class="gymnast">
        <div class="img-container">
          <img src="/assets/Juanma - profile.jpeg" alt="Inscripción" />
        </div>
        <div class="name-container">
          <h2>Nombre completo</h2>
        </div>
        <div class="contact-container">
          <p>Nombre Completo</p>
          <p>Pago realizado: Si</p>
          <p class="hidden-content hidden">Fecha: XX / XX / XXXX</p>
          <p class="hidden-content hidden">Telefono: 666 66 66 66</p>
        </div>
      </div>
      <img src="/assets/tick.webp" class="edit-img" alt="Editar" />
      <img src="/assets/cross.jpg" class="bin-img" alt="Eliminar" />
    </div>
    <div class="gymnast-container">
      <div class="gymnast">
        <div class="img-container">
          <img src="/assets/annie.jpeg" alt="Inscripción" />
        </div>
        <div class="name-container">
          <h2>Nombre completo</h2>
        </div>
        <div class="contact-container">
          <p>Nombre Completo</p>
          <p>Pago realizado: Si</p>
          <p class="hidden-content hidden">Fecha: XX / XX / XXXX</p>
          <p class="hidden-content hidden">Telefono: 666 66 66 66</p>
        </div>
      </div>
      <img src="/assets/tick.webp" class="edit-img" alt="Editar" />
      <img src="/assets/cross.jpg" class="bin-img" alt="Eliminar" />
    </div>
    <div class="gymnast-container">
      <div class="gymnast">
        <div class="img-container">
          <img src="/assets/sofi.png" alt="Inscripción" />
        </div>
        <div class="name-container">
          <h2>Nombre completo</h2>
        </div>
        <div class="contact-container">
          <p>Nombre Completo</p>
          <p>Pago realizado: Si</p>
          <p class="hidden-content hidden">Fecha: XX / XX / XXXX</p>
          <p class="hidden-content hidden">Telefono: 666 66 66 66</p>
        </div>
      </div>
      <img src="/assets/tick.webp" class="edit-img" alt="Editar" />
      <img src="/assets/cross.jpg" class="bin-img" alt="Eliminar" />
    </div>
    <div class="gymnast-container">
      <div class="gymnast">
        <div class="img-container">
          <img src="/assets/mariMar.jpeg" alt="Inscripción" />
        </div>
        <div class="name-container">
          <h2>Nombre completo</h2>
        </div>
        <div class="contact-container">
          <p>Nombre Completo</p>
          <p>Pago realizado: Si</p>
          <p class="hidden-content hidden">Fecha: XX / XX / XXXX</p>
          <p class="hidden-content hidden">Telefono: 666 66 66 66</p>
        </div>
      </div>
      <img src="/assets/tick.webp" class="edit-img" alt="Editar" />
      <img src="/assets/cross.jpg" class="bin-img" alt="Eliminar" />
    </div>
  </div>
  <!-- Content End -->

  <!-- JQuery -->
  <script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="/js/main.js"></script>
</body>

</html>