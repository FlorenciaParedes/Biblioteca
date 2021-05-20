<?php
	session_start();
	include "conexion.php";
	$link=conexion();
	$idOp=$_GET['id'];
	$query= " UPDATE operaciones set ultimo_estado = '3' WHERE operaciones.id= '$idOp'";
	mysqli_query($link,$query);
	echo '<script> window.location="miPerfilBibliotecario.php"</script>';
	?>
