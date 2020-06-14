<?php require 'views/estudiante/header.php'
?>
<!-- INICIO DEL CONTENIDO PRINCIPAL -->

<br>
<br>
<div class="container">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Tipo</th>
                <th scope="col">Valor</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($this->recurso as $row) {
            ?>
            <tr>
                <td><?php echo $row['Tipo']?></td>
                <td><?php echo $row['valor']?></td>
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