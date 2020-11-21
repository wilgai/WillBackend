
$("#registrar").click(function(e){
    validarFormulario();
    e.preventDefault(); 
});


function validarFormulario() {
	var verificar=true;
	var expRegNombres =/^[A-Za-zÁáÉéÍíÓóÚúÜüÑñ]{1,}([\s][A-Za-zÁáÉéÍíÓóÚúÜüÑñ]{1,})+$/;
	var expRegPais = /^[a-záéíóúñ\s]*$/i;
	var expRegEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
	var expRegUrl= /^(http|https|ftp)+\:+\/\/+(www\.|)+[a-z0-9\-\.]+([a-z\.]|)+\.[a-z]{2,4}$/i;
	var expRegTelefono=/^([0-9]\s*)*$/;	
	const inputs = document.querySelectorAll(".campo");

	
    var formulario=document.getElementById("formulario");
	    var email= document.getElementById("correo");
	    var password=document.getElementById("pass");
	    var name=document.getElementById("nam");
	    var confirmpassword=document.getElementById("pass1");
	    var log= document.getElementById("login");
	



	if(!name.value)
	{
	 document.getElementById("error").innerHTML="<div style='color:red;'>Digite tu nombre.</div>";
	 name.style.borderColor="red";
	 name.focus();
	 verificar=false;
	 return false;
	}

	if(!email.value)
	{
	    document.getElementById("error").innerHTML="<div style='color:red;'>Por favor digite su correo.</div>";
	    email.style.borderColor = "red";
		email.focus();
		verificar=false;
		return false;
	}

    if(!expRegEmail.exec(email.value)){
	document.getElementById("error").innerHTML="<div style='color:red;'>Escriba un correo valido.</div>";
	email.style.borderColor = "red";
	email.focus();
	verificar=false;
	return false;
	}

	if(!log.value)
	{
		document.getElementById("error").innerHTML="<div style='color:red;'>Crea un login.</div>.";
		log.style.borderColor ="red";
		log.focus();
		verificar=false;
		return false;
	}

	 if(!password.value)
	{
		document.getElementById("error").innerHTML="<div style='color:red;'>Digite una contraseña.</div>.";
		password.style.borderColor = "red";
		password.focus();
		verificar=false;
		return false;
	}
	 if(!confirmpassword.value)
	{
		document.getElementById("error").innerHTML="<div style='color:red;'>Confirme la contraseña.</div>.";
		confirmpassword.style.borderColor = "red";
		confirmpassword.focus();
		verificar=false;
		return false;
	}
	 if(confirmpassword.value != password.value)
	{
		document.getElementById("error").innerHTML="<div style='color:red;'>Las contraseñas deben coincidir.</div>.";
		confirmpassword.style.borderColor = "red";
		password.style.borderColor = "red";
		password.focus();
		password.value="";
		confirmpassword.value="";
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
        var correo= document.getElementById("correo").value;
	    var pass=document.getElementById("pass").value;
	    var nam=document.getElementById("nam").value;
		var login= document.getElementById("login").value;
		var emailinfo= document.getElementById("emailinfo");
		 var param={};
		 param.correo=correo;
		 param.pass=pass;
		 param.nam=nam;
		 param.login=login;
		var data = JSON.stringify(param) ;
		xmlhttp.onreadystatechange= function() 
		{
		   if(xmlhttp.readyState === 4 && xmlhttp.status ===200)
		   {
			 var mensaje= xmlhttp.responseText;
			 emailinfo.innerHTML=mensaje ;
			emailinfo.style.color="green";
			 limpiarFrm();
		   }
		}
		xmlhttp.open("POST","../Controlador/Usuario/Create.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send(data);	

     }
     
}
 function limpiarFrm()
 {
	document.getElementById("correo").value="";
	document.getElementById("pass").value="";
	document.getElementById("nam").value="";
	document.getElementById("login").value="";
	document.getElementById("pass1").value="";
 }
