<?php
    session_start();
   include 'conexion.php';
   $link=conexion();
   $orden='titulo';

  /* print date('d-m-Y');*/
?>

<html>
<head>
 <title>BIBLIOTECA</title>
 <link type="text/css" rel="stylesheet" href="style.css">
</head>
<body>
 <div id='container' align="left">
    <?php
        if(isset($_SESSION['login'])){
          $lector=$_SESSION['id'];
          if($_SESSION['rol']=='LECTOR'){ ?>
                <a href="miPerfil.php"><?php echo $_SESSION['nombre']," ",$_SESSION['apellido'];?></a>
    <?php   }else{
                if($_SESSION['rol']=='BIBLIOTECARIO') ?>
                  <a href="miPerfilBibliotecario.php"><?php echo $_SESSION['nombre']," ",$_SESSION['apellido'];?></a>
    <?php
             }
         }  ?>
</div>
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
</div><br/><div class='portada'><img src='imagenes/mib.jpg' title="Portada: Mi biblioteca virtual"></div>
 <hr/>
  <form action='index.php' method='GET'>
    <fieldset class='busqueda'>
      <legend ><h3>Realizar Busqueda</h3></legend>
        <table>
        <tr>

        <td>Titulo: <input type= 'text' id='tit' name='tit' ></td>
        <td>Autor: <input type= 'text' id='aut' name='aut'></td>
        </tr>
        </table>
        </br><input type="submit" value="Buscar">
    </fieldset>
  </form>
<hr/>
<?php
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
    $query="SELECT libros.id, libros.titulo, libros.portada, libros.cantidad, autores.nombre, autores.apellido, libros.autores_id FROM `libros` inner JOIN autores on libros.autores_id = autores.id WHERE 1=1";
    $consulta=mysqli_query($link, $query);

    if (((isset($_GET['tit']))&&(!empty($_GET['tit']))) || ((isset($_GET['aut']))&&(!empty($_GET['aut'])))){
        if (!empty($_GET['tit'])){
            $query.=' AND libros.titulo LIKE "%'.$_GET['tit'].'%"';
            $consulta=mysqli_query($link, $query);

        }else{
            $query.=' AND autores.apellido LIKE "%'.$_GET['aut'].'%" OR autores.nombre LIKE "%'.$_GET['aut'].'%"';
            $consulta=mysqli_query($link, $query);
        }

        $totalreg=mysqli_num_rows($consulta);//cuenta el total de registros
        $totalpag= (ceil($totalreg/$cantxpag)) ;//obtengo el total de paginas
        $query.=' ORDER BY libros.titulo ASC';
        $query.=' LIMIT '.$comienzopag.', '.$cantxpag;
        $consulta=mysqli_query($link, $query);
    }else{
        $totalreg=mysqli_num_rows($consulta);//cuenta el total de registros
        $totalpag= (ceil($totalreg/$cantxpag)) ;//obtengo el total de paginas
        if((isset($_GET['autor'])) || (isset($_GET['titulo']))){
           if(isset($_GET['autor'])){
              $query.= ' ORDER BY autores.apellido ASC';
               $query.=' LIMIT '.$comienzopag.', '.$cantxpag;
              $consulta=mysqli_query($link, $query);
           }else{
              $query.=' ORDER BY libros.titulo ASC';
              $query.=' LIMIT '.$comienzopag.', '.$cantxpag;
              $consulta=mysqli_query($link, $query);
            }
          }else{
              $query.=' ORDER BY libros.titulo ASC';
              $query.=' LIMIT '.$comienzopag.', '.$cantxpag;
              $consulta=mysqli_query($link, $query);
          }
        }

?>
 <table class= 'catalogo'>
  <caption><h3>CAT&AacuteLOGO DE LIBROS </h3></caption>
  <tr>
    <th> Portada </th>
    <th> <a href="index.php?titulo='t'"> Titulo </a> </th><!-- para ordenar alfabeticamente por titulo -->
    <th> <a href="index.php?autor='a'"> Autor </a> </th><!-- para ordenar alfabeticamente por autor -->
    <th> Ejemplares </th>
    <?php
    if(isset($_SESSION['login'])){
          if (( $_SESSION['login']==true) &($_SESSION['rol']=='LECTOR')){
      ?>
      <th>Accion</th>
      <?php
    }
    }
    ?>
  </tr>
  <?php
    // ACA COMIENZA EL CODIGO DE LA TABLA CON CONTENIDO QUE VIENE LA TABLA
     while ($fila=mysqli_fetch_array($consulta)){
  ?>
    <tr>
      <td><img src='mostrarImagen.php?id=<?php echo $fila["id"]?>' width="100" height="100"> </td>
      <td> <a target='_blank' href="libro.php?id=<?php echo $fila["id"]?>"> <?php echo $fila["titulo"]?> </a> </td>
      <td> <a target='_blank' href="autor.php?id=<?php echo $fila["autores_id"]?>"> <?php echo $fila["apellido"]," ", $fila["nombre"]?></a></td>
      <?php
      $libroid=$fila['id'];
      $query1="SELECT  operaciones.ultimo_estado, operaciones.libros_id FROM `operaciones` WHERE operaciones.libros_id= '$libroid'";
      $query2=$query1;
      $query2.=" AND operaciones.ultimo_estado='PRESTADO'";
      $consulta2=mysqli_query($link, $query2);
      $prestados=mysqli_num_rows($consulta2);
      $query3=$query1;
      $query3.=" AND operaciones.ultimo_estado='RESERVADO'";
      $consulta3=mysqli_query($link, $query3);
      $reservados=mysqli_num_rows($consulta3);
      $query4=$query1;
      $query4.=" AND operaciones.ultimo_estado='DEVUELTO'";
      $consulta4=mysqli_query($link, $query4);
      $devueltos= mysqli_num_rows($consulta4);
      $cantEj=$fila['cantidad'];
      $noDisponibles=$prestados+$reservados;

      $disponibles=$cantEj-($noDisponibles-$devueltos);
      ?>
      <td> <?php echo $fila["cantidad"],'(prestados: ',$prestados,' reservados: ',$reservados,' disponibles: '  ,$disponibles,')'; ?> </td>
      <?php
        if(isset($_SESSION['login'])){
          if (($_SESSION['login']==true)&($_SESSION['rol']=='LECTOR')){
            $querylec="SELECT operaciones.ultimo_estado, operaciones.lector_id FROM `operaciones` WHERE operaciones.lector_id='$lector'";
            $sql1=$querylec;
            $sql1.=" AND (operaciones.ultimo_estado='RESERVADO' OR operaciones.ultimo_estado='PRESTADO')";
            $consul=mysqli_query($link, $sql1);
            $tengo=mysqli_num_rows($consul);
            $sql2=$querylec;
            $sql2.=" AND operaciones.ultimo_estado='DEVUELTO'";
            $consul2=mysqli_query($link, $sql2);
            $devolvi=mysqli_num_rows($consul2);
            $aux=$tengo-$devolvi;

            if (($disponibles>=1) & ($aux<3)){
              ?>
            <td> <a href="reserva.php?id=<?php echo $fila ['id']?>"> <input type="submit" value="reservar"></a></td>
            <?php

          }
            }
        }
      ?>
    </tr>
    <tr>
    <td></td><td></td>
    <td>
    <?php
    }
    for ($i=1; $i<=$totalpag; $i++) {
       if (((isset($_GET['tit']))&&(!empty($_GET['tit']))) || ((isset($_GET['aut']))&&(!empty($_GET['aut'])))){
          echo "<a href='index.php?tit=".$_GET['tit']."&aut=".$_GET['aut']."&pagina=".$i."'>".$i."</a> | ";
        }else{
          echo "<a href='index.php?pagina=".$i."'>".$i."</a> | ";
    }
}
  ?>
  </td></tr>
  </table>
</body>
</html>
