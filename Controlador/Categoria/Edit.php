<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json,application/x-www-form-urlencoded');
header('Access-Control-Allow-Methods:PUT ');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../Modelo/categoria.php';


//Instancaite DB & connect

$database =new Database();
$db =$database->connect();
//Instanciate blog post object
$cat = new Categoria($db);
//Get raw posted data
$data =json_decode(file_get_contents("php://input"));
$cat->nombre=$data->nombre;
$cat->Id=$data->Id;
//Check if email is alredy exist
$nombre=$cat->CheckName()->rowCount();
if($nombre > 1)
{
    
    echo json_encode(10);
}
else 
{
    // Create post
    if($cat->update()){
        
        echo json_encode(1);
        
    }
    else{
        
        echo json_encode(0);
    }
}


