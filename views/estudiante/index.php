<?php require 'views/estudiante/header.php'
?>
<?php 

$layot_sin_grupo = $this->validacion;
 if($layot_sin_grupo > 0 ) {


?>
<!-- INICIO DEL CONTENIDO PRINCIPAL -->
<div class="container">


    <br>
    <br>
    <br>
    <br>

    <div class="container center">
      <div class="row">
        <div class="col-sm">
          <div class="cardtext-white" style="width: 14rem; background-color: #00979E ">
            <img src="<?php echo constant('URL');?>resources/img/order.svg" class="card-img-top" alt="...">
            <div class="card-body">
            <h5 class="card-title text-white">Historias de Usuarios <span class="badge badge-light"><?php echo $this->num_historias;?></span></h5>
              <p class="card-text text-white">Todas sus historias de usuario incluyendo las del grupo</p>
              <a href="<?php echo constant('URL');?>estudiante/detalleHistoria"class="btn btn-light">Ver Historias </a>
            </div>
          </div>
        </div>
        <div class="col-sm">
        <div class="card text-white bg-dark" style="width: 14rem;">
            <img src="<?php echo constant('URL');?>resources/img/steps.svg" class="card-img-top" alt="...">
            <div class="card-body">
            <h5 class="card-title text-white">Fases <span class="badge badge-light"><?php echo $this->num_fase;?></span></h5>
              <p class="card-text text-white">Todos sus fases incluyendo las del grupo</p>
              <a href="<?php echo constant('URL');?>estudiante/detalleGeneralFase"class="btn btn-light">Ver Fases</a>
            </div>
          </div>
        </div>
        <div class="col-sm">
        <div class="card bg-primary text-white" style="width: 14rem; ">
            <img src="<?php echo constant('URL');?>resources/img/puzzle-pieces.svg" class="card-img-top" alt="...">
            <div class="card-body">
            <h5 class="card-title">Módulos <span class="badge badge-light"><?php echo $this->num_modulo;?></span></h5>
              <p class="card-text">Todos los módulos icnluyendo los del grupo</p>
              <a href="<?php echo constant('URL');?>estudiante/detalleGeneralModulo"class="btn btn-light">Ver Módulos</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>
    <br>
    <div class="container center">
      <div class="row">
        <div class="col-sm">
          <div class="card bg-success text-white" style="width: 14rem; ">
            <img src="<?php echo constant('URL');?>resources/img/statistics.svg" class="card-img-top" alt="...">
            <div class="card-body">
            <h5 class="card-title">Actividades <span class="badge badge-light"><?php echo $this->num_actividad;?></span></h5>
              <p class="card-text">Todos los actividades incluyendo las del grupo</p>
              <a href="<?php echo constant('URL');?>estudiante/detalleGeneralActividad"class="btn btn-light">Ver Actividades</a>
            </div>
          </div>
        </div>
        <div class="col-sm">
        
        </div>
        <div class="col-sm">
        <div class="card text-white" style="width: 14rem; background-color: #B50800 ">
            <img src="<?php echo constant('URL');?>resources/img/choose.svg" class="card-img-top" alt="...">
            <div class="card-body">
            <h5 class="card-title text-white">Recursos <span class="badge badge-light"><?php echo $this->num_recurso;?></span></h5>
              <p class="card-text text-white">Los recursos ecónomicos generados por actividades del grupo</p>
              <a href="<?php echo constant('URL');?>estudiante/detalleRecurso"class="btn btn-light">Ver Recursos</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <br>
<!-- FIN  DEL CONTENIDO PRINCIPAL -->
<?php } else { ?>
  <div class="container">
  <h2> BIENVENIDO <?php echo $this->mensaje;?>  </h2>
  <h4>Aún no estás en ningún grupo. Recuerda que una vez pertenezcas a uno, puedes definir la fase, el objetivo de esta, y definir el módulo.
   Además, puedes proceder a la creación de la historia de usuario, después definir la actividad, y por último, definir el recurso.</h4>
  <img class="" src="<?php echo constant('URL');?>EstiloHome/img/indexestudiante.png">
</div>
 
<?php 
  
}  
?>
<?php require_once "views/estudiante/footer.php"?>


