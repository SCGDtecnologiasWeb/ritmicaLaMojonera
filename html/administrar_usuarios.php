<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Administrar usuarios</title>

  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/css/administrador.css" />
  <link rel="stylesheet" href="/css/administrar_usuarios.css" />
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

  $crumbs = array("Usuarios", "Administrar usuarios");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/title_admin.php");

  include_once($_SERVER['DOCUMENT_ROOT'] . "/templates/side_menu_admin.php");
  ?>

  <!-- Content Start -->
  <div class="content-container">
    <h1>Entrenadores</h1>
    <div class="trainer-container">
      <div class="trainer">
        <div class="img-container">
          <img src="/assets/Juanma - profile.jpeg" alt="Entrenador" />
        </div>
        <div class="name-container">
          <h2>Nombre completo</h2>
          <p class="hidden-content hidden">Entrena: Grupo A</p>
          <p class="hidden-content hidden">Fecha de nacimiento: XX/XX/XXXX</p>
        </div>
        <div class="contact-container">
          <p>
            Correo eléctronico: ejemploejemploejemploejemploejemplo@gmail.com
          </p>
          <p>Teléfono: 666 66 66 66</p>
          <p class="hidden-content hidden">
            Teléfono secundario: 777 77 77 77
          </p>
          <p class="hidden-content hidden">DNI: 99966699</p>
        </div>
      </div>
      <a href="modificar_usuario.html">
        <img src="/assets/edit-icon.PNG" class="edit-img" alt="Editar" />
      </a>
      <img src="/assets/bin-icon.PNG" class="bin-img" alt="Eliminar" />
    </div>
    <div class="trainer-container">
      <div class="trainer">
        <div class="img-container">
          <img src="/assets/Juanma - profile.jpeg" alt="Entrenador" />
        </div>
        <div class="name-container">
          <h2>Nombre completo</h2>
          <p class="hidden-content hidden">Entrena: Grupo A</p>
          <p class="hidden-content hidden">Fecha de nacimiento: XX/XX/XXXX</p>
        </div>
        <div class="contact-container">
          <p>
            Correo eléctronico: ejemploejemploejemploejemploejemplo@gmail.com
          </p>
          <p>Teléfono: 666 66 66 66</p>
          <p class="hidden-content hidden">
            Teléfono secundario: 777 77 77 77
          </p>
          <p class="hidden-content hidden">DNI: 99966699</p>
        </div>
      </div>
      <a href="modificar_usuario.html">
        <img src="/assets/edit-icon.PNG" class="edit-img" alt="Editar" />
      </a>
      <img src="/assets/bin-icon.PNG" class="bin-img" alt="Eliminar" />
    </div>
    <div class="trainer-container">
      <div class="trainer">
        <div class="img-container">
          <img src="/assets/Juanma - profile.jpeg" alt="Entrenador" />
        </div>
        <div class="name-container">
          <h2>Nombre completo</h2>
          <p class="hidden-content hidden">Entrena: Grupo A</p>
          <p class="hidden-content hidden">Fecha de nacimiento: XX/XX/XXXX</p>
        </div>
        <div class="contact-container">
          <p>
            Correo eléctronico: ejemploejemploejemploejemploejemplo@gmail.com
          </p>
          <p>Teléfono: 666 66 66 66</p>
          <p class="hidden-content hidden">
            Teléfono secundario: 777 77 77 77
          </p>
          <p class="hidden-content hidden">DNI: 99966699</p>
        </div>
      </div>
      <a href="modificar_usuario.html">
        <img src="/assets/edit-icon.PNG" class="edit-img" alt="Editar" />
      </a>
      <img src="/assets/bin-icon.PNG" class="bin-img" alt="Eliminar" />
    </div>

    <h1 class="gymnast-header">Gimnastas</h1>
    <div class="gymnast-container">
      <div class="gymnast">
        <div class="img-container">
          <img src="/assets/Juanma - profile.jpeg" alt="Gimnasta" />
        </div>
        <div class="name-container">
          <h2>Nombre completo</h2>
          <p>Grupo: A</p>
          <p class="hidden-content hidden">Fecha de nacimiento: XX/XX/XXXX</p>
        </div>
        <div class="contact-container">
          <p>
            Correo eléctronico: ejemploejemploejemploejemploejemplo@gmail.com
          </p>
          <p>Teléfono: 666 66 66 66</p>
          <p class="hidden-content hidden">
            Teléfono secundario: 777 77 77 77
          </p>
          <p class="hidden-content hidden">DNI: 99966699</p>
        </div>
      </div>
      <a href="modificar_usuario.html">
        <img src="/assets/edit-icon.PNG" class="edit-img" alt="Editar" />
      </a>
      <img src="/assets/bin-icon.PNG" class="bin-img" alt="Eliminar" />
    </div>
    <div class="gymnast-container">
      <div class="gymnast">
        <div class="img-container">
          <img src="/assets/Juanma - profile.jpeg" alt="Gimnasta" />
        </div>
        <div class="name-container">
          <h2>Nombre completo</h2>
          <p>Grupo: A</p>
          <p class="hidden-content hidden">Fecha de nacimiento: XX/XX/XXXX</p>
        </div>
        <div class="contact-container">
          <p>
            Correo eléctronico: ejemploejemploejemploejemploejemplo@gmail.com
          </p>
          <p>Teléfono: 666 66 66 66</p>
          <p class="hidden-content hidden">
            Teléfono secundario: 777 77 77 77
          </p>
          <p class="hidden-content hidden">DNI: 99966699</p>
        </div>
      </div>
      <a href="modificar_usuario.html">
        <img src="/assets/edit-icon.PNG" class="edit-img" alt="Editar" />
      </a>
      <img src="/assets/bin-icon.PNG" class="bin-img" alt="Eliminar" />
    </div>
    <div class="gymnast-container">
      <div class="gymnast">
        <div class="img-container">
          <img src="/assets/Juanma - profile.jpeg" alt="Gimnasta" />
        </div>
        <div class="name-container">
          <h2>Nombre completo</h2>
          <p>Grupo: A</p>
          <p class="hidden-content hidden">Fecha de nacimiento: XX/XX/XXXX</p>
        </div>
        <div class="contact-container">
          <p>
            Correo eléctronico: ejemploejemploejemploejemploejemplo@gmail.com
          </p>
          <p>Teléfono: 666 66 66 66</p>
          <p class="hidden-content hidden">
            Teléfono secundario: 777 77 77 77
          </p>
          <p class="hidden-content hidden">DNI: 99966699</p>
        </div>
      </div>
      <a href="modificar_usuario.html">
        <img src="/assets/edit-icon.PNG" class="edit-img" alt="Editar" />
      </a>
      <img src="/assets/bin-icon.PNG" class="bin-img" alt="Eliminar" />
    </div>
    <div class="gymnast-container">
      <div class="gymnast">
        <div class="img-container">
          <img src="/assets/Juanma - profile.jpeg" alt="Gimnasta" />
        </div>
        <div class="name-container">
          <h2>Nombre completo</h2>
          <p>Grupo: A</p>
          <p class="hidden-content hidden">Fecha de nacimiento: XX/XX/XXXX</p>
        </div>
        <div class="contact-container">
          <p>
            Correo eléctronico: ejemploejemploejemploejemploejemplo@gmail.com
          </p>
          <p>Teléfono: 666 66 66 66</p>
          <p class="hidden-content hidden">
            Teléfono secundario: 777 77 77 77
          </p>
          <p class="hidden-content hidden">DNI: 99966699</p>
        </div>
      </div>
      <a href="modificar_usuario.html">
        <img src="/assets/edit-icon.PNG" class="edit-img" alt="Editar" />
      </a>
      <img src="/assets/bin-icon.PNG" class="bin-img" alt="Eliminar" />
    </div>
  </div>
  <!-- Content End -->

  <!-- JQuery -->
  <script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="/js/main.js"></script>
</body>

</html>