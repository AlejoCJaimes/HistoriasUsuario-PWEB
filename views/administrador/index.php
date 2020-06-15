<?php require 'views/administrador/header.php'?>

<!-- INICIO DEL CONTENIDO PRINCIPAL -->
<!--<div class="container">-->
  <!--<h2> BIENVENIDO <//?php echo $this->mensaje;?>  </h2>
  <h2>Sea usted bienvenido a su panel.</h2>
  <h2>Acá se encontrará con algunas funcionalidades específicas como lo son: </h2>
  <h3>1. Ver usuarios</h3>
  <h3>2. Crear usuarios</h3>
  <h3>3. Editar usuarios</h3>
  <h3>4. Eliminar usuarios</h3>
  <h3>5. Editar su perfil</h3>
  <h3>6. Cerrar sesión</h3>-->

<!--</div>-->

<body onLoad="toastr.success('¡Bienvenido! '+'<?php echo $this->mensaje;?>')">
  <div class="container">


    <br>
    <br>
    <br>
    <br>

    <div class="container center">
      <div class="row">
        <div class="col-sm">
          <div class="card bg-dark text-white" style="width: 14rem; ">
            <img src="<?php echo constant('URL');?>resources/img/group.svg" class="card-img-top" alt="...">
            <div class="card-body">
            <h5 class="card-title">Usuarios <span class="badge badge-light"><?php echo $this->num_usuarios;?></span></h5>
              <p class="card-text">Todos los usuarios, entre administradores, docentes y estudiantes.</p>
              <a href="<?php echo constant('URL');?>administrador/usuarios?page=1"class="btn btn-light">Ver Usuarios</a>
            </div>
          </div>
        </div>
        <div class="col-sm">
        <div class="card bg-success text-white" style="width: 14rem; ">
            <img src="<?php echo constant('URL');?>resources/img/university.svg" class="card-img-top" alt="...">
            <div class="card-body">
            <h5 class="card-title">Programas <span class="badge badge-light"><?php echo $this->num_programas;?></span></h5>
              <p class="card-text">Todos los programas creados hasta el momento</p>
              <a href="<?php echo constant('URL');?>administrador/programa"class="btn btn-light">Ver Programas</a>
            </div>
          </div>
        </div>
        <div class="col-sm">
        <div class="card bg-primary text-white" style="width: 14rem; ">
            <img src="<?php echo constant('URL');?>resources/img/flag.svg" class="card-img-top" alt="...">
            <div class="card-body">
            <h5 class="card-title">Estados <span class="badge badge-light"><?php echo $this->num_estados;?></span></h5>
              <p class="card-text">Aplicados para el control de los proyectos, fases e historias de usuario.</p>
              <a href="<?php echo constant('URL');?>administrador/estado"class="btn btn-light">Ver Estados</a>
            </div>
          </div>
        </div>


      </div>
    </div>
  </div>

  <br>

</body>
<!-- FIN  DEL CONTENIDO PRINCIPAL -->

<?php require 'views/administrador/footer.php'?>
