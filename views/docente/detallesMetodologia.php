<?php require 'views/docente/header.php'
?>


<div class="container">
<h2><i class=" fas fa-info-circle"></i> Detalles de la metodología </h2>

 
    <form action="" method="POST" id="form">

        <div class="form-group">
            <br>
                <label>Nombre</label>
                <input type="text" id="nombre" name="Nombre" class="form-control " placeholder="Escribe el nombre de la metodología" value=" " >
        </div>

        <!--El campo de TextArea falta arreglar para que se despliegue a medida que se escribe-->
        <div class="form-group">
               <label>Descripción</label>
               <textarea name="Descripcion" type=id="Descripcion" placeholder="Escribe la respectiva descripción"class="form-control"value=" ">
               </textarea>
        </div>
        
        <!-- Agregación de Fuentes; EL BOTÓN DE AGREGAR FUENTE NO FUNCIONA!!!-->
        <div class="form-group">
               <label>Fuentes</label>
               <input type="text" id="link" placeholder="Copia y pega el link"class="form-control"value=" " >
               </div>
        <button id="adicional" name=adicional" type="button" class="btn btn-warning"> Agregar fuente </button>
       
     
       <div class="form-group text-center">
                <input type="submit" id="envio" value="Editar" class="btn btn-primary ">
        </div>
        
    </form>
    
</div>


<?php require_once 'views/docente/footer.php'?>