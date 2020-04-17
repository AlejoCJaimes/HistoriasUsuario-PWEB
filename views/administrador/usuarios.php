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
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
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
	.table-title .btn:hover, .table-title .btn:focus {
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
    table.table tr th, table.table tr td {
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
    .pagination li.active a, .pagination li.active a.page-link {
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
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
});
</script>
</head>
        <!--<h6>//<//?php echo $this->respuesta;?></h6>-->
        <!-- End of Topbar -->

        <!--CONTENIDO USUARIOS-->
        <div  class="container">
          <!--mensaje aqui-->
        <div class="table-wrapper">

            <div class="table-title">
                <div class="row">
                    <div class="col-sm-5">
						<h2>Control de  <b>Usuarios</b></h2>
					</div>
					<div class="col-sm-7">
            <?php require_once  'controllers/usuario.php' ?>
						<a href="<?php echo constant('URL');?>administrador/register_admin" class="btn btn-primary"><i class="material-icons">&#xE147;</i> <span>Añadir Administrador</span></a>
            <a href="<?php echo constant('URL');?>usuario/register_docente" class="btn btn-primary"><i class="material-icons">&#xE147;</i> <span>Añadir Docente</span></a>
            <a href="<?php echo constant('URL');?>usuario/register_student" class="btn btn-primary"><i class="material-icons">&#xE147;</i> <span>Añadir Estudiante</span></a>
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
                  foreach ($this->_usuarios as $row ) {
                    $_usuarios = new Users();
                    $_usuarios = $row;

                   ?>

                        <tr>

                        <td><?php echo  $_usuarios->_cedulas?></td>
                        <td><a href="<?php echo constant('URL') . 'administrador/detalleGeneral/' . $_usuarios->correo; ?>" class="avatar" alt="Avatar"><?php echo  $_usuarios->_nombres?> </a></td>
                        <td><a><?php echo  $_usuarios->correo?> </a></td>
                        <td><?php echo  $_usuarios->fecha_registro?></td>
                        <td><?php echo  $_usuarios->rol?></td>


						<td><span class="status text-<?php echo $_usuarios->font?>" name = "estado" >&bull;</span><?php echo  $_usuarios->estado?></td>



            <td>
							<a href="<?php echo constant('URL') . 'administrador/detalleGeneral/' . $_usuarios->correo; ?>" class="settings" title="Editar" data-toggle="tooltip"><i class="material-icons">&#xE8B8;</i></a>
                    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">¿Estás seguro que deseas abandonar?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            </div>
                            <div class="modal-body">Selecciona "aceptar" si deseas cerrar sesión.</div>
                            <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                            <a class="btn btn-primary" href="<?php echo constant('URL');?>account/logout">Aceptar</a>
                            </div>
                        </div>
                        </div>
                    </div>
                            <a href="<?php echo constant('URL') . 'administrador/eliminarUsuario/' . $_usuarios->correo; ?>" class="delete" title="Eliminar" data-toggle="tooltip"><i class="material-icons">&#xE5C9;</i></a>
						</td>
                    </tr>
                </tbody>


              <?php } ?>
            </table>
			<div class="clearfix">
                <div class="hint-text">Mostrando <b><?php
                require_once 'libs/database.php';
                $this->db = new Database();

                //statement return dates
                $query = $this->db->connect()->query("SELECT count(*) AS usuarios from usuario ");
                while($row = $query->fetch()) {


                ?> <?php echo $row['usuarios']?></b> de <b>25</b> registros</div>
                <?php

                     }
                 ?>

                <ul class="pagination">
                    <li class="page-item disabled"><a href="#">Anterior</a></li>
                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item active"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">4</a></li>
                    <li class="page-item"><a href="#" class="page-link">5</a></li>
                    <li class="page-item"><a href="#" class="page-link">Siguiente</a></li>
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
