
function validarform(){

    valido = true; 
        if(document.getElementById("nombre").value ==""){//Si el campo es incompleto          
            alert("Ingrese datos en el campo nombre.");
            document.getElementById("nombre").focus();
            valido = false;  //El boolean cambia su valor a "false" para no enviar el formulario
        }
        if ((document.getElementById("nombre").value!="")&&(!document.getElementById("nombre").value.match(/[a-zA-Z]/))){//distinto de vacio me fijo si son caracteres correctos
            alert("En el campo nombre solo se admiten caracteres alfab\u00E9teticos.");// alerta
            document.getElementById("nombre").focus();
            valido = false;  //El boolean cambia su valor a "false" para no enviar el formulario
        }
        if(document.getElementById("apellido").value==""){//Si el campo es incompleto          
            alert("Ingrese datos en el campo apellido.");
            document.getElementById("apellido").focus();
            valido = false;  //El boolean cambia su valor a "false" para no enviar el formulario
        }
        if ((document.getElementById("apellido").value!="")&&(!document.getElementById("apellido").value.match(/[a-zA-Z]/))){//distinto de vacio me fijo si son caracteres correctos
            alert("En el campo apellido solo se admiten caracteres alfab\u00E9teticos.");// alerta
            document.getElementById("apellido").focus();
            valido = false;  //El boolean cambia su valor a "false" para no enviar el formulario
        }  
        if (document.getElementById("foto").value ==""){//Si el campo es incompleto
            alert("Ingrese foto" );//alerta
            document.getElementById("foto").focus();
            valido = false;  //El boolean cambia su valor a "false" para no enviar el formulario
        } 
        if (document.getElementById("mail").value!=""){
           var email=document.getElementById("mail").value;
           var aux=email.split("@");
           if (!aux[1]|| aux[0]==""){
             alert("e-mail inv\u00E1lido" );//Lanzo una alerta
            document.getElementById("mail").focus();
            valido = false;   //El boolean cambia su valor a "false" para no enviar el formulario
           }
           else{
             var part2=aux[1].split(".");
             if (!part2[1]){//si no existe . no existe parte 1 ni parte 0 
               alert("e-mail inv\u00E1lido");// alerta
               document.getElementById("mail").focus();
                valido = false;   //El boolean cambia su valor a "false" para no enviar el formulario
             }
            }
        }    
        else{//direccion de mail vacia
             alert("Ingrese direcci\u00F3n de e-mail" );// alerta
             document.getElementById("mail").focus();
             valido = false;    //El boolean cambia su valor a "false" para no enviar el formulario
         }   
        if((document.getElementById("clave1").value!="") || (document.getElementById("clave1").value.length>=6)){ //Si no es vacio y es mayor a 6 caracteres
            var clave=document.getElementById("clave1").value;
            var i=0;
            var bmin=false; //variable para munusculas
            var bmay=false; // mayusculas
            var bsimb=false;//simbolos
            for (i=0;clave.length;i++){//avanzo carcter a caracter
              if(clave.charAt(i).value.match(/[a-z]/)){
                bmin=true;
              } 
              if (clave.charAt(i).value.match(/[A-Z]/)){
                bmay=true;
              }
              if ((clave.charAt(i).value.match(/[0-9]/))||(clave.charAt(i).value.match(/\W/))){
                bsimb=true;
              }
            }
            if ((bmay==false)|| (bmin==false) || (bsimb==false)){ // verifico si no se ingreso algun requisito 
              alert("Recuerde que la clave debe tener min\u00FAsculas, may\u00FAsculas y al menos un n\u00FAmero o s\u00EDmbolo ");//Lanzo una alerta
              document.getElementById("clave1").focus();
              valido = false; //El boolean cambia su valor a "false" para no enviar el formulario 
           }
            
        else{
            alert(" Ingrese clave. Recuerde que la clave debe tener min\u00FAsculas, may\u00FAsculas y al menos un n\u00FAmero o s\u00EDmbolo ");//Lanzo una alerta
            document.getElementById("clave1").focus();
            //El boolean cambia su valor a "false" para no enviar el formulario
            valido = false; 
          } 
          }  
        if (document.getElementById("clave2").value!="" ) {
             if (document.getElementById("clave2").value !== document.getElementById("clave1").value) {
                alert ('Las claves no coinciden')
                valido=false
             }
           }
        else{
          alert ("Confirme su clave");     
           }
        if (valido) //Si mi comodín sigue como "true" (si todos los campos tienen datos)
              document.submit();//Lo envío para su procesamiento }, false);              
}

           