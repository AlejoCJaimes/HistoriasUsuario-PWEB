<?php require 'views/docente/header.php'
?>

<?php 
                require_once 'models/Grupo.php';
                foreach ($this->datos_grupo as $row_1) {
                    $datos_grupo = new Grupo();
                    $datos_grupo = $row_1;
             }       
                ?>
<div class="container">
<h2><i class=" fas fa-info-circle"></i> Detalles del grupo </h2>

 
    <form action="" method="POST" id="form">
   
    <br>
    <div class="form-group">
            <input id="ruta" name="ruta" type="hidden" value="<?php echo constant('URL').'views/docente/datos.php'?>">
                <label>Nombre</label>
                    <input type="text" id="nombre" REQUIRED style=" width: 300px; height: 30px;" name="Nombre" class="form-control" value="<?php echo $datos_grupo->nombre;?>" placefolder="Escribe el nombre">

     </div>

        <!-- Lista de estudiantes quemado, para seleccionar a más de uno!-->
        <br>
    
         <div class="table-responsive-md">
                <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">Cédula</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Programa</th>
                    <th scope="col">#Semestre</th>
                 
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
                         
                        
                        
                    </tr>
                </tbody>
                
                <?php }?>
                </table>
            </div>        
      
            <div class="form-group ">
                <a  href="<?php echo constant('URL');?>docente/grupo" class="button" type="button">Volver</a>
        </div>
        
    </form>
    
</div>
<?php 

require_once 'views/docente/footer.php'?>

