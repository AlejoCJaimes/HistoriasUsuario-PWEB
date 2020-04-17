<?php require 'views/administrador/header.php'
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
               <form action="<?php echo constant('URL');?>administrador/EditarPerfil" method="post" name="formulario" id="formulario" autocomplete="off">
                   <fieldset>
                      <br>
                      <!--LLENADO DE COMBO
                      1.Hacer consulta en la base de datos para devolver los registros
                      2.Traer el seleccionado-->
                      <label>Tipo de Identificación</label>
                      <!--Aqui va el mensaje de validacion-->
                      <?php echo $this->confirmacion;?>
                       <select name = "IdTipoDocumento" class="form-control">
                         <option value= "<?php echo $datos_perfil->id_documento ?> " selected="selected"> <?php echo $datos_perfil->tipo_documento ?> </option>






                      <?php

                           require_once 'libs/database.php';
                           $this->db = new Database();

                           //statement return dates
                           $query = $this->db->connect()->query("SELECT Id, NombreDocumento FROM tipodocumento WHERE Id != '$datos_perfil->id_documento' ");

                         while($row = $query->fetch()) {
                       ?>
                              <option value = "<?php echo $row['Id']?>"> <?php echo $row['NombreDocumento']?></option>
                       <?php

                            }
                        ?>
                        </select>





                       <div class="form-group">
                         <br>
                         <label>Número de documento</label>
                          <input type="number" id="validar" name="CedulaAdmin" class="form-control validar" value="<?php echo $datos_perfil->cedula;?>" >
                          </div>
                          <div class="form-group">
                         <label>Nombre</label>
                         <input type="text" id="nombre" name="NombreAdmin" class="form-control" placeholder="Escribe tus nombre" value="<?php echo $datos_perfil->nombre;?>" >
                         </div>
                         <div class="form-group">
                         <label>Apellidos</label>
                         <input type="text" id="nombre" name="ApellidoAdmin" class="form-control" placeholder="Escribe tus apellido" value="<?php echo $datos_perfil->apellido;?>">
                         </div>
                         <div class="form-group">
                           <label>Correo</label>
                          <input type="text" id="validar" name="correo_usuario" class="form-control validar" readonly value="<?php echo $this->mensaje;?>">
                          </div>

                          <!--meter aqui el mensaje de la alerta de actualizacion-->

                       <div class="form-group text-center">
                       <input type="submit" id="envio" value="Guardar" class="btn btn-primary ">
                       </div>
                   </fieldset>
               </form>
           </section>
       </article>
</div>
<!-- FIN  DEL CONTENIDO PRINCIPAL -->

<!-- Comentario dle perfil -->

<?php require_once "views/administrador/footer.php"?>
