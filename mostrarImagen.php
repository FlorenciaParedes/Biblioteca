<?php
	$id= $_GET['id'];
	include "conexion.php";
	$link=conexion();
	$sql="SELECT portada FROM libros WHERE id=$id";
	$result = mysqli_query($link,$sql);
	$row = mysqli_fetch_array($result);
	mysqli_close($link);
	header("content-type: jpg");
	echo $row['portada'];
?>