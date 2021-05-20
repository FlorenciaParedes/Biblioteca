<?php
       $nombre = $_POST["nombre"];
       $apellido = $_POST["apellido"];
       $foto = $_POST["foto"];
       $mail = $_POST["mail"];
       $clave1 = $_POST["clave1"];  
       $clave2=$_POST["clave2"];
	   $ok=true;
	   $mMay= false;/*variable para el match con mayusculas*/
	   $mMin= false;/*variable para el match con minusculas*/
	   $mSim= false;/*variable para el match con simbolo*/
    if (empty(trim($nombre))) { /*me fijo que no es vacio*/
		$ok=false;
	} 
	if	(preg_match("/^([a-zA-Z])+$/",$nombre)==false) { /*y que cumple la condicion si entra el ok devuelve false*/
		$ok=false;	
	}
	if (empty(trim($apellido))) {/*me fijo que no es vacio */
		$ok=false;
	} 
	if	(preg_match("/^([a-zA-Z])+$/",$apellido)==false) {/*y que cumple la condicion */
		$ok=false;
	}
	if (empty(trim($foto))) {
		$ok=false;	
	}
	if (empty(trim($mail))){
		$ok=false;
	} 
	else if (preg_match("/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/",$mail)) { /*validamos usando expresiones regulares ya que no sabemos si podemos utilizar la funcion de filter_var de php */
			echo 'mail valido';
			}else{
				echo 'mail invalido';
				$ok=false;
		}	
	if (empty(trim($clave1))) {/*me fijo que no es vacio y que cumple la condicion */
		$ok=false;
	}else{
		if (strlen($clave1)>=6){
		    for($i=0;$i<strlen($clave1);$i++){ 
                 if ((preg_match("/^([a-z])+$/",$clave1[$i]))){
		            $mMin= true;
	              }
	             if (preg_match("/^([A-Z])+$/",$clave1[$i])){
		             $mMay= true;
	              }
		         if (preg_match("/^([0-9])+$/",$clave1[$i])||(preg_match("/[\W]/",$clave1[$i]))){
			          $mSim= true;
		         }
			     
			}
		    if ((!$mMin) || (!$mMay) || (!$mSim)){
				$ok=false;
			}
		}else{
			$ok=false;
		}
	}
	if (empty(trim($clave2))){
		$ok=false;
	}else{
		if ($clave1!==$clave2){
			$ok=false;
	}
	}  

	if ($ok===true){//OK ES VERDADERO PORQUE TODOS LOS DATOS SON LOS CORRECTOS // hasta aca toodo bien
       include "conexion.php";
       $link=conexion();
       $aux=mysqli_query($link,"SELECT * FROM usuarios WHERE email = '$mail'");// me fijo si existe el mail 
       if(mysqli_num_rows($aux) == 0){ // obtengo el numero de filas de la variable, si es 0 es porque el mail no esta registrado. *******codigo viejo*******
			mysqli_query($link,"INSERT INTO usuarios (email,nombre,apellido,foto,clave,rol) VALUES ('$mail','$nombre','$apellido','$foto','$clave1','lector')"); // agrego a la base de datos.
			echo '<script> alert ("Usuario registrado correctamente");</script>';
			echo '<script> window.location="login.php"; </script>';
		}else{ 
         	echo '<script> alert ("El usuario que intenta registrar ya existe");</script>';
         	echo '<script> window.location="login.php"; </script>';  
     } 
 	}else{
  		echo '<script> window.location="formularioderegistro.php";</script>'; 
  	}
?>
