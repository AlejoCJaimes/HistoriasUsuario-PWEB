<?php require 'views/estudiante/header.php'
?>
<!-- INICIO DEL CONTENIDO PRINCIPAL -->
<form action="<?php echo constant('URL');?>estudiante" Method="POST">
  <div class="container">

    <div class="form-group">
      <label>Descripción</label>
      <textarea class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
    </div>

    <div class="form-group">
      <label>Tipo</label>
      <input type="text" class="form-control">
    </div>

    <div class="form-group">
      <label>Valor</label>
      <input type="number" step="0.000001" placeholder="No pasar de 6 decimales" class="form-control">
    </div>

    <div class="form-group">
      <label>Actividad</label> <br>
      <select name="" id="" class="custom-select col-3">
        <option selected disabled>Selecciona la actividad</option>
        <?php

          require_once 'libs/database.php';
          $this->db = new Database();

          //statement return dates
          $query = $this->db->connect()->query("SELECT Id,Nombre FROM actividad;");

          while($row = $query->fetch()) {
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