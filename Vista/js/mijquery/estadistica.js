function contar_ventas () {
	var boton='ventas';
	$.ajax({
             url:'../Controlador/Cestadistica.php',
             type:'POST',
             data:{boton:boton},
             success:function(resp)
              {
                 var d=resp.split("*");
                var valores = eval(d[0]);
                for(i=0;i<valores.length;i++)
                {
                	var v= valores[i]["ventas"];
                }
                 $("#ventas").html(v.toFixed(2));
              }
           }); 
}

function contar_articulos(){
	var boton='articulos';
	$.ajax({
             url:'../Controlador/Cestadistica.php',
             type:'POST',
             data:{boton:boton},
             success:function(resp)
              {
              	var a=0;
                 var d=resp.split("*");
                var valores = eval(d[0]);
                for(i=0;i<valores.length;i++)
                {
                	var a= valores[i]["articulos"];
                }
                //alert(a);
                 $("#articulos").html(a.toFixed(2));
              }
           }); 
}

function contar_compras(){
	var boton='compras';
	$.ajax({
             url:'../Controlador/Cestadistica.php',
             type:'POST',
             data:{boton:boton},
             success:function(resp)
              {
              	
              	var c=0;
                 var d=resp.split("*");
                var valores = eval(d[0]);
                for(i=0;i<valores.length;i++)
                {
                	var c= valores[i]["compras"];
                }
                
                 $("#compras").html(c.toFixed(2));
              }
           }); 
}
function contar_clientes(){
	var boton='clientes';
	$.ajax({
             url:'../Controlador/Cestadistica.php',
             type:'POST',
             data:{boton:boton},
             success:function(resp)
              {
              	var cli=0;
                 var d=resp.split("*");
                var valores = eval(d[0]);
                for(i=0;i<valores.length;i++)
                {
                	var cli= valores[i]["clientes"];
                }
                //alert(a);
                 $("#clientes").html(cli.toFixed(2));
              }
           }); 
}
 
function total_compra(){
	var boton='total_compra';
	$.ajax({
             url:'../Controlador/Cestadistica.php',
             type:'POST',
             data:{boton:boton},
             success:function(resp)
              {
              	//alert(resp);
              	var com=0;
                 var d=resp.split("*");
                var valores = eval(d[0]);
                for(i=0;i<valores.length;i++)
                {
                	var com= valores[i]["total_compra"];

                }
                //alert(com);
                 $("#total_compra").html(com.toFixed(2));
                 totalCompra=com;
              }
           }); 
}
function total_venta(){
	var boton='total_venta';
	$.ajax({
             url:'../Controlador/Cestadistica.php',
             type:'POST',
             data:{boton:boton},
             success:function(resp)
              {
              	
              	var ven=0;
                 var d=resp.split("*");
                var valores = eval(d[0]);
                for(i=0;i<valores.length;i++)
                {
                	var ven= valores[i]["total_venta"];
                }
                
                 $("#total_venta").html(ven.toFixed(2));
                 totalVenta=ven;
              }
           }); 
}
function total_gasto(){
	var boton='total_gasto';
	$.ajax({
             url:'../Controlador/Cestadistica.php',
             type:'POST',
             data:{boton:boton},
             success:function(resp)
              {
              	//alert(resp);
              	var gasto=0;
                 var d=resp.split("*");
                var valores = eval(d[0]);
                for(i=0;i<valores.length;i++)
                {
                	var gasto= valores[i]["total_gasto"];
                }
                //alert(gasto);
                 $("#total_gasto").html(gasto.toFixed(2));
                 otrosGastos=gasto;
              }
           }); 
}


