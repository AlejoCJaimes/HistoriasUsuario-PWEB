<?php 

$conexion=mysqli_connect("localhost","pruebas",'',"proyecto");
$codigo_programa=$_POST['programa'];
//echo $codigo_programa;
	$sql="SELECT DISTINCT NumeroSemestre
		FROM estudiante 
		WHERE CodigoPrograma='$codigo_programa'
		ORDER BY NumeroSemestre DESC ";
	
	
	$result=mysqli_query($conexion,$sql);

	$cadena="<select id='cbx_numero_semestre' name='cbx_numero_semestre' style='height: 35px;' class='form-control col-2'>";
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
	
	//$tabla="<table id='cbx_numero_semestre' name='cbx_nume'> "; //class="table table-hover"
	//print_r($result);
	while ($row=mysqli_fetch_row($result)) {
	 $cadena=$cadena.'<option value='.$row[0].'>'.utf8_encode($row[0]).'</option>';
	/* resultados en paralelo*/
	}


	echo  $cadena."</select><br>";

	//Usuarios en grupos

	//echo $tabla."</tabla>";

		$query_estudiantes = "SELECT e.Id AS 'Id', e.CedulaEstudiante AS 'CedulaEstudiante', e.NombreEstudiante as 'NombreEstudiante', e.ApellidoEstudiante as 'ApellidoEstudiante', e.NumeroSemestre as 'NumeroSemestre', e.CodigoPrograma as 'CodigoPrograma', r._status as 'estado' 
		FROM estudiante AS e
		JOIN usuario AS u ON e.IdUsuario = u.Id
		JOIN rolusuario AS r ON r.IdUsuario = u.Id
		WHERE r._status !='Pendiente' AND e.CodigoPrograma ='$codigo_programa'
		ORDER BY e.CodigoPrograma DESC ";
	
	/*
	SELECT DISTINCT e.Id AS 'Id', e.CedulaEstudiante AS 'CedulaEstudiante', e.NombreEstudiante as 'NombreEstudiante', e.ApellidoEstudiante as 'ApellidoEstudiante', e.NumeroSemestre as 'NumeroSemestre', e.CodigoPrograma as 'CodigoPrograma', r._status as 'estado' 
	FROM estudiante AS e
	JOIN usuario AS u ON e.IdUsuario = u.Id
	JOIN rolusuario AS r ON r.IdUsuario = u.Id
	WHERE r._status !='Pendiente' AND e.Id != (SELECT IdEstudiante FROM grupoestudiante WHERE IdEstudiante = '63')
	
	*/
	$res = mysqli_query($conexion,$query_estudiantes);
	

		
		while ($row_studiantes=mysqli_fetch_row($res)) { 
			
			$query_2 = "SELECT Nombre FROM programa where codigo = '$codigo_programa'"; 
			$res_3 = mysqli_query($conexion,$query_2);
            while ($row_p=mysqli_fetch_row($res_3)) {
        

		$tabla = $tabla.'<tbody> <tr> <td>'.$row_studiantes[1].'</td>'.'<td>'.$row_studiantes[2].'</td>'.'<td>'.$row_studiantes[3].'</td>'.'<td>'.$row_p[0].'</td>'.'<td>'.$row_studiantes[4].'</td>'.'      
		<td>'. '<div class="custom-control custom-checkbox mr-sm-2">'.'<td>'. '<input type="checkbox" name="estudiantes_seleccionados[]" value='.$row_studiantes[1].'>'.'</td>'.'</div>'.'</td>';
		
	 }
	}
	echo $tabla.' </tr> </tbody> </table>';

	//$tabla //="<table> <thead> <th>HOLA<th> </thead>";

	
	

	/*
	SELECT e.Id AS 'Id', e.CedulaEstudiante AS 'CedulaEstudiante', e.NombreEstudiante as 'NombreEstudiante', e.ApellidoEstudiante as 'ApellidoEstudiante', e.NumeroSemestre as 'NumeroSemestre', e.CodigoPrograma as 'CodigoPrograma', r._status as 'estado' 
        FROM estudiante AS e
        JOIN usuario AS u ON e.IdUsuario = u.Id
        JOIN rolusuario AS r ON r.IdUsuario = u.Id
		WHERE r._status !='Pendiente'
		
		
	*/
	

?>