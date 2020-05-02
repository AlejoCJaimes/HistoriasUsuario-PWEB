<?php require 'views/docente/header.php'
?>
<?php echo $this->confirmacion?>
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

 
    <form action="<?php echo constant('URL');?>docente/actualizarMetodologia" method="POST" id="form">
      
        <div class="form-group">
            <br>
                <label>Nombre</label>
                <input type="text" id="nombre" name="nombreMetodologia" class="form-control " placeholder="Escribe el nombre de la metodología" value="<?php echo $metodologias->nombre?>" >
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
            $array = [];
            require_once 'models/Metodologia.php';
            foreach($this->fuentes as $row){
                $fuentes = new Metodologia();
                $fuentes = $row;
                array_push($array,$fuentes);
            }
            $longitud = count($array);
            
           for ($i=0; $i<$longitud ; $i++) { 
               
?>
            <table id="tablaDinamica">
               <td><input type="text" name="fuente[]" style="width: 500px;" required id="fuente" placeholder="Ingrese cita" class="form-control" value="<?php echo $array[$i]->link?>"></td>
                <td><button id="btn" type="button" class="btn btn-success"><i class=" fas fa-plus"></i></button> </td>
                <td><a href=" <?php echo constant('URL') . 'docente/eliminarFuente/' . $metodologias->id.'/'.$array[$i]->id_fuentes; ?>" type="button" class="btn btn-danger"><i class=" fas fa-trash"></i> </a></td>
                <!--"class="delete" title="Eliminar" data-toggle="tooltip"></a> </td>-->
                <td><ion-icon name="trash-outline"></ion-icon></td>
            </table>
            <?php }?>
        </div>
       
     
       <div class="form-group text-center">
                <input type="submit" id="envio" value="Editar" class="btn btn-primary ">
        </div>
        <input type="text" name="id" style=" width: 0px; height: 0px ; color: white" value="<?php echo $metodologias->id?> " readonly> 
        <input type="text" name="longitud" style=" width: 0px; height: 0px ; color: white" value="<?php echo $longitud?> " readonly>
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