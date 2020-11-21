
/*$('#cod_producto').typeahead({

  source:function(query,result){
    alert("hi");
    $.ajax({
    url:'../Controlador/Ccompra.php',
    method:"POST",
    data:'query='+query+'&boton=buscar1',
    dataType:"json",
         success: function(data){
                  //alert(resp);
                result(data);
                alert("nada");
                            
      }

    });
  }
});

function load_producto(valor,pagina)
 {
   var boton="buscar";
  $.ajax({
   url:"../controler/Ccompra.php",
   method:"POST",
   data:'valor='+valor+'&pagina='+pagina+'&boton=buscar',
   success:function(data)
   {

    //alert(data);
     
    var l=data.split("*");
    var valores = eval(l[0]);
    for(i=0;i<valores.length;i++){
      data=valores[i]["codigo_articulo"]+"*"+valores[i]["nombre"];
    }
       var d=data.split("*");
        //alert(d);
          $("#codigoCliente").val(d[0]);
          $("#nombreCliente").val(d[1]);
          $("#idCliente").val(d[3]);
   }

  });
 }

$('#search_area_producto').on('click','li', function(){
  var valor = $(this).text();
  load_producto(valor,1);
 })*/

function lista_productoC(valor,pagina){
  var pagina=Number(pagina);
  $.ajax({
    url:'../Controlador/Ccompra.php',
    type:'POST',
    data:'valor='+valor+'&pagina='+pagina+'&boton=buscarProd'+'&opcion=""'
  }).done(function(resp){
    alert(resp);
    
    var d=resp.split("*");
    


    var valores = eval(d[0]);
    html="<table class='table table-bordered'><thead><tr><th>Nº</th><th>Codigo</th><th>Nombre</th><th>Costo</th><th>Precio</th><th>Foto</th><th>Opciones</th></tr></thead><tbody>";
    for(i=0;i<valores.length;i++){
      var cont=i+1;
      datos=valores[i]["codigo_articulo"]+"*"+valores[i]["nombre"]+"*"+valores[i]["codigo_suplidor"]+"*"+valores[i]["usuario_registro"]+"*"+valores[i]["fecha_registro"]+"*"+valores[i]["fecha_actualizacion"]+"*"+valores[i]["tipo_impuesto"]+"*"+valores[i]["estado"]+"*"+valores[i]["costo"]+"*"+valores[i]["precio"]+"*"+valores[i]["codigo_subcategoria"]+"*"+valores[i]["referencia_interna"]+"*"+valores[i]["referencia_suplidor"]+"*"+valores[i]["foto"]+"*"+valores[i]["reorden"]+"*"+valores[i]["oferta"]+"*"+valores[i]["modificar_precio"]+"*"+valores[i]["acepta_descuento"]+"*"+valores[i]["detalle"]+"*"+valores[i]["codigo_marca"]+"*"+valores[i]["porciento_beneficio"]+"*"+valores[i]["porciento_minimo"]+"*"+valores[i]["modelo"];
      html+="<tr><td>"+cont+"</td><td>"+valores[i]["codigo_articulo"]+"</td><td>"+valores[i]["nombre"]+"</td><td>"+valores[i]["costo"]+"</td><td>"+valores[i]["precio"]+"</td><td><img src='../Resources/img/producto/"+valores[i]["foto"]+"' width='50px' height='50px'></td><td><button  class='btn btn-success' onclick='seleccionarProducto("+'"'+datos+'"'+");' class='close' data-dismiss='modal' ><span class='glyphicon glyphicon-ok'></span></button></td></tr>";
    }
    html+="</tbody></table>"
    $("#buscarArticulo").html(html);

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
    $("#paginadorArticulo").html(paginar);
    
  });
}
function seleccionarProducto(datos)
{
  var d=datos.split("*");
  //alert(d.length);
  $("#cod_producto").val(d[0]);
  $("#descripcion").val(d[1]);
  //alert(d);
}

var chkitbis = $("#chkitbis");
chkitbis.change(function(event) {
    calcularPrecioVenta ();
});

function calcularPrecioVentaa () 
{
  var itbis=0;
  var ganancia =$("#ganancia").val();
  var prec_com =$("#costo").val();

if($("#chkitbis").is(':checked')) {  
            //$('#chkitbis').val("18.00%");
            itbis=parseFloat(prec_com)*(18/100);

        } else {  
            //$('#chkitbis').val("0.00%");
            itbis=0;
        }  

  if(ganancia!="" && prec_com!="" )
  {
    var beneficio=(parseFloat(ganancia)/100)*parseFloat(prec_com);
    
      $("#precio").val(parseFloat(beneficio)+parseFloat(prec_com)+itbis);
  }
  else if(prec_com!="")
  {
     $("#precio").val(prec_com);
  }
}

function lista_suplidor(valor,pagina){
  var pagina=Number(pagina);
  $.ajax({
    url:'../Controlador/Ccompra.php',
    type:'POST',
    data:'valor='+valor+'&pagina='+pagina+'&boton=buscarSup'+'&opcion=""'
  }).done(function(resp){
    alert(resp);
    
    var d=resp.split("*");
    


    var valores = eval(d[0]);
    html="<table class='table table-bordered'><thead><tr><th>Nº</th><th>Código</th><th>Nombre</th><th>Correo</th><th>Dirección</th><th>Foto</th><th>Opciones</th></tr></thead><tbody>";
    for(i=0;i<valores.length;i++){
      var cont=i+1;
      datos=valores[i]["codigo_usuario"]+"*"+valores[i]["nombre"]+"*"+valores[i]["direccion"]+"*"+valores[i]["identificacion"]+"*"+valores[i]["fecha_nacimiento"]+"*"+valores[i]["fecha_registro"]+"*"+valores[i]["telefono"]+"*"+valores[i]["celular"]+"*"+valores[i]["whatsapp"]+"*"+valores[i]["web"]+"*"+valores[i]["correo"]+"*"+valores[i]["sexo"]+"*"+valores[i]["codigo_ubicacion"]+"*"+valores[i]["limite__credito"]+"*"+valores[i]["condicion_pago"]+"*"+valores[i]["login"]+"*"+valores[i]["clave"]+"*"+valores[i]["tipo_usuario"]+"*"+valores[i]["estado"]+"*"+valores[i]["foto"]+"*"+valores[i]["rnc"]+"*"+valores[i]["sueldo"]+"*"+valores[i]["fecha_ingreso"]+"*"+valores[i]["usuario_registro"]+"*"+valores[i]["Hora"]+"*"+valores[i]["Dispositivo"]+"*"+valores[i]["codigo_sucursal"];
      html+="<tr><td>"+cont+"</td><td>"+valores[i]["codigo_usuario"]+"</td><td>"+valores[i]["nombre"]+"</td><td>"+valores[i]["correo"]+"</td><td>"+valores[i]["direccion"]+"</td><td><img src='../Resources/img/clientes/"+valores[i]["foto"]+"' width='50px' height='50px'></td><td><button  class='btn btn-success' onclick='seleccionarSuplidor("+'"'+datos+'"'+");' class='close' data-dismiss='modal' ><span class='glyphicon glyphicon-ok'></span></button></td></tr>";
    }
    html+="</tbody></table>"
    $("#buscarSuplidor").html(html);
   
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
    $("#paginadorSuplidor").html(paginar);
    
  });
}
function seleccionarSuplidor(datos)
{
  var d=datos.split("*");
  //alert(d.length);
  $("#codigoSuplidor").val(d[0]);
  $("#nombreSuplidor").val(d[1]);
  //alert(d);
}

 $("#btnagregarCompra").click(function(){
   validar_Compra ();
   //alert("Heyy");
 });

function validar_Compra () {
  

  var verificar=true;
  
  var expPrecio=/^[0-9]+([.])?([0-9]+)?$/;  
    var formulario=document.getElementById("formulario");
  var cod_producto= document.getElementById("cod_producto");
  var descripcion=document.getElementById("descripcion");
  var cantidad=document.getElementById("cantidad");
  var descuento=0;
  var itbis=0;
  var ncf=document.getElementById("ncf");
  var referencia=document.getElementById("creferencia");
  
  var precio=0;
  var detalle=document.getElementById("detalle");


  if(!cod_producto.value)
  {
      document.getElementById("error_codigo").innerHTML="<div style='color:red;'>Digite el codigo.</div>";
      cod_producto.style.borderColor = "red";
    cod_producto.focus();
    verificar=false;
    return false;
  }
    
    /*else if(!expPrecio.exec(cod_producto.value)){
  document.getElementById("error_codigo").innerHTML="<div style='color:red;'>Solamente se acepta numero.</div>";
  cod_producto.style.borderColor = "red";
  cod_producto.focus();
  verificar=false;
  return false;
  }*/

  if(!descripcion.value)
  {
      document.getElementById("error_descripcion").innerHTML="<div style='color:red;'>Digite el nombre de la descripcion.</div>";
      descripcion.style.borderColor = "red";
    descripcion.focus();
    verificar=false;
    return false;
  }
    
  /*else if(!precio.value)
  {
    document.getElementById("error_precio").innerHTML="<div style='color:red;'>Digite el costo.</div>.";
    precio.style.borderColor = "red";
    precio.focus();
    verificar=false;
    return false;
  }*/
  /*else if(!expPrecio.exec(precio.value)){
  document.getElementById("error_precio").innerHTML="<div style='color:red;'>Solamente se acepta numero.</div>";
  precio.style.borderColor = "red";
  precio.focus();
  verificar=false;
  return false;
  }
  
  else if(!expPrecio.exec(precio.value)){
  document.getElementById("errorprecio").innerHTML="<div style='color:red;'>Solamente se acepta numero.</div>";
  precio.style.borderColor = "red";
  precio.focus();
  verificar=false;
  return false;
  }*/
  else if(!cantidad.value)
  {
    document.getElementById("error_cantidad").innerHTML="<div style='color:red;'>Digite una cantidad.</div>.";
    cantidad.style.borderColor ="red";
    cantidad.focus();
    verificar=false;
    
  }
  else if(!expPrecio.exec(cantidad.value)){
  document.getElementById("error_cantidad").innerHTML="<div style='color:red;'>Solamente se acepta numero.</div>";
  cantidad.style.borderColor = "red";
  cantidad.focus();
  verificar=false;
  return false;
  }
  
   if(verificar==true){
    //$("#costo").hide();
    
       anadirCompra();
       sumar();
      
     }
     

}

var cont=0;

var contfila=0;
 function anadirCompra() {
   
   var itbis=0;
   var existe=0;
   var index=0;

  var cod_producto =$("#cod_producto").val();
  var descripcion =$("#descripcion").val();
  var cantidad =$("#cantidad").val();
 
  var costo =$("#costo").val();

     //$('#chkitbis').val("18.00%");
            itbis=(parseFloat(costo)*(18/100))*parseFloat(cantidad);

        

  var importe=parseFloat(cantidad)*parseFloat(costo);
  //cont++;

if(contfila===0)
    {
      
      cont++;
      var fila='<tr class="datos" id="'+cont+'"><td>'+cont+'</td><td>'+cod_producto+'</td><td>'+descripcion+'</td><td>'+cantidad+'</td><td>'+costo+'</td><td>'+importe+'</td><td><button class="btn btn-danger" onclick="quitar('+cont+'); sumar();"><span class="glyphicon glyphicon-remove"></span></button></td></tr>';
      $('#tablaCompra').append(fila);
      contfila++;
       redondear();
    }
    else
    {
       $('#tablaCompra tr.datos').each(function(){ 
         if($(this).find('td').eq(1).text()==cod_producto)
         {
          existe=1;
          index=$(this).find('td').eq(0).text();

         }   
       })
    
        var cant=0;
       if(existe===1)
       {
           cant=parseFloat($('#'+index).find('td').eq(3).text())+parseFloat(cantidad);
           $('#'+index).find('td').eq(3).html(cant);
           
         
          
           var importe=parseFloat($('#'+index).find('td').eq(3).text())*parseFloat($('#'+index).find('td').eq(4).text());
           $('#'+index).find('td').eq(5).html(importe);
           //alert("Es la cantidad "+cant);
           
       }
       else
       {
         var fila='<tr class="datos" id="'+cont+'"><td>'+cont+'</td><td>'+cod_producto+'</td><td>'+descripcion+'</td><td>'+cantidad+'</td><td>'+costo+'</td><td>'+importe+'</td><td><button class="btn btn-danger" onclick="quitar('+cont+'); sumar();"><span class="glyphicon glyphicon-remove"></span></button></td></tr>';
      $('#tablaCompra').append(fila);
      
       redondear();
         cont++;
         
         contfila++;
        
       }
    }



 }
 /*Funcion para quitar una fila a la tabla.
***********************************************************/
 function quitar(id_fila)
 {
    $('#'+id_fila).remove();
    redondear();
    
 }
 /*Redondeo las filas de la tabla cuando se quita una fila.
***********************************************************/
 function redondear () {
  var num=1;
  $('#tabla tbody tr').each(function(){
      $(this).find('td').eq(0).text(num);
      num++;
  });
 }

 function sumar() {
  
  var sumab = 0;
  var suman = 0;
  var tot_itbis=0;
  var it=0;
  var tot_bis=0;
$('#tablaCompra tr.datos').each(function(){ //filas con clase 'dato', especifica una clase, asi no tomas el nombre de las columnas
 sumab += parseFloat($(this).find('td').eq(5).text()||0,10) //numero de la celda 3
})
alert(sumab);

suman =sumab+tot_itbis;
$('#totalb').val(sumab);
$('#totaln').val(suman);
$('#itbistot').val(tot_itbis);
}

$("#saveCompra").click(function(){
 var expPrecio=/^[0-9]+([.])?([0-9]+)?$/;
  
  var codigoSuplidor=document.getElementById("codigoSuplidor");
  var nombreSuplidor=document.getElementById("nombreSuplidor");
  var tipoPedido=document.getElementById("tipoPedido");
  if(codigoSuplidor.value=="")
  {
    document.getElementById("errorcodigoSuplidor").innerHTML="<div style='color:red;'>Digite el codigo del suplidor.</div>";
  codigoSuplidor.style.borderColor = "red";
  codigoSuplidor.focus();
  }
  else if(!expPrecio.exec(codigoSuplidor.value)){
  document.getElementById("errorcodigoSuplidor").innerHTML="<div style='color:red;'>Solamente se acepta numero.</div>";
  codigoSuplidor.style.borderColor = "red";
  codigoSuplidor.focus();
  }

   else if(nombreSuplidor.value=="")
   {
     document.getElementById("errorNombre").innerHTML="<div style='color:red;'>Digite el nombre del suplidor.</div>";
  nombreSuplidor.style.borderColor = "red";
  nombreSuplidor.focus();
   }
   
   else
   {
    venta();
   }
});

function venta()
{
  var codigoSuplidor=$("#codigoSuplidor").val();
  var ncf=$("#ncf").val();
  var referencia=$("#referencia").val();
  var descuento=0;
  var detalle=$("#detalle").val();
  var totaln=$("#totaln").val();
  var itbistot=0;
  var opcion="documento"
  var boton="registrarDocumento";
  $.ajax({
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
         type: 'POST',
         url : '../Controlador/Ccompra.php',
         success: function(resp){
                  alert(resp);
                if(resp==1)
                {
                  //alert(resp);
                      detalleVenta();
                      $('#codigoCliente').val('');
                      $('#referencia').val('');
                      $('#detalle').val('');
                      $('#ncf').val('');
                      $('#nombreCliente').val('');
                }
                            
      }

        });
}
var numFac=0;
function detalleVenta()
{
var i, items, item, dataItem, data = [];
var cols = [ "numItem","codigo_articulo","descripcion", "cantidad", "costo", "precio",
 "itbis","importe" ];

$("#tablaCompra tr").each(function() {
    items = $(this).children('td');

    if(items.length === 0) { // return if this tr only contains th
        return;
    }
    dataItem = {};
    for(i = 0; i < cols.length; i+=1) {
        item = items.eq(i);
        if(item) {
            dataItem[cols[i]] = item.html();
        }
    }
    data.push(dataItem);
});
    
var datos= JSON.stringify(data);
alert(datos);
//console.log(datos);

$.ajax({
    data:"arreglo="+datos +'&boton=registrarDetalleDocumento'+'&opcion=documento',
    type: 'POST',
    url : '../Controlador/Ccompra.php',
    success: function(resp){
      alert(resp);
      
          $('#info').fadeIn().html(' <div style="font-size: 20px;"  class="alert alert-success">'+resp+'</div>');
         

      
      }
  });
}
  
function lista_compra(valor,pagina){
  var pagina=Number(pagina);
  var start_date=$('#start_date').val();
  var end_date=$('#end_date').val();
  var valor=valor;
  var opcion='';
  var boton='buscarCompra';
  $.ajax({
    url:'../Controlador/Ccompra.php',
    type:'POST',
    data:{valor:valor,start_date:start_date,end_date:end_date,boton:boton,opcion:opcion}
  }).done(function(resp){
    //alert(resp);
    
    var d=resp.split("*");
    


    var valores = eval(d[0]);
    html="<table class='table table-bordered'><thead><tr><th>Nº</th><th>Codigo</th><th>Provedor</th><th>Monto Total</th><th>Tota ITBIS</th><th>Fecha de compra</th><th>Registrado por</th><th>NCF</th><th>Estado</th><th>Opcion</th></tr></thead><tbody>";
    for(i=0;i<valores.length;i++){
      var cont=i+1;
      var estado='';
       if(valores[i]["estado"]==1)  
          {
            estado = '<span class="label label-success">Active</span>';
          }  
          else{estado = '<span class="label label-danger">Active</span>';}

      datos=valores[i]["id_documento"];
      html+="<tr><td>"+cont+"</td><td>"+valores[i]["id_documento"]+"</td><td>"+valores[i]["suplidor"]+"</td><td>"+valores[i]["monto"]+"</td><td>"+valores[i]["itbis"]+"</td><td>"+valores[i]["fecha"]+"</td><td>"+valores[i]["registradopor"]+"</td><td>"+valores[i]["ncf"]+"</td><td>"+estado+"</td><td><button  class='btn btn-primary' onclick='lista_detalleCompra("+'"'+valores[i]["id_documento"]+'"'+");' class='close' data-dismiss='modal'data-toggle='modal' data-target='#detalleCompra' ><span class='glyphicon glyphicon-eye-open'></span> Ver Detalle</button></td></tr>";
    }
    html+="</tbody></table>"
    $("#Compra").html(html);

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
    $("#paginadorCompra").html(paginar);
    
  });
}

function lista_detalleCompra(id_documento){
  var pagina=Number(pagina);
  var opcion='';
  var boton='buscarDetalleCompra';
  $.ajax({
    url:'../Controlador/Ccompra.php',
    type:'POST',
    data:{id_documento:id_documento,boton:boton,opcion:opcion}
  }).done(function(resp){
    //alert(resp);
    var d=resp.split("*");
    var valores = eval(d[0]);
    
    html="<table class='table table-bordered'><thead><tr><th>Nº</th><th>Codigo Producto</th><th>Descripcion</th><th>Cantidad</th><th>Precio</th><th>ITBIS</th><th>Importe</th></tr></thead><tbody>";
    for(i=0;i<valores.length;i++){
      datos=valores[i]["id_documento"]+"*"+valores[i]["fecha"]+"*"+valores[i]["suplidor"]+"*"+valores[i]["ncf"];
      var cont=i+1;
    html+="<tr><td>"+cont+"</td><td>"+valores[i]["codigo_articulo"]+"</td><td>"+valores[i]["articulo"]+"</td><td>"+valores[i]["cantidad"]+"</td><td>"+valores[i]["monto"]+"</td><td>"+valores[i]["porciento_impuesto"]+"</td><td>"+valores[i]["importe"]+"</td></tr>";
    }
    html+="</tbody></table>"
    var d=datos.split("*");
  //alert(d);
  $("#num_compra").html(d[0]);
  $("#fecha").html(d[1]);
  $("#provedor").html(d[2]);
  $("#ncf").html(d[3]);
    $("#det_compta").html(html);
  });
}