<?php require 'views/docente/header.php'
?>
<!-- Custom fonts for this template-->
<!--<link href="<//?php echo constant('URL');?>resources/css/main.css" rel="stylesheet" media="all">
<script src="//<//?php echo constant('URL');?>resources/js/validar.js"></script>-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">



<!-- ESTILOS PARA LA TABLA NO MODIFICAR-->
<link href="<?php echo constant('URL');?>resources/css/sb-admin-2.min.css" rel="stylesheet">
<link href="<?php echo constant('URL');?>resources/build/toastr.css" rel="stylesheet" type="text/css" />
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
      background: #36b9cc;
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

<!--Method applicated for force initial pagination -->
<body>
<div><?php echo $this->confirmacion;?> </div>
   <!--CONTENIDO GRUPOS-->
   <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-5">
                    <h2><b>Grupos</b></h2>
					</div>
            		<div class="col-sm-7">

                    <!--Esto lleva a crear un nuevo grupo-->
			        <a href="<?php echo constant('URL');?>docente/crearGrupo" class="btn btn-primary"><i class="material-icons">&#xE147;</i> <span>Añadir</span></a>
                    <?php 
                    $i = 0;
                    $getStateDis = "";
                    foreach($this->grupos as $row){
                    $i++;
                 }
                 
                 if ($i > 0 ) {
                        $getStateDis = "";
                 } else {
                        $getStateDis = "disabled";
                 }
                 ?>
                 <a href="" class="btn btn-primary <?php echo $getStateDis ?>" data-toggle="modal" data-target="#staticBackdrop"><i
                    class="material-icons">&#xe872;</i> <span>Eliminar</span></a>
					</div>
                </div>
            </div>

            <!--Recuadro para visualizar los grupos-->
            <div class="container">
            <div class="row">
            <?php 
            $arreglo = [];
            require_once 'models/Grupo.php';
            foreach($this->grupos as $row){
                $grupos = new Grupo();
                $grupos = $row;
                array_push($arreglo,$grupos);
                ?>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body " name='' href="#"><?php echo $grupos->nombre?></div>
                        <!--Esto lleva a editar y ver la metodología-->
                        <div class="card-footer d-flex align-items-center justify-content-between">
                    
                         <a class="small text-black stretched-link" href="<?php echo constant('URL'). 'docente/detalleGeneralGrupo/' . $grupos->id ;?>">Editar</a>
                            <div class="small text-black"><i class="fas fa-angle-right"></i></div>
                            
                        </div>
                        
                    </div>
                </div> 
                <?php } ?>   
            </div>  
        </div>   
           
    <!-- End of Content Wrapper -->
    </div>
  </div>
  
  <!-- End of Page Wrapper -->
</body>
<?php require_once 'views/docente/footer.php'?>
<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Eliminar Grupo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <!-- <p style ="color: red">Tenga en cuenta quer si elimina la metodologia
        se eliminará todo su contenido como fuentes y no podrá recuperarse. </p>-->
        <div class="alert alert-warning" role="alert">
        
            <h6 class="alert-heading"><strong>Tenga en cuenta...</strong></h6>
           
            <hr>
            <p>No podrá eliminar grupos que ya tengan un proyecto asignado </p>
          
            </div>
      </div>
      <div class="modal-body">
      <table id="tablaDinamica">
        <thead>
                <tr>
                <th scope="col" class="text-center">Grupos </th>
                </tr>
        </thead>    
      <?php 
           $arreglo = [];
           require_once 'models/Grupo.php';
           foreach($this->grupos as $row){
               $grupos = new Grupo();
               $grupos = $row;
               array_push($arreglo,$grupos);
        ?>
            <tbody>
            <tr>
               <td><input type="text" readonly style="width: 330px;" required id="fuente" placeholder="Ingrese cita" class="form-control" value="<?php echo $grupos->nombre?>"></td>
                <td><a id ="btn" href=" <?php echo constant('URL').'docente/eliminarGrupo/'. $grupos->id?>" type="button" class="btn btn-danger"><i class=" fas fa-trash"></i> </a></td>
                <td><ion-icon name="trash-outline"></ion-icon></td> 
            </tr>
                </tdbody>
        <?php }?>
        
      <table>  
      </div>
            
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
 


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="<?php echo constant('URL');?>resources/js/toastr.js"></script>
 <!-- Scroll to Top Button-->
 <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>



