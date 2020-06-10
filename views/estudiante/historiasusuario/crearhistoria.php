<?php require 'views/estudiante/header.php'
?>
<!-- INICIO DEL CONTENIDO PRINCIPAL -->
<h3><?php echo $this->confirmacion;?></h3>
<br>
<br>
<form action="<?php echo constant('URL');?>estudiante/addHistoriaUsuario" Method="POST">
    <div class="container">
        <table class="table">
            <thead class="bg-primary">
                <tr>
                    <th scope="col"></th>
                    <th scope="col" class=" text-white">HISTORIA DE USUARIO</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Número: <input type="number" name="NumHistoriaUsuario" min="1" class="form-control col-4"
                            REQUIRED></td>
                    <td>Prioridad: 
                    
                    <!--<input type="text" name="Prioridad" class="form-control" REQUIRED>-->
                    <div class="form-group">
                    <select name="Prioridad" id="prioridad"  class="custom-select" REQUIRED>
                        <option value="" selected disabled  >Selecciona una prioridad </option>
                        <option value="Alta">Alta</option>
                        <option value="Media">Media</option>
                        <option value="Baja">Baja</option>
                    </select>
                    </div>
                    </td>
                    <td>
                        Estado: <select name="IdEstado" class="custom-select" REQUIRED>
                            <option selected disabled value="">Selecciona el estado</option>
                            <?php

                                require_once 'libs/database.php';
                                $this->db = new Database();

                                //statement return dates
                                $query = $this->db->connect()->query("SELECT Id,Nombre FROM estado WHERE Id IN ('4','5');");

                                while($row = $query->fetch()) {
                                ?>
                            <option value="<?php echo $row['Id']?>"> <?php echo $row['Nombre']?></option>
                            <?php

                                    }
                                ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">Nombre: <input type="text" name="Nombre" class="form-control col-6" REQUIRED></td>
                </tr>
                <tr>
                    <td colspan="3">Descripción:<textarea class="form-control" name="Descripcion"
                            id="exampleFormControlTextarea1" rows="4" REQUIRED></textarea></td>
                </tr>
                <tr>
                    <td>
                        <div class="form-group">
                            <label>Módulo</label> <br>
                            <div class="form-row">
                                <div class="col-7">

                                    <select name="IdModulo" class="custom-select" REQUIRED>
                                        <option selected disabled value="">Selecciona el módulo</option>
                                        <?php
                                    foreach ($this->modulo as $row) {
                                    ?>
                                        <option value="<?php echo $row['Id'];?>"> <?php echo $row['Nombre'];?></option>
                                        <?php
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <a href="<?php echo constant('URL');?>estudiante/crearModulo" style="color: white;"
                                        class="btn btn-success" role="button button-sm"> <i
                                            class="fas fa-plus"></i>Agregar
                                        modulo</a>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>


        <br>
        <div class="container">
            <input type="submit" class="btn btn-primary" value="Guardar">
        </div>
        <br>
        <div class="container">
            <a href="<?php echo constant('URL');?>estudiante/detalleHistoria" class="button" type="button"> <i
                    class="fas fa-eye"> </i> Consultar Historias de Usuario</a>
        </div>
    </div>


</form>
<!-- FIN  DEL CONTENIDO PRINCIPAL -->

<?php require_once "views/estudiante/footer.php"?>