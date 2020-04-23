<?php require 'views/docente/header.php'
?>

<div class="container">
<h2><i class=" fas fa-users"></i> Nuevo Grupo </h2>

 
    <form action="" method="POST" id="form">

        <div class="form-group">
            <br>
                <label>Nombre</label>
                <input type="text" id="nombre" name="Nombre" class="form-control " placeholder="Escribe el nombre de la metodología" value=" " >
        </div>


        <!-- Lista de estudiantes quemado, para seleccionar a más de uno!-->
        <div class="form-group"> 
        <label>Selecciona a los estudiantes</label>
        <select name = "NombreEstudiante" multiple="multiple" class="form-control">
        <option value= "1" selected="selected">Juan </option>
        <option value= "1" selected="selected">Alejandro </option>
        <option value= "1" selected="selected">Rangel </option>

        </select>
       
        </div>
      
      
            <div class="form-group text-center">
                <input type="submit" id="envio" value="Crear" class="btn btn-primary ">
        </div>
        
    </form>
    
</div>
<?php 

require_once 'views/docente/footer.php'?>

