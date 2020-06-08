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
                    <td>Módulo: <select name="" id="" class="custom-select">
                            <option selected disabled>Selecciona un módulo</option>
                            <option value=""></option>
                        </select>
                    </td>
                </tr>
                </tr>
                    <td style="width: 400px;">Estado: <select name="" id="" class="custom-select">
                            <option selected disabled>Selecciona un estado</option>
                            <option value=""></option>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
        <input type="submit" class="btn btn-primary">
    </div>

</form>
<!-- FIN  DEL CONTENIDO PRINCIPAL -->

<?php require_once "views/estudiante/footer.php"?>