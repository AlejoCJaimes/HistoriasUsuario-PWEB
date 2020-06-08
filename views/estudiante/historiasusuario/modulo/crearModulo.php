<?php require 'views/estudiante/header.php'
?>

<!-- INICIO DEL CONTENIDO PRINCIPAL -->
<div class="container">
<?php echo $this->confirmacion ?>
    <br>
    <h3><i class="far fa-bookmark"></i>&nbsp; Módulo</h3>
    <hr>
    <form action="<?php echo constant('URL');?>estudiante/addModulo" name="form" method="POST" id="form">
        <div class="form-group">
            <label> Nombre</label>
            <input type="text" id="nombre"  name="nombre" REQUIRED style=" width: 400px; height: 30px;"
                class="form-control" placeholder="Escribe el nombre">

        </div>

        <div class="form-group">
            <label>Descripción</label>
            <textarea name="descripcion" type="text" id="Descripcion" required
                placeholder="Escribe la respectiva descripción" class="form-control" col="1" rows="8"></textarea>

        </div>


        <div class="form-group">

            <label>Fase</label>
            <select name="idfase" REQUIRED id="idfase" style="width: 220px;" class="form-control">
                <option disabled="disabled" value="" selected="selected">Seleccionar una opcion</option>
                <?php
                require_once 'models/Fase.php';
                  foreach ($this->fases as $row) {
                      $fases = new Fase();
                      $fases = $row;
                  
                ?>
                <option value="<?php echo $fases->Id?>"><?php echo $fases->Nombre?></option>
                <?php } ?>
            </select>
        </div>


        <br>


        <div class="form-group ">
            <input type="submit" id="envio" value="Crear" class="btn btn-primary ">
        </div>
    </form>

</div>
<!-- FIN  DEL CONTENIDO PRINCIPAL -->

<?php require_once "views/estudiante/footer.php"?>

<script src='<?php echo constant('URL');?>resources/js/autosize.min.js'></script>
<script>
autosize(document.querySelectorAll('#Descripcion'));
</script>