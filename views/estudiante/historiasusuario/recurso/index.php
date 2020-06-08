<?php require 'views/estudiante/header.php'
?>
<!-- INICIO DEL CONTENIDO PRINCIPAL -->
<h3><?php echo $this->confirmacion;?></h3>
<form action="<?php echo constant('URL');?>estudiante" Method="POST">
  <div class="container">

    <div class="form-group">
      <label>Tipo</label>
      <input type="text" name="Tipo" class="form-control" REQUIRED>
    </div>

    <div class="form-group">
      <label>Descripción</label>
      <textarea class="form-control" name="Descripcion" id="exampleFormControlTextarea1" rows="4" REQUIRED></textarea>
    </div>

    <div class="form-group">
      <label>Valor</label>
      <input type="number" step="0.000001" name="Valor" placeholder="No pasar de 6 decimales" class="form-control" REQUIRED>
    </div>

    <div class="form-group">
      <label>Actividad</label> <br>
      <select name="idActividad" class="custom-select col-3" REQUIRED>
        <option selected disabled value="">Selecciona la actividad</option>
        <?php
          foreach ($this->actividad as $row) {
        ?>
        <option value="<?php echo $row['Id']?>"> <?php echo $row['Nombre']?></option>
        <?php

            }
        ?>
      </select>
    </div>
    <input type="submit" class="btn btn-primary" value="Guardar">
  </div>

</form>
<!-- FIN  DEL CONTENIDO PRINCIPAL -->

<?php require_once "views/estudiante/footer.php"?>