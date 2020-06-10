<?php require 'views/docente/header.php'
?>
<!-- INICIO DEL CONTENIDO PRINCIPAL -->
<body  onLoad="toastr.success('¡Bienvenido! '+'<?php echo $this->mensaje;?>')">
<div class="container">
  <h2> BIENVENIDO <?php echo $this->mensaje;?>  </h2>

  <!--<ul class="list-group">
  <li class="list-group-item d-flex justify-content-between align-items-center">
    Cras justo odio
    <span class="badge badge-primary badge-pill">14</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    Dapibus ac facilisis in
    <span class="badge badge-primary badge-pill">2</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    Morbi leo risus
    <span class="badge badge-primary badge-pill">1</span>
  </li>
</ul>-->
<!--<div class="row">
<div class="col-sm">

<div class="card text-white bg-primary mb-3 col-sm-5" style="max-width: 18rem;">
  <div class="card-header bg-primary">Header</div>
  <div class="card-body">
    <h5 class="card-title">Primary card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.
    </p>
  </div>
</div>
<div class="card text-white bg-primary mb-3 col-sm-5" style="max-width: 18rem;">
  <div class="card-header bg-primary">Header</div>
  <div class="card-body">
    <h5 class="card-title">Primary card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.
    </p>
  </div>
</div>
</div>
</div> -->

<div class="container center">
  <div class="row">
    <div class="col-sm">
      <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Proyectos <span class="badge badge-light"><?php echo $this->num_proyecto;?></span></h5>
          <p class="card-text"><a href="<?php echo constant('URL');?>docente/proyecto" class="text-white"> Ver Proyectos</a></p>
        </div>
      </div>
    </div>
    <div class="col-sm">
      <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Metodologías <span class="badge badge-light"><?php echo $this->num_metodologia;?></span></h5>
          <p class="card-text"><a href="<?php echo constant('URL');?>docente/metodologia" class="text-white"> Ver Metodologías</a></p>
        </div>
      </div>
    </div>
    <div class="col-sm">
      <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Grupos <span class="badge badge-light"><?php echo $this->num_grupo;?></span></h5>
          <p class="card-text"><a href="<?php echo constant('URL');?>docente/grupo" class="text-white"> Ver Grupos</a></p>
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
