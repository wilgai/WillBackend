<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../Modelo/factura.php';


//Instancaite DB & connect

$database =new Database();
$db =$database->connect();

//Instanciate blog post object

$factura = new Factura($db);

//Get ID
$data =json_decode(file_get_contents("php://input"));
//$marca->Id=$data->Id;
$factura->OrderNumber= isset($_GET['id']) ? $_GET['id'] : die();
//Get post

$factura->getOrderByID();

//Create array
$factura_arr['order']=array(
    
    'Id'=>$factura->Id,
    'codigoCliente'=>$factura->codigoCliente,
    'tipoDocumento'=>$factura->tipoDocumento,
    'ncf'=>$factura->ncf,
    'referencia'=>$factura->referencia,
    'descuento'=>$factura->descuento,
    'detalle'=>$factura->detalle,
    'totaln'=>$factura->totaln,
    'itbistot'=>$factura->itbistot,
    'fecha'=>$factura->fecha,
    'OrderNumber'=>$factura->OrderNumber,
    'metPago'=>$factura->metPago,
    'usuario_registro'=>$factura->usuario_registro,
    'suplidor'=>$factura->suplidor  
);
$result = $factura->getOrderByID();
   //Post array
   $dets_arr  = array();
   $dets_arr ['orderDet'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
      extract($row);
      $det_item = array(
         'idProducto'=>$codigo_articulo,
         'nombre'=>$nombre,
         'idDetalle'=>$idDetalle,
         'codigo_articulo'=>$codigo_articulo,
         'cantidad'=>$cantidad,
         'PrecioVenta'=>$precio,
         'Total'=>$Total,
         'idFactura'=>$idFactura,
         'itbis'=>$itbis,
         'ref'=>$ref,
         'IdDetalle'=>$IdDetalle,
         'PrecioCompra'=>$PrecioCompra,
         'Ganancia'=>$Ganancia,
         'precioV'=>$precioV,
         'IdInventario'=>$IdInventario,
         'garantia'=>$garantia
        // 'IdInventario'=>$IdInventario
         );
      //Push to data
      array_push($dets_arr['orderDet'], $det_item);
    }
    
$response = array($factura_arr,$dets_arr);
echo json_encode ($response);