<?php
class Empresa 
{
	private $con;
	private $negocio;
	private $bd_adm;
	function __construct()
	{   
		require_once('conexion.php');
		$this->con=new Conexion();
		$this->bd_adm=$this->con->dbname;
	}

	public function Resgistrar($nombre,$login,$correo,$clave)
	{
        $codigo_emp=0;

		$mensaje='';
		$email='';
		$nom='';
		$sql="select web.nombre,emp.correo
from usuarios_web web inner join usuarios_empresas emp on web.codigo_usuario=emp.codigo_empresa
where emp.correo='".$correo."'OR web.nombre='".$nombre."'";
		$existe=array();
		$this->con->conectar($this->bd_adm);
		$result=$this->con->query($sql);
		while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
              $email=$row['correo'];  
              $nom=$row['nombre'];  
			}
			

			if($correo==$email)
			{
				$mensaje="correo";
			}
		else if($nombre==$nom)
		{
           $mensaje="nombre";
           //echo $mensaje;
		} 		       
		else
		{
			$sql1="INSERT INTO usuarios_web  VALUES('".$nombre."','1') ";
			$this->con->conectar($this->bd_adm);
			$prepare=$this->con->preparedStatement($sql1);
			if($this->con->execute($prepare))
			{

						   $buscarcodigo="select codigo_usuario from usuarios_web where nombre='".$nombre."'";
						   $this->con->conectar($this->bd_adm);
					$result=$this->con->query($buscarcodigo);
					while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
			                
			              $codigo_emp=$row['codigo_usuario'];  
						}
			            $insertar_usuario="INSERT INTO usuarios_empresas VALUES('".$codigo_emp."','".$login."','".$correo."','".$clave."') ";
			            $result=$this->con->query($insertar_usuario); 
			            if($result)
			            {
			              $sql="EXEC CrearDB '".$nombre."'";
			              $this->con->conectar($this->bd_adm);
						  $this->con->query($sql);
                            $this->con->conectar($nombre);
                            $s1="insert into tipos_usuarios values('Administrador')";
                            $this->con->query($s1);
                            $s2="insert into ubicaciones values('Ubicacion')";
                            $this->con->query($s2);
                            $s3="insert into sucursales values('Sucursal1','','','','','','','','','','','0','','')";
                            $this->con->query($s3);
						    $insertar="INSERT INTO usuarios VALUES ('', '','', '', '','','','','','$correo', '','1','','2','','$clave','1','','desconocido.jpg','','','','','','','1')";
						    $resultado=$this->con->query($insertar);
						    if($resultado)
						    {
						    	$mensaje="creo";
						    }
						    else
						    {
						    	$mensaje=die(print_r( sqlsrv_errors(), true));
						    }
						  
						 
			            }
			            else
			            {
			            	$mensaje=die(print_r( sqlsrv_errors(), true));
                          
			            }
			        
			}
			else
			{
				$mensaje=die(print_r( sqlsrv_errors(), true));
				
			}
        }

		return $mensaje;
	}
}


    //$emp=new Empresa();
    //echo $emp->Resgistrar("lili","lilig@gbmi.com","123");





?>