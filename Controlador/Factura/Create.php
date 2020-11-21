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

$factura->usuario_registro=$data->usuario_registro;
$factura->codigoCliente=$data->codigoCliente;
$factura->tipoDocumento=$data->tipoDocumento;
$factura->ncf=$data->ncf;
$factura->referencia=uniqid('F0012');
$factura->descuento=$data->descuento;
$factura->detalle=$data->detalle;
$factura->totaln=$data->totaln;
$factura->itbistot=$data->itbistot;
$factura->fecha=strftime( "%Y-%m-%d", time());
$factura->arreglo=$data->arreglo;
// Create post
if($factura->create()){
    $factura->createDetails();
}
else{
    echo json_encode(
        array('message' => 'Hubo problema creando la factura')
    );
    
}


