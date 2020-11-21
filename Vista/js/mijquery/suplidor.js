
$("#saveSuplidor").click(function(e){
  e.preventDefault(); 
    validarFrmSuplidor();
   
    //alert("Hola");
});
 /*--------------------- Firebase configuration------------------------------*/
 var firebaseConfig = {
  apiKey: "AIzaSyDn7ZAbWwWdnI822p3SrzuqnhDcouiiFvE",
  authDomain: "willtechno-8b6a9.firebaseapp.com",
  databaseURL: "https://willtechno-8b6a9.firebaseio.com",
  projectId: "willtechno-8b6a9",
  storageBucket: "willtechno-8b6a9.appspot.com",
  messagingSenderId: "904964604362",
  appId: "1:904964604362:web:dd5e9e648a40ad30ee4f33"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);
var imagePath;
var imageUrl;

const selectImg=document.getElementById("selectImg");
const myimg=document.getElementById("myimg");
selectImg.addEventListener("change", function(){
  const file=this.files[0];
  if(file){

    const reader=new FileReader();
    reader.addEventListener("load",function(){
      myimg.setAttribute("src",this.result);
    });
    reader.readAsDataURL(file);
    imagePath=file;
  }

});

function validarFrmSuplidor(){ 


                                  var verificar=true;
                                  var expRegNombres =/^[A-Za-zÁáÉéÍíÓóÚúÜüÑñ]{1,}([\s][A-Za-zÁáÉéÍíÓóÚúÜüÑñ]{1,})+$/;
                                  var expRegPais = /^[a-záéíóúñ\s]*$/i;
                                  var expRegEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
                                  var expRegUrl= /^(http|https|ftp)+\:+\/\/+(www\.|)+[a-z0-9\-\.]+([a-z\.]|)+\.[a-z]{2,4}$/i;
                                  var expPrecio=/^([0-9]\s*)*$/;  

                                  var formulario=document.getElementById("frmSuplidores");
                                  var nombreSuplidor= document.getElementById("nombreSuplidor");
                                  var rnc=document.getElementById("rnc");
                                  var tipoSup=document.getElementById("tipoSup");
                                  var direccionSuplidor=document.getElementById("direccionSuplidor");
                                  var telefonoSuplidor=document.getElementById("telefonoSuplidor");
                                  var correoSuplidor=document.getElementById("correoSuplidor");
                                  var web=document.getElementById("web");

                              
                                
                                  if(!nombreSuplidor.value)
                                  {
                                      document.getElementById("errornombre_sup").innerHTML="<div style='color:red;'>Digite el nombre del suplidor.</div>";
                                      nombreSuplidor.style.borderColor = "red";
                                    nombreSuplidor.focus();
                                      verificar=false;
                                      return false;
                                  }
                                  if(!tipoSup.value)
                                  {
                                      document.getElementById("errortipoSup").innerHTML="<div style='color:red;'>Elige el tipo suplidor.</div>";
                                      tipoSup.style.borderColor = "red";
                                    tipoSup.focus();
                                      verificar=false;
                                      return false;
                                  }
                                
                                    
                              if(rnc.value!=""){
                                  if(!expPrecio.exec(rnc.value)){
                                  document.getElementById("error_rnc").innerHTML="<div style='color:red;'>Se acepta solo numeros.</div>";
                                  rnc.style.borderColor = "red";
                                  rnc.focus();
                                  verificar=false;
                                  return false;
                                  }

                                  
                                  }
                                  if(!direccionSuplidor.value)
                                  {
                                    document.getElementById("errordireccion_sup").innerHTML="<div style='color:red;'>Digite la direccion del suplidor.</div>.";
                                    direccionSuplidor.style.borderColor ="red";
                                    rnc.focus();
                                    
                                    verificar=false;
                                    return false;
                                    
                                  }
                                  if(!telefonoSuplidor.value)
                                  {
                                    document.getElementById("errortelefono_sup").innerHTML="<div style='color:red;'>Digite el telefono de suplidor.</div>.";
                                    telefonoSuplidor.style.borderColor ="red";
                                    rnc.focus();
                                  
                                    verificar=false;
                                    return false;
                                    
                                  }
                                
                                if(!expPrecio.exec(telefonoSuplidor.value)){
                                  document.getElementById("errortelefono_sup").innerHTML="<div style='color:red;'>Se acepta solo numeros.</div>";
                                  telefonoSuplidor.style.borderColor = "red";
                                  telefonoSuplidor.focus();
                                  verificar=false;
                                  return false;
                                  }
                                  
                                  
                                if(!expRegEmail.exec(correoSuplidor.value)){
                                  document.getElementById("errorcorreo_sup").innerHTML="<div style='color:red;'>Digite un correo válido.</div>";
                                  correoSuplidor.style.borderColor = "red";
                                  correoSuplidor.focus();
                                  verificar=false;
                                  return false;
                                  } 
                                  if(web.value!="")
                                  {
                                    if(!expRegUrl.exec(web.value)){
                                  document.getElementById("errorweb").innerHTML="<div style='color:red;'>Digite un url válido.</div>";
                                  web.style.borderColor = "red";
                                  web.focus();
                                  verificar=false;
                                  return false;
                                  } 
                                  
                                  }
                              if(verificar===true)
                            {
                              var uploadTask;
                                    
                               //Checking if an image has selected, i will save data with image
                                  if(imagePath)
                                  {
                                            uploadTask=firebase.storage().ref('suplidores/'+Date.now()+".png").put(imagePath);
                                            uploadTask.on('state_changed', function(snapshot){
                                              var progress =(snapshot.bytesTransferred / snapshot.totalBytes) *100;
                                              document.getElementById('upProgess').innerHTML='Cargado'+progress+'%';
                                              },
                                              function(error){
                                                document.getElementById('upProgess').innerHTML='Error al subir la imagen';
                                              },
                                              function(){
                                              uploadTask.snapshot.ref.getDownloadURL().then(function(url)
                                              {
                                                imageUrl=url;
                                                var xmlhttp;
                                                  if(window.XMLHttpRequest)
                                                  {
                                                    xmlhttp= new XMLHttpRequest();
                                                  }
                                                  else
                                                  {
                                                    xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
                                                  }

                                                  var nombre= document.getElementById("nombreSuplidor").value;
                                                  var _rnc=document.getElementById("rnc").value;
                                                  var tipo=document.getElementById("tipoSup").value;
                                                  var direccion= document.getElementById("direccionSuplidor").value;
                                                  var tel= document.getElementById("telefonoSuplidor").value;
                                                  var correo= document.getElementById("correoSuplidor").value;
                                                  var _web=document.getElementById("web").value;

                                                  var info= document.getElementById("info");
                                                  var param={};
                                                  param.correo=correo;
                                                  param.nombre=nombre;
                                                  param._rnc=_rnc;
                                                  param.tipo=tipo;
                                                  param.direccion=direccion;
                                                  param.tel=tel;
                                                  param._web=_web;
                                                  param.imageUrl=imageUrl;
                                                  
                                                  var data = JSON.stringify(param) ;
                                                 
                                                  xmlhttp.onreadystatechange= function() 
                                                  {
                                                    if(xmlhttp.readyState === 4 && xmlhttp.status ===200)
                                                    {
                                                    var mensaje= xmlhttp.responseText;
                                                    /*emailinfo.innerHTML=mensaje ;
                                                    emailinfo.style.color="green";*/
                                                    alert(mensaje);
                                                    limpiarFrm();
                                                    }
                                                  }
                                                  xmlhttp.open("POST","../Controlador/Suplidor/Create.php", true);
                                                  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                                  xmlhttp.send(data);

                                                
                                              }
                                    
                                        );
                                      });
                                  }
                                   // if an image was not selected, i will save data with image without image
                                  else
                                  {
                                    
                                  }  
                                  
                                  
                        }
                        
                      

}

function limpiarFrm()
 {
	 document.getElementById("nombreSuplidor").value="";
   document.getElementById("rnc").value="";
   document.getElementById("tipoSup").value="";
   document.getElementById("direccionSuplidor").value="";
   document.getElementById("telefonoSuplidor").value="";
   document.getElementById("correoSuplidor").value="";
   document.getElementById("web").value="";
   document.getElementById("myimg").src="";
   imagePath="";
   document.getElementById("upProgess").innerHTML="";
 }
var data;
function lista_sup(){
    const request =new XMLHttpRequest();
    request.open("GET","../Controlador/Suplidor/Index.php", true);
    request.onload = ()=>{
      try {
        const json=request.responseText;
        data=json;
        populateDataconst(json);
      } catch (error) {

        console.log(+"Hay un error "+ error);
      }
       
    };
    request.send();   
}
function populateDataconst(json){
  var d=json.split("*");
  //Imprimimos los registro en nuestra Table
  var valores = eval(d[0]);
  var cont;
  for(i=0;i<valores.length;i++){
     cont=i+1;
    datos=valores[i]["Id"]+"*"+valores[i]["nombre"]+"*"+valores[i]["direccion"]+"*"+valores[i]["rnc"]+"*"+valores[i]["telefono"]+"*"+valores[i]["correo"]+"*"+valores[i]["tipo"]+"*"+valores[i]["logo"]+"*"+valores[i]["web"];
    var html="<tr><td>"+cont+"</td><td>"+valores[i]["nombre"]+"</td><td>"+valores[i]["rnc"]+"</td><td>"+valores[i]["telefono"]+"</td><td>"+valores[i]["correo"]+"</td><td>"+valores[i]["web"]+"</td><td>"+valores[i]["direccion"]+"</td><td><img src='"+valores[i]["logo"]+"' width='50px' height='50px'></td><td><button class='btn btn-warning' data-toggle='modal' data-target='#articulos' onclick='mostrar_cliente("+'"'+datos+'"'+");'><span class='glyphicon glyphicon-pencil'></span></button> <button class='btn btn-danger' onclick='eliminar("+'"'+valores[i]["Id"]+'"'+")'><span class='glyphicon glyphicon-trash'></span></button></td></tr>";
    $("#filas").append(html);
  }
  
   
      //document.getElementById("filas").innerHTML=html;
      

     
}

document.addEventListener("DOMContentLoaded", ()=>{lista_sup();});
$(document).ready(function() {    
  $('#lista_sup').DataTable({
  //para cambiar el lenguaje a español
      "language": {
              "lengthMenu": "Mostrar _MENU_ registros",
              "zeroRecords": "No se encontraron resultados",
              "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
              "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
              "infoFiltered": "(filtrado de un total de _MAX_ registros)",
              "sSearch": "Buscar:",
              "oPaginate": {
                  "sFirst": "Primero",
                  "sLast":"Último",
                  "sNext":"Siguiente",
                  "sPrevious": "Anterior"
         },
         "sProcessing":"Procesando...",
          }
  });     
});























































































































	



 

 
    








