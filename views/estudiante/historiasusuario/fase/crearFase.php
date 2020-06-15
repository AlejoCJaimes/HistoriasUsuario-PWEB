<?php require 'views/estudiante/header.php'
?>

<!-- INICIO DEL CONTENIDO PRINCIPAL -->
<div class="container">
<?php echo $this->confirmacion ?>
<br>

  <h3><i class="fas fa-bezier-curve"></i>&nbsp; Fase</h3>
  <hr>
  <form action="<?php echo constant('URL');?>estudiante/addFase" name="form" method="POST" id="form">
  <div class="form-group">
        <label> Nombre</label>
       <input type="text" id="nombre" name="nombre" REQUIRED style=" width: 400px; height: 30px;" class="form-control" placeholder="Escribe el nombre">

     </div>

     <div class="form-group">
        <label>Descripción</label>
        <textarea name="descripcion" type="text" id="descripcion" required placeholder="Escribe la respectiva descripción" class="form-control"></textarea>

     </div>
     <div class="form-group">
        <label>URL</label>
       <input type="text" id="url" name="url" REQUIRED style=" width: 400px; height: 30px;" s class="form-control" placeholder="https://www.w3schools.com/tags/att_img_height.asp">

     </div>

        <div class="form-group">
        <div class="row">
    <div class="col-sm">
    <label>Metodologia</label>
    <input type="text" id="metodologia" name="metodologia" REQUIRED style=" width: 400px; height: 30px;"  value="<?php echo $this->metodologia;?>"class="form-control" readonly>
    </div>
    <div class="col-sm">
    <label>Estado</label>
    <select name = "idestado" REQUIRED id="estado" style="width: 220px;" class="form-control">
                                <option disabled="disabled" value="" selected="selected">Seleccionar una opcion</option>
                                <?php
                                        require_once 'libs/database.php';
                                        $this->db = new Database();
                                        //statement return dates
                                        $query = $this->db->connect()->query("SELECT id, nombre FROM estado;");
                                        while($row = $query->fetch()) {
                                ?>
                                <option value= "<?php echo $row['id']?>"><?php echo $row['nombre']?></option>
                                <?php

                                        }
                                ?>
                        </select>
    </div>
    </div>
        </div>
     
     <br>
  
     <h3><i class="fas fa-bullseye"></i>&nbsp; Objetivo</h3>
     <hr>

     <div class="form-group">
        <label>Descripción</label>
        <textarea name="descripcion_objetivo" type="text" id="Descripcion" required placeholder="Escribe la respectiva descripción" class="form-control"></textarea>

     </div>

     <div class="form-group ">
            <input type="submit" id="envio" value="Crear" class="btn btn-primary ">
        </div>
  </form>
  
</div>
<!-- FIN  DEL CONTENIDO PRINCIPAL -->

<?php require_once "views/estudiante/footer.php"?>

<script src='<?php echo constant('URL');?>resources/js/autosize.min.js'></script>
	<script>
		autosize(document.querySelectorAll('#descripcion'));
	</script>