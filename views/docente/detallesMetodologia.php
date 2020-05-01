<?php require 'views/docente/header.php'
?>

<div class="container">
<?php 
            //$arreglo = [];
            require_once 'models/Metodologia.php';
            foreach($this->metodologias as $row){
                $metodologias = new Metodologia();
                $metodologias = $row;
                //array_push($arreglo,$metodologias);
            }
            
?>
<h2><i class=" fas fa-info-circle"></i> Detalles de la metodología </h2>

 
    <form action="" method="POST" id="form">

        <div class="form-group">
            <br>
                <label>Nombre</label>
                <input type="text" id="nombre" name="Nombre" class="form-control " placeholder="Escribe el nombre de la metodología" value="<?php echo $metodologias->nombre?>" >
        </div>

        <!--El campo de TextArea falta arreglar para que se despliegue a medida que se escribe-->
        <div class="form-group">

            <label>Descripción</label>
            <textarea name="descripcionMetodologia" type="text" id="Descripcion" placeholder="Escribe la respectiva descripción" class="form-control"><?php echo $metodologias->descripcion?></textarea>

        </div>
        
        <!-- Agregación de Fuentes; EL BOTÓN DE AGREGAR FUENTE NO FUNCIONA!!!-->
        <div id="divFuentes" class="form-group">
            <label>Fuentes</label>
            <?php 
            //$arreglo = [];
            require_once 'models/Metodologia.php';
            foreach($this->metodologias as $row){
                $array = new Metodologia();
                $array = $row;
                //array_push($arreglo,$metodologias);
?>
            <table id="tablaDinamica">
               <td><input type="text" name="fuente[]" style="width: 500px;" required id="fuente" placeholder="Ingrese cita" class="form-control" value="<?php echo $metodologias->link?>"></td>
                <td><button id="btn" type="button" class="btn btn-success"><i class=" fas fa-plus"></i></button> </td>
                <td><ion-icon name="trash-outline"></ion-icon></td>
            </table>
            <?php }?>
        </div>
       
     
       <div class="form-group text-center">
                <input type="submit" id="envio" value="Editar" class="btn btn-primary ">
        </div>
        
    </form>
    
</div>


<?php require_once 'views/docente/footer.php'?>
<script>

$(document).ready(function(){
    var i = 1;

    $('#btn').click(function () {
        i++;
        $('#tablaDinamica').append('<tr id="row'+i+'">' +
        '<td><input type="text" name="fuente[]" placeholder="Ingrese cita" class="form-control" /></td>' +
       
         '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class=" fas fa-trash"></i></button></td>' +
          '</tr>');
    });
    
    $(document).on('click', '.btn_remove', function () {
        var id = $(this).attr('id');
       $('#row'+ id).remove();
    });

   
})
</script>
<script src='<?php echo constant('URL');?>resources/js/autosize.min.js'></script>
	<script>
		autosize(document.querySelectorAll('#Descripcion'));
	</script>