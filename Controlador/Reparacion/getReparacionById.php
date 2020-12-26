<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../Modelo/reparacion.php';


//Instancaite DB & connect

$database =new Database();
$db =$database->connect();

//Instanciate blog post object

$reparacion = new Reparacion($db);

//Get ID
$data =json_decode(file_get_contents("php://input"));
//$marca->Id=$data->Id;
$reparacion->numero= isset($_GET['id']) ? $_GET['id'] : die();
//Get post

$reparacion->getReparacionById();
//Create array
$reparacion_arr['reparacion']=array(
    'Id'=>$reparacion->Id,
    'cliente'=>$reparacion->cliente,
    'detalle'=>$reparacion->detalle,
    'numero'=>$reparacion->numero,
    'total'=>$reparacion->total,
    'resgistradoPor'=>$reparacion->resgistradoPor,
    'fecha'=>$reparacion->fecha,
    'estado'=>$reparacion->estado,
    'metPago'=>$reparacion->metPago,
);

$result = $reparacion->getReparacionById();
   //Post array
   $dets_arr  = array();
   $dets_arr ['repDet'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
      extract($row);
      $det_item = array(
         'idDetalle'=>$idDetalle,
         'equipo'=>$equipo,
         'cantidad'=>$cantidad,
         'costo'=>$costo,
         'Total'=>$Total,
         'ref'=>$ref,
         'IdRep'=>$IdRep,
         'detalle'=>$detalle,
         'estado'=>$estado
         );
     
      array_push($dets_arr['repDet'], $det_item);
    }
    
$response = array($reparacion_arr,$dets_arr);
echo json_encode ($response);