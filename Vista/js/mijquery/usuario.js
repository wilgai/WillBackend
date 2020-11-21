


$("#saveuser").click(function(){
    validarFrmUsuario(); 
    //alert("Hola");
});

$("#ano").click(function(){
    Llanaryear(); 
});
$("#mes").click(function(){
    Llanarmonth(); 
});
$("#dia").click(function(){
    Llanarday(); 
});
function Llanaryear () 
{
    var yearStart = 1960;
    var yearEnd = 2017;
    var year = [];
  
    while(yearStart < yearEnd+1){
    year.push(yearStart++);
     }
     var ano=document.getElementById("ano");
     for (var i =0;  i<year.length; i++) {
       var option=document.createElement("OPTION"),
       txt=document.createTextNode(year[i]);
       option.appendChild(txt);
       option.setAttribute("value",year[i]);
       ano.insertBefore(option,ano.lastChild);

     }

}
function Llanarmonth()
{
  var month = [];
  for (var i =1; i <= 12; i++) {
       month.push(i);
     }
     var mes=document.getElementById("mes");
     for (var i =0;  i<month.length; i++) {
       var option=document.createElement("OPTION"),
       txt=document.createTextNode(month[i]);
       option.appendChild(txt);
       option.setAttribute("value",month[i]);
       mes.insertBefore(option,mes.lastChild);
     }
}
function Llanarday ()
{
  var day = [];
  for (var i =1; i <= 31; i++) {
       day.push(i);
     }
     var dia=document.getElementById("dia");
     for (var i =0;  i<day.length; i++) {
       var option=document.createElement("OPTION"),
       txt=document.createTextNode(day[i]);
       option.appendChild(txt);
       option.setAttribute("value",day[i]);
       dia.insertBefore(option,dia.lastChild);
     }
}


$("#saveuser").click(function(e){
    validarFrmUsuario(); 
    e.preventDefault(); 
});


function validarFrmUsuario() 
{

                      var verificar=true;
                        var expRegNombres =/^[A-Za-zÁáÉéÍíÓóÚúÜüÑñ]{1,}([\s][A-Za-zÁáÉéÍíÓóÚúÜüÑñ]{1,})+$/;
                        var expRegPais = /^[a-záéíóúñ\s]*$/i;
                        var expRegEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
                        var expRegUrl= /^(http|https|ftp)+\:+\/\/+(www\.|)+[a-z0-9\-\.]+([a-z\.]|)+\.[a-z]{2,4}$/i;
                        var expPrecio=/^([0-9]\s*)*$/;  

                        var formulario=document.getElementById("frmuser");
                        var username= document.getElementById("username");
                        var identificacion=document.getElementById("identificacion");
                        var mes=document.getElementById("mes");
                        var dia=document.getElementById("dia");
                        var ano=document.getElementById("ano");
                        var direccion=document.getElementById("direccion");
                        var celular=document.getElementById("celular");
                        var correo=document.getElementById("correo");
                        var contrasena1=document.getElementById("contrasena1");
                        var contrasena2=document.getElementById("contrasena2");

                        if(!username.value)
                        {
                            document.getElementById("errornombre_us").innerHTML="<div style='color:red;'>Digite el nombre del usuario.</div>";
                            username.style.borderColor = "red";
                            username.focus();
                            verificar=false;
                            return false;
                        }
                        /*else if(!expRegNombres.exec(username.value)){
                        document.getElementById("errornombre_us").innerHTML="<div style='color:red;'>Digite el nombre y el apellido.</div>";
                        username.style.borderColor = "red";
                        username.focus();
                        verificar=false;
                        return false;
                        }*/
                          
                        else if(!identificacion.value)
                        {
                          document.getElementById("erroridentificacion").innerHTML="<div style='color:red;'>Digite la identificacion del usuario.</div>.";
                          identificacion.style.borderColor = "red";
                          identificacion.focus();
                          verificar=false;
                          return false;
                        }
                        else if(!mes.value)
                        {
                          document.getElementById("errormes").innerHTML="<div style='color:red;'>Elige el mes.</div>.";
                          mes.style.borderColor ="red";
                        mes.focus();
                          verificar=false;
                          
                        }
                        else if(!dia.value)
                        {
                          document.getElementById("errordia").innerHTML="<div style='color:red;'>Elige el dia.</div>.";
                          dia.style.borderColor ="red";
                          dia.focus();
                          verificar=false;
                          
                        }
                        else if(!ano.value)
                        {
                          document.getElementById("errorano").innerHTML="<div style='color:red;'>Elige el ano.</div>.";
                          ano.style.borderColor ="red";
                          ano.focus();
                          verificar=false;
                          
                        }
                        else if(!celular.value)
                        {
                          document.getElementById("errorcelular").innerHTML="<div style='color:red;'>Elige el celular.</div>.";
                          celular.style.borderColor ="red";
                          celular.focus();
                          verificar=false;
                          
                        }
                        else if(!expPrecio.exec(celular.value)){
                        document.getElementById("errorcelular").innerHTML="<div style='color:red;'>Se acepta solo numeros.</div>";
                        celular.style.borderColor = "red";
                        celular.focus();
                        verificar=false;
                        return false;
                        }
                        
                        
                       /* else if(!correo.value)
                        {
                          document.getElementById("errorcorreo").innerHTML="<div style='color:red;'>Digite el correo.</div>.";
                          correo.style.borderColor ="red";
                          correo.focus();
                          verificar=false;  
                        }
                        else if(!expRegEmail.exec(correo.value)){
                        document.getElementById("errorcorreo").innerHTML="<div style='color:red;'>Digite un correo válido.</div>";
                        correo.style.borderColor = "red";
                        correo.focus();
                        verificar=false;
                        return false;
                        }*/
                        else if(!contrasena1.value)
                        {
                          document.getElementById("errorcontrasena1").innerHTML="<div style='color:red;'>Digite una contraseña.</div>.";
                          contrasena1.style.borderColor ="red";
                          contrasena1.focus();
                          verificar=false;  
                        }
                        else if(contrasena1.value!=contrasena2.value)
                        {
                          $('#nocoincidelascontrasenas').show();
                          verificar=false;
                          contrasena1.focus();
                          contrasena1.style.borderColor ="red";
                          contrasena2.style.borderColor ="red";


                          document.getElementById("errorcontrasena1").innerHTML="<div style='color:red;'>Las contraseñas no coincide.</div>.";
                          contrasena1.style.borderColor ="red";
                          contrasena1.focus(); 
                          
                          contrasena2.style.borderColor ="red";
                          verificar=false; 
                        }
                        else if(verificar==true)
                        {
                          var formData = new FormData($("#frmuser")[0]);
                                    $.ajax({
                                      url:'../Controlador/Cusuario.php',
                                      type:'POST',
                                      data:formData,
                                      cache:false,
                                      processData:false,
                                      contentType:false,
                                       beforeSend:function(){
                                          $('#info').html('Guardando...');
                                          $('#info').addClass('btn-danger');
                                         },
                                      success:function(resp)
                                       {
                                         alert(resp);
                                         if(resp==='inserto')
                                              {
                                                //alert(resp);
                                                $('#save').show();
                                                ///lista_articulo('',1);
                                                $("#frmuser").trigger('reset');
                                              }
                                              else if(resp==='correo')
                                              {
                                                $('#correo').show();
                                              }
                                              else
                                              {
                                                $('#unsaved').show();
                                              }
                                       
                                       }
                                    }); 
                                     
                                                           
                            
                        }
}




 function lista_usuarios(valor,pagina){
  var pagina=Number(pagina);
  $.ajax({
    url:'../Controlador/Cusuario.php',
    type:'POST',
    data:'valor='+valor+'&pagina='+pagina+'&boton=buscar'
  }).done(function(resp){
    //alert(resp);
    
    var d=resp.split("*");
    //Imprimimos los registro en nuestra Table
    var valores = eval(d[0]);
    html="<table class='table table-bordered'><thead><tr><th>Nº</th><th>Código</th><th>Nombre</th><th>Cédula</th><th>Teléfono</th><th>Correo</th><th>Dirección</th><th>Foto</th><th>Opciones</th></tr></thead><tbody>";
    for(i=0;i<valores.length;i++){
      var cont=i+1;
      datos=valores[i]["codigo_usuario"]+"*"+valores[i]["nombre"]+"*"+valores[i]["direccion"]+"*"+valores[i]["identificacion"]+"*"+valores[i]["fecha_nacimiento"]+"*"+valores[i]["fecha_registro"]+"*"+valores[i]["telefono"]+"*"+valores[i]["celular"]+"*"+valores[i]["whatsapp"]+"*"+valores[i]["web"]+"*"+valores[i]["correo"]+"*"+valores[i]["sexo"]+"*"+valores[i]["codigo_ubicacion"]+"*"+valores[i]["limite__credito"]+"*"+valores[i]["condicion_pago"]+"*"+valores[i]["login"]+"*"+valores[i]["clave"]+"*"+valores[i]["tipo_usuario"]+"*"+valores[i]["estado"]+"*"+valores[i]["foto"]+"*"+valores[i]["rnc"]+"*"+valores[i]["sueldo"]+"*"+valores[i]["fecha_ingreso"]+"*"+valores[i]["usuario_registro"]+"*"+valores[i]["Hora"]+"*"+valores[i]["Dispositivo"]+"*"+valores[i]["codigo_sucursal"];
      html+="<tr><td>"+cont+"</td><td>"+valores[i]["codigo_usuario"]+"</td><td>"+valores[i]["nombre"]+"</td><td>"+valores[i]["identificacion"]+"</td><td>"+valores[i]["celular"]+"</td><td>"+valores[i]["correo"]+"</td><td>"+valores[i]["direccion"]+"</td><td><img src='../Resources/img/usuarios/"+valores[i]["foto"]+"' width='50px' height='50px'></td><td><button class='btn btn-warning' data-toggle='modal' data-target='#articulos' onclick='mostrar_usuario("+'"'+datos+'"'+");'><span class='glyphicon glyphicon-pencil'></span></button> <button class='btn btn-danger' onclick='eliminar("+'"'+valores[i]["codigo_articulo"]+'"'+")'><span class='glyphicon glyphicon-trash'></span></button></td></tr>";
    }
    html+="</tbody></table>"
    $("#lista_usuarios").html(html);

    var totalreg= d[1];
    var nropaginador=Math.ceil(totalreg/3);
    var campobuscar=$("#buscar").val();
    //alert(nropaginador);
    paginar="<ul class='pagination'>";
    if(pagina>1)
    {
      paginar+="<li><a href='javascript:void(0)' onclick='lista_articulo("+'"'+campobuscar+'","'+1+'"'+")'>&laquo;</a></li>";
      paginar+="<li><a href='javascript:void(0)' onclick='lista_articulo("+'"'+campobuscar+'","'+(pagina-1)+'"'+")'>&lsaquo;</a></li>";

    }
    else
    {
      paginar+="<li class='disabled'><a href='javascript:void(0)'>&laquo;</a></li>";
      paginar+="<li class='disabled'><a href='javascript:void(0)'>&lsaquo;</a></li>";
    }

      limite = 10;
 
      div = Math.ceil(limite / 2);

      pagInicio = (pagina > div) ? (pagina - div) : 1;

      if (nropaginador > div)
      {
        pagRestantes = nropaginador - pagina;
        pagFin = (pagRestantes > div) ? (pagina + div) :nropaginador;
      }
      else 
      {
        pagFin = nropaginador;
      }
      for(i=pagInicio;i<=pagFin;i++){
        if(i==pagina)
          paginar+="<li class='active'><a href='javascript:void(0)'>"+i+"</a></li>";
        else
          paginar+="<li><a href='javascript:void(0)' onclick='lista_articulo("+'"'+campobuscar+'","'+i+'"'+")'>"+i+"</a></li>";
      }
    
    if(pagina<nropaginador)
    {
      paginar+="<li><a href='javascript:void(0)' onclick='lista_articulo("+'"'+campobuscar+'","'+(pagina+1)+'"'+")'>&rsaquo;</a></li>";
      paginar+="<li><a href='javascript:void(0)' onclick='lista_articulo("+'"'+campobuscar+'","'+nropaginador+'"'+")'>&raquo;</a></li>";

    }
    else
    {
      paginar+="<li class='disabled'><a href='javascript:void(0)'>&rsaquo;</a></li>";
      paginar+="<li class='disabled'><a href='javascript:void(0)'>&raquo;</a></li>";
    }
    paginar+="</ul>";
    $("#paginador_usuarios").html(paginar);
    
  });
}

function mostrar_usuario(datos){
  //alert(datos);
  var d=datos.split("*");
  alert(d);
  $("#act_codigo_usuario").val(d[0]);
  $("#act_nombre").val(d[1]);
  $("#act_direccion").val(d[2]);
  $("#act_identificacion").val(d[3]);
  $("#act_telefono").val(d[6]);
  $("#act_celular").val(d[7]);
  $("#act_whatsapp").val(d[8]);
  $("#act_correo").val(d[10]);
  $("#sexo").val(d[11]);
  
  $("#act_login").val(d[15]);
  
  $("#act_tipo_usuario").val(d[17]);
  $("#act_estado").val(d[18]);
  $("#sucursal").val(d[26]);
}

function actualizar_usuario()
 {
  var formData = new FormData($("#actualizar_usuario")[0]);
  $.ajax({
    url:'../Controlador/Cusuario.php',
    type:'POST',
    data:formData,
    cache:false,
    processData:false,
    contentType:false,
     success:function(response)
              {
                alert(response);
                if(response==='true')
                {
                  $('#exito').show();
                  lista_articulo('',1);
                }
                else
                {
                  $('#fail').show();
                }
              }
 });
}

























































































































	



 

 
    








