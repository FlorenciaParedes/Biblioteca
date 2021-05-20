<?php
	session_start();
	include "conexion.php";
	$link=conexion();
	$fecha=date('Y-m-d');
	$lector=$_SESSION['id'];
	$libro=$_GET['id'];
	$query="INSERT INTO operaciones (id, ultimo_estado, fecha_ultima_modificacion, lector_id, libros_id) VALUES ('NULL', '1', '$fecha', '$lector', '$libro')";
	mysqli_query($link,$query);
	echo '<script> window.location="index.php"</script>';
	?>