<?php 

$conexion=mysqli_connect("localhost","pruebas",'',"proyecto");
$id_fase=$_POST['fase'];
//echo $codigo_programa;
	$sql="SELECT Id, Nombre
		FROM modulo 
		WHERE IdFase='$id_fase'
		ORDER BY Nombre DESC ";
	
	
	$result=mysqli_query($conexion,$sql);

	//$cadena="<select id='cbx_modulo' name='cbx_modulo' style='height: 35px; width: 220px;' class='form-control col-3'>";
	//$tabla="<table id='cbx_numero_semestre' name='cbx_nume'> "; //class="table table-hover"
    //print_r($result);
    $cadena = $cadena.'<option value="0">Selecciona una opcion</option>';
	while ($row=mysqli_fetch_row($result)) {
	 $cadena=$cadena.'<option value='.$row[0].'>'.utf8_encode($row[1]).'</option>';
	/* resultados en paralelo*/
	}


//	echo  $cadena."</select><br>";
    echo $cadena;
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