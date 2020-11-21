<?php
class Estadistica
{
	private $bd_adm;
	private $con;
	function __construct()
	{
		require_once('conexion.php');
		$this->con=new Conexion();
		$this->bd_adm=$this->con->dbname;
	}


  public function contar_Compra($empresa)
 {
 	$this->con->conectar($empresa);
  $sql="Select count( doc.id_documento) as compras
from documentos doc inner join detalle_documentos det on doc.id_documento=det.id_documento_afectado
where doc.estado=1 and tipo_documento=2";
  $result=$this->con->query($sql) or trigger_error($this->con->error."[$sql]");
    
    while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
          $resultado[]=$row;    
      }
    return $resultado;
 }
 public function contar_ArticulosDisponibles($empresa)
 {
  $this->con->conectar($empresa);
  $sql="Select count( codigo_articulo) as articulos from articulos where cantidad>0 and estado=1";
  $result=$this->con->query($sql) or trigger_error($this->con->error."[$sql]");
    
    while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
          $resultado[]=$row;    
      }
    return $resultado;
 }

   public function contar_Venta($empresa)
 {
  $this->con->conectar($empresa);
  $sql="Select count( doc.id_documento) as ventas
from documentos doc inner join detalle_documentos det on doc.id_documento=det.id_documento_afectado
where doc.estado=1 and tipo_documento=1";
  $result=$this->con->query($sql) or trigger_error($this->con->error."[$sql]");
    
    while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
          $resultado[]=$row;    
      }
    return $resultado;
 }

 public function contar_Clientes($empresa)
 {
  $this->con->conectar($empresa);
  $sql="Select count(codigo_usuario) as clientes from usuarios where tipo_usuario=3 and estado=1";
  $result=$this->con->query($sql) or trigger_error($this->con->error."[$sql]");
    
    while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
          $resultado[]=$row;    
      }
    return $resultado;
 }

 public function total_venta($empresa)
 {
  $this->con->conectar($empresa);
  $sql="Select SUM(doc.monto) as total_venta
from documentos doc  inner join tipos_documentos tipo on doc.tipo_documento=tipo.tipo_documento
left join detalle_documentos det on det.id_documento_afectado=doc.id_documento
where tipo.tipo_documento=1";
  $result=$this->con->query($sql) or trigger_error($this->con->error."[$sql]");
    
    while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
          $resultado[]=$row;    
      }
    return $resultado;
 }
 public function total_compra($empresa)
 {
  $this->con->conectar($empresa);
  $sql="Select SUM(doc.monto) as total_compra
from documentos doc  inner join tipos_documentos tipo on doc.tipo_documento=tipo.tipo_documento
left join detalle_documentos det on det.id_documento_afectado=doc.id_documento
where tipo.tipo_documento=2";
  $result=$this->con->query($sql) or trigger_error($this->con->error."[$sql]");
    
    while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
          $resultado[]=$row;    
      }
    return $resultado;
 }
 public function total_gasto($empresa)
 {
  $this->con->conectar($empresa);
  $sql="Select SUM(doc.monto) as total_gasto
from documentos doc  inner join tipos_documentos tipo on doc.tipo_documento=tipo.tipo_documento
left join detalle_documentos det on det.id_documento_afectado=doc.id_documento
where tipo.tipo_documento=3";
  $result=$this->con->query($sql) or trigger_error($this->con->error."[$sql]");
    
    while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
          $resultado[]=$row;    
      }
    return $resultado;
 }
       

  
}

?>