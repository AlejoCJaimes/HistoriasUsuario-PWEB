<?php require 'views/docente/header.php'?>

<!-- Combox Anidados-->
<script src="https://code.jquery.com/jquery-3.3.1.js"> </script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>


<body>
<div><?php echo $this->confirmacion;?> </div>
<div class="container">
<?php 
require_once 'models/Grupo.php';
foreach ($this->datos_grupo as $row_1) {
$datos_grupo = new Grupo();
$datos_grupo = $row_1;
}       
?>
    <h2><i class=" fas fa-info-circle"></i> Detalles del grupo </h2>

    <input id="ruta_estudiante" name="ruta" type="hidden" value="<?php echo constant('URL').'views/docente/consultas_grupo/estudiantes_d_grupo.php'?>">
   
    <form action="<?php echo constant('URL');?>docente/actualizar_grupo" method="POST" id="form">
    
        <br>
        <div class="form-group">
            <input id="ruta" name="ruta" type="hidden" value="<?php echo constant('URL').'views/docente/datos.php'?>">
           
            <label>Nombre</label>
            

        </div>

        <div class="form-group">
            <label>Nombre</label> <br>
            <div class="form-row">
                <div class="col-6">
                <input type="text" id="nombre" REQUIRED style=" width: 500px; height: 35px;" name="nombre"
                class="form-control" value="<?php echo $datos_grupo->nombre;?>" placefolder="Escribe el nombre">

                <input id="id_grupo" name="id_grupo" type="hidden" value="<?php echo $datos_grupo->id; ?>">
                </div>
                <div class="col">
                         <input type="submit" value="Cambiar Nombre" role="button" class="btn btn-success">
                </div>
            </div>
        </div>
        <!--edicion-->

        <br>
        <label>Estudiantes del grupo: <?php echo $datos_grupo->nombre;?> </label>  
        <div class="table-responsive-md">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Cédula</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Programa</th>
                        <th scope="col">#Semestre</th>
                        <th scope="col">Eliminar</th>

                    </tr>
                </thead>

                <?php 
                require_once 'models/Estudiante.php';
                foreach ($this->grupos as $row) {
                    $grupos = new Estudiante();
                    $grupos = $row;
                                     
                ?>
                <tbody>
                    <tr>
                        <td> <?php echo $grupos->CedulaEstudiante ?> </td>
                        <td> <?php echo $grupos->NombreEstudiante?> </td>
                        <td> <?php echo $grupos->ApellidoEstudiante ?> </td>
                        <td> <?php echo $grupos->NombrePrograma?> </td>
                        <td> <?php echo $grupos->NumeroSemestre?> </td>
                        <td>
                            <a href="<?php echo constant('URL') .'docente/eliminar_grupo_estudiante/'.$grupos->id.'/'.$datos_grupo->id;?>"
                                style="color: #B20710;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                </tbody>

                <?php }?>
            </table>
        </div>
        <!--Inicio de tabla de estudiantes-->
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

        <br>
        <div class="form-group">
           
        </div>
        <br>
        <div class="form-group ">
            <a href="<?php echo constant('URL');?>docente/grupo" class="button" type="button">Volver</a>

        </div>

    </form>

</div>
</body>


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
        data: {programa: $("#cbx_programa").val(), grupo: $("#id_grupo").val()}, 
        success: function(g) {
            $('#tabla_estudiantes').html(g);
        }
    });
}
</script>

<?php require_once 'views/docente/footer.php'?>
