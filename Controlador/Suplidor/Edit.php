<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json,application/x-www-form-urlencoded');
header('Access-Control-Allow-Methods:POST ');
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
$suplidor->nombre=$data->nombre;
$suplidor->direccion=$data->direccion;
$suplidor->rnc=$data->rnc;
$suplidor->telefono=$data->telefono;
$suplidor->correo=$data->correo;
$suplidor->tipo=$data->tipo;
$suplidor->foto=$data->foto;
$suplidor->web=$data->web;

//Check if email is alredy exist
$name=$suplidor->CheckName()->rowCount();
$email=$suplidor->CheckEmail()->rowCount();
$identification=$suplidor->CheckIdentification()->rowCount();
if($email > 0)
{
    echo "Este correo ya existe.";
}
elseif($identification > 0)
{
    echo "Este rnc ya existe.";
}
elseif($name > 0)
{
    echo "Este name ya existe.";
}
else 
{
    // Create post
    if($usuario->update()){
        echo "Se actualizo el suplidor.";
        
    }
    else{
        echo "No se pudo actualizar el suplidor.";
    }
}


