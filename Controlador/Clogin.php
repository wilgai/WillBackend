<?php
require_once('../Modelo/login.php');
 			$log=new Login();
 			
          $boton=$_POST['boton'];
          if ($boton=="cerrar") 
	       {
	          	
	          	session_start();
	          	session_destroy();
           }
          else
          {
	 				$email=$_POST['correo'];
	 	            $pass=$_POST['pass'];
	 	            $datos=$log->getDatosEmpresa($email,$pass);
	 	            //$datos=$log->getDatosEmpresa("laaaa@gamil.com","145");
                    
                    $array=$log->login($datos[1],$datos[2]);

	 	             if(count($array)<=1) 
	 	             {
	 	             	echo "false";
	 	             } 
	 	             else
	 	             {
	 	                session_start();
	 	             	$_SESSION['login']='true';
	 	             	$_SESSION['nombre']=$array['nombre'];
	 	             	$_SESSION['id_usuario']=$array['codigo_usuario'];
	 	             	$_SESSION['empresa']=$datos[2];
	 	             	$_SESSION['foto']=$array['foto'];
	 	             	$_SESSION['tipo_usuario']=$array['tipo_usuario'];
	 	             	//echo $_SESSION['foto'];
	 	             } 
	 	
          }

               


 			
 			
?>