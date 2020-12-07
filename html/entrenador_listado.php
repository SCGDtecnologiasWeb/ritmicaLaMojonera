<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Listado de gimnastas</title>

  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/entrenador.css" />
  <link rel="stylesheet" href="/css/entrenador_listado.css" />
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

  $crumbs = array("Grupo", "Acceso listado");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title_entrenador.php");

  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/side_menu_entrenador.php");
  ?>

  <!-- Content Start -->
  <div class="content-container">
    <h1>Gimnastas</h1>
    <div class="gymnast-container">
      <div class="gymnast">
        <div class="img-container">
          <img src="/assets/Juanma - profile.jpeg">
        </div>
        <div class="name-container">
          <h2>Nombre completo</h2>
          <p>Grupo: A</p>
          <p class="hidden-content hidden">Fecha de nacimiento: XX/XX/XXXX</p>
        </div>
        <div class="contact-container">
          <p>Correo eléctronico: ejemploejemploejemploejemploejemplo@gmail.com</p>
          <p>Teléfono: 666 66 66 66</p>
          <p class="hidden-content hidden">Teléfono secundario: 777 77 77 77</p>
          <p class="hidden-content hidden">DNI: 99966699</p>
        </div>
      </div>
    </div>
    <div class="gymnast-container">
      <div class="gymnast">
        <div class="img-container">
          <img src="/assets/Juanma - profile.jpeg">
        </div>
        <div class="name-container">
          <h2>Nombre completo</h2>
          <p>Grupo: A</p>
          <p class="hidden-content hidden">Fecha de nacimiento: XX/XX/XXXX</p>
        </div>
        <div class="contact-container">
          <p>Correo eléctronico: ejemploejemploejemploejemploejemplo@gmail.com</p>
          <p>Teléfono: 666 66 66 66</p>
          <p class="hidden-content hidden">Teléfono secundario: 777 77 77 77</p>
          <p class="hidden-content hidden">DNI: 99966699</p>
        </div>
      </div>
    </div>
    <div class="gymnast-container">
      <div class="gymnast">
        <div class="img-container">
          <img src="/assets/Juanma - profile.jpeg">
        </div>
        <div class="name-container">
          <h2>Nombre completo</h2>
          <p>Grupo: A</p>
          <p class="hidden-content hidden">Fecha de nacimiento: XX/XX/XXXX</p>
        </div>
        <div class="contact-container">
          <p>Correo eléctronico: ejemploejemploejemploejemploejemplo@gmail.com</p>
          <p>Teléfono: 666 66 66 66</p>
          <p class="hidden-content hidden">Teléfono secundario: 777 77 77 77</p>
          <p class="hidden-content hidden">DNI: 99966699</p>
        </div>
      </div>
    </div>
    <div class="gymnast-container">
      <div class="gymnast">
        <div class="img-container">
          <img src="/assets/Juanma - profile.jpeg">
        </div>
        <div class="name-container">
          <h2>Nombre completo</h2>
          <p>Grupo: A</p>
          <p class="hidden-content hidden">Fecha de nacimiento: XX/XX/XXXX</p>
        </div>
        <div class="contact-container">
          <p>Correo eléctronico: ejemploejemploejemploejemploejemplo@gmail.com</p>
          <p>Teléfono: 666 66 66 66</p>
          <p class="hidden-content hidden">Teléfono secundario: 777 77 77 77</p>
          <p class="hidden-content hidden">DNI: 99966699</p>
        </div>
      </div>
    </div>
  </div>
  <!-- Content End -->


  <!-- JQuery -->
  <script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="/js/main.js"></script>
</body>

</html>