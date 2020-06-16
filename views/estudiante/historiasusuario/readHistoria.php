<?php require 'views/estudiante/header.php'
?>
<!-- INICIO DEL CONTENIDO PRINCIPAL -->
<h3><?php echo $this->confirmacion;?></h3>
<br>
<br>

<div class="container">
    <form action="<?php echo constant('URL');?>estudiante/editarHistoriaUsuario/<?php echo $this->historiausuario[0][0]; ?>" method="POST">
        <table class="table">
            <thead class="bg-primary">
                <tr>
            
                    <th scope="col" ></th>
                    <th scope="col" class=" text-white">HISTORIA DE USUARIO</th>
                    
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Número: <input type="text" name="NumHistoriaUsuario" min="1"
                            value="<?php echo $this->historiausuario[0][1]; ?>" class="form-control col-4">
                    </td>
                    <td>Prioridad: 
                    
                    <!--<input type="text" name="Prioridad" class="form-control" REQUIRED>-->
                    <div class="form-group">
                    <select name="Prioridad" id="prioridad"  class="custom-select" REQUIRED>
                        <option value="<?php echo $this->historiausuario[0][2]; ?>" selected><?php echo $this->historiausuario[0][2]; ?></option>
                        <option value="Alta">Alta</option>
                        <option value="Media">Media</option>
                        <option value="Baja">Baja</option>
                    </select>
                    </div>
                    </td>
                    <td>
                        <div class="form-group">
                            Estado
                            <div class="form-row">
                                <div class="">

                                    <select name="IdEstado" class="custom-select" REQUIRED>
                                        <option selected value="<?php echo $this->historiausuario[0][9]; ?>"><?php echo $this->historiausuario[0][10]; ?></option>
                                        <?php
                                    foreach ($this->estado as $row) {
                                    ?>
                                        <option value="<?php echo $row['Id'];?>"> <?php echo $row['Nombre'];?></option>
                                        <?php
                                        }
                                    ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">Nombre: <input type="text" name="Nombre"
                            value="<?php echo $this->historiausuario[0][3]; ?>" class="form-control col-6">
                    </td>
                </tr>
                <tr>
                    <td colspan="3">Descripción:<textarea class="form-control" name="Descripcion"
                            id="exampleFormControlTextarea1" rows="4"><?php echo $this->historiausuario[0][4]; ?></textarea></td>
                </tr>
                <tr>
                    <td>
                        <div class="form-group">
                            <label>Módulo</label> <br>
                            <div class="form-row">
                                <div class="col-7">

                                    <select name="IdModulo" class="custom-select" REQUIRED>
                                    <option selected value="<?php echo $this->historiausuario[0][11]; ?>"><?php echo $this->historiausuario[0][12]; ?></option>
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

        <div class="container d-inline">
        <!-- Botón para editar -->
            <input type="submit" class="btn btn-primary d-inline" value="Editar">

        <!-- Abrir Modal para eliminar -->
        <a href="#" class="delete btn btn-danger d-inline" title="Eliminar" data-toggle="modal"
                        data-target="#eliminarHistoria">Eliminar</a>
                    <!-- Inicio modal -->
                    <div class="modal fade" id="eliminarHistoria" tabindex="-1" role="dialog"
                        aria-labelledby="eliminarModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="eliminarModal"><strong>Eliminación de Historia de Usuario</strong>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-primary" role="alert">

                                        <h6 class="alert-heading"><strong>Tenga en cuenta...</strong></h6>

                                        <hr>
                                        <p>¿Está seguro que desea eliminar la historia de usuario: <strong><?php echo $this->historiausuario[0][3]; ?></strong></p>

                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Cancelar</button>
                                    <a href="<?php echo constant('URL') . 'estudiante/eliminarHistoriaUsuario/'.$this->historiausuario[0][0];?>"
                                        style="color: white;" class="btn btn-danger" role="button">Aceptar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <!-- Fin modal -->

    </form>
    <br> <br>
    <div class="container">
        <a href="<?php echo constant('URL');?>estudiante/detalleHistoria" class="button" type="button"> <i
                class="fas fa-eye"> </i> Regresar a Historias de Usuario</a>
    </div>
</div>

<!-- FIN  DEL CONTENIDO PRINCIPAL -->

<?php require_once "views/estudiante/footer.php"?>