<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json,application/x-www-form-urlencoded');
header('Access-Control-Allow-Methods:POST ');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../Modelo/modelo.php';

//Instancaite DB & connect

$database =new Database();
$db =$database->connect();
//Instanciate blog post object
$modelo = new Modelo($db);
//Get raw posted data
$data =json_decode(file_get_contents("php://input"));
$marca->Id=$data->Id;
$marca->nombre=$data->nombre;
$marca->marca=$data->marca;
//Check if email is alredy exist
$nombre=$modelo->CheckName()->rowCount();
if($nombre > 1)
{
    
    echo json_encode(
        array('message'=>'Este Modelo ya existe.')
    );
    
}
else 
{
    // Create post
    if($modelo->update()){
        echo json_encode(
            array('message'=>'Se actualizo el modelo.')
        );
       
        
    }
    else{
        
        echo json_encode(
            array('message'=>'No se pudo actualizar el modelo.')
        );
    }
}


