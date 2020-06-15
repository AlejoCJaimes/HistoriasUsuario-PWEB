<?php require 'views/estudiante/header.php'
?>
<!-- INICIO DEL CONTENIDO PRINCIPAL -->
<h3><?php echo $this->confirmacion;?></h3>
<br>
<div class="container">
    <h3><i class="fas fa-coins"></i>&nbsp; Editar Recurso</h3>
    <hr>
<form action="<?php echo constant('URL');?>estudiante/editarRecurso" Method="POST">
  <div class="container">

    <input type="hidden" name="idRecurso" value="<?php echo $this->recurso["Id"]?>">

    <div class="form-group">
      <label>Tipo</label>
      <input type="text" name="Tipo" class="form-control" value="<?php echo $this->recurso["Tipo"]?>" REQUIRED>
    </div>

    <div class="form-group">
      <label>Descripción</label>
      <textarea class="form-control" name="Descripcion" id="exampleFormControlTextarea1" rows="4" REQUIRED><?php echo $this->recurso["Descripcion"]?></textarea>
    </div>

    <div class="form-group">
      <label>Valor</label>
      <input type="number" step="0.000001" name="Valor" placeholder="No pasar de 6 decimales" value="<?php echo $this->recurso["valor"]?>" class="form-control" REQUIRED>
    </div>

    <div class="form-group">
      <label>Actividad</label> <br>
      <select name="idActividad" class="custom-select col-3" REQUIRED>
        <option selected value="<?php echo $this->recurso["IdActividad"]?>"><?php echo $this->recurso["NombreActividad"]?></option>
        <?php
          foreach ($this->actividad as $row) {
        ?>
        <option value="<?php echo $row['Id']?>"> <?php echo $row['Nombre']?></option>
        <?php

            }
        ?>
      </select>
    </div>
    <br>
    <input type="submit" class="btn btn-primary" value="Editar">
  </div>

</form>
</div>
<br><br>
<div class="container">
&nbsp; &nbsp; &nbsp; &nbsp;<a href="<?php echo constant('URL');?>estudiante/detalleRecurso" class="button" type="button"> <i
                    class="fas fa-arrow-circle-left"> </i> Volver</a>
        </div>
<!-- FIN  DEL CONTENIDO PRINCIPAL -->

<?php require_once "views/estudiante/footer.php"?>