<!DOCTYPE html>
<html lang="eS">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title Page-->
    <title>Registro Docente</title>

    <!-- Icons font CSS-->
    <link href="<?php echo constant('URL');?>resources/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Font special for pages-->


    <!-- Vendor CSS-->
    <link href="<?php echo constant('URL');?>resources/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="<?php echo constant('URL');?>resources/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">
    <link rel="icon" href="<?php echo constant('URL');?>resources/img/logo.png">

    <!-- Main CSS-->
    <link href="<?php echo constant('URL');?>resources/css/main.css" rel="stylesheet" media="all">
    <script src="<?php echo constant('URL');?>resources/js/validar.js"></script>

    <!--<script src="https://code.jquery.com/jquery-3.2.1.js"></script>-->
</head>


<body>


    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                  <div class="input-group"><?php echo $this->mensaje;?> </div>
                    <h2 class="title">Formulario de Registro</h2>

                    <form name ="formularioRegistro" method="POST" action ="<?php echo constant('URL');?>usuario/addDocente">
                      <div class="row row-space">
                          <div class="col-2">
                              <div class="input-group">
                              <label class="label">Tipo Documento</label>
                          <div class="rs-select2 js-select-simple select--no-search">
                              <select id="rol" name="IdTipoDocumento">
                                  <option disabled="disabled" selected="selected">Seleccionar una opcion</option>

                                  <?php

                                       require_once 'libs/database.php';
                                       $this->db = new Database();

                                       //statement return dates
                                       $query = $this->db->connect()->query("SELECT Id, NombreDocumento FROM tipodocumento ");

                                     while($row = $query->fetch()) {
                                   ?>
                                          <option value = "<?php echo $row['Id']?>"> <?php echo $row['NombreDocumento']?></option>
                                   <?php

                                        }
                                    ?>

                              </select>

                              <div class="select-dropdown"></div>

                              </div>
                          </div>

                      </div>
                      <div class="col-2">
                          <div class="input-group">
                              <label class="label">Numero Documento</label>
                              <input class="input--style-4"  type="number" name="CedulaDocente" >
                          </div>
                      </div>

                    </div>

                    <div class="row row-space">
                        <div class="col-2">
                            <div class="input-group">
                                <label class="label">Nombre</label>
                                <input class="input--style-4" type="text" name="NombreDocente" required>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="input-group">
                                <label class="label">Apellido</label>
                                <input class="input--style-4" type="text" name="ApellidoDocente" >
                            </div>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="input-group">
                            <label class="label">Título</label>
                            <input class="input--style-4 " type="text"  name="TituloDocente" required>
                        </div>
                    </div>
                  <div class="row row-space">
                      <div class="col-2">
                          <div class="input-group">
                              <label class="label">Correo</label>
                              <input class="input--style-4" type="email" id= "correo_usuario" name="correo_usuario" required>
                          </div>
                      </div>
                      <div class="col-2">
                          <div class="input-group">
                          <label class="label">Rol</label>
                      <div class="rs-select2 js-select-simple select--no-search">
                          <select id="rol" name="rol">
                              <option disabled="disabled" selected="selected">Seleccionar una opcion</option>
                              <option  value="Docente">Docente</option>


                          </select>

                          <div class="select-dropdown"></div>

                          </div>
                      </div>

                  </div>
                  </div>




                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Contraseña</label>
                                    <input class="input--style-4" type="password" id= "clave_usuarioo" name="clave_usuario" >
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Confirmar Contraseña</label>
                                    <input class="input--style-4" id= "confirmacion_clave" type="password" name="confirmacion_clave" >
                                </div>
                            </div>
                        </div>

                        <div class="p-t-10">

                            <div class="row row-space" id="alerta"> </div>
                            <button type="button"  onclick = "validarFormulario();" class="btn btn--radius-2 btn--blue"  >Regístrate</button>


                            <div class="row row-space">
                            <div class="col-4">
                            <br>

                        <?php require 'views/home/footer.php'?>
                            </div>
                           </div>

                    </form>

                </div>
        </div>
    </div>



    <!-- Jquery JS-->

    <script src="<?php echo constant('URL');?>resources/vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="<?php echo constant('URL');?>resources/vendor/select2/select2.min.js"></script>
    <script src="<?php echo constant('URL');?>resources/vendor/datepicker/moment.min.js"></script>
    <script src="<?php echo constant('URL');?>resources/vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="<?php echo constant('URL');?>resources/js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->
