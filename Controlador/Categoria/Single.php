<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../Modelo/categoria.php';

//Instancaite DB & connect

$database =new Database();
$db =$database->connect();

//Instanciate blog post object

$cat = new Categoria($db);

//Get ID
$data =json_decode(file_get_contents("php://input"));
$cat->Id=$data->Id;
//$usuario->Id= isset($_GET['Id']) ? $_GET['Id'] : die();
//Get post

$cat->read_single();

//Create array
$cat_arr=array(
    'Id'=>$cat->Id,
    'nombre'=>$cat->nombre
    
);

//Make Json
print_r(json_encode($cat_arr));