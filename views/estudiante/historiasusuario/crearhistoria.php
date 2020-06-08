<?php require 'views/estudiante/header.php'
?>

<!-- INICIO DEL CONTENIDO PRINCIPAL -->
<form action="<?php echo constant('URL');?>estudiante/CrearHistoria" Method="POST">
    <table>
        <thead>
            <tr>
                <td>HISTORIA DE USUARIO</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Número: <input type="number"></td>
                <td>Prioridad: <input type="text"></td>
                <td>Fecha Creación: <input type="text" value="<?php echo (date("d")-01) . date("F");?>" readonly></td>
            </tr>
            <tr>
                <td>Nombre: <input type="text"></td>
            </tr>
            <tr>
                <td>Descripción: <input type="text"></td>
            </tr>
            <tr>
                <td>Modulo: <select name="" id="">
                    <option value=""></option>
                </select></td>
                <td>Estado: <select name="" id="">
                    <option value=""></option>
                </select></td>
            </tr>
        </tbody>
    </table>
</form>
<!-- FIN  DEL CONTENIDO PRINCIPAL -->

<?php require_once "views/estudiante/footer.php"?>