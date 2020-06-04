<?php 

$conexion=mysqli_connect('localhost','pruebas','','proyecto');
$codigo_programa=$_POST['continente'];

	$sql="SELECT DISTINCT NumeroSemestre
		FROM estudiante 
		WHERE CodigoPrograma='$codigo_programa'
		ORDER BY NumeroSemestre DESC ";

	$result=mysqli_query($conexion,$sql);

	$cadena="<select id='cbx_numero_semestre' name='cbx_numero_semestre' class='form-control col-2'>";

	while ($row=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$row[0].'>'.utf8_encode($row[0]).'</option>';
	}

	echo  $cadena."</select>";
	

?>