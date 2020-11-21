
 $("#btnagregar").click(function(e){
   validar_Documento ();
   e.preventDefault();
 });

function validar_Documento () {
	

	var verificar=true;
	
	var expPrecio=/^[0-9]+([.])?([0-9]+)?$/;	
    var formulario=document.getElementById("formulario");
	var cod_producto= document.getElementById("cod_producto");
	var descripcion=document.getElementById("descripcion");
	var cantidad=document.getElementById("cantidad");
	var descuento=document.getElementById("descuento");
	var itbis=document.getElementById("itbis");
	var ncf=document.getElementById("ncf");
	var referencia=document.getElementById("creferencia");
	
	var precio=document.getElementById("precio");
	var detalle=document.getElementById("detalle");


	if(!cod_producto.value)
	{
	    document.getElementById("error_codigo").innerHTML="<div style='color:red;'>Digite el codigo.</div>";
	    cod_producto.style.borderColor = "red";
		cod_producto.focus();
		verificar=false;
		return false;
	}
    
    else if(!expPrecio.exec(cod_producto.value)){
	document.getElementById("error_codigo").innerHTML="<div style='color:red;'>Solamente se acepta numero.</div>";
	cod_producto.style.borderColor = "red";
	cod_producto.focus();
	verificar=false;
	return false;
	}

	if(!descripcion.value)
	{
	    document.getElementById("error_descripcion").innerHTML="<div style='color:red;'>Digite el nombre de la descripcion.</div>";
	    descripcion.style.borderColor = "red";
		descripcion.focus();
		verificar=false;
		return false;
	}
    
	else if(!precio.value)
	{
		document.getElementById("error_precio").innerHTML="<div style='color:red;'>Digite el costo.</div>.";
		precio.style.borderColor = "red";
		precio.focus();
		verificar=false;
		return false;
	}
	else if(!expPrecio.exec(precio.value)){
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
	}
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
		
       anadir();
       sumVenta();
      
     }
     

}

var cont=0;
var contfila=0;

 function anadir() {
   var itbis=0;
   var existe=0;
   var index=0;

  var cod_producto =$("#cod_producto").val();
  var descripcion =$("#descripcion").val();
  var cantidad =$("#cantidad").val();
  var precio =$("#precio").val();
  var costo =$("#costo").val();
  
    
            //$('#chkitbis').val("18.00%");
            itbis=(parseFloat(precio)*(18/100))*parseFloat(cantidad);

        

  var importe=parseFloat(cantidad)*parseFloat(precio);
  //cont++;

if(contfila==0)
    {
      
      cont++;
      var fila='<tr class="datos" id="'+cont+'"><td>'+cont+'</td><td>'+cod_producto+'</td><td>'+descripcion+'</td><td>'+cantidad+'</td><td>'+costo+'</td><td>'+precio+'</td><td>'+itbis+'</td><td>'+importe+'</td><td><button class="btn btn-danger" onclick="quitar('+cont+'); sumar();"><span class="glyphicon glyphicon-remove"></span></button></td></tr>';
      $('#tabla').append(fila);
      contfila++;
       redondear();
    }
    else
    {
       $('#tabla tr.datos').each(function(){ 
         if($(this).find('td').eq(1).text()==cod_producto)
         {
          existe=1;
          index=$(this).find('td').eq(0).text();

         }   
       })
    
        var cant=0;
       if(existe==1)
       {
           cant=parseFloat($('#'+index).find('td').eq(3).text())+parseFloat(cantidad);
           $('#'+index).find('td').eq(3).html(cant);
           var sumaitbis=parseFloat($('#'+index).find('td').eq(3).text())*parseFloat($('#'+index).find('td').eq(6).text());
           $('#'+index).find('td').eq(6).html(sumaitbis);
          
           var importe=parseFloat($('#'+index).find('td').eq(3).text())*parseFloat($('#'+index).find('td').eq(5).text());
           $('#'+index).find('td').eq(7).html(importe);
           //alert("Es la cantidad "+cant);
           
       }
       else
       {
         var fila='<tr class="datos" id="'+cont+'"><td>'+cont+'</td><td>'+cod_producto+'</td><td>'+descripcion+'</td><td>'+cantidad+'</td><td>'+costo+'</td><td>'+precio+'</td><td>'+itbis+'</td><td>'+importe+'</td><td><button class="btn btn-danger" onclick="quitar('+cont+'); sumar();"><span class="glyphicon glyphicon-remove"></span></button></td></tr>';
      $('#tabla').append(fila);
      
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

 function sumVenta() {
  
  var sumab = 0;
  var suman = 0;
  var tot_itbis=0;
  var it=0;
  var tot_bis;
$('#tabla tr.datos').each(function(){ //filas con clase 'dato', especifica una clase, asi no tomas el nombre de las columnas
 sumab += parseFloat($(this).find('td').eq(7).text()||0,10) //numero de la celda 3
 tot_itbis += parseFloat($(this).find('td').eq(6).text()||0,10)
})
//alert(sumab);

suman =sumab+tot_itbis;
$('#totalBruto').val(sumab);
$('#totalNeto').val(suman);
$('#itbistot').val(tot_itbis);
}
/*Funcion que recorre el datatables para registrar la compra.
***********************************************************/
$("#saveVenta").click(function(){
 var expPrecio=/^[0-9]+([.])?([0-9]+)?$/;
  
  var codigoCliente=document.getElementById("codigoCliente");
  var nombreCliente=document.getElementById("nombreCliente");
  var tipoPedido=document.getElementById("tipoPedido");
  if(codigoCliente.value=="")
  {
    document.getElementById("errorcodigoCliente").innerHTML="<div style='color:red;'>Digite el codigo del cliente.</div>";
	codigoCliente.style.borderColor = "red";
	codigoCliente.focus();
  }
  else if(!expPrecio.exec(codigoCliente.value)){
	document.getElementById("errorcodigoCliente").innerHTML="<div style='color:red;'>Solamente se acepta numero.</div>";
	codigoCliente.style.borderColor = "red";
	codigoCliente.focus();
	}

   else if(nombreCliente.value=="")
   {
   	 document.getElementById("errorNombre").innerHTML="<div style='color:red;'>Digite el nombre cliente.</div>";
	nombreCliente.style.borderColor = "red";
	nombreCliente.focus();
   }
   
   else
   {
   	documento();
   }
});

function documento()
{
  var codigoCliente=$("#codigoCliente").val();
  
  var ncf=$("#ncf").val();
  var referencia=$("#referencia").val();
  var descuento=$("#descuento").val();
  var detalle=$("#detalle").val();
  var totalNeto=$("#totalNeto").val();
  var itbistot=$("#itbistot").val();
  var opcion="documento"
  var boton="registrarDocumento";
  $.ajax({
          data:{codigoCliente:codigoCliente,
            ncf:ncf,
            referencia:referencia,
            descuento:descuento,
            detalle:detalle,
            totalNeto:totalNeto,
            itbistot:itbistot,
            opcion:opcion,
            boton:boton
          },
         type: 'POST',
         url : '../Controlador/Cdocumento.php',
         success: function(resp){
                  alert(resp);
                if(resp==1)
                {
                  //alert(resp);
                      detalleDocumento();
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
function detalleDocumento()
{
var i, items, item, dataItem, data = [];
var cols = [ "numItem","codigo_articulo","descripcion", "cantidad", "costo", "precio",
 "itbis","importe" ];

$("#tabla tr").each(function() {
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
//alert(datos);
//console.log(datos);

$.ajax({
    data:"arreglo="+datos +'&boton=registrarDetalleDocumento'+'&opcion=documento',
    type: 'POST',
    url : '../Controlador/Cdocumento.php',
    success: function(resp){
      alert(resp);
      if(resp>0)
      {  
         $("#facturacion").modal("show");
         //$("#numFac").val(resp);       
         $("#generarFarctura").click(function(){
          
               document.location='factura.php?num_fac='+resp;
});

      }
      }
  });
}


function facturar(numFac)
{
 
}

function lista_productoV(valor,pagina){

   $("#cod_producto").val("");
  $("#descripcion").val("");
  $("#precio").val("");
  $("#costo").val("");
  $("#nombre").val("");
  $("#ganancia").val("");
  var pagina=Number(pagina);
  $.ajax({
    url:'../Controlador/Cdocumento.php',
    type:'POST',
    data:'valor='+valor+'&pagina='+pagina+'&boton=buscarProd'+'&opcion=""'
  }).done(function(resp){
    //alert(resp);
    
    var d=resp.split("*");
    


    var valores = eval(d[0]);
    html="<table class='table table-bordered'><thead><tr><th>Nº</th><th>Codigo</th><th>Nombre</th><th>Costo</th><th>Precio</th><th>Foto</th><th>Opciones</th></tr></thead><tbody>";
    for(i=0;i<valores.length;i++){
      var cont=i+1;
      datos=valores[i]["codigo_articulo"]+"*"+valores[i]["nombre"]+"*"+valores[i]["codigo_suplidor"]+"*"+valores[i]["usuario_registro"]+"*"+valores[i]["fecha_registro"]+"*"+valores[i]["fecha_actualizacion"]+"*"+valores[i]["tipo_impuesto"]+"*"+valores[i]["estado"]+"*"+valores[i]["costo"]+"*"+valores[i]["precio"]+"*"+valores[i]["codigo_subcategoria"]+"*"+valores[i]["referencia_interna"]+"*"+valores[i]["referencia_suplidor"]+"*"+valores[i]["foto"]+"*"+valores[i]["reorden"]+"*"+valores[i]["oferta"]+"*"+valores[i]["modificar_precio"]+"*"+valores[i]["acepta_descuento"]+"*"+valores[i]["detalle"]+"*"+valores[i]["codigo_marca"]+"*"+valores[i]["porciento_beneficio"]+"*"+valores[i]["porciento_minimo"]+"*"+valores[i]["modelo"];
      html+="<tr><td>"+cont+"</td><td>"+valores[i]["codigo_articulo"]+"</td><td>"+valores[i]["nombre"]+"</td><td>"+valores[i]["costo"]+"</td><td>"+valores[i]["precio"]+"</td><td><img src='../Resources/img/producto/"+valores[i]["foto"]+"' width='50px' height='50px'></td><td><button  class='btn btn-success' onclick='seleccionarProd("+'"'+datos+'"'+");' class='close' data-dismiss='modal' ><span class='glyphicon glyphicon-ok'></span></button></td></tr>";
    }
    html+="</tbody></table>"
    $("#buscarProd").html(html);

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
    $("#paginadorProd").html(paginar);
    
  });
}
function seleccionarProd(datos)
{
  var d=datos.split("*");
  //alert(d.length);
  $("#cod_producto").val(d[0]);
  $("#descripcion").val(d[1]);
  $("#precio").val(d[9]);
  $("#costo").val(d[8]);
  $("#nombre").val(d[1]);
  $("#cantidad").focus();
  //alert(d);
}
function lista_clientes(valor,pagina){
  var pagina=Number(pagina);
  $.ajax({
    url:'../Controlador/Cdocumento.php',
    type:'POST',
    data:'valor='+valor+'&pagina='+pagina+'&boton=buscarCli'+'&opcion=""'
  }).done(function(resp){
    alert(resp);
    
    var d=resp.split("*");
    


    var valores = eval(d[0]);
    html="<table class='table table-bordered'><thead><tr><th>Nº</th><th>Código</th><th>Nombre</th><th>Correo</th><th>Dirección</th><th>Foto</th><th>Opciones</th></tr></thead><tbody>";
    for(i=0;i<valores.length;i++){
      var cont=i+1;
      datos=valores[i]["codigo_usuario"]+"*"+valores[i]["nombre"]+"*"+valores[i]["direccion"]+"*"+valores[i]["identificacion"]+"*"+valores[i]["fecha_nacimiento"]+"*"+valores[i]["fecha_registro"]+"*"+valores[i]["telefono"]+"*"+valores[i]["celular"]+"*"+valores[i]["whatsapp"]+"*"+valores[i]["web"]+"*"+valores[i]["correo"]+"*"+valores[i]["sexo"]+"*"+valores[i]["codigo_ubicacion"]+"*"+valores[i]["limite__credito"]+"*"+valores[i]["condicion_pago"]+"*"+valores[i]["login"]+"*"+valores[i]["clave"]+"*"+valores[i]["tipo_usuario"]+"*"+valores[i]["estado"]+"*"+valores[i]["foto"]+"*"+valores[i]["rnc"]+"*"+valores[i]["sueldo"]+"*"+valores[i]["fecha_ingreso"]+"*"+valores[i]["usuario_registro"]+"*"+valores[i]["Hora"]+"*"+valores[i]["Dispositivo"]+"*"+valores[i]["codigo_sucursal"];
      html+="<tr><td>"+cont+"</td><td>"+valores[i]["codigo_usuario"]+"</td><td>"+valores[i]["nombre"]+"</td><td>"+valores[i]["correo"]+"</td><td>"+valores[i]["direccion"]+"</td><td><img src='../Resources/img/clientes/"+valores[i]["foto"]+"' width='50px' height='50px'></td><td><button  class='btn btn-success' onclick='seleccionarCli("+'"'+datos+'"'+");' class='close' data-dismiss='modal' ><span class='glyphicon glyphicon-ok'></span></button></td></tr>";
    }
    html+="</tbody></table>"
    $("#buscarClientes").html(html);

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
    $("#paginadorCli").html(paginar);
    
  });
}
function seleccionarCli(datos)
{
  var d=datos.split("*");
  //alert(d.length);
  $("#codigoCliente").val(d[0]);
  $("#nombreCliente").val(d[1]);
  //alert(d);
}
function lista_venta(valor,pagina){
  var pagina=Number(pagina);
  var start_date=$('#start_date').val();
  var end_date=$('#end_date').val();
  var valor=valor;
  var opcion='';
  var boton='buscarVenta';
  $.ajax({
    url:'../Controlador/Cdocumento.php',
    type:'POST',
    data:{valor:valor,start_date:start_date,end_date:end_date,boton:boton,opcion:opcion}
  }).done(function(resp){
    //alert(resp);
    
    var d=resp.split("*");
    

    var cant=0;
    var monto=0;
    var tot_itbis=0;
    var valores = eval(d[0]);
    //html="<table class='table table-bordered'><thead><tr><th rowspan='2'>Nº</th><th rowspan='2'>Producto</th><th rowspan='2'>Categoria</th><th rowspan='2'>Cantidad</th><th rowspan='2'>Monto Total</th><th rowspan='2'>Total ITBIS</th></tr></thead><tbody>";
    html="<table table class='table table-bordered'><thead></thead><tbody><tr><th rowspan='2'>No</th><th rowspan='2'>Producto</th><th rowspan='2'>Categoria</th><th rowspan='2'>Cantidad</th><th rowspan='2'>Monto Total</th><th colspan='2'>Total impuesto(%)</th></tr><tr><th>Tasa</th><th>Cant.</th></tr>";
    for(i=0;i<valores.length;i++){
      var cont=i+1;
      cant=cant+valores[i]["cantidad"];

      monto=monto+valores[i]["precio_total"];
      tot_itbis=tot_itbis+valores[i]["total_itbis"];
      //datos=valores[i]["id_documento"];
      html+="<tr><td>"+cont+"</td><td>"+valores[i]["articulo"]+"</td><td>"+valores[i]["categoria"]+"</td><td align='center'>"+valores[i]["cantidad"]+"</td><td align='center'>"+valores[i]["precio_total"]+"</td><td align='center'>18%</td><td align='center'>"+valores[i]["total_itbis"]+"</td></tr>";
      
    }
    html+=" <tr><td align='right' colspan='3'><b>Total</b></td><td align='center'><b>"+'Uds:'+cant.toFixed(2)+"</b></td><td align='center'><b>"+'RD$:'+monto.toFixed(2)+"</b></td><td align='center'><b></b></td><td align='center'><b>"+'RD$:'+tot_itbis.toFixed(2)+"</b></td></tr>";
    html+="</tbody></table>"
    $("#Venta").html(html);

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
    $("#paginadorVenta").html(paginar);
    
  });
}

function lista_ventaporano(valor,pagina){
  var pagina=Number(pagina);
  var start_date=$('#start_date').val();
  var end_date=$('#end_date').val();
  var valor=valor;
  var opcion='';
  var boton='buscarVentaP';
  $.ajax({
    url:'../Controlador/Cdocumento.php',
    type:'POST',
    data:{valor:valor,start_date:start_date,end_date:end_date,boton:boton,opcion:opcion}
  }).done(function(resp){
    //alert(resp);
    var d=resp.split("*");
    var cant=0;
    var monto=0;
    var tot_itbis=0;
    var valores = eval(d[0]);
    //html="<table class='table table-bordered'><thead><tr><th rowspan='2'>Nº</th><th rowspan='2'>Producto</th><th rowspan='2'>Categoria</th><th rowspan='2'>Cantidad</th><th rowspan='2'>Monto Total</th><th rowspan='2'>Total ITBIS</th></tr></thead><tbody>";
    html="<table table class='table table-bordered'><thead></thead><tbody><tr><th>Nº</th><th>MES</th><th>CANTIDAD DE ARTICULOS</th><th>TOTAL EN PESOS</th></tr>";
    for(i=0;i<valores.length;i++){
      var cont=i+1;
      cant=cant+valores[i]["cantidad"];

      monto=monto+valores[i]["total_venta"];
      
      //datos=valores[i]["id_documento"];
      html+="<tr><td>"+cont+"</td><td>"+valores[i]["fecha"]+"</td><td>"+valores[i]["cantidad"]+"</td><td >"+valores[i]["total_venta"]+"</td></tr>";
      
    }
     html+=" <tr><td align='right' colspan='2'><b>Total</b></td><td align='center'><b>"+'Uds:'+cant.toFixed(2)+"</b></td><td align='center'><b>"+'RD$:'+monto.toFixed(2)+"</b></td><td align='center'><b></b></td></tr>";
    html+="</tbody></table>"
    $("#VentaP").html(html);

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
    $("#paginadorVentaP").html(paginar);
    
  });
}

function lista_factura(valor,pagina){
  var pagina=Number(pagina);
  var start_date=$('#start_date').val();
  var end_date=$('#end_date').val();
  var valor=valor;
  var opcion='';
  var boton='buscarFactura';
  $.ajax({
    url:'../Controlador/Cdocumento.php',
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
      html+="<tr><td>"+cont+"</td><td>"+valores[i]["id_documento"]+"</td><td>"+valores[i]["suplidor"]+"</td><td>"+valores[i]["monto"].toFixed(2)+"</td><td>"+valores[i]["itbis"].toFixed(2)+"</td><td>"+valores[i]["fecha"]+"</td><td>"+valores[i]["registradopor"]+"</td><td>"+valores[i]["ncf"]+"</td><td>"+estado+"</td><td><button  class='btn btn-primary' onclick='lista_detalleFactura("+'"'+valores[i]["id_documento"]+'"'+");' class='close' data-dismiss='modal'data-toggle='modal' data-target='#detalleFactura' ><span class='glyphicon glyphicon-eye-open'></span> Ver Detalle</button></td></tr>";
    }
    html+="</tbody></table>"
    $("#Factura").html(html);

    var totalreg= d[1];
    var nropaginador=Math.ceil(totalreg/3);
    var campobuscar=$("#buscar").val();
    //alert(nropaginador);
    paginar="<ul class='pagination'>";
    if(pagina>1)
    {
      paginar+="<li><a href='javascript:void(0)' onclick='lista_factura("+'"'+campobuscar+'","'+1+'"'+")'>&laquo;</a></li>";
      paginar+="<li><a href='javascript:void(0)' onclick='lista_factura("+'"'+campobuscar+'","'+(pagina-1)+'"'+")'>&lsaquo;</a></li>";

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
          paginar+="<li><a href='javascript:void(0)' onclick='lista_factura("+'"'+campobuscar+'","'+i+'"'+")'>"+i+"</a></li>";
      }
    
    if(pagina<nropaginador)
    {
      paginar+="<li><a href='javascript:void(0)' onclick='lista_factura("+'"'+campobuscar+'","'+(pagina+1)+'"'+")'>&rsaquo;</a></li>";
      paginar+="<li><a href='javascript:void(0)' onclick='lista_articulo("+'"'+campobuscar+'","'+nropaginador+'"'+")'>&raquo;</a></li>";

    }
    else
    {
      paginar+="<li class='disabled'><a href='javascript:void(0)'>&rsaquo;</a></li>";
      paginar+="<li class='disabled'><a href='javascript:void(0)'>&raquo;</a></li>";
    }
    paginar+="</ul>";
    $("#paginadorFactura").html(paginar);
    
  });
}
function lista_detalleFactura(id_documento){
  var pagina=Number(pagina);
  var opcion='';
  var boton='buscarDetalleFactura';
  $.ajax({
    url:'../Controlador/Cdocumento.php',
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
    html+="<tr><td>"+cont+"</td><td>"+valores[i]["codigo_articulo"]+"</td><td>"+valores[i]["articulo"]+"</td><td>"+valores[i]["cantidad"].toFixed(2)+"</td><td>"+valores[i]["monto"].toFixed(2)+"</td><td>"+valores[i]["porciento_impuesto"].toFixed(2)+"</td><td>"+valores[i]["importe"].toFixed(2)+"</td></tr>";
    }
    html+="</tbody></table>"
    var d=datos.split("*");
  //alert(d);
  $("#num_compra").html(d[0]);
  $("#fecha").html(d[1]);
  $("#provedor").html(d[2]);
  $("#ncf").html(d[3]);
    $("#det_factura").html(html);
  });
}

function movimiento(valor,pagina){
  var pagina=Number(pagina);
  var start_date=$('#start_date').val();
  var end_date=$('#end_date').val();
  var valor=valor;
  var opcion='';
  var boton='buscarMovimiento';
  $.ajax({
    url:'../Controlador/Cdocumento.php',
    type:'POST',
    data:{valor:valor,start_date:start_date,end_date:end_date,boton:boton,opcion:opcion}
  }).done(function(resp){
    //alert(resp);
    var d=resp.split("*");
    var valores = eval(d[0]);
    
    html="<table class='table table-bordered' id='tablamov'><thead><tr><th>Movimiento</th><th>Monto Total</th></tr></thead><tbody>";
    for(i=0;i<valores.length;i++){
      dato=valores[i]["nombre"]+"*"+valores[i]["total"];
      var cont=i+1;
    html+="<tr><td>"+valores[i]["nombre"]+"</td><td "+cont+">"+valores[i]["total"]+"</td></tr>";
    }
    html+="</tbody></table>"
     var compra=0;
     var gasto=0;
     var venta=0;
    
    


    //var l=dato.split("*");
    //alert(l);
  /*$("#num_compra").html(d[0]);
  $("#fecha").html(d[1]);
  $("#provedor").html(d[2]);
  $("#ncf").html(d[3]);*/
    $("#Movimiento").html(html);
  });
}

/*Highcharts.chart('container', {
    chart: {
        type: 'area'
    },
    title: {
        text: ''
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: ['Enero.', 'Febrero.', 'Marzo.', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        tickmarkPlacement: 'on',
        title: {
            enabled: false
        }
    },
    yAxis: {
        title: {
            text: 'Miles'
        },
        labels: {
            formatter: function () {
                return this.value / 1000;
            }
        }
    },
    tooltip: {
        split: true,
        valueSuffix: ' mil pesos'
    },
    plotOptions: {
        area: {
            stacking: 'normal',
            lineColor: '#666666',
            lineWidth: 1,
            marker: {
                lineWidth: 1,
                lineColor: '#666666'
            }
        }
    },
    series: [{
        name: 'Usuario1',
        data: [502, 635, 809, 947, 1402, 3634, 5268]
    }, {
        name: 'Usuario2',
        data: [106, 107, 111, 133, 221, 767, 1766]
    }, {
        name: 'Usuario3',
        data: [463, 203, 276, 408, 547, 729, 628]
    }, {
        name: 'Usuario4',
        data: [850, 31, 54, 156, 339, 818, 1201]
    }, {
        name: 'Usuario5',
        data: [2, 2, 2, 6, 13, 30, 46]
    }]
});*/

$('#buscarDatos').click(function(){

 var opcion=$('#opcion').val();
 if(opcion==='producto')
 {
  dat_producto ();
 }
 else if(opcion==='categoria')
 {
  dat_categoria ();
 }
 else if(opcion==='cliente')
 {
   dat_cliente ();
 }

});
 function dat_producto (valor,pagina) {
  var pagina=Number(pagina);
  var start_date=$('#start_date').val();
  var end_date=$('#end_date').val();
  var cant_fila=$('#cant_fila').val();
  //alert(cant_fila);
  var opcion='';
  var boton='productoMasVendido';
  $.ajax({
    url:'../Controlador/Cdocumento.php',
    type:'POST',
    data:{cant_fila:cant_fila,start_date:start_date,end_date:end_date,boton:boton,opcion:opcion}
  }).done(function(resp){
    alert(resp);
    
    var d=resp.split("*");
    


    var valores = eval(d[0]);
    html="<table class='table table-bordered'><thead><tr><th>Nº</th><th>Codigo</th><th>Nombre</th><th>Monto Total</th></tr></thead><tbody>";
    for(i=0;i<valores.length;i++){
      var cont=i+1;
      

      datos=valores[i]["id_documento"];
      html+="<tr><td>"+cont+"</td><td>"+valores[i]["codigo_articulo"]+"</td><td>"+valores[i]["nombre"]+"</td><td>"+valores[i]["total"].toFixed(2)+"</td><td>"+valores[i]["costo"].toFixed(2)+"</td></tr>";
    }
    html+="</tbody></table>"
    $("#ConsultaAvanzada").html(html);

    var totalreg= d[1];
    var nropaginador=Math.ceil(totalreg/3);
    var campobuscar=$("#buscar").val();
    //alert(nropaginador);
    paginar="<ul class='pagination'>";
    if(pagina>1)
    {
      paginar+="<li><a href='javascript:void(0)' onclick='lista_factura("+'"'+campobuscar+'","'+1+'"'+")'>&laquo;</a></li>";
      paginar+="<li><a href='javascript:void(0)' onclick='lista_factura("+'"'+campobuscar+'","'+(pagina-1)+'"'+")'>&lsaquo;</a></li>";

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
          paginar+="<li><a href='javascript:void(0)' onclick='lista_factura("+'"'+campobuscar+'","'+i+'"'+")'>"+i+"</a></li>";
      }
    
    if(pagina<nropaginador)
    {
      paginar+="<li><a href='javascript:void(0)' onclick='lista_factura("+'"'+campobuscar+'","'+(pagina+1)+'"'+")'>&rsaquo;</a></li>";
      paginar+="<li><a href='javascript:void(0)' onclick='lista_articulo("+'"'+campobuscar+'","'+nropaginador+'"'+")'>&raquo;</a></li>";

    }
    else
    {
      paginar+="<li class='disabled'><a href='javascript:void(0)'>&rsaquo;</a></li>";
      paginar+="<li class='disabled'><a href='javascript:void(0)'>&raquo;</a></li>";
    }
    paginar+="</ul>";
    $("#paginadorConsultaAvanzada").html(paginar);
    
  });

 }
 function dat_categoria(valor,pagina) {
  var pagina=Number(pagina);
  var start_date=$('#start_date').val();
  var end_date=$('#end_date').val();
  var cant_fila=$('#cant_fila').val();
  //alert(cant_fila);
  var opcion='';
  var boton='categoriaMasVendido';
  $.ajax({
    url:'../Controlador/Cdocumento.php',
    type:'POST',
    data:{cant_fila:cant_fila,start_date:start_date,end_date:end_date,boton:boton,opcion:opcion}
  }).done(function(resp){
    alert(resp);
    
    var d=resp.split("*");
    


    var valores = eval(d[0]);
    html="<table class='table table-bordered'><thead><tr><th>Nº</th><th>Codigo Categoria</th><th>Cantidad</th><th>Nombre Categoria</th><th>Monto Total</th></tr></thead><tbody>";
    for(i=0;i<valores.length;i++){
      var cont=i+1;
      

      datos=valores[i]["id_documento"];
      html+="<tr><td>"+cont+"</td><td>"+valores[i]["codigo_categoria"]+"</td><td>"+valores[i]["nombre"]+"</td><td>"+valores[i]["total"].toFixed(2)+"</td><td>"+valores[i]["costo"].toFixed(2)+"</td></tr>";
    }
    html+="</tbody></table>"
    $("#ConsultaAvanzada").html(html);

    var totalreg= d[1];
    var nropaginador=Math.ceil(totalreg/3);
    var campobuscar=$("#buscar").val();
    //alert(nropaginador);
    paginar="<ul class='pagination'>";
    if(pagina>1)
    {
      paginar+="<li><a href='javascript:void(0)' onclick='lista_factura("+'"'+campobuscar+'","'+1+'"'+")'>&laquo;</a></li>";
      paginar+="<li><a href='javascript:void(0)' onclick='lista_factura("+'"'+campobuscar+'","'+(pagina-1)+'"'+")'>&lsaquo;</a></li>";

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
          paginar+="<li><a href='javascript:void(0)' onclick='lista_factura("+'"'+campobuscar+'","'+i+'"'+")'>"+i+"</a></li>";
      }
    
    if(pagina<nropaginador)
    {
      paginar+="<li><a href='javascript:void(0)' onclick='lista_factura("+'"'+campobuscar+'","'+(pagina+1)+'"'+")'>&rsaquo;</a></li>";
      paginar+="<li><a href='javascript:void(0)' onclick='lista_articulo("+'"'+campobuscar+'","'+nropaginador+'"'+")'>&raquo;</a></li>";

    }
    else
    {
      paginar+="<li class='disabled'><a href='javascript:void(0)'>&rsaquo;</a></li>";
      paginar+="<li class='disabled'><a href='javascript:void(0)'>&raquo;</a></li>";
    }
    paginar+="</ul>";
    $("#paginadorConsultaAvanzada").html(paginar);
    
  });

 }
 function dat_cliente(valor,pagina) {
  var pagina=Number(pagina);
  var start_date=$('#start_date').val();
  var end_date=$('#end_date').val();
  var cant_fila=$('#cant_fila').val();
  //alert(cant_fila);
  var opcion='';
  var boton='clienteMasVendido';
  $.ajax({
    url:'../Controlador/Cdocumento.php',
    type:'POST',
    data:{cant_fila:cant_fila,start_date:start_date,end_date:end_date,boton:boton,opcion:opcion}
  }).done(function(resp){
    alert(resp);
    
    var d=resp.split("*");
    


    var valores = eval(d[0]);
    html="<table class='table table-bordered'><thead><tr><th>Nº</th><th>Codigo Cliente</th><th>Cantidad compro</th><th>Nombre Cliente</th><th>Monto Total</th></tr></thead><tbody>";
    for(i=0;i<valores.length;i++){
      var cont=i+1;
      

      datos=valores[i]["id_documento"];
      html+="<tr><td>"+cont+"</td><td>"+valores[i]["codigo_usuario"]+"</td><td>"+valores[i]["nombre"]+"</td><td>"+valores[i]["total"].toFixed(2)+"</td><td>"+valores[i]["costo"].toFixed(2)+"</td></tr>";
    }
    html+="</tbody></table>"
    $("#ConsultaAvanzada").html(html);

    var totalreg= d[1];
    var nropaginador=Math.ceil(totalreg/3);
    var campobuscar=$("#buscar").val();
    //alert(nropaginador);
    paginar="<ul class='pagination'>";
    if(pagina>1)
    {
      paginar+="<li><a href='javascript:void(0)' onclick='lista_factura("+'"'+campobuscar+'","'+1+'"'+")'>&laquo;</a></li>";
      paginar+="<li><a href='javascript:void(0)' onclick='lista_factura("+'"'+campobuscar+'","'+(pagina-1)+'"'+")'>&lsaquo;</a></li>";

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
          paginar+="<li><a href='javascript:void(0)' onclick='lista_factura("+'"'+campobuscar+'","'+i+'"'+")'>"+i+"</a></li>";
      }
    
    if(pagina<nropaginador)
    {
      paginar+="<li><a href='javascript:void(0)' onclick='lista_factura("+'"'+campobuscar+'","'+(pagina+1)+'"'+")'>&rsaquo;</a></li>";
      paginar+="<li><a href='javascript:void(0)' onclick='lista_articulo("+'"'+campobuscar+'","'+nropaginador+'"'+")'>&raquo;</a></li>";

    }
    else
    {
      paginar+="<li class='disabled'><a href='javascript:void(0)'>&rsaquo;</a></li>";
      paginar+="<li class='disabled'><a href='javascript:void(0)'>&raquo;</a></li>";
    }
    paginar+="</ul>";
    $("#paginadorConsultaAvanzada").html(paginar);
    
  });

 }