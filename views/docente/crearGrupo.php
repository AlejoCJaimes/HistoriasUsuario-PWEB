<?php require 'views/docente/header.php';
   // require 'views/docente/getNumeroSemestre.php';

?>

<!-- Combox Anidados-->
<script src="https://code.jquery.com/jquery-3.3.1.js"> </script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

<!--Script para generar los combox anindados según el valor que vaya cambiando por la opción-->


<body>
    <div><?php echo $this->confirmacion;?> </div>
    <div class="container">
        <h2><i class=" fas fa-users"></i> Nuevo Grupo </h2>
        <form action="<?php echo constant('URL');?>docente/agregarGrupo" method="POST" id="form">

            <hr>
            <div class="form-group">
                <input id="ruta_semestre" name="ruta" type="hidden" value="<?php echo constant('URL').'views/docente/consultas_grupo/n_semestre.php'?>">
                <input id="ruta_estudiante" name="ruta" type="hidden" value="<?php echo constant('URL').'views/docente/consultas_grupo/estudiantes.php'?>">                
                <label>Nombre</label>
                <input type="text" id="nombre" REQUIRED style=" width: 400px; height: 35px;" name="Nombre"
                    class="form-control" value="<?php echo $this->nombreGrupo;?>" placefolder="Escribe el nombre">

            </div>
            <br>
            <div class="form-group">
                <label>Programa</label>
                <select id="cbx_programa" name="cbx_programa" class="form-control col-3">
                    <option value="0" selected="selected">Selecciona un programa</option>
                    <?php 

                        foreach ($this->programas as $row) {
                            $programas = $row;
                    ?>
                    <option value="<?php echo $programas[0] ?> "> <?php echo $programas[1] ?></option>
                    <?php 
                    
                        }
                    ?>
                </select>
            </div>
             <br>           
            <div class="form-group"> 
             <label>Estudiantes Disponibles</label>
             <br>
			<div id="tabla_estudiantes"> </div>
            </div>


            <div class="form-group">
                <input type="submit" id="envio" value="Crear" class="btn btn-primary">
            </div>
            
            <br>
        <div class="form-group ">
            <a href="<?php echo constant('URL');?>docente/grupo" class="button" type="button">Volver</a>

        </div>
        </form>
    </div>

</body>


<!--<script type="text/javascript">
/*$(document).ready(function() {
    $('#cbx_programa').val(1);
    recargarLista();

    $('#cbx_programa').change(function() {
        recargarLista();
    });

})*/
</script>-->

<!--Estudiantes por numero de semestre-->
<!--<script type="text/javascript">
/*function recargarLista() {
    $.ajax({
        type: "POST",
        url: $('#ruta_semestre').val(),
        data: "programa=" + $('#cbx_programa').val(),
        success: function(r) {
            $('#cbx_semestre').html(r);
        }
        
    });
}*/
</script>-->

<script type="text/javascript">
$(document).ready(function() {
    $('#cbx_programa').val();
    recargarListaxSemestre();

    $('#cbx_programa').change(function() {
    recargarListaxSemestre();
    });

})
</script>
<script type="text/javascript">
function recargarListaxSemestre() {
    $.ajax({
        type: "POST",
        url: $('#ruta_estudiante').val(),
        data: {programa: $("#cbx_programa").val()}, 
        success: function(g) {
            $('#tabla_estudiantes').html(g);
        }
    });
}
</script>

<?php require_once 'views/docente/footer.php'?>