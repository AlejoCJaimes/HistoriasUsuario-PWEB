<?php 

$conexion=mysqli_connect("localhost","pruebas",'',"proyecto");
$programa = $_POST['programa'];
$grupo = $_POST['grupo'];
//Seleccionar estudiantes que no pertenezcan a un grupo 
	//Variables Auxiliares

	$students = [];
	$available = [];
	$item_on = [];
	$item_off = [];
	
	
	//Statement Query
	
	$query_students_on = "SELECT e.Id AS 'Id', e.CedulaEstudiante AS 'CedulaEstudiante', e.NombreEstudiante as 'NombreEstudiante', e.ApellidoEstudiante as 'ApellidoEstudiante', e.NumeroSemestre as 'NumeroSemestre', p.Nombre as 'Programa', r._status as 'estado' 
	FROM estudiante AS e
	  JOIN grupoestudiante as gp ON gp.IdEstudiante = e.Id
	JOIN programa as p ON p.codigo = e.CodigoPrograma
	JOIN usuario AS u ON e.IdUsuario = u.Id
	JOIN rolusuario AS r ON r.IdUsuario = u.Id
	WHERE r._status !='Pendiente'
	ORDER BY e.CodigoPrograma DESC";
	
	$query_students_off = "SELECT e.Id AS 'Id', e.CedulaEstudiante AS 'CedulaEstudiante', e.NombreEstudiante as 'NombreEstudiante', e.ApellidoEstudiante as 'ApellidoEstudiante', e.NumeroSemestre as 'NumeroSemestre', p.Nombre as 'Programa', r._status as 'estado' 
	FROM estudiante AS e
	JOIN programa as p ON p.codigo = e.CodigoPrograma
	JOIN usuario AS u ON e.IdUsuario = u.Id
	JOIN rolusuario AS r ON r.IdUsuario = u.Id
	WHERE r._status !='Pendiente'
	ORDER BY e.CodigoPrograma DESC";
	//fetch query
	
	$res_on = mysqli_query($conexion,$query_students_on);
	$res_off = mysqli_query($conexion, $query_students_off);
	
	while ($row_on=mysqli_fetch_row($res_on)) {
		
	array_push($item_on,$row_on[0]); 
	}
	while ($row_off=mysqli_fetch_row($res_off)) {
		
		array_push($item_off,$row_off[0]); 
	}
	
	//use the array_dift obtained different results
	$available = array_diff($item_off,$item_on);
	

	
/*Programa*/
if ($programa != 0) {
	

//create table

$tabla ="<table class='table table-hover'>
	<thead>
		<tr>
		<th scope='col'>Cédula</th>
		<th scope='col'>Nombre</th>
		<th scope='col'>Apellido</th>
		<th scope='col'>Programa</th>
		<th scope='col'>#Semestre</th>
		<th scope='col'>Seleccionar</th>
		</tr>
	</thead>";


foreach ($available as $id_estudiante) {
	
	
	$sql_student="SELECT e.Id AS 'Id', e.CedulaEstudiante AS 'CedulaEstudiante', e.NombreEstudiante as 'NombreEstudiante', e.ApellidoEstudiante as 'ApellidoEstudiante', e.NumeroSemestre as 'NumeroSemestre', p.Nombre as 'Programa', r._status as 'estado' 
	FROM estudiante AS e
    JOIN programa as p ON p.codigo = e.CodigoPrograma
	JOIN usuario AS u ON e.IdUsuario = u.Id
	JOIN rolusuario AS r ON r.IdUsuario = u.Id
	WHERE r._status !='Pendiente' AND e.CodigoPrograma = '$programa' AND e.Id = '$id_estudiante'
	ORDER BY e.CodigoPrograma DESC ";
	$res_avaible = mysqli_query($conexion,$sql_student);
	while ($row_students_avaible=mysqli_fetch_row($res_avaible)) { 

		$tabla = $tabla.'<tbody> <tr> <td>'.$row_students_avaible[1].'</td>'.'<td>'.$row_students_avaible[2].'</td>'.'<td>'.$row_students_avaible[3].'</td>'.'<td>'.$row_students_avaible[5].'</td>'.'<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row_students_avaible[4].'</td>'.
		 '<td>'.'<a href="'.'http://localhost/HistoriasUsuario-PWEB/'.'docente/actualizar_grupo_estudiante/'.$row_students_avaible[0].'/'.$grupo.'"class="button" type="button"> &nbsp; &nbsp; <i class="fas fa-plus" style="color: #17A673"> </i> </a>' .'</td>';
	
	}
}

echo $tabla.' </tr> </tbody> </table>';

 } else {
	$tabla ="<table class='table table-hover'>
	<thead>
		<tr>
		<th scope='col'>Cédula</th>
		<th scope='col'>Nombre</th>
		<th scope='col'>Apellido</th>
		<th scope='col'>Programa</th>
		<th scope='col'>#Semestre</th>
		<th scope='col'>Seleccionar</th>
		</tr>
	</thead>";


	foreach ($available as $id_estudiante) {
	
		$sql_student="SELECT e.Id AS 'Id', e.CedulaEstudiante AS 'CedulaEstudiante', e.NombreEstudiante as 'NombreEstudiante', e.ApellidoEstudiante as 'ApellidoEstudiante', e.NumeroSemestre as 'NumeroSemestre', p.Nombre as 'Programa', r._status as 'estado' 
		FROM estudiante AS e
		JOIN programa as p ON p.codigo = e.CodigoPrograma
		JOIN usuario AS u ON e.IdUsuario = u.Id
		JOIN rolusuario AS r ON r.IdUsuario = u.Id
		WHERE r._status !='Pendiente' AND e.Id = '$id_estudiante'
		ORDER BY e.CodigoPrograma DESC ";
		$res_avaible = mysqli_query($conexion,$sql_student);
		while ($row_students_avaible=mysqli_fetch_row($res_avaible)) { 
            $tabla = $tabla.'<tbody> <tr> <td>'.$row_students_avaible[1].'</td>'.'<td>'.$row_students_avaible[2].'</td>'.'<td>'.$row_students_avaible[3].'</td>'.'<td>'.$row_students_avaible[5].'</td>'.'<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row_students_avaible[4].'</td>'.
            '<td>'.'<a href="'.'http://localhost/HistoriasUsuario-PWEB/'.'docente/actualizar_grupo_estudiante/'.$row_students_avaible[0].'/'.$grupo.'"class="button" type="button"> &nbsp; &nbsp; <i class="fas fa-plus" style="color: #17A673"> </i> </a>' .'</td>';
		
		}
	}
	echo $tabla.'</tr> </tbody> </table>';
 }
	

?>