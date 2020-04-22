<?php require 'views/docente/header.php'
?>
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
        <div class="form-group">
                <label>Metodología</label>
                <input type="text" id="metodología" name="IdMetodologia" class="form-control" value="" >
        </div>
        <div class="form-group">
                <label>Estado</label>
                <input type="text" id="estado" name="IdEstado" class="form-control validar"  value=" ">
        </div>
        <div class="form-group text-center">
                <input type="submit" id="envio" value="Crear" class="btn btn-primary ">
        </div>
    </form>
</div>


<?php require_once 'views/docente/footer.php'?>
