<?php
class Subcategoria 
{
	private $con;
	function __construct()
	{
		require_once('conexion.php');
		$this->con=new Conexion();
	}

    public function LlenarCategoria($empresa)
  {   $resultado=array();
    $this->con->conectar($empresa);
    $sql="SELECT codigo_categoria,nombre FROM categoria ";
    $result=$this->con->query($sql);
   while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
          $resultado[]=$row;    
      }
    return $resultado;
  }

	 public function InsertarSubCategoria($empresa,$nombre,$codigo_categoria)
	{
		$this->con->conectar($empresa);
		$sql="INSERT INTO subcategoria VALUES('".$nombre."','".$codigo_categoria."')";
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

  function listar_SubCategoria($filtro,$inicio=FALSE,$limite=FALSE,$empresa)
  {
    $this->con->conectar($empresa);
    $resultado=array();
    
    if ($inicio!==FALSE && $limite!==FALSE)
     {
       $sql="SELECT *FROM subcategoria WHERE nombre LIKE '%".$filtro."%' ORDER BY codigo_subcategoria  DESC ";
    }
  else
  {
    $sql="SELECT *FROM subcategoria WHERE nombre LIKE '%".$filtro."%' ORDER BY codigo_subcategoria  DESC";

  }
    $result=$this->con->query($sql) or trigger_error($this->con->error."[$sql]");
    
    while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
          $resultado[]=$row;    
      }

      
    
    return $resultado;


  }

   public function Actualizar_Subcategoria($empresa,$codigo_categoria,$nombre,$codigo_subcategoria)
        {
          $this->con->conectar($empresa);
          $sql=" UPDATE subcategoria SET nombre='".$nombre."',codigo_categoria='".$codigo_categoria."'
          WHERE codigo_subcategoria='".$codigo_subcategoria."'";
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
   public function Eliminar_Subcategoria($empresa,$codigo_subcategoria)
   {
      $this->con->conectar($empresa);
     $sql="DELETE FROM subcategoria WHERE subcategoria='".$subcategoria."'";
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