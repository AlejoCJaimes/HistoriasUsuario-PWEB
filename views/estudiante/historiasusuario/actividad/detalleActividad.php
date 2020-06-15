<?php require 'views/estudiante/header.php'?>

<!-- INICIO DEL CONTENIDO PRINCIPAL -->
<div class="container">
<br>
<br>

<h3><i class="fas fa-chart-line"></i>&nbsp; Actividad</h3>
<hr>
<br>
<div><?php echo $this->confirmacion;?></div>

<a role="button" class="btn btn-info" href="<?php echo constant('URL');?>estudiante/crearActividad"> <i class="fas fa-plus"></i> Crear Actividad</a>
<br>
<br>
<table class="table table-hover">
<thead class="thead bg-success text-white   ">
    <tr>
      <th scope="col">Actividad</th>
      <th scope="col">Descripcion</th>
      <th scope="col">Fecha de Creacion</th>
      <th scope="col">Elaborado por</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  
  <tbody>
 
    <tr>
    <?php 
         require_once 'models/Actividad.php';
        foreach ($this->actividad as $row) {
            $actividad = new Actividad();
            $actividad = $row;
        ?>

          <!--Variables Auxiliares del modal-->
          <?php 
             $var = '#_'.$actividad->Id;
             $var_2 = '_'.$actividad->Id;
        ?>

      <td><?php echo $actividad->Nombre ?></td>
      <td>
      
      <a href="" data-toggle="modal" data-target="<?php echo $var?>"
        style="color: #2C9FAF;"><i class="fas fa-eye"></i> Leer</a>
        
        <div class="modal fade" id="<?php echo $var_2?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-bookmark"></i> Descripcion</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                         </button>
                    </div>
                <div class="modal-body">
                        <div class="form-group">
                        <textarea class="form-control" id="Descripcion" name="descripcion" READONLY rows="4"><?php echo $actividad->Descripcion?></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>      
            
     </td>
      
      
      <td><?php echo $actividad->FechaCreacion ?></td>
      <td><?php echo $actividad->nombre_estudiante ?></td>
      
      
      <td class="text-center">  
      
       <!--Variables Auxiliares del modal-->
      <?php 
             $var_edit_1 = '#_5'.$actividad->Id;
             $var_edit_2 = '_5'.$actividad->Id;
        ?>

      <a href="" data-toggle="modal" data-target="<?php echo $var_edit_1?>"
        style="color: #EBAB10;"><i class="fas fa-edit"></i></a>
      
        <div class="modal fade" id="<?php echo $var_edit_2?>" tabindex="-1" role="dialog" aria-labelledby="a" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-bookmark"></i> Actividad</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                         </button>
                    </div>
                <div class="modal-body text-left">
                <form action="<?php echo constant('URL') .'estudiante/editActividad' ?>" method="POST">
                <input type="hidden" class="form-control" name="Id" value="<?php echo$actividad->Id?>"/>
                        <div class="form-group">
                            <label for="inputName">Nombre</label>
                            <input type="text" class="form-control" name="Nombre" value="<?php echo$actividad->Nombre?>"/>
                        </div>
                        <div class="form-group">
                        <label for="inputName">Descripcion</label>
                        <textarea class="form-control" id="descripcion_actividad" name="Descripcion" rows="4"><?php echo $actividad->Descripcion?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputName">Historia de Usuario</label>
                            <input type="text" class="form-control" READONLY name="historia" value="<?php echo$actividad->HistoriaUsuario?>"/>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <input type="submit" value="Guardar" class="btn btn-primary">
            </form>
                    </div>
                </div>
            </div>
        </div>    




         <!--Variables Auxiliares del modal ELIMINACION-->
      <?php 
             $var_del_1 = '#_4'.$actividad->Id;
             $var_del_2 = '_4'.$actividad->Id;
        ?>


      <a href="" data-toggle="modal" data-target="<?php echo $var_del_1?>"
        style="color: #B20710;"><i class="fas fa-trash"></i></a>
        
        
        <div class="modal fade" id="<?php echo $var_del_2?>" tabindex="-1" role="dialog" aria-labelledby="a" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-eraser"></i> Eliminar Actividad</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                         </button>
                    </div>
                <div class="modal-body text-left">
                <form action="<?php echo constant('URL') .'estudiante/eliminarActividad' ?>" method="POST">
                <input type="hidden" class="form-control" name="Id" value="<?php echo$actividad->Id?>"/>
                        <div class="form-group">
                          
                            <br>
                            <h5>¿Está seguro de eliminar la actividad <?php echo$actividad->Nombre?>?</h5>
                            </div>
                            <p>Tenga en cuenta que al eliminar una actividad, se eliminarán los recursos asociados
                            a esta.</p>
                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <input type="submit" value="Aceptar" class="btn btn-danger">
            </form>
                    </div>
                </div>
            </div>
        </div>    






      </td>
    </tr>
        <?php }?>
  </tbody>
</table>


</div>
<!-- FIN  DEL CONTENIDO PRINCIPAL -->
<script src='<?php echo constant('URL');?>resources/js/autosize.min.js'></script>
	<script>
		autosize(document.querySelectorAll('#descripcion_actividad'));
	</script>

<?php require_once "views/estudiante/footer.php"?>
