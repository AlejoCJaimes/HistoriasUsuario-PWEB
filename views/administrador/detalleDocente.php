<?php require 'views/administrador/header.php'
?>

<!-- INICIO DEL CONTENIDO PRINCIPAL -->

<div class="container">

  <?php
    require_once 'models/Users.php';
      foreach($this->datos_perfil as $row){
        $datos_perfil = new Users();
        $datos_perfil = $row;
    }
  ?>

  <h3><?php echo $this->mensaje;?></h3>
  <article>

    <?php
        require_once 'models/Users.php';
          foreach($this->docente as $row){
            $docente = new Users();
            $docente = $row;
          }
        ?>
<h6><?php echo $this->confirmacion; ?></h6>
    <form action="<?php echo constant('URL');?>administrador/actualizarDocente" method="post" name="formularioInfoPersonal" id="formulario" autocomplete="off">
      <fieldset>
        <br>
        <h5><i class="fas fas fa-user"></i> Informacion Personal </h5>
        <br>

        <div class="form-row">
          <div class="form-group col-md-5">
            <label>Tipo de Identificación</label>
            <select name="IdTipoDocumento" class="form-control">
              <option value="<?php echo $datos_perfil->id_documento ?> ">
                <?php echo $datos_perfil->tipo_documento ?></option>
                <?php

                require_once 'libs/database.php';
                $this->db = new Database();

                //statement return dates
                $query = $this->db->connect()->query("SELECT Id, NombreDocumento FROM tipodocumento WHERE Id != '$datos_perfil->id_documento'");

                while($row = $query->fetch()) {
              ?>
              <option value="<?php echo $row['Id']?>"> <?php echo $row['NombreDocumento']?></option>
              <?php
                  }
              ?>
            </select>
          </div>
          <div class="form-group col-md-5">
            <label>Numero de Documento</label>
            <input type="number" name="CedulaDocente" class="form-control" value="<?php echo $datos_perfil->cedula;?>" placeholder="Escribe el documento">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-5">
            <label for="inputEmail4">Nombres</label>
            <input type="text" name="NombreDocente" value="<?php echo $datos_perfil->nombre;?>" class="form-control" placeholder="Escribe tus nombre">
          </div>
          <div class="form-group col-md-5">
            <label for="inputEmail4">Apellidos</label>
            <input type="text" name="ApellidoDocente" value="<?php echo $datos_perfil->apellido;?>" class="form-control" placeholder="Escribe tus apellidos">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-5">
            <label>Titulo</label>
            <input type="text" name="TituloDocente" value="<?php echo $datos_perfil->titulo_docente;?>" class="form-control" placeholder="Titulo profesional">
          </div>
          <div class="form-group col-md-5">
          <label>Correo</label>
          <input type="text" name="correo_usuario" class="form-control" readonly
            value="<?php echo $docente->correo; ?>">
        </div>
        </div>
        <div class="form-row align-items-center">
          <div class="col-auto my-2">
            <button type="submit" class="btn btn-primary ">Editar</button>
          </div>
        </div>
    </form>
    </fieldset>


    <br>

    <form action="<?php echo constant('URL');?>administrador/actualizarEstado" method="post"
      name="formularioDatosUsuario" id="formulario" autocomplete="off">
      <fieldset>
        <!--Datos Usuario-->
        <h5><i class="fas fa-cog"></i> Datos de Usuario </h5>
        <br>
        <?php echo $this->respuesta;?>
        <div class="form-row">
          <div class="form-group col-md-5">
            <label>Rol</label>
            <select name="rol" class="form-control">
              <!--loadData dropDownList-->
              <option value="<?php echo $docente->id_rol; ?>">  <?php echo $docente->rol; ?> </option>
            </select>
          </div>
          <div class="form-group col-md-5">
            <label>Correo</label>
            <input type="text" name="correo_usuario" class="form-control" readonly
              value="<?php echo $docente->correo; ?>">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-5">
            <label>Estado</label>
            <select name="estado" class="form-control">

              <!--loadData dropDownList-->
              <option name="estado" selected value="<?php echo $docente->estado; ?>">
                <?php echo $docente->estado; ?></option>
              <option value="Activo"> Activo</option>
              <option value="Suspendido">Suspendido</option>
            </select>
          </div>
        </div>


        <div class="form-row align-items-center">
          <div class="col-auto my-2">
            <button type="submit" class="btn btn-primary ">Editar</button>
          </div>
        </div>
    </form>
    <fieldset>


  </article>
</div>
<!-- FIN  DEL CONTENIDO PRINCIPAL -->

<?php require_once "views/administrador/footer.php"?>