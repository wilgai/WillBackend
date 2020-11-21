<?php
class Cliente
{
	private $bd_adm;
	private $con;
	function __construct()
	{
		require_once('conexion.php');
		$this->con=new Conexion();
		$this->bd_adm=$this->con->dbname;
	}


  public function insertarCliente($empresa,$nombre,$identificacion,$fecha_nacimiento,$direccion,$celular,$correo,$sexo,$usuario_registro,$foto)
 {
 	$codigo_empresa=0;
 	$mensaje='';
 	$this->con->conectar($empresa);
 	$sql="SELECT *FROM usuarios WHERE identificacion='".$identificacion."' AND tipo_usuario=3";
		$result=$this->con->query($sql);
		$row=sqlsrv_has_rows($result);
		if($row===true)
		{
			return "false";
		}
		else
		{ 
      $this->con->conectar($empresa);
        $sql="INSERT INTO usuarios VALUES ('$nombre', '$direccion','$identificacion', '$fecha_nacimiento', GETDATE(),'','$celular','','','$correo','$sexo','1','','','','','1','1','$foto','','',GETDATE(),'$usuario_registro','','','1')";
        $result=$this->con->query($sql);
        if($result)
        {
          return "true";
        }
        else
        {
           $mensaje=die( print_r( sqlsrv_errors(), true));
        } 
		    
		}

		return $mensaje;

 }
       function listar_cliente($filtro,$inicio=FALSE,$limite=FALSE,$empresa)
  {
    $this->con->conectar($empresa);
    $resultado=array();
    
    if ($inicio!==FALSE && $limite!==FALSE)
     {
       $sql="SELECT *FROM usuarios WHERE nombre LIKE '%".$filtro."%' AND tipo_usuario=1 ORDER BY codigo_usuario  DESC ";


        
  }
  else
  {
    $sql="SELECT *FROM usuarios WHERE nombre LIKE '%".$filtro."%'AND tipo_usuario=1 ORDER BY codigo_usuario  DESC";

  }
    $result=$this->con->query($sql) or trigger_error($this->con->error."[$sql]");
    
    while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
          $resultado[]=$row;    
      }

      
    
    return $resultado;


  }

   public function Actualizar_cliente($empresa,$codigo_usuario,$nombre,$identificacion,$estado,$direccion,$celular,$telefono,$whatsapp,$correo,$sexo,$condicionPago,$limiteCredito)
  {
  	 $this->con->conectar($empresa);
  	 $sql=" UPDATE [dbo].[usuarios]
   SET nombre='".$nombre."',
       direccion='".$direccion."',
       identificacion='".$identificacion."',
       telefono='".$telefono."', 
       celular='".$celular."', 
       whatsapp='".$whatsapp."', 
       correo='".$correo."', 
       sexo='".$sexo."',
       limite__credito='".$limiteCredito."',
       condicion_pago='".$condicionPago."',
       estado='".$estado."' 
       WHERE codigo_usuario='".$codigo_usuario."'
       ";
       $result=$this->con->query($sql);

        if($result)
        {
          return true;
        }
        else
        {
          
           return die( print_r( sqlsrv_errors(), true));
        	
        }
 
  	
  }
}

?>