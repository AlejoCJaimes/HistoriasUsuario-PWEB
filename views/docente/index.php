<?php require 'views/docente/header.php'
?>
<!-- INICIO DEL CONTENIDO PRINCIPAL -->

<body onLoad="toastr.success('¡Bienvenido! '+'<?php echo $this->mensaje;?>')">
  <div class="container">


    <br>
    <br>
    <br>
    <br>

    <div class="container center">
      <div class="row">
        <div class="col-sm">
          <div class="card bg-success text-white" style="width: 14rem; ">
            <img src="<?php echo constant('URL');?>resources/img/projector.svg" class="card-img-top" alt="...">
            <div class="card-body">
            <h5 class="card-title">Proyectos <span class="badge badge-light"><?php echo $this->num_proyecto;?></span></h5>
              <p class="card-text">Todos los proyectos recopilados hasta el momento</p>
              <a href="<?php echo constant('URL');?>docente/proyecto"class="btn btn-light">Ver Proyectos</a>
            </div>
          </div>
        </div>
        <div class="col-sm">
        <div class="card bg-warning text-white" style="width: 14rem; ">
            <img src="<?php echo constant('URL');?>resources/img/coworking.svg" class="card-img-top" alt="...">
            <div class="card-body">
            <h5 class="card-title">Grupos <span class="badge badge-light"><?php echo $this->num_grupo;?></span></h5>
              <p class="card-text">Todos los grupos creado sin o con proyecto asignado</p>
              <a href="<?php echo constant('URL');?>docente/grupo"class="btn btn-light">Ver Grupos</a>
            </div>
          </div>
        </div>
        <div class="col-sm">
        <div class="card bg-primary text-white" style="width: 14rem; ">
            <img src="<?php echo constant('URL');?>resources/img/brain.svg" class="card-img-top" alt="...">
            <div class="card-body">
            <h5 class="card-title">Metodologías <span class="badge badge-light"><?php echo $this->num_metodologia;?></span></h5>
              <p class="card-text">Todos las metodologías  ágiles creadas hasta el momento</p>
              <a href="<?php echo constant('URL');?>docente/metodologia"class="btn btn-light">Ver Metodologías</a>
            </div>
          </div>
        </div>


      </div>
    </div>
  </div>

  <br>

</body>

<!-- FIN  DEL CONTENIDO PRINCIPAL -->

<?php require_once 'views/docente/footer.php'?>