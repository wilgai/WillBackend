
$("#saveCategoria").click(function(e){
    validarFrmCategoria();
    //alert("hola");
    e.preventDefault(); 
});


function validarFrmCategoria() {
	var verificar=true;
	var nombre= document.getElementById("nombre");
	if(!nombre.value)
	{
	    document.getElementById("errornombre").innerHTML="<div style='color:red;'>Digite el nombre de la categoria.</div>";
	    nombre.style.borderColor = "red";
		nombre.focus();
		verificar=false;
		return false;
	}
    
	                         else if(verificar==true){
	                         	var nombre=$("#nombre").val();
	                         	var boton='guardar';
                                    $.ajax({
                                      type:'POST',
                                      url:'../Controlador/Ccategoria.php',
                                      data:{nombre:nombre,boton:boton},
                                      success:function(resp)
                                       {
                                         //alert(resp);
                                         if(resp==='true')
                                              {
                                                //alert(resp);
                                                $('#save').show();
                                                lista_categoria('',1);
                                                $("#frmcategoria").trigger('reset');

                                              }
                                              else
                                              {
                                                $('#unsave').show();
                                              }
                                       
                                       }
                                    }); 
                                     
     }
     
}

function lista_categoria(valor,pagina){
  var pagina=Number(pagina);
  $.ajax({
    url:'../Controlador/Ccategoria.php',
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
      datos=valores[i]["codigo_categoria"]+"*"+valores[i]["nombre"]+"*"+valores[i]["usuario_registro"];
      html+="<tr><td>"+cont+"</td><td>"+valores[i]["codigo_categoria"]+"</td><td>"+valores[i]["nombre"]+"</td><td><button class='btn btn-warning' data-toggle='collapse' data-target='#frmcategoria' onclick='mostrar_categoria("+'"'+datos+'"'+");'><span class='glyphicon glyphicon-pencil'></span></button> <button class='btn btn-danger' onclick='eliminar("+'"'+valores[i]["codigo_categoria"]+'"'+")'><span class='glyphicon glyphicon-trash'></span></button></td></tr>";
    }
    html+="</tbody></table>"
    $("#listaCategoria").html(html);

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
    $("#paginadorCategoria").html(paginar);
    
  });
}
function mostrar_categoria(datos){
  //alert(datos);
  var d=datos.split("*");
  //alert(d);
  $("#codigo_categoria").val(d[0]);
  $("#nombre").val(d[1]);
  $("#saveCategoria").hide();
   $("#actualizar").attr("type", "submit");

}

$("#actualizar").click(function(e){
    var verificar=true;
	var nombre= document.getElementById("nombre");
	if(!nombre.value)
	{
	    document.getElementById("errornombre").innerHTML="<div style='color:red;'>Digite el nombre de la categoria.</div>";
	    nombre.style.borderColor = "red";
		nombre.focus();
		verificar=false;
		return false;
	}
    
	                         else if(verificar==true){
	                         	var nombre=$("#nombre").val();
	                         	var codigo_categoria=$("#codigo_categoria").val();
	                         	var boton='actualizar';
                                    $.ajax({
                                      type:'POST',
                                      url:'../Controlador/Ccategoria.php',
                                      data:{nombre:nombre,codigo_categoria:codigo_categoria,boton:boton},
                                      success:function(resp)
                                       {
                                         alert(resp);
                                         if(resp==='true')
                                              {
                                                //alert(resp);
                                                
                                                lista_categoria('',1);
                                                $("#frmcategoria").trigger('reset');
                                                $("#saveCategoria").show();
                                                $("#actualizar").attr("type", "hidden");
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



