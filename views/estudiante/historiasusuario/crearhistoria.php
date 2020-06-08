<?php require 'views/estudiante/header.php'
?>
<!-- INICIO DEL CONTENIDO PRINCIPAL -->
<form action="<?php echo constant('URL');?>estudiante" Method="POST">
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
                    <td>Número: <input type="number" class="form-control col-4"></td>
                    <td>Prioridad: <input type="text" class="form-control"></td>
                    <td>Fecha Creación: <input type="text" value="<?php echo (date("d")-01) . " de " . date("F");?>"
                            class="form-control" readonly>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">Nombre: <input type="text" class="form-control col-6"></td>
                </tr>
                <tr>
                    <td colspan="3">Descripción:<textarea class="form-control" id="exampleFormControlTextarea1"
                            rows="4"></textarea></td>
                </tr>
                <tr>
                    <td>
                        <div class="form-group">
                            <label>Módulo</label> <br>
                            <select name="" id="" class="custom-select">
                                <option selected disabled>Selecciona el módulo</option>
                                <?php

                                require_once 'libs/database.php';
                                $this->db = new Database();

                                //statement return dates
                                $query = $this->db->connect()->query("SELECT Id,Nombre FROM modulo;");

                                while($row = $query->fetch()) {
                                ?>
                                <option value="<?php echo $row['Id']?>"> <?php echo $row['Nombre']?></option>
                                <?php

                                    }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                </tr>
                <td style="width: 400px;">
                    <div class="form-group">
                        <label>Estado</label> <br>
                        <select name="" id="" class="custom-select">
                            <option selected disabled>Selecciona el estado</option>
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