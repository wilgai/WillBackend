
$("#savemarca").click(function(e){
    validarFrmMarca();
    //alert("hola");
    e.preventDefault(); 
});


function validarFrmMarca() {
	var verificar=true;
	var marca= document.getElementById("marca");
	if(!marca.value)
	{
	    document.getElementById("errormarca").innerHTML="<div style='color:red;'>Digite el nombre de la marca.</div>";
	    marca.style.borderColor = "red";
		marca.focus();
		verificar=false;
		return false;
	}
    
	else if(verificar==true){
		                       var marca=$("#marca").val();
	                         	var boton='guardar';
                                    $.ajax({
                                      type:'POST',
                                      url:'../Controlador/Cmarca.php',
                                      data:{marca:marca,boton:boton},
                                      success:function(resp)
                                       {
                                         alert(resp);
                                         if(resp==='true')
                                              {
                                                //alert(resp);
                                                $('#save').show();
                                                lista_categoria('',1);
                                                $("#frmmarca").trigger('reset');

                                              }
                                              else
                                              {
                                                $('#unsave').show();
                                              }
                                       
                                       }
                                    }); 
     }
     

	


}

function lista_marca(valor,pagina){
  var pagina=Number(pagina);
  $.ajax({
    url:'../Controlador/Cmarca.php',
    type:'POST',
    data:'valor='+valor+'&pagina='+pagina+'&boton=buscar'
  }).done(function(resp){
    //alert(resp);
    
    var d=resp.split("*");
    //Imprimimos los registro en nuestra Table
    var valores = eval(d[0]);
    html="<table class='table table-bordered'><thead><tr><th>Nº</th><th>Código Categoría</th><th>Categoría</th><th>Opciones</th></tr></thead><tbody>";
    for(i=0;i<valores.length;i++){
      var cont=i+1;
      datos=valores[i]["codigo_marca"]+"*"+valores[i]["nombre"];
      html+="<tr><td>"+cont+"</td><td>"+valores[i]["codigo_marca"]+"</td><td>"+valores[i]["nombre"]+"</td><td><button class='btn btn-warning' data-toggle='collapse' data-target='#frmmarca' onclick='mostrar_marca("+'"'+datos+'"'+");'><span class='glyphicon glyphicon-pencil'></span></button> <button class='btn btn-danger' onclick='eliminar("+'"'+valores[i]["codigo_marca"]+'"'+")'><span class='glyphicon glyphicon-trash'></span></button></td></tr>";
    }
    html+="</tbody></table>"
    $("#listaMarca").html(html);

    var totalreg= d[1];
    var nropaginador=Math.ceil(totalreg/3);
    var campobuscar=$("#buscar").val();
    //alert(nropaginador);
    paginar="<ul class='pagination'>";
    if(pagina>1)
    {
      paginar+="<li><a href='javascript:void(0)' onclick='lista_suplidor("+'"'+campobuscar+'","'+1+'"'+")'>&laquo;</a></li>";
      paginar+="<li><a href='javascript:void(0)' onclick='lista_suplidor("+'"'+campobuscar+'","'+(pagina-1)+'"'+")'>&lsaquo;</a></li>";

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
          paginar+="<li><a href='javascript:void(0)' onclick='lista_suplidor("+'"'+campobuscar+'","'+i+'"'+")'>"+i+"</a></li>";
      }
    
    if(pagina<nropaginador)
    {
      paginar+="<li><a href='javascript:void(0)' onclick='lista_suplidor("+'"'+campobuscar+'","'+(pagina+1)+'"'+")'>&rsaquo;</a></li>";
      paginar+="<li><a href='javascript:void(0)' onclick='lista_suplidor("+'"'+campobuscar+'","'+nropaginador+'"'+")'>&raquo;</a></li>";

    }
    else
    {
      paginar+="<li class='disabled'><a href='javascript:void(0)'>&rsaquo;</a></li>";
      paginar+="<li class='disabled'><a href='javascript:void(0)'>&raquo;</a></li>";
    }
    paginar+="</ul>";
    $("#paginadorMarca").html(paginar);
    
  });
}
function mostrar_marca(datos){
  //alert(datos);
  var d=datos.split("*");
  //alert(d);
  $("#codigo_marca").val(d[0]);
  $("#marca").val(d[1]);
  $("#savemarca").hide();
   $("#actualizarmarca").attr("type", "submit");

}
$("#actualizarmarca").click(function(e){
    var verificar=true;
	var marca= document.getElementById("marca");
	if(!marca.value)
	{
	    document.getElementById("errormarca").innerHTML="<div style='color:red;'>Digite el nombre de la categoria.</div>";
	    marca.style.borderColor = "red";
		marca.focus();
		verificar=false;
		return false;
	}
    
	                         else if(verificar==true){
	                         	var nombre=$("#marca").val();
	                         	var codigo_marca=$("#codigo_marca").val();
	                         	var boton='actualizar';
                                    $.ajax({
                                      type:'POST',
                                      url:'../Controlador/Cmarca.php',
                                      data:{nombre:nombre,codigo_marca:codigo_marca,boton:boton},
                                      success:function(resp)
                                       {
                                         alert(resp);
                                         if(resp==='true')
                                              {
                                                //alert(resp);
                                                
                                                lista_categoria('',1);
                                                $("#frmmarca").trigger('reset');
                                                $("#savemarca").show();
                                                $("#actualizarmarca").attr("type", "hidden");
                                                $('#edit').show();


                                              }
                                              else
                                              {
                                                $('#unsave').show();
                                              }
                                       
                                       }
                                    }); 
                                     
     }
    e.preventDefault(); 
});
