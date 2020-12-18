<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../Modelo/suplidor.php';


//Instancaite DB & connect

$database =new Database();
$db =$database->connect();
//Instanciate blog post object
$suplidor = new Suplidor($db);

//Get raw posted data
$data =json_decode(file_get_contents("php://input"));
$suplidor->Id=$data->Id;
$suplidor->nombre=$data->nombre;
$suplidor->direccion=$data->direccion;
$suplidor->rnc=$data->rnc;
$suplidor->telefono=$data->telefono;
$suplidor->correo=$data->correo;
$suplidor->tipo=$data->tipo;
$suplidor->logo=$data->logo;
$suplidor->web=$data->web;

//Check if email is alredy exis

$name=0;
$email=0;
$rnc=0;

if($data->nombre !="" || $data->nombre !=null )
{
    $name=$suplidor->CheckName()->rowCount();
}

if($data->correo !="" || $data->correo !=null )
{
    $email=$suplidor->CheckEmail()->rowCount();
}

if($data->rnc !="" || $data->rnc !=null )
{
    $rnc=$suplidor->CheckIdentification()->rowCount();
}

if($email > 1)
{
    echo json_encode(20);
    
}
elseif($rnc > 1)
{
    echo json_encode(30);
    
}
elseif($name > 1)
{
    echo json_encode(10);
    
}
else 
{
    // Create post
    if($suplidor->update()){
        echo json_encode(1);
        
        
    }
    else{
        echo json_encode(0);
    }
}


