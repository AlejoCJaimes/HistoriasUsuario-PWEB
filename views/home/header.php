<!--<!DOCTYPE html>
<html lang="es">
<head>
  <title>Home</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
  <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="canonical" href="https://getbootstrap.com/docs/4.1/examples/pricing/">

</head>
<body>

   <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
      <h5 class="my-0 mr-md-auto font-weight-normal text-dark">Electiva Páginas Web</h5>
      <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="<//?php echo constant('URL');?>home">Inicio</a>
        <a class="p-2 text-dark" href="<//?php echo constant('URL');?>contacto">Contacto</a>
        <a class="p-2 text-dark" href="<//?php echo constant('URL');?>usuario/register_student">Registrarse Estudiante</a>
        <a class="p-2 text-dark" href="<//?php echo constant('URL');?>usuario/register_docente">Registrarse Docente</a>
      </nav>
      <a class="btn btn-outline-primary" href="<//?php echo constant('URL');?>account">Iniciar Sesion</a>
    </div>

</body>
</html>
-->

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title> Home </title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Facebook Opengraph integration: https://developers.facebook.com/docs/sharing/opengraph -->
  <meta property="og:title" content="">
  <meta property="og:image" content="">
  <meta property="og:url" content="">
  <meta property="og:site_name" content="">
  <meta property="og:description" content="">

  <!-- Twitter Cards integration: https://dev.twitter.com/cards/  -->
  <meta name="twitter:card" content="summary">
  <meta name="twitter:site" content="">
  <meta name="twitter:title" content="">
  <meta name="twitter:description" content="">
  <meta name="twitter:image" content="">

  <!-- Place your favicon.ico and apple-touch-icon.png in the template root directory -->
  <link href="favicon.ico" rel="shortcut icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="<?php echo constant('URL');?>EstiloHome/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="<?php echo constant('URL');?>EstiloHome/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo constant('URL');?>EstiloHome/lib/animate-css/animate.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="<?php echo constant('URL');?>EstiloHome/css/style.css" rel="stylesheet">
  <link rel="icon" href="<?php echo constant('URL');?>resources/img/logo.png">
</head>

<body>
  <div id="preloader"></div>

  <!--==========================
  Hero Section
  ============================-->
  <section id="hero">
    <div class="hero-container">
      <div class="wow fadeIn">
        <div class="hero-logo">
          <img class="" src="<?php echo constant('URL');?>EstiloHome/img/inicio.png">
        </div>

        <h1>BIENVENIDO AL SISTEMA DE HISTORIAS DE USUARIO</h1>
        <h2> Aquí podrás <span class="rotating">llevar el control de tus estudiantes, tener un órden, gestionar tus historias</span></h2>
        <div class="actions">
         
          <a href="<?php echo constant('URL');?>usuario/register_docente" class="btn-services">Regístrate -> Docente</a>
          <a href="<?php echo constant('URL');?>usuario/register_student" class="btn-services">Regístrate -> Estudiante</a>
          <a href="<?php echo constant('URL');?>account" class="btn-get-started">Inicia Sesión</a>
        </div>
      </div>
    </div>
  </section>

  <!--==========================
  Sección de encabezado
  ============================-->
  <header id="header">
    <div class="container">
      <div id="logo" class="pull-center">
      
        <!-- Descomenta abajo si prefieres usar una imagen de texto -->
        <!--<h1><a href="#hero">Encabezado 1</a></h1>-->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="#hero">Inicio</a></li>
          <li><a href="#about">Acerca de</a></li>
          <li><a href="#testimonials">Roles</a></li>
          <li><a href="#contact">Contacto</a></li>
        </ul>
      </nav>
      <!-- #nav-menu-container -->
    </div>
  </header>
  <!-- #header -->