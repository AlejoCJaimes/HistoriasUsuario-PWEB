<?php require 'views/estudiante/header.php'
?>
<!-- INICIO DEL CONTENIDO PRINCIPAL -->
<div class="container">
<h3><?php echo $this->confirmacion;?></h3>
<br>
    <h3><i class="fas fa-chart-line"></i>&nbsp; Actividad</h3>
    <hr>
<form action="<?php echo constant('URL');?>estudiante/addActividad" Method="POST">
  <div class="container">

    <div class="form-group">
      <label>Nombre</label>
      <input type="text" name="Nombre" class="form-control" style="width: 500px" REQUIRED>
    </div>

    <div class="form-group">
      <label>Descripción</label>
      <textarea class="form-control" name="Descripcion" id="exampleFormControlTextarea1" rows="4" style="width: 500px" REQUIRED></textarea>
    </div>

    <div class="form-group">
      <label>Historia de usuario</label> <br>
      <select name="IdHistoriaUsuario" id="" class="custom-select col-3" REQUIRED>
        <option selected disabled value="">Selecciona la historia de usuario</option>
        <?php
          foreach ($this->historiasUsuario as $row) {
        ?>
        <option value="<?php echo $row['Id']?>"> <?php echo $row['Nombre']?></option>
        <?php

            }
        ?>
      </select>
      
    </div>
  <br>
  <br>
    <input type="submit" class="btn btn-primary" value="Guardar">
  </div>
<br>
<br>
  <div class="container">
            <a href="<?php echo constant('URL');?>estudiante/detalleGeneralActividad" class="button" type="button"> <i
                    class="fas fa-eye"> </i> Consultar Actividades</a>
        </div>
</form>
</div>
<!-- FIN  DEL CONTENIDO PRINCIPAL -->

<?php require_once "views/estudiante/footer.php"?>