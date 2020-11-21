<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../Modelo/usuario.php';

//Instancaite DB & connect

$database =new Database();
$db =$database->connect();
//Instanciate blog post object
$usuario = new Usuario($db);
//Get raw posted data
$data =json_decode(file_get_contents("php://input"));
$usuario->Id=$data->Id;
$usuario->nombre=$data->nombre;
$usuario->direccion=$data->direccion;
$usuario->identificacion=$data->identificacion;
$usuario->telefono=$data->telefono;
$usuario->correo=$data->correo;
$usuario->usuario=$data->usuario;
$usuario->tipo_usuario=$data->tipo_usuario;
$usuario->contrasena=$data->contrasena;
$usuario->estado=null;
$usuario->sexo=$data->sexo;

//Check if email is alredy exist
$email=$usuario->CheckEmail()->rowCount();
$identification=$usuario->CheckIdentification()->rowCount();
if($email > 1)
{
    echo json_encode(
         'Este correo ya existe'
    );
}
elseif($identification > 1)
{
    echo json_encode(
        'Este documento existe'
    );
}
else 
{
    // Create post
    if($usuario->lockUser()){
        echo json_encode(
             'Se desactivo el usuario'
        );
    }
    else{
        echo json_encode(
             'No se pudo desactivar el usario'
        );
    }
}


