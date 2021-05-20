<?php
    session_start();
    include "conexion.php";
    $link=conexion();
    if (isset ($_session['email'])){
      echo '<script> window.location="MiPerfil.php"</script>';
    }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Iniciar Sesi&oacuten</title>
	<a href='index.php'> <img src='imagenes/mib.jpg'> </a>
  <hr/>
  <link type="text/css" rel="stylesheet" href="style.css">
	</head>
	<body>
		<form name='ingresar' action='ingresar.php' method="POST">
		<fieldset>
	     <legend> <h1> Ingresar</h1>	</legend>
	<table>
      <tr>
      <td>E-mail: </td>
      <td><input type= 'text' name='email' id='email' required/></td>
      </tr>
      <tr>
      <td>Clave: </td>
      <td><input type= 'password' name='pass' id='pass' required/></td>
      </tr>
	</table>
	</br>
<input type="submit" value="login">
</fieldset>
</form>

</body>
</html>