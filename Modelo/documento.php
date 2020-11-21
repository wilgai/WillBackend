<?php
/**
* 
*/
class Documento 
{
	private $con;
	function __construct()
	{
		require_once('conexion.php');
		$this->con=new Conexion();
	}

	function insertarDocumento($empresa,$usuario_registro,$codigoCliente,$tipoDocumento,$ncf,$referencia,$descuento,$detalle,$totaln,$itbistot)
	{
		$fecha=strftime( "%Y-%m-%d", time());
		$fecha_registro=strftime( "%Y-%m-%d", time());
		$this->con->conectar($empresa);
		$sql="INSERT INTO documentos VALUES ('$fecha','$fecha_registro','$detalle','$tipoDocumento',
			'$codigoCliente','$usuario_registro','$usuario_registro','$totaln','$itbistot','$descuento',
			'$ncf','','1','1','','')";
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
	function insertarDetalleDocumento($empresa,$detalles)
	{
		 $validar=0;
		 $idDocumento=0;
    	$argDetalle=json_decode($detalles,true);
    	     $buscarIdDocumento="SELECT MAX(id_documento) AS id_documento FROM documentos";
	         $this->con->conectar($empresa);
		     $result=$this->con->query($buscarIdDocumento);
		     while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
              $idDocumento=$row['id_documento'];  
			}

			if($idDocumento>0)
			{
				foreach ($argDetalle as $row) 
				{
    		    $sql="INSERT INTO detalle_documentos VALUES('".$row["codigo_articulo"]."','".$row["cantidad"]."','".$row["costo"]."',
    		    	'".$row["precio"]."','".$idDocumento."','".$row["itbis"]."')";
               $existencia=$row["cantidad"];
             $update="UPDATE articulos SET  cantidad=cantidad-$existencia WHERE codigo_articulo='".$row["codigo_articulo"]."'";
    		    $result1=$this->con->query($sql);
            $result2=$this->con->query($update);  
            codigo_articulo
            cantidad 
            precio 
            idFactura	 
            itbis       
    	        }                                          
    	        if($result1&&$result2)
    	        {
    	        	$validar=$idDocumento;
                
    	        }
    	        else
    	        {
    	        	$validar=false;
    	        }
			}
    	    
            return $validar;
	}
    public function datosFactura($empresa,$num_factura)
    {
        $resultado=array();
         $this->con->conectar($empresa);
        $sql="Select det.id_detalle_documento,doc.id_documento,det.codigo_articulo,art.nombre as articulo, det.cantidad,det.monto,us.nombre as cliente,doc.fecha,usa.nombre as vendedor,doc.ncf,doc.descuento,det.porciento_impuesto,(det.monto*det.cantidad) as importe
from documentos doc inner join detalle_documentos det on doc.id_documento=det.id_documento_afectado
inner join articulos art on det.codigo_articulo=art.codigo_articulo
inner join usuarios us on doc.codigo_usuario=us.codigo_usuario
inner join usuarios usa on doc.codigo_usuario_vendedor=usa.codigo_usuario
where doc.id_documento=$num_factura";
                  
                 
        
    $result=$this->con->query($sql)or trigger_error($this->con->error."[$sql]");
    if($result)
    {
      while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
          $resultado[]=$row;
              
      }
      return $resultado;
    }
    }

	function listarProducto($filtro,$inicio=FALSE,$limite=FALSE,$empresa)
    {
    $this->con->conectar($empresa);
    $resultado=array();
    
    if ($inicio!==FALSE && $limite!==FALSE)
     {
       $sql="select *from articulos where codigo_articulo like '%".$filtro."%' or nombre like '%".$filtro."%' ORDER BY codigo_articulo  DESC "; 
    }
  else
  {
    $sql="select *from articulos where codigo_articulo like '%".$filtro."%' or nombre like '%".$filtro."%' ORDER BY codigo_articulo  DESC ";

  }
    $result=$this->con->query($sql);
    if($result)
    {
    	while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
          $resultado[]=$row;
              
      }
    }
    else
    {
      $resultado[]=trigger_error($this->con->error."[$sql]");
    	
    }
    return $resultado;
  }

  function listarSuplidorGasto($filtro,$inicio=FALSE,$limite=FALSE,$empresa)
    {
    $this->con->conectar($empresa);
    $resultado=array();
    
    if ($inicio!==FALSE && $limite!==FALSE)
     {
       $sql="Select *from usuarios where (codigo_usuario like '%".$filtro."%' or nombre like '%".$filtro."%') and tipo_usuario=5 ORDER BY codigo_usuario  DESC "; 
    }
  else
  {
    $sql="Select *from usuarios where (codigo_usuario like '%".$filtro."%' or nombre like '%".$filtro."%') and tipo_usuario=5 ORDER BY codigo_usuario  DESC ";

  }
    $result=$this->con->query($sql);
    if($result)
    {
      while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
          $resultado[]=$row;
              
      }
      
    }
    else
    {
      $resultado[]=trigger_error($this->con->error."[$sql]");

      
    }
    return $resultado;
  }

   function listarCliente($filtro,$inicio=FALSE,$limite=FALSE,$empresa)
    {
    $this->con->conectar($empresa);
    $resultado=array();
    
    if ($inicio!==FALSE && $limite!==FALSE)
     {
       $sql="Select *from usuarios where (codigo_usuario like '%".$filtro."%' or nombre like '%".$filtro."%') and tipo_usuario=3 ORDER BY codigo_usuario  DESC "; 
    }
  else
  {
    $sql="Select *from usuarios where (codigo_usuario like '%".$filtro."%' or nombre like '%".$filtro."%') and tipo_usuario=3 ORDER BY codigo_usuario  DESC ";

  }
    $result=$this->con->query($sql);
    if($result)
    {
    	while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
          $resultado[]=$row;
              
      }
      
    }
    else
    {
      $resultado[]=trigger_error($this->con->error."[$sql]");

    	
    }
    return $resultado;
  }

 function consultar_Venta($filtro,$start_date,$end_date,$inicio=FALSE,$limite=FALSE,$empresa)
  {
    $this->con->conectar($empresa);
    $resultado=array();
    
    if ($inicio!==FALSE && $limite!==FALSE)
     {
       $sql="SELECT  art.nombre as articulo,SUM(det.cantidad)as cantidad ,SUM(det.monto) as precio_total,SUM(det.porciento_impuesto) as total_itbis,cat.nombre as categoria
from documentos doc
inner join detalle_documentos det on doc.id_documento=det.id_documento_afectado
inner join tipos_documentos tip on tip.tipo_documento=doc.tipo_documento
inner join usuarios us on us.codigo_usuario=doc.codigo_usuario
inner join usuarios us_r on us_r.codigo_usuario=doc.codigo_usuario_registro
inner join articulos art on art.codigo_articulo=det.codigo_articulo
inner join subcategoria sub on sub.codigo_subcategoria=art.codigo_subcategoria
inner join categoria cat on cat.codigo_categoria=sub.codigo_categoria WHERE ";
       if($start_date!=""&&$end_date!="")
       {
        $sql.= "doc.fecha BETWEEN '".$start_date."' AND '".$end_date."' AND ";
       }
      else if($filtro!="")
          {
           $sql.= "OR art.nombre LIKE '%".$filtro."%' ";
           $sql.= "OR cat.nombre LIKE '%".$filtro."%' ";
           $sql.= "AND ";
          }
       $sql.= "doc.tipo_documento='2' ";
       $sql.= " group by art.nombre,cat.nombre";
       
   
  }
  else
  {
    $sql="SELECT  art.nombre as articulo,SUM(det.cantidad)as cantidad ,SUM(det.monto) as precio_total,SUM(det.porciento_impuesto) as total_itbis,cat.nombre as categoria
from documentos doc
inner join detalle_documentos det on doc.id_documento=det.id_documento_afectado
inner join tipos_documentos tip on tip.tipo_documento=doc.tipo_documento
inner join usuarios us on us.codigo_usuario=doc.codigo_usuario
inner join usuarios us_r on us_r.codigo_usuario=doc.codigo_usuario_registro
inner join articulos art on art.codigo_articulo=det.codigo_articulo
inner join subcategoria sub on sub.codigo_subcategoria=art.codigo_subcategoria
inner join categoria cat on cat.codigo_categoria=sub.codigo_categoria WHERE ";
       if($start_date!="" && $end_date!="")
       {
        $sql.= "doc.fecha BETWEEN '".$start_date."' AND '".$end_date."' AND ";
       }
      else if($filtro!="")
          {
           
           $sql.= " art.nombre LIKE '%".$filtro."%' ";
           $sql.= "OR cat.nombre LIKE '%".$filtro."%' ";
          
           $sql.= "AND ";
          }
       $sql.= "doc.tipo_documento='1' ";
       $sql.= " group by art.nombre,cat.nombre";
    }
  
    $result=$this->con->query($sql) or trigger_error($this->con->error."[$sql]");
    
    while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
          $resultado[]=$row;    
      }
    return $resultado;
}
function consultar_VentaP($filtro,$start_date,$end_date,$inicio=FALSE,$limite=FALSE,$empresa)
  {
    $resultado=array();
    $this->con->conectar($empresa);
    $resultado=array();
    
    if ($inicio!==FALSE && $limite!==FALSE)
     {
       $sql="
SET LANGUAGE Spanish;
Select SUM(doc.monto) as total_venta,DATENAME(MONTH,doc.fecha) as fecha,Sum(det.cantidad) as cantidad
from documentos doc  inner join tipos_documentos tipo on doc.tipo_documento=tipo.tipo_documento
inner join detalle_documentos det on det.id_documento_afectado=doc.id_documento
inner join usuarios us  on us.codigo_usuario=doc.codigo_usuario_vendedor
where doc.tipo_documento=2 group by DATENAME(MONTH,doc.fecha) ";
       
  }
  else
  {
    $sql="

Select SUM(doc.monto) as total_venta,DATENAME(MONTH,doc.fecha) as fecha,Sum(det.cantidad) as cantidad
from documentos doc  inner join tipos_documentos tipo on doc.tipo_documento=tipo.tipo_documento
inner join detalle_documentos det on det.id_documento_afectado=doc.id_documento
inner join usuarios us  on us.codigo_usuario=doc.codigo_usuario_vendedor
where doc.tipo_documento=2 group by DATENAME(MONTH,doc.fecha)";  
    }
  
    $result=$this->con->query($sql) or trigger_error($this->con->error."[$sql]");
    
    while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
          $resultado[]=$row;    
      }
    return $resultado;
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


    function consultar_Factura($filtro,$start_date,$end_date,$inicio=FALSE,$limite=FALSE,$empresa)
  {
    $this->con->conectar($empresa);
    $resultado=array();
    
    if ($inicio!==FALSE && $limite!==FALSE)
     {
       $sql="SELECT  doc.id_documento,us.nombre as suplidor,doc.monto,doc.itbis,doc.fecha,us_r.nombre as registradopor,doc.estado,doc.ncf
from documentos doc
inner join detalle_documentos det on doc.id_documento=det.id_documento_afectado
inner join tipos_documentos tip on tip.tipo_documento=doc.tipo_documento
inner join usuarios us on us.codigo_usuario=doc.codigo_usuario
inner join usuarios us_r on us_r.codigo_usuario=doc.codigo_usuario_registro
inner join articulos art on art.codigo_articulo=det.codigo_articulo
inner join subcategoria sub on sub.codigo_subcategoria=art.codigo_subcategoria
inner join categoria cat on cat.codigo_categoria=sub.codigo_categoria WHERE ";
       if($start_date!=""&&$end_date!="")
       {
        $sql.= "doc.fecha BETWEEN '".$start_date."' AND '".$end_date."' AND ";
       }
      else if($filtro!="")
          {
           $sql.= "(doc.id_documento LIKE '%".$filtro."%' ";
           $sql.= "OR us.nombre LIKE '%".$filtro."%' ";
           $sql.= "OR doc.monto LIKE '%".$filtro."%' ";
           $sql.= "OR doc.itbis LIKE '%".$filtro."%' ";
           $sql.= "OR us_r.nombre LIKE '%".$filtro."%' ";
           $sql.= "OR doc.ncf LIKE '%".$filtro."%') ";
           $sql.= "AND ";
          }
       $sql.= "doc.tipo_documento='1' ";
   
  }
  else
  {
    $sql="SELECT  doc.id_documento,us.nombre suplidor,doc.monto,doc.itbis,doc.fecha,us_r.nombre as registradopor,doc.estado,doc.ncf
from documentos doc
inner join detalle_documentos det on doc.id_documento=det.id_documento_afectado
inner join tipos_documentos tip on tip.tipo_documento=doc.tipo_documento
inner join usuarios us on us.codigo_usuario=doc.codigo_usuario
inner join usuarios us_r on us_r.codigo_usuario=doc.codigo_usuario_registro
inner join articulos art on art.codigo_articulo=det.codigo_articulo
inner join subcategoria sub on sub.codigo_subcategoria=art.codigo_subcategoria
inner join categoria cat on cat.codigo_categoria=sub.codigo_categoria WHERE ";
       if($start_date!="" && $end_date!="")
       {
        $sql.= "doc.fecha BETWEEN '".$start_date."' AND '".$end_date."' AND ";
       }
      else if($filtro!="")
          {
           $sql.= "(doc.id_documento LIKE '%".$filtro."%' ";
           $sql.= "OR us.nombre LIKE '%".$filtro."%' ";
           $sql.= "OR doc.monto LIKE '%".$filtro."%' ";
           $sql.= "OR doc.itbis LIKE '%".$filtro."%' ";
           $sql.= "OR us_r.nombre LIKE '%".$filtro."%' ";
           $sql.= "OR doc.ncf LIKE '%".$filtro."%') ";
           $sql.= "AND ";
          }
       $sql.= "doc.tipo_documento='1' ";
    }
  
    $result=$this->con->query($sql) or trigger_error($this->con->error."[$sql]");
    
    while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
          $estado='';
           $fecha=date_format($row['fecha'], 'd-m-Y');
          //$fecha=date("d/m/Y", strtotime($row["fecha"]));
           
          $sub_array = array();
         $sub_array['id_documento'] = $row["id_documento"];
         $sub_array['suplidor'] = $row["suplidor"];
         $sub_array['monto'] = $row["monto"];
         $sub_array['itbis'] = $row["itbis"];
         $sub_array['registradopor'] = $row["registradopor"];
         $sub_array['ncf'] = $row["ncf"];
         $sub_array['fecha'] = $fecha;
         $sub_array['estado'] = $row['estado'];


          $resultado[]=$sub_array;    
      }

      
    
    return $resultado;
}

  function datosDetalleFactura($empresa,$num_factura)
                    {
                        $resultado=array();
                         $this->con->conectar($empresa);
                        $sql="Select det.id_detalle_documento,doc.id_documento,det.codigo_articulo,art.nombre as articulo, det.cantidad,det.monto,us.nombre as cliente,doc.fecha,usa.nombre as usuario,doc.ncf,doc.descuento,det.porciento_impuesto,(det.monto*det.cantidad) as importe
                from documentos doc inner join detalle_documentos det on doc.id_documento=det.id_documento_afectado
                inner join articulos art on det.codigo_articulo=art.codigo_articulo
                inner join usuarios us on doc.codigo_usuario=us.codigo_usuario
                inner join usuarios usa on doc.codigo_usuario_vendedor=usa.codigo_usuario
                where doc.id_documento=$num_factura";
                                  
                                 
                        
                    $result=$this->con->query($sql)or trigger_error($this->con->error."[$sql]");
                    if($result)
                    {
                      while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
                        $fecha=date_format($row['fecha'], 'd-m-Y');
                          $sub_array = array();
                           $sub_array['id_documento'] = $row["id_documento"];
                           $sub_array['codigo_articulo'] = $row["codigo_articulo"];
                           $sub_array['articulo'] = $row["articulo"];
                           $sub_array['cantidad'] = $row["cantidad"];
                           $sub_array['monto'] = $row["monto"];
                           $sub_array['ncf'] = $row["ncf"];
                           $sub_array['fecha'] = $fecha;
                           $sub_array['suplidor'] = $row['cliente'];
                           $sub_array['usuario'] = $row['usuario'];
                           $sub_array['descuento'] = $row['descuento'];
                           $sub_array['porciento_impuesto'] = $row['porciento_impuesto'];
                           $sub_array['importe'] = $row['importe'];


                           $resultado[]=$sub_array; 
                              
                      }
                      return $resultado;
                    }

  

}

function movimiento($filtro,$start_date,$end_date,$inicio=FALSE,$limite=FALSE,$empresa)
  {
    $this->con->conectar($empresa);
    $resultado=array();
    
    if ($inicio!==FALSE && $limite!==FALSE)
     {
       $sql="Select tipo.nombre,SUM(doc.monto) as total
from documentos doc  inner join tipos_documentos tipo on doc.tipo_documento=tipo.tipo_documento
left join detalle_documentos det on det.id_documento_afectado=doc.id_documento  ";
       if($start_date!=""&&$end_date!="")
       {
        $sql.= "WHERE doc.fecha BETWEEN '".$start_date."' AND '".$end_date."'  ";
       }
      
       $sql.= "group by tipo.nombre ";
   
  }
  else
  {
    $sql="Select tipo.nombre,SUM(doc.monto) as total
from documentos doc  inner join tipos_documentos tipo on doc.tipo_documento=tipo.tipo_documento
left join detalle_documentos det on det.id_documento_afectado=doc.id_documento  ";
       if($start_date!="" && $end_date!="")
       {
        $sql.= "WHERE doc.fecha BETWEEN '".$start_date."' AND '".$end_date."'  ";
       }
      
       $sql.= "group by tipo.nombre ";
    }
  
    $result=$this->con->query($sql) or trigger_error($this->con->error."[$sql]");
    
    while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
         


          $resultado[]=$row;    
      }

    return $resultado;
}

function productoMasVendido($cant_fila,$start_date,$end_date,$inicio=FALSE,$limite=FALSE,$empresa)
  {
    $this->con->conectar($empresa);
    $resultado=array();
    
    if ($inicio!==FALSE && $limite!==FALSE)
     {
       $sql="SELECT TOP $cant_fila   art.codigo_articulo, art.nombre,sum(det.cantidad) as total,SUM(det.monto) as costo
from documentos doc
inner join detalle_documentos det on doc.id_documento=det.id_documento_afectado
inner join tipos_documentos tip on tip.tipo_documento=doc.tipo_documento
inner join usuarios us on us.codigo_usuario=doc.codigo_usuario
inner join usuarios us_r on us_r.codigo_usuario=doc.codigo_usuario_registro
inner join articulos art on art.codigo_articulo=det.codigo_articulo
inner join subcategoria sub on sub.codigo_subcategoria=art.codigo_subcategoria
inner join categoria cat on cat.codigo_categoria=sub.codigo_categoria WHERE ";
       if($start_date!=""&&$end_date!="")
       {
        $sql.= "doc.fecha BETWEEN '".$start_date."' AND '".$end_date."' AND ";
       }
      /*else if($filtro!="")
          {
           $sql.= "OR art.nombre LIKE '%".$filtro."%' ";
           $sql.= "OR cat.nombre LIKE '%".$filtro."%' ";
           $sql.= "AND ";
          }*/
       $sql.= "doc.tipo_documento='1' ";
       $sql.= " group by art.nombre,art.codigo_articulo 

                 ORDER  BY SUM(det.cantidad) DESC;";
       
   
  }
  else
  {
    $sql="SELECT TOP $cant_fila  art.codigo_articulo, art.nombre,sum(det.cantidad) as total,SUM(det.monto) as costo
from documentos doc
inner join detalle_documentos det on doc.id_documento=det.id_documento_afectado
inner join tipos_documentos tip on tip.tipo_documento=doc.tipo_documento
inner join usuarios us on us.codigo_usuario=doc.codigo_usuario
inner join usuarios us_r on us_r.codigo_usuario=doc.codigo_usuario_registro
inner join articulos art on art.codigo_articulo=det.codigo_articulo
inner join subcategoria sub on sub.codigo_subcategoria=art.codigo_subcategoria
inner join categoria cat on cat.codigo_categoria=sub.codigo_categoria WHERE ";
       if($start_date!="" && $end_date!="")
       {
        $sql.= "doc.fecha BETWEEN '".$start_date."' AND '".$end_date."' AND ";
       }
      /*else if($filtro!="")
          {
           
           $sql.= " art.nombre LIKE '%".$filtro."%' ";
           $sql.= "OR cat.nombre LIKE '%".$filtro."%' ";
          
           $sql.= "AND ";
          }*/
       $sql.= "doc.tipo_documento='1' ";
       $sql.= " group by art.nombre,art.codigo_articulo 

                 ORDER  BY SUM(det.cantidad) DESC;";
    }
  
    $result=$this->con->query($sql) or trigger_error($this->con->error."[$sql]");
    
    while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
          $resultado[]=$row;    
      }
    return $resultado;
}

function categoriaMasVendido($cant_fila,$start_date,$end_date,$inicio=FALSE,$limite=FALSE,$empresa)
  {
    $this->con->conectar($empresa);
    $resultado=array();
    
    if ($inicio!==FALSE && $limite!==FALSE)
     {
       $sql="SELECT TOP $cant_fila   cat.codigo_categoria, cat.nombre,sum(det.cantidad) as total,SUM(det.monto) as costo
from documentos doc
inner join detalle_documentos det on doc.id_documento=det.id_documento_afectado
inner join tipos_documentos tip on tip.tipo_documento=doc.tipo_documento
inner join usuarios us on us.codigo_usuario=doc.codigo_usuario
inner join usuarios us_r on us_r.codigo_usuario=doc.codigo_usuario_registro
inner join articulos art on art.codigo_articulo=det.codigo_articulo
inner join subcategoria sub on sub.codigo_subcategoria=art.codigo_subcategoria
inner join categoria cat on cat.codigo_categoria=sub.codigo_categoria WHERE ";
       if($start_date!=""&&$end_date!="")
       {
        $sql.= "doc.fecha BETWEEN '".$start_date."' AND '".$end_date."' AND ";
       }
      /*else if($filtro!="")
          {
           $sql.= "OR art.nombre LIKE '%".$filtro."%' ";
           $sql.= "OR cat.nombre LIKE '%".$filtro."%' ";
           $sql.= "AND ";
          }*/
       $sql.= "doc.tipo_documento='1' ";
       $sql.= " group by cat.nombre,cat.codigo_categoria

                 ORDER  BY SUM(det.cantidad) DESC;";
       
   
  }
  else
  {
    $sql="SELECT TOP $cant_fila   cat.codigo_categoria, cat.nombre,sum(det.cantidad) as total,SUM(det.monto) as costo
from documentos doc
inner join detalle_documentos det on doc.id_documento=det.id_documento_afectado
inner join tipos_documentos tip on tip.tipo_documento=doc.tipo_documento
inner join usuarios us on us.codigo_usuario=doc.codigo_usuario
inner join usuarios us_r on us_r.codigo_usuario=doc.codigo_usuario_registro
inner join articulos art on art.codigo_articulo=det.codigo_articulo
inner join subcategoria sub on sub.codigo_subcategoria=art.codigo_subcategoria
inner join categoria cat on cat.codigo_categoria=sub.codigo_categoria WHERE ";
       if($start_date!="" && $end_date!="")
       {
        $sql.= "doc.fecha BETWEEN '".$start_date."' AND '".$end_date."' AND ";
       }
      /*else if($filtro!="")
          {
           
           $sql.= " art.nombre LIKE '%".$filtro."%' ";
           $sql.= "OR cat.nombre LIKE '%".$filtro."%' ";
          
           $sql.= "AND ";
          }*/
       $sql.= "doc.tipo_documento='1' ";
       $sql.= " group by cat.nombre,cat.codigo_categoria 

                 ORDER  BY SUM(det.cantidad) DESC;";
    }
  
    $result=$this->con->query($sql) or trigger_error($this->con->error."[$sql]");
    
    while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
          $resultado[]=$row;    
      }
    return $resultado;
}

function clienteMasVendido($cant_fila,$start_date,$end_date,$inicio=FALSE,$limite=FALSE,$empresa)
  {
    $this->con->conectar($empresa);
    $resultado=array();
    
    if ($inicio!==FALSE && $limite!==FALSE)
     {
       $sql="SELECT TOP $cant_fila   us.codigo_usuario, us.nombre,sum(det.cantidad) as total,SUM(det.monto) as costo
from documentos doc
inner join detalle_documentos det on doc.id_documento=det.id_documento_afectado
inner join tipos_documentos tip on tip.tipo_documento=doc.tipo_documento
inner join usuarios us on us.codigo_usuario=doc.codigo_usuario
inner join usuarios us_r on us_r.codigo_usuario=doc.codigo_usuario_registro
inner join articulos art on art.codigo_articulo=det.codigo_articulo
inner join subcategoria sub on sub.codigo_subcategoria=art.codigo_subcategoria
inner join categoria cat on cat.codigo_categoria=sub.codigo_categoria WHERE ";
       if($start_date!=""&&$end_date!="")
       {
        $sql.= "doc.fecha BETWEEN '".$start_date."' AND '".$end_date."' AND ";
       }
      /*else if($filtro!="")
          {
           $sql.= "OR art.nombre LIKE '%".$filtro."%' ";
           $sql.= "OR cat.nombre LIKE '%".$filtro."%' ";
           $sql.= "AND ";
          }*/
       $sql.= "doc.tipo_documento='1' ";
       $sql.= " group by us.nombre,us.codigo_usuario

                 ORDER  BY SUM(det.cantidad) DESC;";
       
   
  }
  else
  {
    $sql="SELECT TOP $cant_fila   us.codigo_usuario, us.nombre,sum(det.cantidad) as total,SUM(det.monto) as costo
from documentos doc
inner join detalle_documentos det on doc.id_documento=det.id_documento_afectado
inner join tipos_documentos tip on tip.tipo_documento=doc.tipo_documento
inner join usuarios us on us.codigo_usuario=doc.codigo_usuario
inner join usuarios us_r on us_r.codigo_usuario=doc.codigo_usuario_registro
inner join articulos art on art.codigo_articulo=det.codigo_articulo
inner join subcategoria sub on sub.codigo_subcategoria=art.codigo_subcategoria
inner join categoria cat on cat.codigo_categoria=sub.codigo_categoria WHERE ";
       if($start_date!="" && $end_date!="")
       {
        $sql.= "doc.fecha BETWEEN '".$start_date."' AND '".$end_date."' AND ";
       }
      /*else if($filtro!="")
          {
           
           $sql.= " art.nombre LIKE '%".$filtro."%' ";
           $sql.= "OR cat.nombre LIKE '%".$filtro."%' ";
          
           $sql.= "AND ";
          }*/
       $sql.= "doc.tipo_documento='1' ";
       $sql.= " group by us.nombre,us.codigo_usuario 

                 ORDER  BY SUM(det.cantidad) DESC;";
    }
  
    $result=$this->con->query($sql) or trigger_error($this->con->error."[$sql]");
    
    while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
          $resultado[]=$row;    
      }
    return $resultado;
}






	
}




?>