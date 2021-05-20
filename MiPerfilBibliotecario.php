 <?php
    session_start();
    include "conexion.php";
    $link=conexion();
    if(isset($_SESSION['login'])){ 
      if($_SESSION['rol']=='BIBLIOTECARIO'){ 
  
    ?>
<html>
<head> 
  <TITLE>Bibliotecario</TITLE>
</head>
 <body>
   <?php 
        if(isset($_SESSION['login'])){ ?> 
            <a><?php echo  "Usuario loggeado: ", $_SESSION['nombre']," ", $_SESSION['apellido'];?></a> 
          <div id='container' align="right">  
          <a href='cerrar.php'> Cerrar Sesi&oacuten </a>
          </div>      
    <?php  
        } 
    ?> 
  <a href='index.php'> <img src='imagenes/mib.jpg'> </a>
  <hr/>
  <link type="text/css" rel="stylesheet" href="style.css">
  <form action='miPerfilBibliotecario.php' method='GET'>
      <fieldset class='busqueda'>
        <legend ><h3>Refinar Busqueda</h3></legend>
          <table>
          <tr>

          <td>Titulo: <input type= 'text' id='tit' name='tit' ></td>
          <td>Autor: <input type= 'text' id='aut' name='aut'></td>
          </tr>
          <tr><td>Lector: <input type= 'text' id='lec' name='lec' ></td></tr>
          <tr><td>Fecha desde: <input type="date" name="fechaD" id="fechaD"></td>
            <td>Fecha hasta: <input type="date" name="fechaH" id="fechaH" ></td> 
          </tr>
          </table>
          </br><input type="submit" value="Buscar">
      </fieldset>
  </form>
  <hr/>

<TABLE>
  <caption><h2>Operaciones</h2></caption>
<tr>
  <th>T&iacutetulo</th>
  <th> Autor </th>
  <th> Lector </th> 
  <th> Estado </th>
  <th> Fecha </th>
  <th> Accion </th>
 </tr>
 <?php
 $query="SELECT libros.id as IdLibro,libros.titulo,autores.nombre as NombreAutor,autores.apellido as ApellidoAutor, usuarios.apellido,usuarios.nombre,operaciones.id as IdOperacion, operaciones.ultimo_estado,operaciones.fecha_ultima_modificacion FROM `operaciones` INNER JOIN usuarios on operaciones.lector_id=usuarios.id INNER JOIN libros on operaciones.libros_id=libros.id INNER JOIN autores on autores.id=libros.autores_id WHERE 1=1 ";
    $consulta=mysqli_query($link, $query);
    if (((isset($_GET['tit']))&&(!empty($_GET['tit']))) || ((isset($_GET['aut']))&&(!empty($_GET['aut']))) || ((isset($_GET['lec']))&&(!empty($_GET['lec']))) || ((isset($_GET['fechaD']))&&(!empty($_GET['fechaD'])))||((isset($_GET['fechaH']))&&(!empty($_GET['fechaH'])))){
        if (!empty($_GET['tit'])){
            $query.=' AND libros.titulo LIKE "%'.$_GET['tit'].'%"';
            $consulta=mysqli_query($link, $query) or die (mysqli_error());
        }else{
          if (!empty($_GET['aut'])){
            $query.=' AND autores.apellido LIKE "%'.$_GET['aut'].'%"';
            $consulta=mysqli_query($link, $query)or die (mysqli_error()); 
            }else{
              if (!empty($_GET['lec'])){
                  $query.=' AND (usuarios.nombre LIKE "%'.$_GET['lec'].'%" OR usuarios.apellido LIKE "%'.$_GET['lec'].'%")';
                  $consulta=mysqli_query($link, $query)or die (mysqli_error());
              }else{
                if (!empty($_GET['fechaD']) & (!empty($_GET['fechaH']))){
                  //echo $_GET["fechaD"];
                  //echo $_GET["fechaH"];
                  $query.=' AND operaciones.fecha_ultima_modificacion BETWEEN "'.$_GET["fechaD"].'" AND "'.$_GET["fechaH"].'"';
                  echo $query;
                  $consulta=mysqli_query($link, $query)or die (mysqli_error()); //  La consulta funciona con un formato distinto de fecha. El filtro espera la fecha sin separadores = aaaammdd y el input lo genera con '-' = aaaa-mm-dd . No logramos hacer la conversion 
                }
              }
            }   
        }
    }else{
        $consulta=mysqli_query($link, $query);
    }
  
 
 while ($fila=mysqli_fetch_array($consulta)){
 ?>
 <tr>
  <td> <?php echo $fila["titulo"]?> </td>
  <td> <?php echo $fila["NombreAutor"]," ", $fila["ApellidoAutor"] ?></td>
  <td><?php echo $fila ['apellido']," " ,$fila['nombre'] ?></td>
  <td> <?php echo $fila["ultimo_estado"]?> </td>
  <td> <?php echo $fila["fecha_ultima_modificacion"]?></td>
  <td> <?php if($fila['ultimo_estado']=='RESERVADO'){?>
      <a href="prestar.php?id=<?php echo $fila ['IdOperacion']?>"> <input type="submit" value="PRESTAR" ></a> 
      <?php }elseif ($fila['ultimo_estado']=='PRESTADO' ) { ?>
       <a href="devolver.php?id=<?php echo $fila ['IdOperacion']?>"> <input type="submit" value="DEVOLVER"> </a>
     <?php } ?>

        </td>
 </tr>
<?php
}

?>


</TABLE>


 </body> 
</head>
</html>
<?php
    
    }else{
      echo '<script> window.location="MiPerfil.php"</script>';
}
  }else {
    echo '<script> window.location="login.php"</script>';
  }
  ?>