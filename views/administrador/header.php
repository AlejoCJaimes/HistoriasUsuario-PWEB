<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administrador</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo constant('URL');?>resources/layout_partial/fontawesome-free/css/all.min.css" rel="stylesheet"
        type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo constant('URL');?>resources/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="icon" href="<?php echo constant('URL');?>resources/img/logo.png">
</head>
<!--Estilos para el logout modal
Recordar que el boton de cerrar sesion se encuentra para todos en la 
sección del header en administrador linea 150-156 hace referencia a esto.-->
<style type="text/css">
.dropdown-item-b {
  display: block;
  width: 100%;
  padding: 0.25rem 1.5rem;
  clear: both;
  font-weight: 400;
  color: #3a3b45;
  text-align: inherit;
  white-space: nowrap;
  background-color: transparent;
  border: 0;
}

.dropdown-item-b:hover, .dropdown-item-b:focus {
  color: #2e2f37;
  text-decoration: none;
  background-color: #274EC1;
}
}
</style>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- BARRA LATERAL -->
            <a class="sidebar-brand d-flex align-items-center justify-content"
                href="<?php echo constant('URL');?>administrador">
                <div class="sidebar-brand-icon rotate-n-18">
                    <i class='fas fa-user-astronaut'></i>
                </div>
                <div class="sidebar-brand-text mx-2">Administrador <sup></sup></div>
            </a>


            <!-- Divider -->
            <hr class="sidebar-divider my-1">
            <!-- Nav Item - Usuarios -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo constant('URL');?>administrador">
                    <i class=" fas fa-address-book"></i>
                    <span>Inicio</span></a>
            </li>




            <li class="nav-item">
                <a class="nav-link" href="<?php echo constant('URL');?>administrador/usuarios?page=1">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Usuarios</span></a>
            </li>



            <!-- Nav Item - Usuarios -->
            <!--<li class="nav-item">
        <a class="nav-link" disabled="disabled" href="#">
          <i class="fa fa-user-plus"></i>
          <span>Añadir usuario</span></a>
      </li>-->

            <li class="nav-item">
                <a class="nav-link" href="<?php echo constant('URL');?>administrador/perfil">
                    <i class="fas fa-user"></i>
                    <span>Perfil</span></a>
            </li>


            <!-- Nav Item -Usuarios Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-cog"></i>
                    <span>Ajustes</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?php echo constant('URL');?>administrador/clave">Cambiar
                            contraseña</a>
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
                <nav class="navbar navbar-expand navbar-light bg-primary topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!--Encabezado dinámico-->
                    <h3 style="color:#fff"><?php echo $this->cabecera;?></h3>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                     

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="dropdown-item-b" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-power-off" style = "color: white"></i>
                            </a>


                        </li>

                    </ul>

                </nav>

                <!-- End of Topbar -->