<?php require 'views/estudiante/header.php'
?>
<!-- INICIO DEL CONTENIDO PRINCIPAL -->
<h3><?php echo $this->confirmacion;?></h3>
<br>
<br>
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
                <td>Número: <input type="text" name="NumHistoriaUsuario" min="1" class="form-control col-4" READONLY>
                </td>
                <td>Prioridad: <input type="text" name="Prioridad" class="form-control" READONLY></td>
                <td>
                    Estado:<input type="text" name="IdModulo" min="1" class="form-control" READONLY>
                </td>
            </tr>
            <tr>
                <td colspan="3">Nombre: <input type="text" name="Nombre" class="form-control col-6" READONLY></td>
            </tr>
            <tr>
                <td colspan="3">Descripción:<textarea class="form-control" name="Descripcion"
                        id="exampleFormControlTextarea1" rows="4" READONLY></textarea></td>
            </tr>
            <tr>
                <td>
                    <div class="form-group">
                        <label>Módulo</label> <br>
                        <div class="form-row">
                            <div class="col-7">

                                <input type="text" name="IdModulo" min="1" class="form-control" READONLY>
                                
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <div class="container">
        <a href="<?php echo constant('URL');?>estudiante/detalleHistoria" class="button" type="button"> <i
                class="fas fa-eye"> </i> Regresar a Historias de Usuario</a>
    </div>
</div>

<!-- FIN  DEL CONTENIDO PRINCIPAL -->

<?php require_once "views/estudiante/footer.php"?>