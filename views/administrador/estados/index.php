<?php require 'views/administrador/header.php'?>

<!-- INICIO DEL CONTENIDO PRINCIPAL -->
<body>

<div class="container">
<div class="input-group"><?php echo $this->confirmacion;?> </div>
<br>
<h3>  <i class="fab fa-font-awesome-alt"></i>&nbsp; Estados&nbsp;&nbsp;&nbsp;&nbsp;<hr> <br><button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#exampleModal"> <i class="fas fa-plus"></i> Añadir Estado</button></h3> 

<label for="exampleFormControlTextarea1"></label>

<br>
<br>
<table class="table table-hover">
  <thead class="bg bg-primary text-white text-center">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Nombre</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody  class="text-center">
    <tr>
        <?php 
            foreach ($this->estados as $row) {
                $estados = $row;
            
        ?>
        <th scope="row"><?php echo $estados[0]?></th>
        <td><?php echo $estados[1]?></td>
        <td>
        <a href="<?php echo constant('URL') .'administrador/eliminar_estado/'.$estados[0];?>"
        style="color: #B20710;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-trash"></i></a>
        
        <!--Variables Auxiliares del modal-->
        <?php 
             $var = '#_'.$estados[0];
             $var_2 = '_'.$estados[0];
        ?>
        
        <a href=""
        style="color: #FC8E1B;"  data-toggle="modal" data-target="<?php echo $var?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-edit"></i></a>
        </td>
    </tr>
    <!--Modal de Edicion-->
     <!-- Modal -->
    <div class="modal fade" id="<?php echo $var_2?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fab fa-font-awesome-alt"></i> Estados</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="<?php echo constant('URL') .'administrador/editEstado' ?>" method="POST">
            <div class="form-group">
                            <label for="inputName">Id</label>
                            <input type="number" class="form-control" name="Id" READONLY value="<?php echo $estados[0]?>"/>
                        </div>
                        <div class="form-group">
                            <label for="inputMessage">Estado</label>
                            <input type="text" class="form-control" name="estado" value="<?php echo $estados[1]?>"/>
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




    <?php }?>
  </tbody>
</table>
</div>
</body>
<!-- FIN  DEL CONTENIDO PRINCIPAL -->
<!--Inicio de Modal creacion-->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fab fa-font-awesome-alt"></i> Estados</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo constant('URL').'administrador/addEstado'?>" method="POST">
       
                    <div class="form-group">
                        <label for="inputMessage">Estado</label>
                        <input type="text" class="form-control" name="estado"/>
                    </div>
                   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <input type="submit" value="Crear" class="btn btn-primary">
        </form>
      </div>
    </div>
  </div>
</div>
<!--Fin de Modal Creacion-->

<?php require 'views/administrador/footer.php'?>
