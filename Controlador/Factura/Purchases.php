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

//Blog post query

$result = $factura->readPurchases();
//Get count row

$num =$result->rowCount();

//Check if any posts

if($num > 0)
{
    //Post array
    $facturas_arr = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
      extract($row);
      $factura_item = array(
         'Id'=>$Id,
         'codigoCliente'=>$codigoCliente,
         'tipoDocumento'=>$tipoDocumento,
         'ncf'=>$ncf,
         'referencia'=>$referencia,
         'descuento'=>$descuento,
         'detalle'=>$detalle,
         'totaln'=>$totaln,
         'itbistot'=>$itbistot,
         'fecha'=>$fecha,
         'OrderNumber'=>$OrderNumber,
         'metPago'=>$metPago,
         'usuario_registro'=>$usuario_registro,
         'nombre'=>$nombre,
         'direccion'=>$direccion,
         'identificacion'=>$identificacion,
         'Suplidor'=>$Suplidor,
         'IdSuplidor'=>$IdSuplidor
         );
      //Push to data
      array_push($facturas_arr, $factura_item);
    }
    //Turn to json
  echo json_encode($facturas_arr);
}
else{
    echo json_encode(
        array('message'=>'No se ha encontrado ninguna factura')
    );

}