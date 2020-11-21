<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json,application/x-www-form-urlencoded');
header('Access-Control-Allow-Methods:POST ');
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
//Check if email is alredy exist
$nombre=$cat->CheckName()->rowCount();
$identification=$usuario->CheckIdentification()->rowCount();
if($nombre > 0)
{
    echo "Esta categoria ya existe.";
}
else 
{
    // Create post
    if($usuario->create()){
        echo "Se creo la categoria.";
        
    }
    else{
        echo "No se pudo crear la categoria.";
    }
}


