<?php
//graba los datos en la BD
$conn = new mysqli('localhost', 'root', '', 'bd_prueba');
$nombre=$_POST['nombre'];
$alias=$_POST['alias'];
$rut=$_POST['rut'];
$email=$_POST['email'];
$id_region=$_POST['id_region'];
$id_comuna=$_POST['id_comuna'];
$id_candidato=$_POST['id_candidato'];
$entero=$_POST['entero'];

//valida si el rut ya votó
$result = $conn->query("SELECT COUNT(*) FROM votacion where rut='".$rut."'");
$row = $result->fetch_row();

if ($row[0]>0) {
	echo "Usted ya votó.";
} else {
	//si no ha votado, se graba la votación
	$sql="INSERT INTO `votacion` (`id`,`nombre`, `alias`,`rut`, `email`,`id_region`,`id_comuna`,`id_candidato`,`entero`) VALUES (NULL, '$nombre', '$alias', '$rut', '$email', '$id_region', '$id_comuna', '$id_candidato', '$entero')";

	if ($conn->query($sql) === TRUE) {
		echo "Votación registrada.";
	}
	else 
	{
		echo "Error al registrar su votación.";
	}
}
	
?>