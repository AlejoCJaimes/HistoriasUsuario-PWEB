<?php 

$conexion=mysqli_connect("localhost","pruebas",'',"proyecto");
$codigo_programa=$_POST['programa'];
//echo $codigo_programa;
	$sql="SELECT DISTINCT NumeroSemestre
		FROM estudiante 
		WHERE CodigoPrograma='$codigo_programa'
		ORDER BY NumeroSemestre DESC ";
	
	$result=mysqli_query($conexion,$sql);

	$cadena="<select id='cbx_numero_semestre' name='cbx_numero_semestre' class='form-control col-2'>";
	//print_r($result);
	while ($row=mysqli_fetch_row($result)) {
	 $cadena=$cadena.'<option value='.$row[0].'>'.utf8_encode($row[0]).'</option>';
		//echo "a";
	}

	echo  $cadena."</select>";
	

?>