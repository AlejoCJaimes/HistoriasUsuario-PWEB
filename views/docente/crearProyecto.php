<?php require 'views/docente/header.php'
?>

<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Js 3.4.1-->
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/flick/jquery-ui.min.css">
    <script src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
</head>

<body>
    <div><?php echo $this->confirmacion;?> </div>
    <div class="container">
        <h2><i class=" fas fa-project-diagram"></i> Nuevo Proyecto </h2>

        <form action="<?php echo constant('URL');?>docente/agregarProyecto" method="POST" id="form">
            <div class="form-group">
                <br>
                <label>Nombre</label>
                <input type="text" id="nombre" name="nombreProyecto" REQUIRED class="form-control "
                    placeholder="Escribe el nombre del proyecto" value="">
            </div>

            <label class="t-2">Fecha fin de grupo</label>
            <div class="form-group">

                <div class="input-group" style=" width: 200px;">
                    <input type="text" REQUIRED class="form-control" style=" width: 50px;" id="fecha" name="fechaFin"
                        min="2020-05-10" max="2020-06-30">
                    <div class="input-group-append">
                        <span class="material-icons input-group-text">calendar_today</span>
                    </div>
                </div>

                <!--DropDrownList de metodología-->
                <div class="form-group">
                    <label>Metodologia</label>
                    <select name="idMetodologia" REQUIRED id="metodologia" class="form-control">
                        <option disabled="disabled" selected="selected" value="">Seleccionar una opcion</option>
                        <?php
                                        require_once 'libs/database.php';
                                        $this->db = new Database();
                                        //statement return dates
                                        $query = $this->db->connect()->query("SELECT id, nombre FROM metodologia;");
                                        while($row = $query->fetch()) {
                                ?>
                        <option value="<?php echo $row['id']?>"><?php echo $row['nombre']?></option>
                        <?php

                                        }
                                ?>
                    </select>
                </div>

                <!-- Lista de grupos quemados, para seleccionar a más de uno!-->
                <div class="form-group">
                    <label>Selecciona a los grupos</label>
                    <select name="idGrupo" id="grupo" REQUIRED class="form-control">
                        <option disabled="disabled" selected="selected" value="">Seleccionar una opcion</option>
                        <?php
                                        require_once 'models/Grupo.php';
                                       foreach ($this->grupos as $row ) { 
                                        $grupos = new Grupo();
                                        $grupos = $row;
                                       
                                ?>
                        <option value="<?php echo $grupos->id?>"><?php echo $grupos->nombre?></option>
                        <?php

                                        }
                                ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Selecciona el estado</label>
                    <div class="input-group" style=" width: 300px;">
                        <select name="idEstado" REQUIRED id="estado" class="form-control">
                            <option disabled="disabled" value="" selected="selected">Seleccionar una opcion</option>
                            <?php
                                       
                                       foreach ($this->estados as $row ) { 
                                        $estados = $row;
                                       
                                ?>
                        <option value="<?php echo $estados[0]?>"><?php echo $estados[1]?></option>
                        <?php

                                        }
                                ?>
                        </select>
                    </div>
                </div>

                <div class="form-group text-center">
                    <input type="submit" id="envio" value="Crear" class="btn btn-primary ">
                </div>

                <br>
                <br>
                <div class="form-group ">
                                <a href="<?php echo constant('URL');?>docente/proyecto" class="button"
                                        type="button">Volver</a>
                        </div>
                </div>
        </form>
    </div>
    </body>

    <!--Script que formatea el calendario en español-->
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
        monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre",
            "Octubre", "Noviembre", "Diciembre"
        ],
        // Nombres de los meses en formato corto 
        monthNamesShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov",
            "Dec"
        ],
        // Cuando seleccionamos la fecha esta se pone en el campo Input 
        onSelect: function(dateText) {
            $('#fecha').val(dateText);
        }
    });
    </script>

    <?php require_once 'views/docente/footer.php'?>
