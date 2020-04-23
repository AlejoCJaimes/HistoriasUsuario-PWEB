<?php require 'views/docente/header.php'
?>
<div class="input-group"><?php echo $this->confirmacion;?> </div>
<div class="container">
    <h2><i class=" fas fa-th-large"></i> Nueva Metodología </h2>


    <form action="<?php echo constant('URL');?>docente/addMetodologia" name="form" method="POST" id="form">

        <div class="form-group">
            <br>
            <label>Nombre</label>
            <input type="text" id="nombreMetodologia" name="nombreMetodologia" class="form-control" placeholder="Escribe el nombre de la metodología">
        </div>
        <div class="form-group">

            <!--El campo de TextArea falta arreglar para que se despliegue a medida que se escribe-->

            <label>Descripción</label>
            <textarea name="descripcionMetodologia" type="text" id="Descripcion" placeholder="Escribe la respectiva descripción" class="form-control"></textarea>

        </div>


        <!-- Agregación de Fuentes; EL BOTÓN DE AGREGAR FUENTE NO FUNCIONA!!!-->
        <div id="divFuentes" class="form-group">
            <label>Fuentes</label>
            <input type="text" name="fuente[]" id="fuente" placeholder="Ingrese cita" class="form-control">
        </div>
        <button id="btn" type="button" class="btn btn-warning"> Agregar fuente </button>

        <div class="form-group text-center">
            <input type="submit" id="envio" value="Crear" class="btn btn-primary ">
        </div>

    </form>
    <!-- Script para agregar dinámicamente nuevos inputs -->
    <script>
        $("#btn").addEventListener("click",function(){
            var input = document.createElement("input");
            input.setAttribute("type","text");
            input.setAttribute("name","fuente[]");
            input.setAttribute("class","form-control");
            input.setAttribute("placeholder","Ingrese cita");
            var divFuentes = document.getElementById("divFuentes");
            divFuentes.appendChild(input);
        })

        function $(selector){
            return document.querySelector(selector);
        }
    </script>
</div>
<?php 

require_once 'views/docente/footer.php'?>