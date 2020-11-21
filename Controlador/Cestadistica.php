<?php

require_once('../Modelo/estadistica.php');
     session_start();
 $usuario_registro=$_SESSION['id_usuario'];
 $empresa=$_SESSION['empresa'];
	$boton= $_POST['boton'];

  if($boton==='clientes')
  {
     $est=new Estadistica();
    $clientes=$est->contar_Clientes($empresa);
     echo json_encode($clientes);
  }
  if($boton==='articulos')
  {
     $est=new Estadistica();
    $articulos=$est->contar_ArticulosDisponibles($empresa);
     echo json_encode($articulos);
  }
  if($boton==='compras')
  {
     $est=new Estadistica();
     $compras=$est->contar_Compra($empresa);
     echo json_encode($compras);
  }
  if($boton==='ventas')
  {
     $est=new Estadistica();
    $ventas=$est->contar_Venta($empresa);
     echo json_encode($ventas);
  }
   if($boton==='total_compra')
  {
     $est=new Estadistica();
    $total_compra=$est->total_compra($empresa);
     echo json_encode($total_compra);
  }
   if($boton==='total_venta')
  {
     $est=new Estadistica();
    $total_venta=$est->total_venta($empresa);
     echo json_encode($total_venta);
  }
   if($boton==='total_gasto')
  {
     $est=new Estadistica();
    $total_gasto=$est->total_gasto($empresa);
     echo json_encode($total_gasto);
  }






	

?>