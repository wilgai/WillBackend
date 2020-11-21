function registrarGasto()
{
 var expPrecio=/^[0-9]+([.])?([0-9]+)?$/;
  verficar=true;
  var codigoSuplidorGasto=document.getElementById("codigoSuplidor");
  var nombreSuplidorGasto=document.getElementById("nombreSuplidorGasto");
  var monto=document.getElementById("monto");

  if(codigoSuplidorGasto.value=="")
  {
    document.getElementById("errorcodigoSuplidor").innerHTML="<div style='color:red;'>Digite el codigo del suplidor.</div>";
  codigoSuplidorGasto.style.borderColor = "red";
  codigoSuplidorGasto.focus();
  verficar=false;
  }
  else if(!expPrecio.exec(codigoSuplidorGasto.value)){
  document.getElementById("errorcodigoSuplidor").innerHTML="<div style='color:red;'>Solamente se acepta numero.</div>";
  codigoSuplidorGasto.style.borderColor = "red";
  codigoSuplidorGasto.focus();
  verficar=false;

  }
  if(monto.value=="")
  {
    document.getElementById("errorgasto").innerHTML="<div style='color:red;'>Digite el monto del gasto.</div>";
  monto.style.borderColor = "red";
  monto.focus();
  verficar=false;

  }
  else if(!expPrecio.exec(monto.value)){
  document.getElementById("errorgasto").innerHTML="<div style='color:red;'>Solamente se acepta numero.</div>";
  monto.style.borderColor = "red";
  monto.focus();
  verficar=false;

  }

   else if(nombreSuplidorGasto.value=="")
   {
     document.getElementById("errorNombre").innerHTML="<div style='color:red;'>Digite el nombre del suplidor.</div>";
  nombreSuplidorGasto.style.borderColor = "red";
  nombreSuplidorGasto.focus();
  verficar=false;

   }
   
   else if(verficar==true)
   {
      var codigoSuplidor=$("#codigoSuplidor").val();
  var ncf=$("#ncf").val();
  var referencia=$("#referencia").val();
  var descuento='';
  var detalle=$("#detalle").val();
  var totaln=$("#monto").val();
  var itbistot=$("#impuesto").val();
  var opcion="documento"
  var boton="registrarDocumentoGasto";
  
  $.ajax({
    url:'../Controlador/Ccompra.php',
    type:'POST',
    data:{codigoSuplidor:codigoSuplidor,
          ncf:ncf,
          referencia:referencia,
          descuento:descuento,
          detalle:detalle,
          totaln:totaln,
          itbistot:itbistot,
          opcion:opcion,
          boton:boton
         },
    beforeSend:function(){
            alert("hai");
           },
    success:function(data)
       {         if(data==1)
                {
                  $('#save').show();
                  //lista_articulo('',1);
                  $("#frmgasto").trigger('reset');
                }
                else
                {
                  $('#unsaved').show();
                }                                                             
       }
   }); 
}
   
}

function lista_suplidorGasto(valor,pagina){
  var pagina=Number(pagina);
  $.ajax({
    url:'../Controlador/Cdocumento.php',
    type:'POST',
    data:'valor='+valor+'&pagina='+pagina+'&boton=sup_gasto'+'&opcion=""'
  }).done(function(resp){
    //alert(resp);
    
    var d=resp.split("*");
    


    var valores = eval(d[0]);
    html="<table class='table table-bordered'><thead><tr><th>Código</th><th>Nombre</th><th>Correo</th><th>Dirección</th><th>Foto</th><th>Opciones</th></tr></thead><tbody>";
    for(i=0;i<valores.length;i++){
      var cont=i+1;
      datos=valores[i]["codigo_usuario"]+"*"+valores[i]["nombre"]+"*"+valores[i]["direccion"]+"*"+valores[i]["identificacion"]+"*"+valores[i]["fecha_nacimiento"]+"*"+valores[i]["fecha_registro"]+"*"+valores[i]["telefono"]+"*"+valores[i]["celular"]+"*"+valores[i]["whatsapp"]+"*"+valores[i]["web"]+"*"+valores[i]["correo"]+"*"+valores[i]["sexo"]+"*"+valores[i]["codigo_ubicacion"]+"*"+valores[i]["limite__credito"]+"*"+valores[i]["condicion_pago"]+"*"+valores[i]["login"]+"*"+valores[i]["clave"]+"*"+valores[i]["tipo_usuario"]+"*"+valores[i]["estado"]+"*"+valores[i]["foto"]+"*"+valores[i]["rnc"]+"*"+valores[i]["sueldo"]+"*"+valores[i]["fecha_ingreso"]+"*"+valores[i]["usuario_registro"]+"*"+valores[i]["Hora"]+"*"+valores[i]["Dispositivo"]+"*"+valores[i]["codigo_sucursal"];
      html+="<tr><td>"+valores[i]["codigo_usuario"]+"</td><td>"+valores[i]["nombre"]+"</td><td>"+valores[i]["correo"]+"</td><td>"+valores[i]["direccion"]+"</td><td><img src='../Resources/img/clientes/"+valores[i]["foto"]+"' width='50px' height='50px'></td><td><button  class='btn btn-success' onclick='seleccionarSuplidorGasto("+'"'+datos+'"'+");' class='close' data-dismiss='modal' ><span class='glyphicon glyphicon-ok'></span></button></td></tr>";
    }
    html+="</tbody></table>"
    $("#buscarSuplidorGasto").html(html);
   
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
    $("#paginadorSuplidorGasto").html(paginar);
    
  });
}
function seleccionarSuplidorGasto(datos)
{
  var d=datos.split("*");
  //alert(d.length);
  $("#codigoSuplidor").val(d[0]);
  $("#nombreSuplidorGasto").val(d[1]);
  //alert(d);
}
function lista_gastos(valor,pagina){
  var pagina=Number(pagina);
  
  var opcion='';
  var boton='buscarGastos';
  $.ajax({
    url:'../Controlador/Ccompra.php',
    type:'POST',
    data:{valor:valor,boton:boton,opcion:opcion}
  }).done(function(resp){
    //alert(resp);
    
    var d=resp.split("*");
    


    var valores = eval(d[0]);
    html="<table class='table table-bordered'><thead><tr><th>Nº</th><th>Codigo</th><th>Descripcion</th><th>Monto Total</th><th>Entidad</th><th>Fecha de pagodo</th><th>Registrado por</th><th>Estado</th><th>Opcion</th></tr></thead><tbody>";
    for(i=0;i<valores.length;i++){
      var cont=i+1;
      var estado='';
       if(valores[i]["estado"]==1)  
          {
            estado = '<span class="label label-success">Active</span>';
          }  
          else{estado = '<span class="label label-danger">Active</span>';}

      datos=valores[i]["id_documento"];
      html+="<tr><td>"+cont+"</td><td>"+valores[i]["id_documento"]+"</td><td>"+valores[i]["detalle"]+"</td><td>"+valores[i]["monto"]+"</td><td>"+valores[i]["entidad"]+"</td><td>"+valores[i]["fecha"]+"</td><td>"+valores[i]["nombre"]+"</td><td>"+estado+"</td><td><button class='btn btn-warning' data-toggle='modal' data-target='#articulos' onclick='mostrarGasto("+'"'+datos+'"'+");'><span class='glyphicon glyphicon-pencil'></span></button> <button class='btn btn-danger' onclick='eliminargasto("+'"'+valores[i]["id_documento"]+'"'+")'><span class='glyphicon glyphicon-trash'></span></button></td></tr>";
    }
    html+="</tbody></table>"
    $("#listaGasto").html(html);

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
    $("#paginadorGasto").html(paginar);
    
  });
}
