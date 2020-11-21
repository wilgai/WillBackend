
$("#savetipousuario").click(function(e){
    validarFrmTipousuario();
    //alert("hola");
    e.preventDefault(); 
});


function validarFrmTipousuario() {
	var verificar=true;
	var tipousuario= document.getElementById("tipousuario");
	if(!tipousuario.value)
	{
	    document.getElementById("errortipousuario").innerHTML="<div style='color:red;'>Digite el tipo de usuario.</div>";
	    tipousuario.style.borderColor = "red";
		tipousuario.focus();
		verificar=false;
		return false;
	}
    
	else if(verificar==true){
			            var tipousuario=$("#tipousuario").val();
	                         	var boton='guardar';
                                    $.ajax({
                                      type:'POST',
                                      url:'../Controlador/Ctipousuario.php',
                                      data:{tipousuario:tipousuario,boton:boton},
                                      success:function(resp)
                                       {
                                         alert(resp);
                                         if(resp==='true')
                                              {
                                                //alert(resp);
                                                $('#save').show();
                                                lista_categoria('',1);
                                                $("#frmtipousuario").trigger('reset');

                                              }
                                              else
                                              {
                                                $('#unsave').show();
                                              }
                                       
                                       }
                                    });
     }
     

	


}