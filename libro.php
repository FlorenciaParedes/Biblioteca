<html>
<head>
		<meta charset ="UTF-8">
		<?php 
		session_start();
		$id= $_GET['id'];
		include "conexion.php";
		$link=conexion();
		$query= 'SELECT autores.id as IdAutor, libros.id, libros.titulo,libros.descripcion, libros.portada, libros.cantidad,  autores.nombre, autores.apellido, libros.autores_id FROM libros inner JOIN autores on libros.autores_id = autores.id where libros.id = '.$id;
		
		$consulta=mysqli_query($link, $query);
		$fila=mysqli_fetch_array($consulta);
		?>
	<title><?php echo $fila['titulo'] ?></title>
		<link type="text/css" rel="stylesheet" href="style.css">
</head>
<body>
	<div id='container' align="right">	
	 <a target='_blank' href="formularioderegistro.php"> Registrarse</a>  &nbsp | &nbsp
		 <a href="login.php"> Iniciar </a>
	</div>
	<br/><div class='portada'><a href='index.php'> <img src='imagenes/mib.jpg'></a></div>	
<br/>
	<div id='info' align='left'>

		 <p><h2> <?php echo $fila['titulo'] ?></h2></p>
		 <P><?php echo "Autor: ". $fila['nombre'],$fila['apellido'];?></P> 
		 <P><?php echo "Ejemplares: ". $fila['cantidad'] ; ?> </P>
		 <div id='imagenlibro' align='right'>
			 <a href='autor.php?id=<?php echo $fila["IdAutor"]?>'><img src='mostrarImagen.php?id=<?php echo $fila["id"]?>' width="250" height="250"></a>
		 </div>
		 <div id='descripcion'>
			<p><h3>Descripci&oacuten</h3></p>
			<p> <?php echo $fila['descripcion'] ?></p>
		</div>

	</div>

		 


</body>
</html>