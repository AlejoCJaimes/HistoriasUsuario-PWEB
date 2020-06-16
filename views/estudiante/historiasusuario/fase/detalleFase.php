<?php require 'views/estudiante/header.php'
?>
<!-- INICIO DEL CONTENIDO PRINCIPAL -->
<div class="container">
<br>
<br>

<h3><i class="fas fa-bezier-curve"></i>&nbsp; Fase</h3>
<hr>
<br>
<div><?php echo $this->confirmacion;?></div>

<a role="button" class="btn btn-info" href="<?php echo constant('URL');?>estudiante/crearFase"> <i class="fas fa-plus"></i> Crear Fase</a>
<br>
<br>
<table class="table table-hover">
<thead class="thead bg-success text-white   ">
    <tr>
      <th scope="col">Fase</th>
      <th scope="col">Descripcion</th>
      <th scope="col">Fecha de Creacion</th>
      <th scope="col">Ultima Actualización</th>
      <th scope="col">Objetivo</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  
  <tbody>
 
    <tr>
    <?php 
         require_once 'models/Fase.php';
        foreach ($this->fases as $row) {
            $fases = new Fase();
            $fases = $row;
        ?>

          <!--Variables Auxiliares del modal-->
          <?php 
             $var = '#_'.$fases->Id;
             $var_2 = '_'.$fases->Id;
        ?>

      <td><?php echo $fases->Nombre ?></td>
      
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
                        <textarea class="form-control" id="Descripcion" name="descripcion" READONLY rows="4"><?php echo $fases->Descripcion?></textarea>
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
      
      
      <td><?php echo $fases->FechaCreacion?></td>
      <td><?php echo $fases->FechaActualizacion?></td>

      <td>

       <!--Variables Auxiliares del modal-->
       <?php 
             $var_modulo_1 = '#_45'.$fases->Id;
             $var_modulo_2 = '_45'.$fases->Id;
        ?>
      
      <a href="" data-toggle="modal" data-target="<?php echo $var_modulo_1?>"
        style="color: #2C9FAF;"><i class="fas fa-eye"></i> Leer</a>
        
        <div class="modal fade" id="<?php echo $var_modulo_2?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-bookmark"></i> Objetivo</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                         </button>
                    </div>
                <div class="modal-body">
                        <div class="form-group">
                        <textarea class="form-control" id="Descripcion" READONLY name="descripcion" rows="4"><?php echo $fases->nombre_objetivo?></textarea>
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




      
      
      <td class="text-center">  
      
       <!--Variables Auxiliares del modal-->
      <?php 
             $var_edit_1 = '#_5'.$fases->Id;
             $var_edit_2 = '_5'.$fases->Id;
        ?>

      <a href="" data-toggle="modal" data-target="<?php echo $var_edit_1?>"
        style="color: #EBAB10;"><i class="fas fa-edit"></i></a>
      
        <div class="modal fade" id="<?php echo $var_edit_2?>" tabindex="-1" role="dialog" aria-labelledby="a" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-bookmark"></i> Fases</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                         </button>
                    </div>
                <div class="modal-body text-left">
                <form action="<?php echo constant('URL') .'estudiante/editFase' ?>" method="POST">
                <input type="hidden" class="form-control" name="IdFase" value="<?php echo$fases->Id?>"/>
                <input type="hidden" class="form-control" name="IdObjetivo" value="<?php echo$fases->id_objetivo?>"/>
                        <div class="form-group">
                            <label for="inputName">Nombre</label>
                            <input type="text" class="form-control" name="nombre" value="<?php echo$fases->Nombre?>"/>
                        </div>
                        <div class="form-group">
                        <label for="inputName">Descripcion</label>
                        <textarea class="form-control" id="descripcion_actividad" name="descripcion" rows="6"><?php echo $fases->Descripcion?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputName">Estado</label>
                            <select name="id_estado" REQUIRED id="idestado" style="width: 220px;" class="form-control">
                                <option value="<?php echo $fases->IdEstado ?>"><?php echo $fases->nombre_estado?></option>
                                <?php
                                foreach ($this->estados as $row) {
                                    $estados = $row;
                                
                                ?>
                                <option value="<?php echo $estados[0]?>"><?php echo $estados[1]?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="inputName">Objetivo</label>
                        <textarea class="form-control" id="descripcion_actividad" name="objetivo" rows="6"><?php echo $fases->nombre_objetivo?></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <input type="submit" value="Editar" class="btn btn-primary">
            </form>
                    </div>
                </div>
            </div>
        </div>    




         <!--Variables Auxiliares del modal ELIMINACION-->
      <?php 
             $var_del_1 = '#_4'.$fases->Id;
             $var_del_2 = '_4'.$fases->Id;
        ?>


      <a href="" data-toggle="modal" data-target="<?php echo $var_del_1?>"
        style="color: #B20710;"><i class="fas fa-trash"></i></a>
        
        
        <div class="modal fade" id="<?php echo $var_del_2?>" tabindex="-1" role="dialog" aria-labelledby="a" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-eraser"></i> Eliminar Fase</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                         </button>
                    </div>
                <div class="modal-body text-left">
                <form action="<?php echo constant('URL') .'estudiante/eliminarFase' ?>" method="POST">
                <input type="hidden" class="form-control" name="Id" value="<?php echo$fases->Id?>"/>
                        <div class="form-group">
                          
                            <br>
                            <h5>¿Está seguro de eliminar la fase <?php echo$fases->Nombre?>?</h5>
                            </div>
                            <p>Tenga en cuenta que al eliminar una fase, se eliminarán todos los elementos asociados a ella 
                            como modulo, historia de usuario, actividad, recurso y objetivo.</p>
                        
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
