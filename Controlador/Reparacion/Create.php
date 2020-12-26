<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:POST ');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../Modelo/reparacion.php';

//Instancaite DB & connect

$database =new Database();
$db =$database->connect();
//Instanciate blog post object
$reparacion = new Reparacion($db);
//Get raw posted data
date_default_timezone_set('America/Santo_Domingo');
$date = date('d-m-y H:i:A');
$data =json_decode(file_get_contents("php://input"));
$reparacion->Id=$data->Id;
$reparacion->cliente=$data->cliente;
$reparacion->detalle=$data->detalle;
$reparacion->numero=$data->numero;
$reparacion->total=$data->total;
$reparacion->resgistradoPor=$data->resgistradoPor;
$reparacion->fecha=$date;
$reparacion->estado=$data->estado;
$reparacion->metPago=$data->metPago;
$reparacion->DeletedOrderItemIDs=$data->DeletedOrderItemIDs;
$result=$data->repDet;
$reparacion->repDet=json_encode($result,true);

//var_dump($factura->orderDet);

// Create post
if($_SERVER['REQUEST_METHOD'] != "OPTIONS")
{
    if($reparacion->Id ==0 || $reparacion->Id ==null) 
    {
        if($reparacion->create()){
            echo json_encode(true);
          
        }
        else{
            echo json_encode(false);
            
        }
    } 
    else
    {
        if($reparacion->update()){
            echo json_encode(true);
        }
        else{
            echo json_encode(false);
            
        }

    }   
}


