<?php

require_once('../Modelo/usuario.php');
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
    $us=new Usuario();
    $a=  $us->listar_usuario($valor,$inicio=FALSE,$limite=FALSE,$nombreEmpresa);
    $b=count($a);
    $c=  $us->listar_usuario($valor,$inicio,$limite,$nombreEmpresa);
    
    echo json_encode($c)."*".$b;

  }


	if($boton==='guardar')
	{
		$nombre=$_POST['username'];
    $login=$_POST['login'];
		$identificacion=$_POST['identificacion'];
		$dia=$_POST['dia'];
		$mes=$_POST['mes'];
		$ano=$_POST['ano'];
		$fecha_nacimiento=$ano."-".$mes."-".$dia;
		$direccion=$_POST['direccion'];
		$celular=$_POST['celular'];
		$correo=$_POST['correo'];
		$contrasena1=$_POST['contrasena1'];
		$tipo_usuario=$_POST['tipo_usuario'];
		$img=$_FILES["imagen"]["name"];
		if($img==='')
		{
			$foto="desconocido.jpg";
		}
		else
		{
           $foto=uniqid()."-".$_FILES["imagen"]["name"];
           $ruta="../Resources/img/usuarios/".$foto;
   	       move_uploaded_file($_FILES["imagen"]["tmp_name"],$ruta);
		}
	$us=new Usuario();
     echo $us->insertarUsuario($nombreEmpresa,$nombre,$login,$identificacion,$fecha_nacimiento,$direccion,$celular,$correo,$contrasena1,$tipo_usuario,$usuario_registro,$foto);
 
    }


	//$us=new Usuario();
     //echo $us->insertarUsuario("Wilgaisoft","gege","SA3120344","1991-06-01","Santiago","8299899258","llla@gmail.com","123","1","1","");
    
if($boton==='actualizar')
  {
    $prod=new Usuario();
           $empresa=$nombreEmpresa;
           $codigo_usuario=$_POST['codigo_usuario'];
           $nombre=$_POST['act_nombre'];
           $identificacion=$_POST['act_identificacion'];
           $tipo_usuario=$_POST['act_tipo_usuario'];
           $estado=$_POST['act_estado'];
           $direccion=$_POST['act_direccion'];
           $celular=$_POST['act_celular'];
           $telefono=$_POST['act_telefono'];
           $whatsapp=$_POST['act_whatsapp'];
           $login=$_POST['act_login'];
           $correo=$_POST['act_correo'];
           $sexo=$_POST['sexo'];
           $sueldo=$_POST['act_sueldo'];
           $sucursal=$_POST['sucursal'];


           
    
  if($prod->Actualizar_usuario($empresa,$codigo_usuario,$nombre,$identificacion,$tipo_usuario,$estado,$direccion,$celular,$telefono,$whatsapp,$login,$correo,$sexo,$sueldo,$sucursal))
   
   	echo "true";
   
   else
   	echo "false";

} 










?>