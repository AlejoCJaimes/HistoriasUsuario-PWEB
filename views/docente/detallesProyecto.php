<?php require 'views/docente/header.php'
?>
<div class="container">
<h2><i class=" fas fa-info-circle"></i> Detalles del proyecto </h2>

 <?php  
 
    require_once 'models/Proyecto.php';

    foreach ($this->proyecto as $row) {
        $proyecto = new Proyecto();
        $proyecto = $row;
    }
 
 ?>
    <form action="" method="POST" id="form">

        <div class="form-group">
            
                <label>Nombre</label>
                <input type="text" id="nombre" name="NombreProyecto" class="form-control " placeholder="Escribe el nombre del proyecto" value="<?php echo $proyecto->NombreProyecto ?> " >
           
        </div>
        <div class="form-group">
               <label>Fecha límite</label>
               <input type="text" id="FechaFin" name="FechaFin" class="form-control"value="<?php echo $proyecto->FechaFin?> " >
        </div>
        
        <!--DropDrownList de metodología READONLY-->
        <div class="form-group" readonly> 
        <label>Metodologia</label readonly>
        <select name = "idMetodologia" REQUIRED id="metodologia" class="form-control">
                                <?php
                                        require_once 'libs/database.php';
                                        $this->db = new Database();
                                        //statement return dates
                                        $query = $this->db->connect()->query("SELECT id, nombre FROM metodologia  WHERE id = '$proyecto->IdMetodologia';");
                                        while($row = $query->fetch()) {
                                ?>
                                <option value= "<?php echo $row['id']?>"><?php echo $row['nombre']?></option>
                                <?php

                                        }
                                ?>
                        </select>
        </div>

        <div class="form-group"> 
                        <label>Selecciona a los grupos</label>
                        <select name = "idGrupo" id="grupo" REQUIRED class="form-control">
                                <?php
                                        require_once 'libs/database.php';
                                        $this->db = new Database();
                                        //statement return dates
                                        $query = $this->db->connect()->query("SELECT g.id, g.nombre FROM grupo as g JOIN grupoproyecto as gp ON g.Id = gp.IdGrupo WHERE gp.IdProyecto = '$proyecto->Id';");
                                        while($row = $query->fetch()) {
                                ?>
                                <option value="<?php echo $row['id']?>"><?php echo $row['nombre']?></option>
                                <?php

                                        }
                                ?>
                        </select>
                </div>


        <!--DropDrownList de estado-->     
        <div class="form-group"> 
        <label>Estado</label>
        <select name = "idEstado" REQUIRED id="estado" class="form-control">
                                <?php
                                        require_once 'libs/database.php';
                                        $this->db = new Database();
                                        //statement return dates
                                        $query = $this->db->connect()->query("SELECT id, nombre FROM estado WHERE id = '$proyecto->IdEstado';");
                                        while($row = $query->fetch()) {
                                ?>
                                <option value= "<?php echo $row['id']?>"><?php echo $row['nombre']?></option>
                                <?php

                                        }
                                ?>
                        </select>
        </div>
        <div class="form-group ">
                <a  href="<?php echo constant('URL');?>docente/proyecto" class="button" type="button">Volver</a>
        </div>
    </form>
</div>

<?php require_once 'views/docente/footer.php'?>