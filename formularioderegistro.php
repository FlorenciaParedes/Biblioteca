<html>
<head> 
   <a href='index.php'> <img src='imagenes/mib.jpg'></a>
   <title> Registro </title>   
   <link type="text/css" rel="stylesheet" href="style.css">
</head>
<body>
  
<script type="text/javascript" src="java.js"></script>

 <form name='datosR' action="accion.php" method="POST" enctype="multipsrt/form-data">
   <fieldset>
    <legend> <h1> Registro de Lector</h1>	</legend>
    <table>
    <tr>
      <td> Nombre: </td>
      <td><input type= 'text' name='nombre' id='nombre' required/></td>
    </tr>
    <th></th>
    <tr>
      <td>Apellido: </td> 
      <td><input type= 'text' name='apellido' id='apellido' required/></td>
    </tr>
    <th></th>
    <tr>
      <td>Foto: </td>
      <td><input type='file' name='foto' id='foto' required/></td> 
    </tr>
    <th></th>
    <tr>
      <td> Email: </td>
      <td><input type= 'text' name='mail' id='mail' required/></td>
    </tr>
    <th></th>
    <tr>
      <td>Clave: </td>
      <td><input type= 'password' name='clave1' id='clave1' title="Minimo 6 caracteres, letras mayusculas y minisculas y por lo menos un numero o simbolo" required/ ></td>
    </tr>
    <th></th>
    <tr>
      <td>Confirmacion de clave: </td>
      <td><input type= 'password' name='clave2' id='clave2'  required/ ></td>
    </tr>
  </table>
  <br>
  <input  type="submit" value="Registrarse" onclick="validarform()"> 
   </fieldset>
 </form>

</body>
</html>