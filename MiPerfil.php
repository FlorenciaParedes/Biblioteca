 <?php
    session_start();
    include "conexion.php";
    $link=conexion(); 
    if(isset($_SESSION['login'])){ 
      if($_SESSION['rol']=='LECTOR'){ 
    ?>
<html>
<head> 

  <title>Mi Perfil</title>
  <div id='container' align="right">	
    <a href='cerrar.php'> Cerrar Sesi&oacuten </a>
  </div>	
  <a href='index.php'> <img src='imagenes/mib.jpg'> </a>
  <hr/>
  <link type="text/css" rel="stylesheet" href="style.css">
</head>
 <body><?php
    if($_SESSION['login']=true){
?>
  <h1> MI PERFIL </h1>	
    <?php
    /*$query="SELECT usuarios.nombre,usuarios.apellido,usuarios.email,usuarios.foto FROM `usuarios`" ;
    $consulta=mysqli_query($link,$query);
    $fila = mysqli_fetch_array($consulta);
    echo "Nombre: ".$fila['nombre'];?></br>
    <?php echo "Apellido: ".$fila['apellido'];?></br>
    <?php echo "E-mail: ".$fila['email'];*/
      $mail=$_SESSION['email'];
      $nombre=$_SESSION['nombre'];
      $apellido=$_SESSION['apellido'];
      $foto=$_SESSION['foto'];
      $id= $_SESSION['id'];
      $query="SELECT libros.id, libros.portada, libros.titulo, libros.autores_id, autores.nombre, autores.apellido, operaciones.ultimo_estado, operaciones.fecha_ultima_modificacion, operaciones.lector_id  FROM `operaciones`INNER JOIN usuarios ON operaciones.lector_id=usuarios.id INNER JOIN libros ON operaciones.libros_id=libros.id INNER JOIN autores ON libros.autores_id=autores.id  WHERE lector_id = '$id'  ORDER BY `operaciones`.`fecha_ultima_modificacion` DESC";
     $consulta=mysqli_query($link, $query);
      
    ?>
    <h3>Nombre: <?php echo $nombre; ?> </h3>
    <h3>Apellido: <?php echo $apellido; ?> </h3>
    <h3>Email: <?php echo $mail; ?> </h3>
     </br>
    <table>
 	<caption><h3>HISTORIAL DE OPERACIONES </h3></caption>
 	<tr>
 	<th>Portada</th>
 	<th>T&iacutetulo</th>
 	<th>Autor</th> 
 	<th>Estado</th>
 	<th> Fecha</th>
 </tr>
 <?php
 while ($fila=mysqli_fetch_array($consulta)){
 ?>
 <tr>
 	<td><img src='mostrarImagen.php?id=<?php echo $fila["id"]?>' width="100" height="100"></td>
 	<td> <?php echo $fila["titulo"]?> </td>
 	<td> <?php echo $fila["apellido"], $fila["nombre"] ?></td>
 	<td> <?php echo $fila["ultimo_estado"]?> </td>
 	<td> <?php echo $fila["fecha_ultima_modificacion"]?></td>
 </tr>
<?php
}
}
?>
</table>
 </body> 
</head>
</html>
<?php
    }else{
      echo '<script> window.location="MiPerfilBibliotecario.php"</script>';
}
  }else {
    echo '<script> window.location="login.php"</script>';
  }
  ?>