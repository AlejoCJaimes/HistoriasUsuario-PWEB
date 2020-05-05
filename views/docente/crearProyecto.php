<?php require 'views/docente/header.php'
?>
<body>
<div class="container">
<h2><i class=" fas fa-project-diagram"></i> Nuevo Proyecto </h2>

 
    <form action="" method="POST" id="form">

        <div class="form-group">
            <br>
                <label>Nombre</label>
                <input type="text" id="nombre" name="NombreProyecto" class="form-control " placeholder="Escribe el nombre del proyecto" value=" " >
        </div>
        <div class="form-group">
               <label>Fecha límite</label>
               <input type="date" id="FechaFin" name="FechaFin" class="form-control"value=" " >
        </div>
        
<!--DropDrownList de metodología-->
        <div class="form-group"> 
        <label>Metodologia</label>
        <select name = "metodologia" class="form-control">
        <option disabled="disabled" selected="selected">Seleccionar una opcion</option>
        <option value= "1" selected="selected">Cascada </option>
        </select>
        </div>

          <!-- Lista de grupos quemados, para seleccionar a más de uno!-->
          <div class="form-group"> 
        <label>Selecciona a los grupos</label>
        <select name = "NombreEstudiante" multiple="multiple" class="form-control">
        <option value= "1" selected="selected">Grupo1 </option>
        <option value= "1" selected="selected">Grupo2 </option>
        <option value= "1" selected="selected">Grupo3 </option>
        </select>
        </div>


<!--DropDrownList de estado-->
        <div class="form-group"> 
        <label>Estado</label>
        <select name = "estado" class="form-control">
        <option disabled="disabled" selected="selected">Seleccionar una opcion</option>
        <option value= "1" selected="selected"> Publicado </option>
        </select>
        </div>

        <div class="form-group text-center">
                <input type="submit" id="envio" value="Crear" class="btn btn-primary ">
        </div>
    </form>
</div>
<?php require_once 'views/docente/footer.php'?>
</body>

