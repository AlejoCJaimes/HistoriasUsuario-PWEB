<?php require 'views/estudiante/header.php'
?>
<div class="container">
  <h2><i class="fas fa-cog"></i> Cambiar Clave </h2>
       <article>
           <section class="container">
               <form action="<?php echo constant('URL');?>estudiante/ActualizarClave" method="post" name="formulario" id="formulario" autocomplete="off">
                   <fieldset>
                      <?php echo $this->confirmacion;?>
                       <div class="form-group">
                         <br>
                         <label>Contraseña</label>
                        <input type="password" id="validar" name="clave_usuario" class="form-control validar" placeholder="escribe tu contraseña">
                        </div>
                        <div class="form-group">
                       <label>Confirmar Contraseña</label>
                       <input type="password" id="nombre" name="confirmar_clave" class="form-control" placeholder="confirma tu contraseña">
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

<?php require_once "views/estudiante/footer.php"?>
