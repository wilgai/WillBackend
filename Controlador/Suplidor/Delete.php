<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:DELETE ');
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
//$usuario->id=$_GET['id'];

if($suplidor->delete()){
    echo "Se elimino el suplidor";
}
else{
   echo "No se pudo eliminar el usuario";
}