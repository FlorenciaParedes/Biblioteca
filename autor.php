<?php
    session_start();
    include "conexion.php";
    $link=conexion();
    $id=$_GET["id"];
    $cantxpag=5; //variable que me almacena cantidad de registros a mostrar por pagina
    if (isset($_GET["pagina"])) {
        if(is_numeric($_GET["pagina"])){
            if($_GET["pagina"]==1){
                $pagina=1;
            }else{
                $pagina=$_GET["pagina"];
            }
        }else{
            $pagina=1;
        }
    }else{
        $pagina=1;
    }
    $comienzopag=($pagina-1)*$cantxpag;
    $query="SELECT autores.id, autores.nombre, autores.apellido, libros.id, libros.autores_id, libros.portada, libros.titulo, libros.cantidad FROM `autores` INNER JOIN libros ON autores.id=libros.autores_id WHERE autores.id='$id' ORDER BY libros.titulo ASC";
    $consulta=mysqli_query($link, $query);
    $totalreg=mysqli_num_rows($consulta);//cuenta el total de registros 
    $totalpag= (ceil($totalreg/$cantxpag)) ;//obtengo el total de paginas
    $query.=' LIMIT '.$comienzopag.', '.$cantxpag;
    $consulta=mysqli_query($link, $query);
?>    
<html>
<head>
  <title>Autor</title>
    <link type="text/css" rel="stylesheet" href="style.css">
</head>
<body>
  <div id='container' align="right">  
   <?php

 if(isset($_SESSION['login'])){
?>
    <a href="cerrar.php"> Cerrar sesion </a>
  <?php
}else{
 ?>
  <a target='_blank' href="formularioderegistro.php"> Registrarse</a>  &nbsp | &nbsp
  <a href="login.php"> Iniciar </a>
  <?php
}
?>
  </div>
  <br/><div class='portada'><a href='index.php'> <img src='imagenes/mib.jpg'></a></div> 
<br/>
<hr/>
 <table>
  <caption><h3>LIBROS DEL AUTOR </h3></caption>
  <tr> 
    <th> Portada </th>
    <th> Titulo </th>
    <th> Ejemplares </th>
  </tr>
  <?php
    while ($fila=mysqli_fetch_array($consulta)){
  ?>    
  <tr>
    <td><img src='mostrarImagen.php?id=<?php echo $fila["id"]?>' width="100" height="100"></td> 
    <td> <a target='_blank' href="libro.php?id=<?php echo $fila["id"]?>"> <?php echo $fila["titulo"]?></a></td>
    <td> <?php echo $fila["cantidad"]?> </td>
  </tr> 
    <td></td>
    <td>
    <?php
    }
    for ($i=1; $i<=$totalpag; $i++) {
       echo "<a href='autor.php?id=".$id."&pagina=".$i."'>".$i."</a> | ";
    }

  ?>
  </td></tr>  
</table>
</body>
</html>