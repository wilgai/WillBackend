<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../Modelo/usuario.php';

//Instancaite DB & connect

$database =new Database();
$db =$database->connect();

//Instanciate blog post object

$usuario = new Usuario($db);

//Get ID
//$data =json_decode(file_get_contents("php://input"));
//$usuario->Id=$data->Id;
$usuario->Id= isset($_GET['Id']) ? $_GET['Id'] : die();
//Get post

$usuario->read_single();

//Create array
$usuario_arr=array(
    'Id'=>$usuario->Id,
    'nombre'=>$usuario->nombre,
    'direccion'=>$usuario->direccion,
    'identificacion'=>$usuario->identificacion,
    'telefono'=>$usuario->telefono,
    'correo'=>$usuario->correo,
    'usuario'=>$usuario->usuario,
    'tipo_usuario'=>$usuario->tipo_usuario,
    'contrasena'=>$usuario->contrasena,
    'estado'=>$usuario->estado,
    'sexo'=>$usuario->sexo
);

//Make Json

print_r(json_encode($usuario_arr));