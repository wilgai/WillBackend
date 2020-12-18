<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../Modelo/modelo.php';


//Instancaite DB & connect

$database =new Database();
$db =$database->connect();

//Instanciate blog post object

$modelo = new Modelo($db);

//Get ID
$data =json_decode(file_get_contents("php://input"));
$modelo->Id=$data->Id;
//$usuario->Id= isset($_GET['Id']) ? $_GET['Id'] : die();
//Get post

$cat->read_single();

//Create array
$marca_arr=array(
    'Id'=>$marca->Id,
    'nombre'=>$modelo->nombre,
    'marca'=>$modelo->marca
    
);

//Make Json
print_r(json_encode($marca_arr));