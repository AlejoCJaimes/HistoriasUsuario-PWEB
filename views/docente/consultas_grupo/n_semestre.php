<?php 

$conexion=mysqli_connect("localhost","pruebas",'',"proyecto");
$codigo_programa=$_POST['programa'];
echo $codigo_programa;
//echo $codigo_programa;
	$sql="SELECT DISTINCT NumeroSemestre
		FROM estudiante 
		WHERE CodigoPrograma='$codigo_programa'
		ORDER BY NumeroSemestre DESC ";
	
	$result=mysqli_query($conexion,$sql);

	
	//$tabla="<table id='cbx_numero_semestre' name='cbx_nume'> "; //class="table table-hover"
	//print_r($result);
	$cadena = '<option value="0">Seleccionar una opcion</option>';
	while ($row=mysqli_fetch_row($result)) {
	 $cadena=$cadena.'<option value='.$row[0].'>'.utf8_encode($row[0]).'</option>';
	/* resultados en paralelo*/
	}


	echo  $cadena;

	
	

?>