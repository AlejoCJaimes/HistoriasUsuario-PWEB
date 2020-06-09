<?php 

$conexion=mysqli_connect("localhost","pruebas",'',"proyecto");
$id_modulo=$_POST['historia'];
//echo $codigo_programa;
	$sql="SELECT h.id, h.NumHistoriaUsuario, h.prioridad, h.nombre, DATE_FORMAT(h.FechaCreacion,' %d-%M-%Y %h:%i %p'), m.Nombre, e.Nombre
    FROM historiausuario as h 
    JOIN modulo as m ON m.Id = h.IdModulo
    JOIN estado as e ON e.Id = h.IdEstado
    WHERE h.IdModulo = '$id_modulo'
	ORDER BY h.NumHistoriaUsuario";
	
	
	$result=mysqli_query($conexion,$sql);

	//$cadena="<select id='cbx_historia' name='cbx_historia' style='height: 35px; width: 220px;' class='form-control col-3'>";
	//$tabla="<table id='cbx_numero_semestre' name='cbx_nume'> "; //class="table table-hover"
    //print_r($result);
    $tabla ="<table class='table table-hover'>
	<thead>
		<tr>
		<th scope='col'>#Historia</th>
		<th scope='col'>Prioridad</th>
		<th scope='col'>Nombre</th>
		<th scope='col'>Fecha Creacion</th>
		<th scope='col'>Modulo</th>
        <th scope='col'>Estado</th>
        <th scope='col'>Consultar</th>
		</tr>
    </thead>";
    $aux_modal_1 = "";
    $aux_modal_2 = "";

   
    
    
    
    while ($row_studiantes=mysqli_fetch_row($result)) {
    $var_pos_inicial_1 = '#_'.$row_studiantes[2];
    $var_pos_inicial_2 = '_'.$row_studiantes[2];
	 //$cadena=$cadena.'<option value='.$row[0].'>'.utf8_encode($row[3]).'</option>';
    /* resultados en paralelo*/
    $tabla = $tabla.'<tbody> <tr> <td>'.$row_studiantes[1].'</td>'.'<td>'.$row_studiantes[2].'</td>'.'<td>'.$row_studiantes[3].'</td>'.'<td>'.$row_studiantes[4].'</td>'.'<td>'.$row_studiantes[5].'</td>'.'
    <td>'.$row_studiantes[6].'</td>'.'<td>'.'<a href="'.'http://localhost/HistoriasUsuario-PWEB/'.'estudiante/readHistoria/'.$row_studiantes[0].'"class="button" type="button"> &nbsp; &nbsp; <i class="fas fa-eye" style="color: #17A673"> </i> </a>' .'</td>';
    
    /*echo $modal= "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModal'>
    Launch demo modal
  </button>";*/
  
  /*cho $modal_example ='<div class="modal fade" id="'.$var_pos_inicial_2.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        
        <div class="container">
        <table class="table">
            <thead class="bg-primary">
                <tr>
                    <th scope="col"></th>
                    <th scope="col" class=" text-white text-center">HISTORIA DE USUARIO N°'.$row_studiantes[1].'</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    
                </tr>
            </thead>
            <tbody>
               <tr>
                <td>Prioridad
                
                </td>
                <td>
                Nombre
                
                </td>
                <td>
                Fecha de Creacion
                
                </td>
                <td>
                
                Última Actualización
                
                </td>
                <td>
                Estado
                
                </td>
                <td>
                
                Modulo
                
                </td>
                <td>
                
                Descripcion
                </td>
                
               </tr>
                
            </tbody>
        </table>
        </div>'
        .
        
        '</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>';*/

}


	//echo  $cadena."</select><br>";
    echo $tabla.' </tr> </tbody> </table>';
	//Usuarios en grupos
	//$tabla //="<table> <thead> <th>HOLA<th> </thead>";

  
	
	

	/*
	SELECT e.Id AS 'Id', e.CedulaEstudiante AS 'CedulaEstudiante', e.NombreEstudiante as 'NombreEstudiante', e.ApellidoEstudiante as 'ApellidoEstudiante', e.NumeroSemestre as 'NumeroSemestre', e.CodigoPrograma as 'CodigoPrograma', r._status as 'estado' 
        FROM estudiante AS e
        JOIN usuario AS u ON e.IdUsuario = u.Id
        JOIN rolusuario AS r ON r.IdUsuario = u.Id
		WHERE r._status !='Pendiente'
		
		
	*/
	

?>