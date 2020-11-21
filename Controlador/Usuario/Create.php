<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json,application/x-www-form-urlencoded');
header('Access-Control-Allow-Methods:POST ');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
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
$usuario->nombre=$data->nombre;
$usuario->direccion=$data->direccion;
$usuario->identificacion=uniqid();
$usuario->telefono=$data->telefono;
$usuario->correo=$data->correo;
$usuario->usuario=$data->usuario;
$usuario->tipo_usuario=$data->tipo_usuario;
$usuario->contrasena=$data->contrasena;
$usuario->estado=$data->estado;
$usuario->sexo=$data->sexo;

//Check if email is alredy exist
if($_SERVER['REQUEST_METHOD'] != "OPTIONS")
{
    $email=$usuario->CheckEmail()->rowCount();
    $identification=$usuario->CheckIdentification()->rowCount();
    if($email > 0)
    {
        echo json_encode(
            'Este correo ya existe.'
        );
        
    }
    elseif($identification > 0)
    {
        echo json_encode(
            'Este documento ya existe.'
        );
       
    }
    else 
    {
        // Create post
        if($usuario->create()){
            echo json_encode(
                'Se registro el usuario, por favor verifique su correo para confimar la cuenta.'
            );
            
            
        }
        else{
            echo json_encode(
                'No se pudo crear el usuario.'
            );
            
        }
    }
}


