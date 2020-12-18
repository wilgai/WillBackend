<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../Modelo/suplidor.php';


//Instancaite DB & connect

$database =new Database();
$db =$database->connect();

//Instanciate blog post object

$suplidor = new Suplidor($db);

//Get ID
$data =json_decode(file_get_contents("php://input"));
$suplidor->Id=$data->Id;
//$usuario->Id= isset($_GET['Id']) ? $_GET['Id'] : die();
//Get post

$suplidor->read_single();

//Create array
$suplidor_arr=array(
    'Id'=>$suplidor->Id,
    'nombre'=>$suplidor->nombre,
    'direccion'=>$suplidor->direccion,
    'ncf'=>$suplidor->ncf,
    'telefono'=>$suplidor->telefono,
    'correo'=>$suplidor->correo,
    'web'=>$suplidor->web,
    'tipo_usuario'=>$suplidor->tipo,
    'foto'=>$usuario->foto
);

//Make Json

print_r(json_encode($suplidor_arr));