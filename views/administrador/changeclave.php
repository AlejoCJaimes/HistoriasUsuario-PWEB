<?php require 'views/administrador/header.php'?>
<div class="container">
  <h2><i class="fas fa-cog"></i> Cambiar Clave </h2>
       <article>
           <section class="container">
           <div class="container">
               <form action="<?php echo constant('URL');?>administrador/ActualizarClave" method="post" name="formulario" id="formulario" autocomplete="off">
                   <fieldset>
                      <?php echo $this->confirmacion;?>
                       <div class="form-group">
                         <br>
                         <label>Contraseña</label>
                        <input type="password" id="validar" name="clave_usuario" class="form-control validar" style="width: 450px" placeholder="escribe tu contraseña">
                        </div>
                        <div class="form-group">
                       <label>Confirmar Contraseña</label>
                       <input type="password" id="nombre" name="confirmar_clave" class="form-control" style="width: 450px"  placeholder="confirma tu contraseña">
                       </div>
                       <div class="form-group">
                       <input type="submit" id="envio" value="Guardar" class="btn btn-primary ">
                       </div>
                   </fieldset>
               </form>
               </div>
           </section>
       </article>
</div>
<!-- FIN  DEL CONTENIDO PRINCIPAL -->

<?php require 'views/administrador/footer.php'?>
