<?php require 'views/administrador/header.php'
?>

<!-- INICIO DEL CONTENIDO PRINCIPAL -->

<div class="container">




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

        <?php
      require_once 'models/Users.php';
      foreach($this->administrador as $row){
        $administrador = new Users();
        $administrador = $row;
      }
    ?>
        <!--  <h3> Datos de CARGAR DATOS DEL CRUD </h3> -->
        <form action="<?php echo constant('URL');?>administrador/EditarAdmin" method="post"
            name="formularioInfoPersonal" id="formulario" autocomplete="off">
            <fieldset>
                <br>
                <h5><i class="fas fas fa-user"></i> Informacion Personal </h5>
                <br>
                <?php echo $this->confirmacion;?>

                <div class="form-row">
                    <div class="form-group col-md-5">
                        <!-- Acá -->
                        <label>Tipo de Identificación</label>
                        <select name="IdTipoDocumento" class="form-control">

                            <!--loadData dropDownList-->
                            <option value="<?php echo $datos_perfil->id_documento ?> ">
                                <?php echo $datos_perfil->tipo_documento ?>
                            </option>


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
                        <!-- Hasta acá -->
                    </div>
                    <div class="form-group col-md-5">
                        <label>Numero de Documento</label>
                        <input type="number" name="CedulaAdmin" class="form-control" placeholder="Escribe el documento"
                            value="<?php echo $datos_perfil->cedula;?>">
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="inputEmail4">Nombres</label>
                        <input type="text" name="NombreAdmin" class="form-control" placeholder="Escribe tus nombre"
                            value="<?php echo $datos_perfil->nombre;?>">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="inputEmail4">Apellidos</label>
                        <input type="text" name="ApellidoAdmin" class="form-control" placeholder="Escribe tus apellidos"
                            value="<?php echo $datos_perfil->apellido;?>">
                    </div>
                </div>

                <div class="form-group col-md-5">
                    <label>Correo</label>
                    <input type="text" name="correo_usuario" class="form-control" readonly
                        value="<?php echo $administrador->correo; ?>">
                </div>
                <div class="form-row align-items-center">
                    <div class="col-auto my-2">
                        <button type="submit" class="btn btn-primary ">Editar</button>
                    </div>
                </div>
        </form>
        </fieldset>

        <!--Formulario de Datos Usuario-->

        <br>
        <!--<form action="<//?php //echo constant('URL');?>administrador/actualizarEstado" method="post"
            name="formularioDatosUsuario" id="formulario" autocomplete="off">
            <fieldset>
                Datos Usuario-->

                <!--<h5><i class="fas fa-cog"></i> Datos de Usuario </h5>
                <br>
                <//?php echo $this->respuesta;?>
                <div class="form-row">
                
                    <div class="form-group col-md-5">
                        <label>Rol</label>
                        <select name="rol" class="form-control">

                            loadData dropDownList
                            <option value="<//?php echo $administrador->id_rol; ?>">
                                <//?php echo $administrador->rol; ?> </option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label>Estado</label>
                        <select name="estado" class="form-control">

                            <!loadData dropDownList
                            <option disabled="disabled" selected="selected" value="<//?php echo $administrador->estado; ?>">  <//?php echo $administrador->estado; ?> </option>
                            <option value="Activo"> Activo</option>                        
                            <option value="Suspendido">Suspendido</option>
                        </select>
                    </div>
                </div>


                <div class="form-row align-items-center">
                    <div class="col-auto my-2">
                        <button type="submit" class="btn btn-primary" id="Editar datos Usuario">Editar</button>
                    </div>
                </div>
                <input type="text" name="correo_usuario"  style=" width: 0px; height: 0px ; color: white" value="<//?php echo $administrador->correo; ?>">
        <</form>-->
        <fieldset>


    </article>
</div>
<!-- FIN  DEL CONTENIDO PRINCIPAL -->

<?php require_once "views/administrador/footer.php"?>