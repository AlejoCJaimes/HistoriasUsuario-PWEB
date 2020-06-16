<?php require 'views/estudiante/header.php'
?>
<!-- INICIO DEL CONTENIDO PRINCIPAL -->
<div class="container">
<br>
<br>

<h3><i class="far fa-object-group"></i> Módulo</h3>
<hr>
<br>
<div><?php echo $this->confirmacion;?></div>

<a role="button" class="btn btn-info" href="<?php echo constant('URL');?>estudiante/crearModulo"> <i class="fas fa-plus"></i> Crear Módulo</a>
<br>
<br>
<table class="table table-hover">
<thead class="thead bg-success text-white   ">
    <tr>
      <th scope="col">Módulo</th>
      <th scope="col">Descripcion</th>
      <th scope="col">Fecha Creación</th>
      <th scope="col">Última Modificación</th>
      <th scope="col">Fase</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  
  <tbody>
 
    <tr>
    <?php 
        foreach ($this->modulos as $row) {
            $modulos= $row;
        ?>

          <!--Variables Auxiliares del modal-->
          <?php 
             $var = '#_'.$modulos[0];
             $var_2 = '_'.$modulos[0];
        ?>

      <td><?php echo $modulos[3] ?></td>
      
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
                        <textarea class="form-control" id="Descripcion" name="descripcion" READONLY rows="4"><?php echo $modulos[5]?></textarea>
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
      
      
      <td><?php echo $modulos[1]?></td>
      <td><?php echo $modulos[2]?></td>

      <td>

       <!--Variables Auxiliares del modal-->
       <?php 
             $var_modulo_1 = '#_45'.$modulos[0];
             $var_modulo_2 = '_45'.$modulos[0];
        ?>
      
      <a href="" data-toggle="modal" data-target="<?php echo $var_modulo_1?>"
        style="color: #2C9FAF;"><i class="fas fa-eye"></i> Leer</a>
        
        <div class="modal fade" id="<?php echo $var_modulo_2?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-bookmark"></i> Fase</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                         </button>
                    </div>
                    
                <div class="modal-body">
                        <div class="form-group">
                        <label for="inputName">Nombre</label>
                        <input type="text" class="form-control" name="fase" READONLY value="<?php echo$modulos[6]?>"/>
                        </div>
                        <div class="form-group">
                        <label for="inputName">Descripcion</label>
                        <textarea class="form-control" id="Descripcion" READONLY name="fase" rows="4"><?php echo $modulos[7]?></textarea>
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
             $var_edit_1 = '#_5'.$modulos[0];
             $var_edit_2 = '_5'.$modulos[0];
        ?>

      <a href="" data-toggle="modal" data-target="<?php echo $var_edit_1?>"
        style="color: #EBAB10;"><i class="fas fa-edit"></i></a>
      
        <div class="modal fade" id="<?php echo $var_edit_2?>" tabindex="-1" role="dialog" aria-labelledby="a" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-bookmark"></i> Módulos</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                         </button>
                    </div>
                <div class="modal-body text-left">
                <form action="<?php echo constant('URL') .'estudiante/editModulo' ?>" method="POST">
                <input type="hidden" class="form-control" name="Id" value="<?php echo $modulos[0]?>"/>
                        <div class="form-group">
                            <label for="inputName">Nombre</label>
                            <input type="text" class="form-control" name="nombre" value="<?php echo$modulos[3]?>"/>
                        </div>
                        <div class="form-group">
                        <label for="inputName">Descripcion</label>
                        <textarea class="form-control" id="descripcion_actividad" name="descripcion" rows="6"><?php echo $modulos[5]?></textarea>
                        </div>
                        
                        <div class="form-group">
                        <label for="inputName">Fase</label>
                        <input type="text" class="form-control" name="fase" READONLY value="<?php echo$modulos[6]?>"/>
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
             $var_del_1 = '#_4'.$modulos[0];
             $var_del_2 = '_4'.$modulos[0];
        ?>


      <a href="" data-toggle="modal" data-target="<?php echo $var_del_1?>"
        style="color: #B20710;"><i class="fas fa-trash"></i></a>
        
        
        <div class="modal fade" id="<?php echo $var_del_2?>" tabindex="-1" role="dialog" aria-labelledby="a" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-eraser"></i> Eliminar Módulo</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                         </button>
                    </div>
                <div class="modal-body text-left">
                <form action="<?php echo constant('URL') .'estudiante/eliminarModulo' ?>" method="POST">
                <input type="hidden" class="form-control" name="Id" value="<?php echo$modulos[0]?>"/>
                        <div class="form-group">
                          
                            <br>
                            <h5>¿Está seguro de eliminar el módulo <?php echo$modulos[3]?>?</h5>
                            </div>
                            <p>Tenga en cuenta que al eliminar un módulo, se eliminarán todos los elementos asociados a ella 
                            siempre y cuando estén creados, como:  historia de usuario, actividad y recurso</p>
                        
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
