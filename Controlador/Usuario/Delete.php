<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:DELETE ');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../Modelo/usuario.php';
session_start();
if(!isset($_SESSION['token'])){
    echo json_encode(404);
    exit;
  }
  if(!isset($_COOKIE['token'])){
    echo json_encode(404);
    exit;
  }
  if($_SESSION['token'] != $_COOKIE['token']){
    echo json_encode(404);
    exit;
  }

//Instancaite DB & connect

$database =new Database();
$db =$database->connect();

//Instanciate blog post object

$usuario = new Usuario($db);

//Get raw posted data

$data =json_decode(file_get_contents("php://input"));
$usuario->Id=$data->Id;
//$usuario->id=$_GET['id'];




// Create post
if($usuario->delete()){
    echo json_encode(
        array('message' => 'Se elimino el usuario',
        'id'=>$usuario->Id)
    );
}
else{
    echo json_encode(
        array('message' => 'No se pudo eliminar el usuario')
    );
}