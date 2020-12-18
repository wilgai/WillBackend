<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json,application/x-www-form-urlencoded');
header('Access-Control-Allow-Methods:POST ');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../Modelo/marca.php';


//Instancaite DB & connect

$database =new Database();
$db =$database->connect();
//Instanciate blog post object
$marca = new Marca($db);
//Get raw posted data
$data =json_decode(file_get_contents("php://input"));
$marca->nombre=$data->nombre;
//Check if email is alredy exist
$nombre=$marca->CheckName()->rowCount();
if($nombre > 0)
{

    echo json_encode(10);
}
else 
{
    // Create post
    if($marca->create()){
        
        echo json_encode(1);
        
    }
    else{
        
        echo json_encode(0);
    }
}


