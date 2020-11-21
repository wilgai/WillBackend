<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:DELETE ');
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
$cat->Id=$data->Id;
//$usuario->id=$_GET['id'];

// Create post
if($cat->delete()){
    echo 'Se elimino la categoria';
}
else{
    echo 'No se pudo eliminar la categoria';
}