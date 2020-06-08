<?php require 'views/estudiante/header.php'
?>
<!-- INICIO DEL CONTENIDO PRINCIPAL -->
<h3><?php echo $this->confirmacion;?></h3>
<form action="<?php echo constant('URL');?>estudiante/addHistoriaUsuario" Method="POST">
    <div class="container">
        <table class="table">
            <thead class="bg-success">
                <tr>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th class="text-right text-white" scope="col">HISTORIA DE USUARIO</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Número: <input type="number" name="NumHistoriaUsuario" min="1" class="form-control col-4" REQUIRED></td>
                    <td>Prioridad: <input type="text" name="Prioridad" class="form-control" REQUIRED></td>
                    <td>
                        Estado: <select name="IdEstado" class="custom-select" REQUIRED>
                            <option selected disabled value="">Selecciona el estado</option>
                            <?php

                                require_once 'libs/database.php';
                                $this->db = new Database();

                                //statement return dates
                                $query = $this->db->connect()->query("SELECT Id,Nombre FROM estado;");

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
                    <td colspan="3">Descripción:<textarea class="form-control" name="Descripcion" id="exampleFormControlTextarea1" rows="4"
                            REQUIRED></textarea></td>
                </tr>
                <tr>
                    <td>
                        <div class="form-group">
                            <label>Módulo</label> <br>
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
                    </td>
                </tr>
            </tbody>
        </table>
        <input type="submit" class="btn btn-primary" value="Guardar">
    </div>

</form>
<!-- FIN  DEL CONTENIDO PRINCIPAL -->

<?php require_once "views/estudiante/footer.php"?>