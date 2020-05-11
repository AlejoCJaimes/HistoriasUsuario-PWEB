<?php require 'views/docente/header.php'
?>
<body>
<div><?php echo $this->confirmacion;?> </div>
    <div class="container">
        <h2><i class=" fas fa-users"></i> Nuevo Grupo </h2>
            <form action="<?php echo constant('URL');?>docente/agregarGrupo" method="POST" id="form">
            <div class="form-group">
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
<?php require_once 'views/docente/footer.php'?>
