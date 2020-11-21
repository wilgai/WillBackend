
								function Llenarcombo()
								{
	                         	  var boton='buscarCategoria';
                                    $.ajax({
                                      type:'POST',
                                      url:'../Controlador/Csubcategoria.php',
                                      data:{boton:boton},
                                      success:function(resp)
                                       {
                                         var d=resp.split("*");
                                         var valores = eval(d[0]);
                                           for(i=0;i<valores.length;i++){
										      var cont=i+1;
										      html="<option value='"+valores[i]["codigo_categoria"]+"'>"+valores[i]["nombre"]+"</option>";
										    $("#codigo_cat").append(html);
										    }

										    
                                       }
                                    }); 
                                     

}

$("#savesubcategoria").click(function(e){
    validarFrmSubcategoria();
    //alert("hola");
    e.preventDefault(); 
});


function validarFrmSubcategoria() {
	var verificar=true;
	var nombre= document.getElementById("nombre");
	var codigo_cat= document.getElementById("codigo_cat");
	if(!nombre.value)
	{
	    document.getElementById("errornombre").innerHTML="<div style='color:red;'>Digite el nombre de la subcategoria.</div>";
	    nombre.style.borderColor = "red";
		nombre.focus();
		verificar=false;
		return false;
	}
	if(!codigo_cat.value)
	{
	    document.getElementById("errorcat").innerHTML="<div style='color:red;'>Elige una categoria.</div>";
	    codigo_cat.style.borderColor = "red";
		codigo_cat.focus();
		verificar=false;
		return false;
	}
    
	else if(verificar==true){
		                        var nombre=$("#nombre").val();
		                        var codigo_cat=$("#codigo_cat").val();
	                         	var boton='guardar';
                                    $.ajax({
                                      type:'POST',
                                      url:'../Controlador/Csubcategoria.php',
                                      data:{nombre:nombre,codigo_cat:codigo_cat,boton:boton},
                                      success:function(resp)
                                       {
                                         alert(resp);
                                         if(resp==='true')
                                              {
                                                //alert(resp);
                                                $('#save').show();
                                                lista_categoria('',1);
                                                $("#frmsubcategoria").trigger('reset');

                                              }
                                              else
                                              {
                                                $('#unsave').show();
                                              }
                                       
                                       }
                                    }); 

                                     
     }
     

	


}

function lista_subcategoria(valor,pagina){
  var pagina=Number(pagina);
  $.ajax({
    url:'../Controlador/Csubcategoria.php',
    type:'POST',
    data:'valor='+valor+'&pagina='+pagina+'&boton=buscar'
  }).done(function(resp){
    //alert(resp);
    
    var d=resp.split("*");
    //Imprimimos los registro en nuestra Table
    var valores = eval(d[0]);
    html="<table class='table table-bordered'><thead><tr><th>Nº</th><th>Código Subategoría</th><th>Categoría</th><th>Nombre Subcategoría</th><th>Opciones</th></tr></thead><tbody>";
    for(i=0;i<valores.length;i++){
      var cont=i+1;
      datos=valores[i]["codigo_subcategoria"]+"*"+valores[i]["nombre"]+"*"+valores[i]["codigo_categoria"];
      html+="<tr><td>"+cont+"</td><td>"+valores[i]["codigo_subcategoria"]+"</td><td>"+valores[i]["nombre"]+"</td><td>"+valores[i]["cat"]+"</td><td><button class='btn btn-warning' data-toggle='collapse' data-target='#frmsubcategoria' onclick='mostrar_subcategoria("+'"'+datos+'"'+");'><span class='glyphicon glyphicon-pencil'></span></button> <button class='btn btn-danger' onclick='eliminar("+'"'+valores[i]["codigo_categoria"]+'"'+")'><span class='glyphicon glyphicon-trash'></span></button></td></tr>";
    }
    html+="</tbody></table>"
    $("#lista_sub_Categoria").html(html);

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
    $("#paginador_sub_Categoria").html(paginar);
    
  });
}
function mostrar_subcategoria(datos){
  //alert(datos);
  var d=datos.split("*");
  //alert(d);
  $("#codigo_categoria").val(d[0]);
  $("#nombre").val(d[1]);
  $("#codigo_cat").val(d[2]);
  $("#savesubcategoria").hide();
   $("#actualizarsubcategoria").attr("type", "submit");

}
$("#actualizarsubcategoria").click(function(e){
    var verificar=true;
	var nombre= document.getElementById("nombre");
	var codigo_cat= document.getElementById("codigo_cat");
	if(!nombre.value)
	{
	    document.getElementById("errornombre").innerHTML="<div style='color:red;'>Digite el nombre de la subcategoria.</div>";
	    nombre.style.borderColor = "red";
		nombre.focus();
		verificar=false;
		return false;
	}
	if(!codigo_cat.value)
	{
	    document.getElementById("errorcat").innerHTML="<div style='color:red;'>Elige una categoria.</div>";
	    codigo_cat.style.borderColor = "red";
		codigo_cat.focus();
		verificar=false;
		return false;
	}
    
	                         else if(verificar==true){
	                         	var nombre=$("#nombre").val();
		                        var codigo_cat=$("#codigo_cat").val();
	                         	var codigo_subcategoria=$("#codigo_subcategoria").val();
	                         	var boton='actualizar';
                                    $.ajax({
                                      type:'POST',
                                      url:'../Controlador/Csubcategoria.php',
                                      data:{nombre:nombre,codigo_cat:codigo_cat,codigo_subcategoria:codigo_subcategoria,boton:boton},
                                      success:function(resp)
                                       {
                                         alert(resp);
                                         if(resp==='true')
                                              {
                                                //alert(resp);
                                                
                                                
                                                $("#frmsubcategoria").trigger('reset');
                                                $("#savesubcategoria").show();
                                                $("#actualizarsubcategoria").attr("type", "hidden");
                                                $('#edit').show();
                                                lista_subcategoria('',1);


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

