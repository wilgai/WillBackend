<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:POST ');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../Modelo/factura.php';

//Instancaite DB & connect

$database =new Database();
$db =$database->connect();
//Instanciate blog post object
$factura = new Factura($db);
//Get raw posted data
$data =json_decode(file_get_contents("php://input"));
$factura->Id=$data->Id;
$factura->usuario_registro=$data->usuario_registro;
$factura->codigoCliente=$data->codigoCliente;
$factura->tipoDocumento=$data->tipoDocumento;
$factura->ncf=$data->ncf;
$factura->referencia=$data->referencia;
$factura->descuento=$data->descuento;
$factura->detalle=$data->detalle;
$factura->totaln=$data->totaln;
$factura->itbistot=$data->itbistot;
$factura->fecha=strftime( "%Y-%m-%d", time());
$factura->suplidor=$data->suplidor;
$factura->OrderNumber=$data->OrderNumber;
$factura->metPago=$data->metPago;
$factura->DeletedOrderItemIDs=$data->DeletedOrderItemIDs;
$result=$data->orderDet;
$factura->orderDet=json_encode($result,true);

//var_dump($factura->orderDet);

// Create post
if($_SERVER['REQUEST_METHOD'] != "OPTIONS")
{
    if($factura->Id ==0 || $factura->Id ==null) 
    {
        if($factura->create()){
            echo json_encode(true);
        }
        else{
            echo json_encode(false);
            
        }
    } 
    else
    {
        if($factura->update()){
            echo json_encode(true);
        }
        else{
            echo json_encode(false);
            
        }

    }   
}


