<?php require 'views/docente/header.php'
?>
<div><?php echo $this->confirmacion;?> </div>
<link href="/open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">


<body>
<div class="container">

    <h2><i class=" fas fa-th-large"></i> Nueva Metodología </h2>

    
    <form action="<?php echo constant('URL');?>docente/addMetodologia" name="form" method="POST" id="form">

        <div class="form-group">
            <br>
            <label>Nombre</label>
            <input type="text" id="nombreMetodologia" required name="nombreMetodologia" class="form-control" placeholder="Escribe el nombre de la metodología">
        </div>
        <div class="form-group">

            <label>Descripción</label>
            <textarea name="descripcionMetodologia" type="text" id="Descripcion" required placeholder="Escribe la respectiva descripción" class="form-control"></textarea>

        </div>
        <div id="divFuentes" class="form-group">
            <label>Fuentes</label>
            <table id="tablaDinamica">
               <td><input type="text" name="fuente[]" style="width: 500px;" required id="fuente" placeholder="Ingrese cita" class="form-control" required> </td>
                <td><button id="btn" type="button" class="btn btn-success"><i class=" fas fa-plus"></i></button> </td>
                <td><ion-icon name="trash-outline"></ion-icon></td>
            </table>
           
        </div>
        
        <div class="form-group text-center">
            <input type="submit" id="envio" value="Crear" class="btn btn-primary ">
        </div>

    </form>

    <!-- Script para agregar dinámicamente nuevos inputs -->
   

</div>
</body>
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