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
  <!-- Header Start -->
  <div class="administrator-header">
    <img src="/assets/logo_ritmica2.png" />
  </div>
  <!-- Header End -->

  <!-- Title Start -->
  <div class="container">
    <div class="row title-row">
      <div class="col title-empty-col"></div>
      <div class="col-5 title-col">
        <div class="title-main">
          <span>Usuarios</span>
        </div>
      </div>

      <div class="col-5 title-col">
        <div class="title-path">
          <span>Usuarios</span>
          <span>/</span>
          <span>Administrar usuarios</span>
        </div>
      </div>
      <div class="col title-empty-col"></div>
    </div>
  </div>
  <!-- Title End -->

  <!-- Side Menu Start -->
  <button class="open-btn">
    <i class="fas fa-chevron-right"></i>
  </button>
  <div class="side-menu">
    <a href="javascript:void(0)" class="close-btn">&times;</a>

    <div class="menu-section">
      <a href="javascript:void(0)" class="menu-title">Usuarios</a>
      <a href="/html/administrar_inscripciones.html" class="menu-text">Inscripciones</a>
      <a href="/html/administrar_usuarios.html" class="menu-text">Administrar usuarios</a>
      <a href="/html/registrar_usuarios.html" class="menu-text">Registrar usuarios</a>
    </div>

    <div class="menu-section">
      <a href="javascript:void(0)" class="menu-title">Noticias</a>
      <a href="/html/anadir_noticias.html" class="menu-text">Añadir noticias</a>
      <a href="/html/modificar_noticias.html" class="menu-text">Modificar o eliminar noticias</a>
    </div>

    <div class="menu-section">
      <a href="javascript:void(0)" class="menu-title">Horarios</a>
      <a href="/html/modificar_horarios.html" class="menu-text">Actualizar y modificar horarios</a>
    </div>

    <div class="menu-section">
      <a href="javascript:void(0)" class="menu-title">Galería</a>
      <a href="/html/anadir_imagenes.html" class="menu-text">Añadir nueva imagen</a>
      <a href="/html/modificar_imagenes.html" class="menu-text">Eliminar imagenes</a>
    </div>

    <div class="menu-section">
      <a href="javascript:void(0)" class="menu-title">Palmarés</a>
      <a href="/html/anadir_logros.html" class="menu-text">Añadir logros del club</a>
      <a href="/html/modificar_logros.html" class="menu-text">Modificar o eliminar logros del club</a>
    </div>

  </div>
  <!-- Side Menu End -->

  <!-- Content Start -->
  <div class="content-container">
    <h1>Entrenadores</h1>
    <div class="trainer-container">
      <div class="trainer">
        <div class="img-container">
          <img src="/assets/Juanma - profile.jpeg">
        </div>
        <div class="name-container">
          <h2>Nombre completo</h2>
          <p class="hidden-content hidden">Entrena: Grupo A</p>
          <p class="hidden-content hidden">Fecha de nacimiento: XX/XX/XXXX</p>
        </div>
        <div class="contact-container">
          <p>Correo eléctronico: ejemploejemploejemploejemploejemplo@gmail.com</p>
          <p>Teléfono: 666 66 66 66</p>
          <p class="hidden-content hidden">Teléfono secundario: 777 77 77 77</p>
          <p class="hidden-content hidden">DNI: 99966699</p>
        </div>
      </div>
      <a href="modificar_usuario.html">
        <img src="/assets/edit-icon.PNG" class="edit-img">
      </a>
      <img src="/assets/bin-icon.PNG" class="bin-img">
    </div>
    <div class="trainer-container">
      <div class="trainer">
        <div class="img-container">
          <img src="/assets/Juanma - profile.jpeg">
        </div>
        <div class="name-container">
          <h2>Nombre completo</h2>
          <p class="hidden-content hidden">Entrena: Grupo A</p>
          <p class="hidden-content hidden">Fecha de nacimiento: XX/XX/XXXX</p>
        </div>
        <div class="contact-container">
          <p>Correo eléctronico: ejemploejemploejemploejemploejemplo@gmail.com</p>
          <p>Teléfono: 666 66 66 66</p>
          <p class="hidden-content hidden">Teléfono secundario: 777 77 77 77</p>
          <p class="hidden-content hidden">DNI: 99966699</p>
        </div>
      </div>
      <a href="modificar_usuario.html">
        <img src="/assets/edit-icon.PNG" class="edit-img">
      </a>
      <img src="/assets/bin-icon.PNG" class="bin-img">
    </div>
    <div class="trainer-container">
      <div class="trainer">
        <div class="img-container">
          <img src="/assets/Juanma - profile.jpeg">
        </div>
        <div class="name-container">
          <h2>Nombre completo</h2>
          <p class="hidden-content hidden">Entrena: Grupo A</p>
          <p class="hidden-content hidden">Fecha de nacimiento: XX/XX/XXXX</p>
        </div>
        <div class="contact-container">
          <p>Correo eléctronico: ejemploejemploejemploejemploejemplo@gmail.com</p>
          <p>Teléfono: 666 66 66 66</p>
          <p class="hidden-content hidden">Teléfono secundario: 777 77 77 77</p>
          <p class="hidden-content hidden">DNI: 99966699</p>
        </div>
      </div>
      <a href="modificar_usuario.html">
        <img src="/assets/edit-icon.PNG" class="edit-img">
      </a>
      <img src="/assets/bin-icon.PNG" class="bin-img">
    </div>

    <h1 class="gymnast-header">Gimnastas</h1>
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
      <a href="modificar_usuario.html">
        <img src="/assets/edit-icon.PNG" class="edit-img">
      </a>
      <img src="/assets/bin-icon.PNG" class="bin-img">
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
      <a href="modificar_usuario.html">
        <img src="/assets/edit-icon.PNG" class="edit-img">
      </a>
      <img src="/assets/bin-icon.PNG" class="bin-img">
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
      <a href="modificar_usuario.html">
        <img src="/assets/edit-icon.PNG" class="edit-img">
      </a>
      <img src="/assets/bin-icon.PNG" class="bin-img">
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
      <a href="modificar_usuario.html">
        <img src="/assets/edit-icon.PNG" class="edit-img">
      </a>
      <img src="/assets/bin-icon.PNG" class="bin-img">
    </div>
  </div>
  <!-- Content End -->


  <!-- JQuery -->
  <script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="/js/main.js"></script>
</body>

</html>