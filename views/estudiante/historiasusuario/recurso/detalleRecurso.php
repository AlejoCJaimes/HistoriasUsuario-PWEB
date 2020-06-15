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
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Tipo</th>
                <th scope="col">Valor</th>
                <th scope="col">Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($this->recurso as $row) {
            ?>
            <tr>
                <td><?php echo $row['Tipo']?></td>
                <td><?php echo $row['valor']?></td>
                <td><a href="<?php echo constant('URL') . 'estudiante/editarRecursoView/'.$row['Id']?>"
                            class="settings" title="Editar" data-toggle="tooltip"><i
                                class="material-icons">&#xE8B8;</i></a>

                                <a href="#" style="color: #B20710;" class="delete" title="Eliminar" data-toggle="modal" data-target="<?php echo $var_pos_inicial_1?>"><i
                    class="material-icons">&#xE5C9;</i></a></td>
            </tr>
            <?php

                }
            ?>
        </tbody>
        <tr class="table-active">
            <th scope="col">Total: </th>
            <th scope="col"><?php echo $this->totalRecursos?></th>
        </tr>
    </table>
</div>

<!-- FIN  DEL CONTENIDO PRINCIPAL -->

<?php require_once "views/estudiante/footer.php"?>