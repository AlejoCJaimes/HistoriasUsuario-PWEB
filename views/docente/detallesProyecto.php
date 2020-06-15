<?php require 'views/docente/header.php'?>

<head>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/flick/jquery-ui.min.css">
        <script src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
</head>

<body>
        <div class="container">
        <div><?php echo $this->confirmacion;?> </div>
                <h2><i class=" fas fa-info-circle"></i> Detalles del proyecto </h2>
                <br>
                <br>
                <?php  
                require_once 'models/Proyecto.php';
                foreach ($this->proyecto as $row) {
                        $proyecto = new Proyecto();
                        $proyecto = $row;
                }
                ?>
                <form action="<?php echo constant('URL');?>docente/actualizar_proyecto" method="POST" id="form">
                       
                        <div class="form-group">

                                <label>Nombre</label>
                                <input type="text" id="nombre" name="NombreProyecto" class="form-control"
                                        placeholder="Escribe el nombre del proyecto"
                                        value="<?php echo $proyecto->NombreProyecto ?> " style="width: 400px">
                                        <input type="hidden" id="hidden" name="id_proyecto" value="<?php echo $proyecto->Id?>">
                        </div>
                        <div class="form-group">
                                <label>Fecha límite</label>

                                <div class="input-group" style=" width: 250px;">
                                        <input type="text" class="form-control" style=" width: 50px;" id="fecha"
                                                name="fecha_fin" min="2020-05-10" max="2020-06-30"
                                                value="<?php echo $proyecto->FechaFin?>">
                                        <div class="input-group-append">
                                                <span class="material-icons input-group-text">calendar_today</span>
                                        </div>
                                </div>
                        </div>
                        <!--DropDrownList de metodología READONLY-->
                        <div class="form-group">
                                <label>Metodologia</label>
                                <input type="text" id="nombre" READONLY name="NombreMetodologia" class="form-control"
                                        placeholder="Escribe el nombre del proyecto"
                                        value="<?php echo $proyecto->nombre_metodologia ?> " style="width: 400px">
                        </div>

                        <div class="form-group">
                                <label>Grupo</label>
                                <input type="text" id="nombre" name="NombreGrupo" READONLY class="form-control"
                                        placeholder="Escribe el nombre del proyecto"
                                        value="<?php echo $proyecto->nombre_grupo ?> " style="width: 400px">
                        </div>

                        <div class="form-group" readonly>
                                <label>Elaborado por </label readonly>
                                <input type="text" id="nombre" name="nombreDocente" READONLY class="form-control"
                                        placeholder="Escribe el nombre del proyecto"
                                        value="<?php echo $proyecto->nombre_docente ?> " style="width: 400px">
                        </div>


                        <!--DropDrownList de estado-->
                        <div class="form-group">
                                <label>Estado</label>
                                <select name="idEstado" REQUIRED id="estado" class="form-control" style="width: 400px">
                                        <option value="<?php echo $proyecto->IdEstado?>">
                                                <?php echo $proyecto->nombre_estado ?></option>
                                        <?php
                                                
                                        foreach($this->estados as $row) {
                                                $estados = $row;
                                        
                                        ?>
                                        <option value="<?php echo $estados[0]?>"><?php echo $estados[1]?>
                                        </option>
                                        <?php

                                        }
                                ?>
                                </select>
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                                <input type="submit" value="Guardar Cambios" role="button" class="btn btn-primary">
                        </div>
                        <br>
                        <br>
                        <div class="form-group ">
                                <a href="<?php echo constant('URL');?>docente/proyecto" class="button"
                                        type="button">Volver</a>
                        </div>
                </form>
        </div>
</body>
<script>
        $("#fecha").datepicker({
                // Formato de la fecha
                dateFormat: "yy-mm-dd",
                // Primer dia de la semana El lunes
                firstDay: 1,
                // Dias Largo en castellano
                dayNames: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"],
                // Dias cortos en castellano
                dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
                // Nombres largos de los meses en castellano
                monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto",
                        "Septiembre",
                        "Octubre", "Noviembre", "Diciembre"
                ],
                // Nombres de los meses en formato corto 
                monthNamesShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct",
                        "Nov",
                        "Dec"
                ],
                // Cuando seleccionamos la fecha esta se pone en el campo Input 
                onSelect: function (dateText) {
                        $('#fecha').val(dateText);
                }
        });
</script>
<?php require_once 'views/docente/footer.php'?>