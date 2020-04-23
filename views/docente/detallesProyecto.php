<?php require 'views/docente/header.php'
?>
<div class="container">
<h2><i class=" fas fa-info-circle"></i> Detalles del proyecto </h2>

 
    <form action="" method="POST" id="form">

        <div class="form-group">
            
                <label>Nombre</label>
                <input type="text" id="nombre" name="NombreProyecto" class="form-control " placeholder="Escribe el nombre del proyecto" value=" " >
           
        </div>
        <div class="form-group">
               <label>Fecha límite</label>
               <input type="date" id="FechaFin" name="FechaFin" class="form-control"value=" " >
        </div>

        <!--DropDrownList de metodología READONLY-->
        <div class="form-group" readonly> 
        <label>Metodologia</label readonly>
        <select name = "metodologia" class="form-control" readonly>
        <option disabled="disabled" selected="selected">Seleccionar una opcion</option readonly>
        <option value= "1" selected="selected">Cascada </option readonly>
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
                <input type="submit" id="envio" value="Editar" class="btn btn-primary ">
        </div>
    </form>
</div>

<?php require_once 'views/docente/footer.php'?>