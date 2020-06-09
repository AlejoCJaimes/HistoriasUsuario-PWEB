<?php require 'views/estudiante/header.php'
?>

<head>
    <script src="https://code.jquery.com/jquery-3.3.1.js"> </script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

</head>

<body>

    <!--Rutas Combos-->
    <input id="ruta_modulo" name="ruta" type="hidden"
        value="<?php echo constant('URL').'views/estudiante/historiasusuario/asset/datos_modulo.php'?>">
    <input id="ruta_historia" name="ruta" type="hidden"
        value="<?php echo constant('URL').'views/estudiante/historiasusuario/asset/datos_historia.php'?>">
    <!-- INICIO DEL CONTENIDO PRINCIPAL -->
    <h3><?php echo $this->confirmacion;?></h3>
    <br>
    <div class="container">
        <h3><i class="fas fa-flag"></i>&nbsp; Historias de usuario </h3>
        <hr>


        <div class="form-group">
            <label>Fase</label> <br>
            <div class="form-row">
                <div class="col-4">

                    <select name="cbx_fase" REQUIRED id="cbx_fase" style="width: 220px;" class="form-control">
                        <option disabled="disabled" value="" selected="selected">Seleccionar una opcion</option>
                        <?php
                require_once 'models/Fase.php';
                  foreach ($this->fases as $row) {
                      $fases = new Fase();
                      $fases = $row;
                    var_dump($fases);
                  
                ?>
                        <option value="<?php echo $fases->Id?>"><?php echo $fases->Nombre?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col">
                    <a href="<?php echo constant('URL');?>estudiante/crearFase" style="color: white;"
                        class="btn btn-success" role="button button-sm"> <i class="fas fa-plus"></i>Agregar
                        Fase</a>
                </div>
            </div>
        </div>
        

        <div class="form-group">
            <label>Modulo</label> <br>
            <div class="form-row">
                <div class="col-4">
                <select name ="cbx_modulo" id="cbx_modulo" REQUIRED style="width: 220px;" class="form-control"> 
        </select>
        
                </div>
                <div class="col">
                <a href="<?php echo constant('URL');?>estudiante/crearModulo" style="color: white;"
                        class="btn btn-success" role="button button-sm"> <i class="fas fa-plus"></i>Agregar
                        modulo</a>
                </div>
            </div>
        </div>
        <!--<div class="col">
                
                </div>-->
       
        <div class="form-group"> 
             <label>Historia Usuario</label>
			<div id="historia_usuario"> </div>
            </div>
            

    </div>



    </form>

    <!-- FIN  DEL CONTENIDO PRINCIPAL -->
</body>
<!--MODULOS-->
<script type="text/javascript">
$(document).ready(function() {
    $('#cbx_fase').val();
    recargarLista();

    $('#cbx_fase').change(function() {
        recargarLista();
    });

})
</script>
<script type="text/javascript">
function recargarLista() {
    $.ajax({
        type: "POST",
        url: $('#ruta_modulo').val(),
        data: "fase=" + $('#cbx_fase').val(),
        success: function(r) {
            $('#cbx_modulo').html(r);

        }
    });
}
</script>

<!--HISTORIAS DE USUARIO-->
<script type="text/javascript">
$(document).ready(function() {
    $('#cbx_modulo').val();
    _recargarLista();

    $('#cbx_modulo').change(function() {
        _recargarLista();
    });

})
</script>
<script type="text/javascript">
function _recargarLista() {
    $.ajax({
        type: "POST",
        url: $('#ruta_historia').val(),
        data: "historia=" + $('#cbx_modulo').val(),
        success: function(g) {
            $('#historia_usuario').html(g);

        }
    });
}
</script>


<?php require_once "views/estudiante/footer.php"?>