


/*$("#savecliente").click(function(){
    validarFrmCliente(); 
});

$("#anoCliente").click(function(){
    Llanaryear(); 
});
$("#mesCliente").click(function(){
    Llanarmonth(); 
});
$("#diaCliente").click(function(){
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
     var ano=document.getElementById("anoCliente");
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
     var mes_cliente=document.getElementById("mes_cliente");
     for (var i =0;  i<month.length; i++) {
       var option=document.createElement("OPTION"),
       txt=document.createTextNode(month[i]);
       option.appendChild(txt);
       option.setAttribute("value",month[i]);
       mes_cliente.insertBefore(option,mes_cliente.lastChild);
     }
}
function Llanarday ()
{
  var day = [];
  for (var i =1; i <= 31; i++) {
       day.push(i);
     }
     var dia=document.getElementById("diaCliente");
     for (var i =0;  i<day.length; i++) {
       var option=document.createElement("OPTION"),
       txt=document.createTextNode(day[i]);
       option.appendChild(txt);
       option.setAttribute("value",day[i]);
       dia.insertBefore(option,dia.lastChild);
     }
}*/


$("#saveCliente").click(function(e){
    validarFrmCliente();
    e.preventDefault(); 
});


function validarFrmCliente() 
{

                      var verificar=true;
                        var expRegNombres =/^[A-Za-zÁáÉéÍíÓóÚúÜüÑñ]{1,}([\s][A-Za-zÁáÉéÍíÓóÚúÜüÑñ]{1,})+$/;
                        var expRegPais = /^[a-záéíóúñ\s]*$/i;
                        var expRegEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
                        var expRegUrl= /^(http|https|ftp)+\:+\/\/+(www\.|)+[a-z0-9\-\.]+([a-z\.]|)+\.[a-z]{2,4}$/i;
                        var expPrecio=/^([0-9]\s*)*$/;  

                        var formulario=document.getElementById("frmClientes");
                        var nombreCliente= document.getElementById("nombreCliente");
                        var identificacionCliente=document.getElementById("identificacionCliente");
                        var fecha_nacimiento=document.getElementById("fecha_nacimiento");
                        var diaCliente=document.getElementById("diaCliente");
                        var anoCliente=document.getElementById("anoCliente");
                        var direccionCliente=document.getElementById("direccionCliente");
                        var celularCliente=document.getElementById("celularCliente");
                        var correoCliente=document.getElementById("correoCliente");
                        var sexoCliente=document.getElementById("sexoCliente");
                       
                      

                        if(nombreCliente.value=="")
                        {
                            document.getElementById("errornombre_cli").innerHTML="<div style='color:red;'>Digite el nombre del cliente.</div>";
                            nombreCliente.style.borderColor = "red";
                           nombreCliente.focus();
                            verificar=false;
                            return false;
                        }
                        else if(!expRegNombres.exec(nombreCliente.value)){
                        document.getElementById("errornombre_cli").innerHTML="<div style='color:red;'>Digite el nombre y el apellido.</div>";
                        nombreCliente.style.borderColor = "red";
                        nombreCliente.focus();
                        verificar=false;
                        return false;
                        }
                          
                        else if(identificacionCliente.value=="")
                        {
                          document.getElementById("erroridentificacion_cli").innerHTML="<div style='color:red;'>Digite la identificacion del cliente.</div>.";
                          identificacionCliente.style.borderColor = "red";
                          identificacionCliente.focus();
                          verificar=false;
                          return false;
                        }
                        else if(fecha_nacimiento.value="")
                        {
                          document.getElementById("errormes_cli").innerHTML="<div style='color:red;'>Elige el mes.</div>.";
                          fecha_nacimiento.style.borderColor ="red";
                        
                          verificar=false;
                          
                        }
                        /*else if(diaCliente.value=="")
                        {
                          document.getElementById("errordia_cli").innerHTML="<div style='color:red;'>Elige el dia.</div>.";
                          diaCliente.style.borderColor ="red";
                          
                          verificar=false;
                          
                        }*/
                        /*else if(anoCliente.value=="")
                        {
                          document.getElementById("errorano_cli").innerHTML="<div style='color:red;'>Elige el ano.</div>.";
                          anoCliente.style.borderColor ="red";
                          
                          verificar=false;
                          
                        }*/
                        else if(celularCliente.value=="")
                        {
                          document.getElementById("errorcelular_cli").innerHTML="<div style='color:red;'>Elige el celular.</div>.";
                          celularCliente.style.borderColor ="red";
                          celularCliente.focus();
                          verificar=false;
                          
                        }
                        else if(!expPrecio.exec(celularCliente.value)){
                        document.getElementById("errorcelular_cli").innerHTML="<div style='color:red;'>Se acepta solo numeros.</div>";
                        celularCliente.style.borderColor = "red";
                        celularCliente.focus();
                        verificar=false;
                        return false;
                        }
                        
                        
                       
                        else if(!expRegEmail.exec(correoCliente.value)){
                        document.getElementById("errorcorreo_cli").innerHTML="<div style='color:red;'>Digite un correo válido.</div>";
                        correoCliente.style.borderColor = "red";
                        correoCliente.focus();
                        verificar=false;
                        return false;
                        } 
                         else if(sexoCliente.value=="")
                        {
                          document.getElementById("errorsexo_cli").innerHTML="<div style='color:red;'>Elige el sexo del cliente.</div>.";
                          sexoCliente.style.borderColor ="red";
                          sexoCliente.focus();
                          verificar=false;
                          
                        }
                        else if(verificar==true)
                        {
                          var formData = new FormData($("#frmuClientes")[0]);
                                    $.ajax({
                                      url:'../Controlador/Ccliente.php',
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
                                         if(resp==='true')
                                              {
                                                //alert(resp);
                                                $('#save').show();
                                                ///lista_articulo('',1);
                                                $("#frmuser").trigger('reset');
                                              }
                                              else
                                              {
                                                $('#exist').show();
                                              }
                                       
                                       }
                                    }); 
                                     
                                                           
                            
                        }
}




 function lista_cliente(valor,pagina){
  var pagina=Number(pagina);
  $.ajax({
    url:'../Controlador/Ccliente.php',
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
      html+="<tr><td>"+cont+"</td><td>"+valores[i]["codigo_usuario"]+"</td><td>"+valores[i]["nombre"]+"</td><td>"+valores[i]["identificacion"]+"</td><td>"+valores[i]["celular"]+"</td><td>"+valores[i]["correo"]+"</td><td>"+valores[i]["direccion"]+"</td><td><img src='../Resources/img/clientes/"+valores[i]["foto"]+"' width='50px' height='50px'></td><td><button class='btn btn-warning' data-toggle='modal' data-target='#articulos' onclick='mostrar_cliente("+'"'+datos+'"'+");'><span class='glyphicon glyphicon-pencil'></span></button> <button class='btn btn-danger' onclick='eliminar("+'"'+valores[i]["codigo_articulo"]+'"'+")'><span class='glyphicon glyphicon-trash'></span></button></td></tr>";
    }
    html+="</tbody></table>"
    $("#lista_cliente").html(html);

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
    $("#paginador_cliente").html(paginar);
    
  });
}

function mostrar_cliente(datos){
  //alert(datos);
  var d=datos.split("*");
  //alert(d);
  $("#act_codigo_usuario").val(d[0]);
  $("#act_nombre").val(d[1]);
  $("#act_direccion").val(d[2]);
  $("#act_identificacion").val(d[3]);
  $("#act_telefono").val(d[6]);
  $("#act_celular").val(d[7]);
  $("#act_whatsapp").val(d[8]);
  $("#act_correo").val(d[10]);
  $("#sexo").val(d[11]);
  $("#act_estado").val(d[18]);

}

function actualizar_cliente()
 {
  var formData = new FormData($("#actualizar_cliente")[0]);
  $.ajax({
    url:'../Controlador/Ccliente.php',
    type:'POST',
    data:formData,
    cache:false,
    processData:false,
    contentType:false,
     success:function(response)
              {
                //alert(response);
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

























































































































	



 

 
    








