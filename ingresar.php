<?php
	session_start();
	include "conexion.php";
	$link=conexion();
	if ((isset($_POST['email']))&& (isset($_POST['pass']))){
			$usser=$_POST['email'];
			$pass=$_POST['pass'];
	}		
	$sql= mysqli_query($link,"SELECT * FROM usuarios WHERE email = '$usser' AND clave ='$pass'");
	if (mysqli_num_rows($sql)>0) or die { // obtengo el numero de filas de la variable, si es 0 es porque el mail no esta registrado.
		$row= mysqli_fetch_array ($sql);
		$_SESSION["email"]=$row ['email'];
		$_SESSION["nombre"]=$row ['nombre'];
		$_SESSION["apellido"]=$row ['apellido'];
		$_SESSION["foto"]=$row ['foto'];
		$_SESSION["id"]=$row ['id'];
		$_SESSION['login']=true;
		$_SESSION['rol']=$row['rol'];
		
		if ($row['rol'] == 'BIBLIOTECARIO') {
				echo '<script> window.location="MiPerfilBibliotecario.php"</script>';
		}else
		       echo '<script> window.location="MiPerfil.php"</script>';
	}else{
		$_SESSION['login']=false;
		echo '<script> alert ("usuario o contraseña incorrecta");</script>';
		echo '<script> window.location="login.php"; </script>';
	}	

?>