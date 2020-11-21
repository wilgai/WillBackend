<?php
require_once('../Modelo/compra.php');
 session_start();
 $usuario_registro=$_SESSION['id_usuario'];
 $empresa=$_SESSION['empresa'];
	$boton= $_POST['boton'];
  $opcion= $_POST['opcion'];


 
     if($boton==='buscar1')
    {
        $query=$_POST['query'];
        //$query='wil';
        $ins=new Compra();
        $c= $ins->listarProducto($query);
        echo json_encode($c);
    }

    if($boton==='buscarProd')
  {
    $inicio = 0;
        $limite = 6;
        if (isset($_POST['pagina'])) {
          $pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
        $valor=$_POST['valor'];
    $ins=new Compra();
    $a= $ins->listarProducto($valor,$inicio=FALSE,$limite=FALSE,$empresa);
    $b=count($a);
    $c= $ins->listarProducto($valor,$inicio,$limite,$empresa);
    
    echo json_encode($c)."*".$b;
  }

  if($boton==='buscarSup')
  {
    $inicio = 0;
        $limite = 6;
        if (isset($_POST['pagina'])) {
          $pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
        $valor=$_POST['valor'];
    $ins=new Compra();
    $a= $ins->listarSuplidor($valor,$inicio=FALSE,$limite=FALSE,$empresa);
    $b=count($a);
    $c= $ins->listarSuplidor($valor,$inicio,$limite,$empresa);
    
    echo json_encode($c)."*".$b;
  }

    if($opcion==='documento')
    {
    if($boton==='registrarDocumento')
     {
        $documento=new Compra();

            $codigoCliente=$_POST['codigoSuplidor'];
            $tipoDocumento="2";
            $ncf=$_POST['ncf'];
            $referencia=$_POST['referencia'];
            $descuento=$_POST['descuento'];
            $detalle=$_POST['detalle'];
            $totaln=$_POST['totaln'];
            $itbistot=$_POST['itbistot'];

            if($documento->insertarCompra($empresa,$usuario_registro,$codigoCliente,$tipoDocumento,$ncf,$referencia,$descuento,$detalle,$totaln,$itbistot))
            {
              echo 1;
            }
            else
            {
              echo 0;
            }
            //echo $documento->insertarDocumento($empresa,$usuario_registro,$codigoCliente,$tipoDocumento,$ncf,$referencia,$descuento,$detalle,$totaln,$itbistot);  
      }
    }

      if($opcion==='documento')
    {
    if($boton==='registrarDocumentoGasto')
     {
        $documento=new Compra();

            $codigoCliente=$_POST['codigoSuplidor'];
            $tipoDocumento="3";
            $ncf=$_POST['ncf'];
            $referencia=$_POST['referencia'];
            $descuento=$_POST['descuento'];
            $detalle=$_POST['detalle'];
            $totaln=$_POST['totaln'];
            $itbistot=$_POST['itbistot'];

            if($documento->insertarCompraGasto($empresa,$usuario_registro,$codigoCliente,$tipoDocumento,$ncf,$referencia,$descuento,$detalle,$totaln,$itbistot))
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
            $documento=new Compra();
            //var_dump($_POST);
             if($_POST)
             {
              $detalles=($_POST["arreglo"]);
              echo $documento->insertarDetalleCompra($empresa,$detalles);
             }
      }
    }

      if($boton==='buscarCompra')
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
    $ins=new Compra();
    $a= $ins->consultar_Compra($valor,$start_date,$end_date,$inicio=FALSE,$limite=FALSE,$empresa);
    $b=count($a);
    $c= $ins->consultar_Compra($valor,$start_date,$end_date,$inicio,$limite,$empresa);
    
    echo json_encode($c)."*".$b;
  }

    if($boton==='buscarGastos')
     {
        $inicio = 0;
        $limite = 6;
        if (isset($_POST['pagina'])) {
          $pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
        $valor=$_POST['valor'];
        
    $ins=new Compra();
    $a= $ins->consultar_CompraGasto($valor,$inicio=FALSE,$limite=FALSE,$empresa);
    $b=count($a);
    $c= $ins->consultar_CompraGasto($valor,$inicio,$limite,$empresa);
    
    echo json_encode($c)."*".$b;
  }

    if($boton==='buscarDetalleCompra')
  {
    $id_documento=$_POST['id_documento'];
    $ins=new Compra();
    
    echo json_encode($ins->datosCompra($empresa,$id_documento));
  }

?>
     