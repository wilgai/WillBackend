<?php

require_once('../Modelo/cliente.php');
     session_start();
 $usuario_registro=$_SESSION['id_usuario'];
 $nombreEmpresa=$_SESSION['empresa'];
	$boton= $_POST['boton'];


  if($boton==='buscar')
  {
    $inicio = 0;
        $limite = 6;
        if (isset($_POST['pagina'])) {
          $pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
        $valor=$_POST['valor'];
    $cli=new Cliente();
    $a=  $cli->listar_cliente($valor,$inicio=FALSE,$limite=FALSE,$nombreEmpresa);
    $b=count($a);
    $c=  $cli->listar_cliente($valor,$inicio,$limite,$nombreEmpresa);
    
    echo json_encode($c)."*".$b;

  }


	if($boton==='guardar')
	{
		$nombre=$_POST['nombreCliente'];
		$identificacion=$_POST['identificacionCliente'];
		/*$dia=$_POST['diaCliente'];
		$mes=$_POST['mes'];
		$ano=$_POST['anoCliente'];*/
		$fecha_nacimiento=$_POST['fecha_nacimiento'];
		$direccion=$_POST['direccionCliente'];
		$celular=$_POST['celularCliente'];
		$correo=$_POST['correoCliente'];
    $sexo=$_POST['sexoCliente'];
		$img=$_FILES["imagen"]["name"];
		if($img==='')
		{
			$foto="desconocido.jpg";
		}
		else
		{
           $foto=uniqid()."-".$_FILES["imagen"]["name"];
           $ruta="../Resources/img/clientes/".$foto;
   	       move_uploaded_file($_FILES["imagen"]["tmp_name"],$ruta);
		}
	$cli=new Cliente();
     echo $cli->insertarCliente($nombreEmpresa,$nombre,$identificacion,$fecha_nacimiento,$direccion,$celular,$correo,$sexo,$usuario_registro,$foto);
     
 
    }


	//$us=new Usuario();
     //echo $us->insertarUsuario("Wilgaisoft","gege","SA3120344","1991-06-01","Santiago","8299899258","llla@gmail.com","123","1","1","");
    
if($boton==='actualizar')
  {
    $cli=new Cliente();
           $empresa=$nombreEmpresa;
           $codigo_usuario=$_POST['codigo_usuario'];
           $nombre=$_POST['act_nombre'];
           $identificacion=$_POST['act_identificacion'];
           $estado=$_POST['act_estado'];
           $direccion=$_POST['act_direccion'];
           $celular=$_POST['act_celular'];
           $telefono=$_POST['act_telefono'];
           $whatsapp=$_POST['act_whatsapp'];
           $correo=$_POST['act_correo'];
           $sexo=$_POST['sexo'];
           $condicionPago=$_POST['act_condicionPago'];
           $limiteCredito=$_POST['act_limiteCredito'];

  if($cli->Actualizar_cliente($empresa,$codigo_usuario,$nombre,$identificacion,$estado,$direccion,$celular,$telefono,$whatsapp,$correo,$sexo,$condicionPago,$limiteCredito))
   
   	echo "true";
   
   else
   	echo "false";

} 










?>