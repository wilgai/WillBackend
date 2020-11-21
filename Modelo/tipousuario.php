<?php
class TipoDocumento 
{
	private $con;
	function __construct()
	{
		require_once('conexion.php');
		$this->con=new Conexion();
	}

	 public function InsertarTipoDocumento($empresa,$nombre)
	{
		$this->con->conectar($empresa);
		$sql="INSERT INTO tipos_usuarios VALUES('".$nombre."')";
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

  function listar_TipoDocumento($filtro,$inicio=FALSE,$limite=FALSE,$empresa)
  {
    $this->con->conectar($empresa);
    $resultado=array();
    
    if ($inicio!==FALSE && $limite!==FALSE)
     {
       $sql="SELECT *FROM tipos_documentos WHERE nombre LIKE '%".$filtro."%' ORDER BY tipo_documento  DESC ";
    }
  else
  {
    $sql="SELECT *FROM tipos_documentos WHERE nombre LIKE '%".$filtro."%' ORDER BY tipo_documento  DESC";

  }
    $result=$this->con->query($sql) or trigger_error($this->con->error."[$sql]");
    
    while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
          $resultado[]=$row;    
      }

      
    
    return $resultado;


  }

   public function Actualizar_categoria($empresa,$tipo_documento,$nombre)
        {
          $this->con->conectar($empresa);
          $sql=" UPDATE tipos_documentos SET  
          nombre='".$nombre."',
          WHERE tipo_documento='".$tipo_documento."'";

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
   public function Eliminar_tipodocumento($empresa,$tipo_documento)
   {
      $this->con->conectar($empresa);
     $sql="DELETE FROM tipos_documentos WHERE tipo_documento='".$tipo_documento."'";
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
 

 



//$prod=new Producto();
//echo $prod->Actualizar_articulo('1','Fgcomputech','','','','','','','','','','','','','','','','','','','','','');
?>