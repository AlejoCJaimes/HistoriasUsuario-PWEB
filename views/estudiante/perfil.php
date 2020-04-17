<?php require 'views/estudiante/header.php'
?>

<!-- INICIO DEL CONTENIDO PRINCIPAL -->

<div class="container">
  <h2>Editar Perfil</h2>
       <article>
         <?php
         require_once 'models/Users.php';
           foreach($this->datos_perfil as $row){
             $datos_perfil = new Users();
             $datos_perfil = $row;
           }
           /*public $cedula;
           public $tipo_documento;
           public $nombre;
           public $apellido;
           public $id_documento;
         */
         ?>

           <section class="container">
               <form action="<?php echo constant('URL');?>estudiante/EditarPerfil" method="POST" name="formulario" id="formulario" autocomplete="off">
                   <fieldset>
                      <br>
                      <!--Aqui va el mensaje de validacion-->
                      <?php echo $this->confirmacion;?>
                       <label>Tipo de Identificación</label>
                        <select class="form-control">
                               <option disabled="disabled" selected="selected" value = "<?php echo $datos_perfil->id_documento;?>"><?php echo $datos_perfil->tipo_documento;?></option>

                        </select>
                       <div class="form-group">
                         <br>
                         <label>Número de documento</label>
                        <input type="text" id="validar" name="CedulaEstudiante" class="form-control validar" placeholder="100506589" readonly value="<?php echo $datos_perfil->cedula;?>">
                        </div>
                        <div class="form-group">
                       <label>Nombre</label>
                       <input type="text" id="nombre" name="NombreEstudiante" class="form-control" placeholder="Escribe tus nombres" value="<?php echo $datos_perfil->nombre;?>" >
                       </div>
                       <div class="form-group">
                       <label>Apellidos</label>
                       <input type="text" id="nombre" name="ApellidoEstudiante" class="form-control" placeholder="Escribe tus apellidos" value="<?php echo $datos_perfil->apellido;?>">
                       </div>
                       <label>Programa</label>
                        <select class="form-control">
                               <option disabled="disabled" readonly selected="selected" value="<?php echo $datos_perfil->$codigo_programa;?>" ><?php echo $datos_perfil->programa;?></option>

                        </select>
                        <br>
                         <div class="form-group">
                        <label>Ubicacion semestral</label>
                        <input type="number" id="nombre" name="NumeroSemestre" class="form-control" placeholder="numero de semestre" value="<?php echo $datos_perfil->numero_semestre;?>" min="1" max="10">
                        </div>
                        <div class="form-group">
                        <label>Correo</label>
                       <input type="text" id="validar" name="correo_usuario" class="form-control validar" readonly value="<?php echo $this->mensaje;?>">
                       </div>


                       <div class="form-group text-center">
                       <input type="submit" id="envio" value="Guardar" class="btn btn-primary ">
                       </div>
                   </fieldset>
               </form>
           </section>
       </article>
</div>

<?php require_once "views/estudiante/footer.php"?>
