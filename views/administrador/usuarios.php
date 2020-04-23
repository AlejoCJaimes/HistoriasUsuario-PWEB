<?php require 'views/administrador/header.php'?>

<!-- Custom fonts for this template-->
<!--<link href="<//?php echo constant('URL');?>resources/css/main.css" rel="stylesheet" media="all">
  <script src="//<//?php echo constant('URL');?>resources/js/validar.js"></script>-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">



<!-- ESTILOS PARA LA TABLA NO MODIFICAR-->
<link href="<?php echo constant('URL');?>resources/css/sb-admin-2.min.css" rel="stylesheet">

<style type="text/css">
body {
    color: #566787;
    background: #f5f5f5;

}

.table-wrapper {
    background: #fff;
    padding: 40px 18px;
    margin: 40px -50px;
    border-radius: 8px;
    box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
}

.table-title {
    padding-bottom: 15px;
    background: #299BE4;
    color: #fff;
    padding: 16px 30px;
    margin: -20px -25px 10px;
    border-radius: 3px 3px 0 0;
}

.table-title h2 {
    margin: 3px 0 0;
    font-size: 24px;
}

.table-title .btn {
    color: #566787;
    float: right;
    font-size: 13px;
    background: #fff;
    border: none;
    min-width: 50px;
    border-radius: 2px;
    border: none;
    outline: none !important;
    margin-left: 10px;
}

.table-title .btn:hover,
.table-title .btn:focus {
    color: #566787;
    background: #f2f2f2;
}

.table-title .btn i {
    float: left;
    font-size: 21px;
    margin-right: 5px;
}

.table-title .btn span {
    float: left;
    margin-top: 2px;
}

table.table tr th,
table.table tr td {
    border-color: #e9e9e9;
    padding: 12px 15px;
    vertical-align: middle;
}

table.table tr th:first-child {
    width: 60px;
}

table.table tr th:last-child {
    width: 100px;
}

table.table-striped tbody tr:nth-of-type(odd) {
    background-color: #fcfcfc;
}

table.table-striped.table-hover tbody tr:hover {
    background: #f5f5f5;
}

table.table th i {
    font-size: 13px;
    margin: 0 5px;
    cursor: pointer;
}

table.table td:last-child i {
    opacity: 0.9;
    font-size: 22px;
    margin: 0 5px;
}

table.table td a {
    font-weight: bold;
    color: #566787;
    display: inline-block;
    text-decoration: none;
}

table.table td a:hover {
    color: #2196F3;
}

table.table td a.settings {
    color: #2196F3;
}

table.table td a.delete {
    color: #F44336;
}

table.table td i {
    font-size: 19px;
}

table.table .avatar {
    border-radius: 50%;
    vertical-align: middle;
    margin-right: 10px;
}

.status {
    font-size: 30px;
    margin: 2px 2px 0 0;
    display: inline-block;
    vertical-align: middle;
    line-height: 10px;
}

.text-success {
    color: #10c469;
}

.text-info {
    color: #62c9e8;
}

.text-warning {
    color: #FFC107;
}

.text-danger {
    color: #ff5b5b;
}

.pagination {
    float: right;
    margin: 0 0 5px;
}

.pagination li a {
    border: none;
    font-size: 13px;
    min-width: 30px;
    min-height: 30px;
    color: #999;
    margin: 0 2px;
    line-height: 30px;
    border-radius: 2px !important;
    text-align: center;
    padding: 0 6px;
}

.pagination li a:hover {
    color: #666;
}

.pagination li.active a,
.pagination li.active a.page-link {
    background: #299BE4;
}

.pagination li.active a:hover {
    background: #0397d6;
}

.pagination li.disabled i {
    color: #ccc;
}

.pagination li i {
    font-size: 16px;
    padding-top: 6px
}

.hint-text {
    float: left;
    margin-top: 10px;
    font-size: 13px;
}
</style>
<script type="text/javascript">
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
</head>
<!--<h6>//<//?php echo $this->respuesta;?></h6>-->
<!-- End of Topbar -->

<!--Method applicated for force initial pagination -->


<!--CONTENIDO USUARIOS-->
<div class="container">
    <!--mensaje aqui-->
    <div class="table-wrapper">

        <div class="table-title">
            <div class="row">
                <div class="col-sm-5">
                    <h2>Control de <b>Usuarios</b></h2>
                </div>
                <div class="col-sm-7">
                    <?php require_once  'controllers/usuario.php' ?>
                    <a href="<?php echo constant('URL');?>administrador/register_admin" class="btn btn-primary"><i
                            class="material-icons">&#xE147;</i> <span>Añadir Administrador</span></a>
                    <a href="<?php echo constant('URL');?>usuario/register_docente" class="btn btn-primary"><i
                            class="material-icons">&#xE147;</i> <span>Añadir Docente</span></a>
                    <a href="<?php echo constant('URL');?>usuario/register_student" class="btn btn-primary"><i
                            class="material-icons">&#xE147;</i> <span>Añadir Estudiante</span></a>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Fecha de registro</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>


                <?php

                  include_once 'models/Users.php';
                  //Se cargan los dartos
                  $arregloUsuarios = array();
                  $posicion = 0;
                  $cantidadPaginacion = 5; //Variable que maneja la cantidad de usuarios por página
                  foreach ($this->_usuarios as $row ) {
                    $_usuarios = new Users();
                    $_usuarios = $row;
                    $arregloUsuarios[$posicion] = $row;
                    $posicion++;
                  }
                  if(isset($_GET['page'])){
                    $numeroPagina = $_GET['page']-1;
                  }else{
                      $numeroPagina = "";
                  }
                    //Mostrar resultados por página
                    for ($i=0; $i<$cantidadPaginacion; $i++) { 
                        if($numeroPagina >= 1){
                            $posicionInicial = $i + $cantidadPaginacion*($numeroPagina);
                            if(!empty($arregloUsuarios[$posicionInicial]->correo)){
                               
                               
                               
                               
                                ?>

                <tr>
                    <td><?php echo  $arregloUsuarios[$posicionInicial]->_cedulas?></td>
                    <td><a href="<?php echo constant('URL') . 'administrador/detalleGeneral/' . $arregloUsuarios[$posicionInicial]->correo; ?>"
                            class="avatar" alt="Avatar"><?php echo  $arregloUsuarios[$posicionInicial]->_nombres?> </a>
                    </td>
                    <td><a><?php echo  $arregloUsuarios[$posicionInicial]->correo?> </a></td>
                    <td><?php echo  $arregloUsuarios[$posicionInicial]->fecha_registro?></td>
                    <td><?php echo  $arregloUsuarios[$posicionInicial]->rol?></td>


                    <td><span class="status text-<?php echo $arregloUsuarios[$posicionInicial]->font?>"
                            name="estado">&bull;</span><?php echo  $arregloUsuarios[$posicionInicial]->estado?></td>



                    <td>
                        <a href="<?php echo constant('URL') . 'administrador/detalleGeneral/' . $arregloUsuarios[$posicionInicial]->correo; ?>"
                            class="settings" title="Editar" data-toggle="tooltip"><i
                                class="material-icons">&#xE8B8;</i></a>

                        <a href="<?php echo constant('URL') . 'administrador/eliminarUsuario/' . $arregloUsuarios[$posicionInicial]->correo; ?>"
                            class="delete" title="Eliminar" data-toggle="tooltip">
                            <i class="material-icons"> &#xE5C9;</i></a>

                        <!--Modal eliminar Usuario-->
                        <!-- Modal -->

                    </td>


                </tr>

                <?php
                    }
                ?>
                <?php
                //Primera pagina de las tablas
                        }else{
                            if(!empty($arregloUsuarios[$i]->correo)){?>
                <tr>
                    <td><?php echo  $arregloUsuarios[$i]->_cedulas?></td>
                    <td><a href="<?php echo constant('URL') . 'administrador/detalleGeneral/' . $arregloUsuarios[$i]->correo; ?>"
                            class="avatar" alt="Avatar"><?php echo  $arregloUsuarios[$i]->_nombres?> </a></td>
                    <td><a><?php echo  $arregloUsuarios[$i]->correo?> </a></td>
                    <td><?php echo  $arregloUsuarios[$i]->fecha_registro?></td>
                    <td><?php echo  $arregloUsuarios[$i]->rol?></td>


                    <td><span class="status text-<?php echo $arregloUsuarios[$i]->font?>"
                            name="estado">&bull;</span><?php echo  $arregloUsuarios[$i]->estado?></td>

                    <td>
                        <a href="<?php echo constant('URL') . 'administrador/detalleGeneral/' . $arregloUsuarios[$i]->correo; ?>"
                            class="settings" title="Editar" data-toggle="tooltip"><i
                                class="material-icons">&#xE8B8;</i></a>
                        <a href="<?php echo constant('URL') . 'administrador/eliminarUsuario/' . $arregloUsuarios[$i]->correo; ?>"
                            class="delete" title="Eliminar" data-toggle="tooltip" ><i
                                class="material-icons">&#xE5C9;</i></a>
                    </td>
                </tr>
                <?php
                            }
                            ?>
                <?php
                        }
                        ?>
                <?php
                    }    
                   ?>
            </tbody>



            <!--Funcionalidad de la Paginación-->
        </table>
        <div class="clearfix">
            <div class="hint-text">Mostrando <b>

                    <?php
                require_once 'libs/database.php';
                $this->db = new Database();
                //count elements get from bdd
                $elements = 0;
                //statement return dates
                $query = $this->db->connect()->query("SELECT count(*) AS usuarios from usuario ");
                while($row = $query->fetch()) {
                    $elements = $row['usuarios'];
                 }
                 
                 $object_by_page = 5;           
                 //13/5 = 3      
                 /*The function Ceil can me let round out up. In this
                 case, this calculus is applicated for page, bicos the bdd return
                 4 rows, which means that the divsion is decimal, don´t integer.
                 Did you Understand all? Ask me, if have questions!
                 */
                 $pages = ceil($elements/$object_by_page);
                 
                ?>

                    <?php echo $elements ?></b> de <b>25</b> registros</div>




            <ul class="pagination">
                <!--Return-->
                <li class="page-item 
                    
                    <?php echo $_GET['page'] <= 1 ? 'disabled': ''
                    
                    ?>
                    ">
                    <a href="<?php echo constant('URL')?>administrador/usuarios?page=<?php echo $_GET['page']-1?>"
                        class="page-link">Anterior</a></li>

                <?php for ($i=0; $i<$pages;$i++) { 
                        # Method dinamic for show "item" por each page
                    ?>
                <!--Application the TruTables-->
                <li class="page-item <?php echo $_GET['page'] == ($i+1)  ? 'active' : '' 
                    
                    ?>">
                    <!--Method get for page-->
                    <a href="<?php echo constant('URL')?>administrador/usuarios?page=<?php echo ($i +1)?>"
                        class="page-link"><?php echo ($i +1)?>
                    </a></li>
                <?php  } ?>

                <li class="page-item 
                    
                    <?php echo $_GET['page'] >=$pages? 'disabled': ''
                    
                    ?>
                    ">
                    <a href="<?php echo constant('URL')?>administrador/usuarios?page=<?php echo $_GET['page']+1?>"
                        class="page-link">Siguiente</a></li>
            </ul>
        </div>
    </div>
</div>
</div>
<!-- End of Main Content -->

<!-- Footer -->

<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<?php require 'views/administrador/footer.php'?>