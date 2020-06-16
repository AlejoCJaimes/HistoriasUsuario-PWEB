<?php require 'views/estudiante/header.php'
?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<h3 align="center"><?php echo $this->confirmacion;?></h3>
<br>
<!-- INICIO DEL CONTENIDO PRINCIPAL -->

<br>
<br>
<div class="container">
<h3><i class="fas fa-coins"></i>&nbsp; Total Recursos</h3>
    <hr>
    <br>
    <br>
    <table class="table">
        <thead class="thead bg bg-success text-white">
            <tr>
                <th scope="col">Tipo</th>
                <th scope="col">Valor</th>
                <th scope="col">Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($this->recurso as $row) {

                $op = $row["Id"];
            ?>
            <tr>
                <td><?php echo $row['Tipo']?></td>
                <td><?php echo $row['valor']?></td>
                <!-- Abrir vista para editar con Modal -->
                <td>
                    <a href="<?php echo constant('URL') . 'estudiante/editarRecursoView/'.$row['Id']?>" class="settings"
                    style="color: #EBAB10;"  title="Editar" data-toggle="tooltip"> <i class="fas fa-edit"></i></a>
                    <!-- Abrir Modal para eliminar -->
                    <a href="#" style="color: #B20710;" class="delete" title="Eliminar" data-toggle="modal"
                    style="color: #B20710;" data-target="#_<?php echo $op?>"><i class="fas fa-trash"></i></a>
                    <!-- Inicio modal -->
                    <div class="modal fade" id="_<?php echo $op?>" tabindex="-1" role="dialog"
                        aria-labelledby="eliminarModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="eliminarModal"><strong>Eliminación de recurso</strong>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-primary" role="alert">

                                        <h6 class="alert-heading"><strong>Tenga en cuenta...</strong></h6>

                                        <hr>
                                        <p>¿Está seguro que desea eliminar el recurso <strong><?php echo $row['Tipo']?></strong></p>

                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Cancelar</button>
                                    <a href="<?php echo constant('URL') . 'estudiante/eliminarRecurso/'.$row['Id']?>"
                                        style="color: white;" class="btn btn-danger" role="button">Aceptar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fin modal -->
                </td>
            </tr>
            <?php

                }
            ?>
        </tbody>
        <tr class="table text-white" style="background: #18AC77">
            <th scope="col">Total: </th>
            <th scope="col"><?php echo $this->totalRecursos?></th>
        </tr>
    </table>
</div>
<div class="container">
&nbsp; &nbsp; &nbsp; &nbsp;<a href="<?php echo constant('URL');?>estudiante/crearRecurso" class="button" type="button"> <i
                    class="fas fa-arrow-circle-left"> </i> Volver</a>
        </div>

<!-- FIN  DEL CONTENIDO PRINCIPAL -->

<?php require_once "views/estudiante/footer.php"?>