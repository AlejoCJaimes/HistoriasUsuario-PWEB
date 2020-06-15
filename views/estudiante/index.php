<?php require 'views/estudiante/header.php'
?>

<!-- INICIO DEL CONTENIDO PRINCIPAL -->
<div class="container">
  <h2> BIENVENIDO <?php echo $this->mensaje;?>  </h2>
  <h4>Recuerda que tu puedes definir la fase, el objetivo de esta, y definir el módulo. Además, puedes proceder a la creación de la historia de usuario, después definir la actividad, y por último, definir el recurso.  </h4>
  <img class="" src="<?php echo constant('URL');?>EstiloHome/img/indexestudiante.png">
</div>
<!-- FIN  DEL CONTENIDO PRINCIPAL -->

<?php require_once "views/estudiante/footer.php"?>
