<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Estudiante</title>

  <link href="<?php echo constant('URL');?>resources/layout_partial/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo constant('URL');?>resources/css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="icon" href="<?php echo constant('URL');?>resources/img/logo.png">
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

 <!-- BARRA LATERAL -->
 <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo constant('URL');?>estudiante">
        <div class="sidebar-brand-icon rotate-n-18">
        <i class='fas fa-graduation-cap'></i>
        </div>
        <div class="sidebar-brand-text mx-3">Estudiante <sup></sup></div>
      </a>


      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <!-- Nav Item - Usuarios -->
      <li class="nav-item">
        <a class="nav-link" href="<?php echo constant('URL');?>estudiante">
          <i class="fas fa-home"></i>
          <span>Inicio</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo constant('URL');?>estudiante/perfil">
          <i class="fas fa-user"></i>
          <span>Perfil</span></a>
      </li>

          <!-- Nav Item -Usuarios Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-cog"></i>
          <span>Ajustes</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo constant('URL');?>estudiante/clave">Cambiar contraseña</a>
          </div>
        </div>
      </li>


      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-success topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <h3 style="color:#fff"> Inicio </h3>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
           <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
              <i class="fas fa-power-off"></i>
              </a>


            </li>

          </ul>

        </nav>


        <!-- End of Topbar -->
