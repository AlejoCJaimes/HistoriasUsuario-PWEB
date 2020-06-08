<?php require 'views/estudiante/header.php'
?>
<!-- INICIO DEL CONTENIDO PRINCIPAL -->
<form action="<?php echo constant('URL');?>estudiante" Method="POST">
  <div class="container">

    <div class="form-group">
      <label>Nombre</label>
      <input type="text" class="form-control" REQUIRED>
    </div>

    <div class="form-group">
      <label>Descripción</label>
      <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" REQUIRED></textarea>
    </div>

    <div class="form-group">
      <label>Historia de usuario</label> <br>
      <select name="" id="" class="custom-select col-3" REQUIRED>
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

    <input type="submit" class="btn btn-primary" value="Guardar">
  </div>
</form>
<!-- FIN  DEL CONTENIDO PRINCIPAL -->

<?php require_once "views/estudiante/footer.php"?>