<?php require 'views/docente/header.php'
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
               <form action="<?php echo constant('URL');?>docente/EditarPerfil" method="post" name="formulario" id="formulario" autocomplete="off">
                   <fieldset>
                      <br>
                       <label>Tipo de Identificación</label>
                       <!--Aqui va el mensaje de validacion-->
                       <?php echo $this->confirmacion;?>
                        <select class="form-control">
                               <option disabled="disabled" selected="selected" value = "<?php echo $datos_perfil->id_documento;?>" readonly><?php echo $datos_perfil->tipo_documento;?></option>

                        </select>
                       <div class="form-group">
                         <br>
                         <label>Número de documento</label>
                        <input type="text" id="validar" name="CedulaDocente" class="form-control validar" value =  "<?php echo $datos_perfil->cedula;?>" readonly>
                        </div>
                        <div class="form-group">
                       <label>Nombre</label>
                       <input type="text" id="nombre" name="NombreDocente" class="form-control" placeholder="Escribe tus nombres" value =  "<?php echo $datos_perfil->nombre;?>">
                       </div>
                       <div class="form-group">
                       <label>Apellidos</label>
                       <input type="text" id="nombre" name="ApellidoDocente" class="form-control" placeholder="Escribe tus apellidos" value =  "<?php echo $datos_perfil->apellido;?>">
                       </div>
                       <div class="form-group">
                       <label>Título</label>
                       <input type="text" id="nombre" name="TituloDocente" class="form-control" placeholder="Ingeniero de Sistemas" readonly value =  "<?php echo $datos_perfil->titulo_docente;?>">
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
<!-- FIN  DEL CONTENIDO PRINCIPAL -->

<?php require_once "views/docente/footer.php"?>
