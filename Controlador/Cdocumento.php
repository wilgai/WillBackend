<?php
require_once('../Modelo/documento.php');
 session_start();
 $usuario_registro=$_SESSION['id_usuario'];
 $empresa=$_SESSION['empresa'];
$opcion= $_POST['opcion'];
	$boton= $_POST['boton'];


    if($boton==='buscarProd')
  {
    $inicio = 0;
        $limite = 6;
        if (isset($_POST['pagina'])) {
          $pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
        $valor=$_POST['valor'];
    $ins=new Documento();
    $a= $ins->listarProducto($valor,$inicio=FALSE,$limite=FALSE,$empresa);
    $b=count($a);
    $c= $ins->listarProducto($valor,$inicio,$limite,$empresa);
    
    echo json_encode($c)."*".$b;
  }
  if($boton==='buscarCli')
  {
    $inicio = 0;
        $limite = 6;
        if (isset($_POST['pagina'])) {
          $pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
        $valor=$_POST['valor'];
    $ins=new Documento();
    $a= $ins->listarCliente($valor,$inicio=FALSE,$limite=FALSE,$empresa);
    $b=count($a);
    $c= $ins->listarCliente($valor,$inicio,$limite,$empresa);
    
    echo json_encode($c)."*".$b;
  }

	  if($opcion==='documento')
    {
	  if($boton==='registrarDocumento')
	   {
      
        $documento=new Documento();

            $codigoCliente=$_POST['codigoCliente'];
            
            $tipoDocumento="1";
            $ncf=$_POST['ncf'];
            $referencia=$_POST['referencia'];
            $descuento=$_POST['descuento'];
            $detalle=$_POST['detalle'];
            $totaln=$_POST['totalNeto'];
            $itbistot=$_POST['itbistot'];

            if($documento->insertarDocumento($empresa,$usuario_registro,$codigoCliente,$tipoDocumento,$ncf,$referencia,$descuento,$detalle,$totaln,$itbistot))
            {
              echo 1;
            }
            else
            {
              echo 0;
            }
            //echo $documento->insertarDocumento($empresa,$usuario_registro,$codigoCliente,$tipoDocumento,$ncf,$referencia,$descuento,$detalle,$totaln,$itbistot);
         
            
      }


      if($boton==='registrarDetalleDocumento')
      {
            $documento=new Documento();
            //var_dump($_POST);
             if($_POST)
             {
              $detalles=($_POST["arreglo"]);
              echo $documento->insertarDetalleDocumento($empresa,$detalles);
             }
             
           

      }
    }
    if($opcion==='venta')
    {
      if($boton==='registrarVenta')
      {
         $pedido=new Pedido();
         $pedido->idUsuario=$idUsuario;   
         $pedido->idCliente=$_POST['idCliente'];
         $pedido->tipoPedido=$_POST['tipoPedido'];
         $pedido->tipoComprobante=$_POST['tipoComprobante'];
         $pedido->serieComprobante=$_POST['serieComprobante'];
         $pedido->numeroComprobante=$_POST['numeroComprobante'];
         $pedido->monto=$_POST['monto'];
         $pedido->total=$_POST['total'];
         $pedido->cambio=$_POST['cambio'];
         $pedido->pagocon=$_POST['pagocon'];
         $pedido->formadepago=$_POST['formadepago'];
         $pedido->insertarPedidoEntregado();
         $pedido->insertarVenta();
         //var_dump($_POST);

      }
      if($boton==='registrarDetalleVenta')
      {

          $pedido=new Pedido();
            //var_dump($_POST);
             if($_POST)
             {
              $detalles=($_POST["arreglo"]);
             }

             //print_r($detalles);
             
            echo $pedido->insertarDetallePedido($detalles);
             
      
       }
     }

     if($boton==='buscarVenta')
  {
    $inicio = 0;
        $limite = 6;
        if (isset($_POST['pagina'])) {
          $pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
        $valor=$_POST['valor'];
        $start_date=$_POST['start_date'];
        $end_date=$_POST['end_date'];
    $ins=new Documento();
    $a= $ins->consultar_Venta($valor,$start_date,$end_date,$inicio=FALSE,$limite=FALSE,$empresa);
    $b=count($a);
    $c= $ins->consultar_Venta($valor,$start_date,$end_date,$inicio,$limite,$empresa);
    
    echo json_encode($c)."*".$b;
  }
  if($boton==='buscarVentaP')
  {
    $inicio = 0;
        $limite = 6;
        if (isset($_POST['pagina'])) {
          $pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
        $valor=$_POST['valor'];
        $start_date=$_POST['start_date'];
        $end_date=$_POST['end_date'];
    $ins=new Documento();
    $a= $ins->consultar_VentaP($valor,$start_date,$end_date,$inicio=FALSE,$limite=FALSE,$empresa);
    $b=count($a);
    $c= $ins->consultar_VentaP($valor,$start_date,$end_date,$inicio,$limite,$empresa);
    
    echo json_encode($c)."*".$b;
  }

      if($boton==='buscarFactura')
  {
    $inicio = 0;
        $limite = 6;
        if (isset($_POST['pagina'])) {
          $pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
        $valor=$_POST['valor'];
        $start_date=$_POST['start_date'];
        $end_date=$_POST['end_date'];
    $ins=new Documento();
    $a= $ins->consultar_Factura($valor,$start_date,$end_date,$inicio=FALSE,$limite=FALSE,$empresa);
    $b=count($a);
    $c= $ins->consultar_Factura($valor,$start_date,$end_date,$inicio,$limite,$empresa);
    
    echo json_encode($c)."*".$b;
  }




  if($boton==='sup_gasto')
  {
    $inicio = 0;
        $limite =4;
        if (isset($_POST['pagina'])) {
          $pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
        $valor=$_POST['valor'];
    $ins=new Documento();
    $a= $ins->listarSuplidorGasto($valor,$inicio=FALSE,$limite=FALSE,$empresa);
    $b=count($a);
    $c= $ins->listarSuplidorGasto($valor,$inicio,$limite,$empresa);
    
    echo json_encode($c)."*".$b;
  }

  if($boton==='buscarDetalleFactura')
  {
    $id_documento=$_POST['id_documento'];
    $ins=new Documento();
    
    echo json_encode($ins->datosDetalleFactura($empresa,$id_documento));
  }

   if($boton==='buscarMovimiento')
  {
    $inicio = 0;
        $limite = 6;
        if (isset($_POST['pagina'])) {
          $pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
        $valor=$_POST['valor'];
        $start_date=$_POST['start_date'];
        $end_date=$_POST['end_date'];
    $ins=new Documento();
    $a= $ins->movimiento($valor,$start_date,$end_date,$inicio=FALSE,$limite=FALSE,$empresa);
    $b=count($a);
    $c= $ins->movimiento($valor,$start_date,$end_date,$inicio,$limite,$empresa);
    
    echo json_encode($c)."*".$b;
  }

  if($boton==='productoMasVendido')
  {
    $inicio = 0;
        $limite = 6;
        if (isset($_POST['pagina'])) {
          $pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
        $cant_fila=$_POST['cant_fila'];
        $start_date=$_POST['start_date'];
        $end_date=$_POST['end_date'];
    $ins=new Documento();
    $a= $ins->productoMasVendido($cant_fila,$start_date,$end_date,$inicio=FALSE,$limite=FALSE,$empresa);
    $b=count($a);
    $c= $ins->productoMasVendido($cant_fila,$start_date,$end_date,$inicio,$limite,$empresa);
    
    echo json_encode($c)."*".$b;
  }
  if($boton==='categoriaMasVendido')
  {
    $inicio = 0;
        $limite = 6;
        if (isset($_POST['pagina'])) {
          $pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
        $cant_fila=$_POST['cant_fila'];
        $start_date=$_POST['start_date'];
        $end_date=$_POST['end_date'];
    $ins=new Documento();
    $a= $ins->categoriaMasVendido($cant_fila,$start_date,$end_date,$inicio=FALSE,$limite=FALSE,$empresa);
    $b=count($a);
    $c= $ins->categoriaMasVendido($cant_fila,$start_date,$end_date,$inicio,$limite,$empresa);
    
    echo json_encode($c)."*".$b;
  }

  if($boton==='clienteMasVendido')
  {
    $inicio = 0;
        $limite = 6;
        if (isset($_POST['pagina'])) {
          $pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
        $cant_fila=$_POST['cant_fila'];
        $start_date=$_POST['start_date'];
        $end_date=$_POST['end_date'];
    $ins=new Documento();
    $a= $ins->clienteMasVendido($cant_fila,$start_date,$end_date,$inicio=FALSE,$limite=FALSE,$empresa);
    $b=count($a);
    $c= $ins->clienteMasVendido($cant_fila,$start_date,$end_date,$inicio,$limite,$empresa);
    
    echo json_encode($c)."*".$b;
  }



  ?>   