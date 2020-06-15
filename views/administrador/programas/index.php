<?php require 'views/administrador/header.php'?>

<!-- INICIO DEL CONTENIDO PRINCIPAL -->
<body>

<div class="container">
<div class="input-group"><?php echo $this->confirmacion;?> </div>
<br>
<h3> <i class="fas fa-university"></i>&nbsp; Programas Universitarios&nbsp;&nbsp;&nbsp;&nbsp;<hr> <br><button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#exampleModal"> <i class="fas fa-plus"></i> Añadir Programa</button></h3> 

<label for="exampleFormControlTextarea1"></label>

<br>
<br>
<table class="table table-hover">
  <thead class="bg bg-primary text-white text-center">
    <tr>
      <th scope="col">Código</th>
      <th scope="col">Nombre</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody  class="text-center">
    <tr>
        <?php 
            foreach ($this->programas as $row) {
                $programas = $row;
            
        ?>
        <th scope="row"><?php echo $programas[0]?></th>
        <td><?php echo $programas[1]?></td>
        <td>
        <a href="<?php echo constant('URL') .'administrador/eliminar_programa/'.$programas[0];?>"
        style="color: #B20710;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-trash"></i></a>
        
        <!--Variables Auxiliares del modal-->
        <?php 
             $var = '#_'.$programas[0];
             $var_2 = '_'.$programas[0];
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
            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-university"></i> Programa</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="<?php echo constant('URL') .'administrador/editPrograma' ?>" method="POST">
            <div class="form-group">
                            <label for="inputName">Código SNIES</label>
                            <input type="number" class="form-control" name="codigo" READONLY value="<?php echo $programas[0]?>" placeholder="código del programa"/>
                        </div>
                        <div class="form-group">
                            <label for="inputMessage">Programa</label>
                            <textarea class="form-control" name="programa" placeholder="Nombre del programa"><?php echo $programas[1]?></textarea>
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
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-university"></i> Programa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo constant('URL').'administrador/addPrograma'?>" method="POST">
        <div class="form-group">
                        <label for="inputName">Código SNIES</label>
                        <input type="number" class="form-control" name="codigo" placeholder="código del programa"/>
                    </div>
                    <div class="form-group">
                        <label for="inputMessage">Programa</label>
                        <textarea class="form-control" name="programa" placeholder="Nombre del programa"></textarea>
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
