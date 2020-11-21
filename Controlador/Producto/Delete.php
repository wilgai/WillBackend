<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:DELETE ');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../Modelo/producto.php';

//Instancaite DB & connect
$database =new Database();
$db =$database->connect();
//Instanciate blog post object
$producto = new Producto($db);
//Get raw posted data
$data =json_decode(file_get_contents("php://input"));
$producto->Id=$data->Id;
//$usuario->id=$_GET['id'];
// Create post
if($producto->delete()){
    echo json_encode(
        array('message' => 'Se elimino el producto')
        
    );
}
else{
    echo json_encode(
        array('message' => 'No se pudo eliminar el producto')
    );
}