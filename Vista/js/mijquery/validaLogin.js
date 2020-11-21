
$("#login").click(function(e){
	    validarLogin();
        e.preventDefault();
    });

function validarLogin() {
var expRegEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
var log= document.getElementById("loginus");
var pass= document.getElementById("clave");
var verificar=true;

if(!log.value)
	{
	  log.style.borderColor = "red";
		log.focus();
		verificar=false;
		return false;
	}

 if(!pass.value)
	{
		pass.style.borderColor = "red";
		pass.focus();
		verificar=false;
		return false;
  }
  
 if(verificar===true)
	{
     
     var xmlhttp;
		if(window.XMLHttpRequest)
		{
			xmlhttp= new XMLHttpRequest();
		}
		else
		{
			xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
		}
        var login= document.getElementById("loginus").value;
	      var clave=document.getElementById("clave").value;
		    var logininfo= document.getElementById("logininfo");
		 var param={};
		 param.clave=clave;
     param.login=login;
     
		var data = JSON.stringify(param) ;
		xmlhttp.onreadystatechange= function() 
		{
		   if(xmlhttp.readyState === 4 && xmlhttp.status ===200)
		   {
       var mensaje= xmlhttp.responseText;
         if(mensaje==="true")
         {
          document.location="bienvenido.php";
         }
         else
         {
          logininfo.innerHTML="Usuario o Contraseña incorrecto." ;
          logininfo.style.color="red";
          limpiarFrm();
          log.focus();
         
         }
		
		   }
		}
		xmlhttp.open("POST","../Controlador/Usuario/Login.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send(data);	
      


	}
}
function limpiarFrm()
 {
  document.getElementById("loginus").value="";
	document.getElementById("clave").value="";
 }

$("#cerrar").click(function(){
	    $.ajax({
                url:'../Controlador/Clogin.php',
                type:'POST',
                data:"boton=cerrar"
            }).done(function(resp){
              //alert(resp);
                document.location="login.php";
            });
   //alert("hola");
    });


