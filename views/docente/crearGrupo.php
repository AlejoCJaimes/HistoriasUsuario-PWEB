<?php require 'views/docente/header.php';
   // require 'views/docente/getNumeroSemestre.php';

?>

<!-- Combox Anidados-->
<script src="https://code.jquery.com/jquery-3.3.1.js"> </script>
<script
	src="https://code.jquery.com/jquery-3.3.1.min.js"
	integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
	crossorigin="anonymous"></script>
	
<!--Script para generar los combox anindados según el valor que vaya cambiando por la opción-->


<body>
<div><?php echo $this->confirmacion;?> </div>
    <div class="container">
        <h2><i class=" fas fa-users"></i> Nuevo Grupo </h2>
            <form action="<?php echo constant('URL');?>docente/agregarGrupo" method="POST" id="form">
            
            <!--Select Desplegables con la base de datos Anidados-->
            <br>
            <hr>
            <div class="form-group"> 
                <label>Programa</label>
                    <select  id="cbx_programa" name ="cbx_programa" class="form-control col-3">
                        <option value= "0" selected="selected">Selecciona un programa</option>   
                        <?php 
                        
                        require_once 'libs/database.php';
                        $this->db = new Database();

                        $query_programa = $this->db->connect()->query("SELECT * FROM programa ORDER BY Nombre");
                        while ($row =$query_programa->fetch()) {
                            echo "<option value=".$row['codigo'].">".$row['Nombre']."</option>";
                          
                        }

                        ?>
                    </select>
            </div>
            <br>
            <div class="form-group"> 
                <label>Numero Semestre</label>
			<div id="numero_semestre"> </div>
            </div>
            
            <!--Input tipo hidden-->
            
            <div class="form-group">
            <input id="ruta" name="ruta" type="hidden" value="<?php echo constant('URL').'views/docente/datos.php'?>">
                <label>Nombre</label>
                    <input type="text" id="nombre" REQUIRED style=" width: 400px; height: 30px;" name="Nombre" class="form-control" value="<?php echo $this->nombreGrupo;?>" placefolder="Escribe el nombre">

            </div>
            <div class="form-group">
                <label>Busqueda </label>
                <table id="tablaBusqueda">
                    <tr>
                    <td><input type="text" id="nombre" style=" width: 400px; height: 30px;" name="busqueda" class="form-control" placefolder="Escribe el nombre">
                    <td><button id="btn" type="button" class="btn btn-secondary"><i class=" fas fa-search"></i></button></td>
                    </tr>
                </table>

            </div>




            <div class="table-responsive-md">
                <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">Cédula</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Programa</th>
                    <th scope="col">#Semestre</th>
                    <th scope="col">Seleccionar</th>
                    </tr>
                </thead>
            <!--Code PHP-->
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
                        <td> <div class="custom-control custom-checkbox mr-sm-2">
                        
                        <td><input type="checkbox" name="estudiantes_seleccionados[]" value="<?php echo $grupos->CedulaEstudiante?>"></td>
                            </div>
                        </td>
                        
                    </tr>
                </tbody>
                
                <?php }?>
                </table>
                <div class="form-group">
                    <input type="submit" id="envio" value="Crear" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
     
</body>
<script type="text/javascript">
	$(document).ready(function(){
		$('#cbx_programa').val(1);
		recargarLista();

		$('#cbx_programa').change(function(){
			recargarLista();
		});
	})
</script>
<script type="text/javascript">
	function recargarLista(){
		$.ajax({
			type:"POST",
			url: $('#ruta').val(),
			data:"programa=" + $('#cbx_programa').val(),
			success:function(r){
				$('#numero_semestre').html(r);
			}
		});
	}
</script>

<?php require_once 'views/docente/footer.php'?>
