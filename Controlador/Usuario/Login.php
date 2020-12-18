<?php

require('../../vendor/autoload.php');
use \Firebase\JWT\JWT;
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../Modelo/login.php';


//Instancaite DB & connect

$database =new Database();
$db =$database->connect();

//Instanciate blog post object

$usuario = new Login($db);

//Get ID

if($_SERVER['REQUEST_METHOD']==="POST")
{
  $data =json_decode(file_get_contents("php://input"));

    $usuario->usuario=$data->Usuario;
    $usuario->contrasena=$data->Contrasena;

if($usuario->login()->rowCount() > 0)
{
    
    $row=$usuario->login()->fetch(PDO::FETCH_ASSOC);
    $iss="localhost";
    $iat=time();
    $nbf=$iat +10;
    $exp=$iat +60;
    $aud="user";
    $user_arr_data=array(
      "foto"=>$row["foto"],
      "tipo"=>$row["tipo_usuario"],
      "id"=>$row["Id"],
      "name"=>$row["nombre"]
     
    );
    $secret_key="owt125";
    $payload=array(
     "iss"=>$iss,
     "iat"=>$iat,
     "nbf"=>$nbf,
     "exp"=>$exp,
     "aud"=>$aud,
     "data"=>$user_arr_data);
     $jwt=JWT::encode($payload,$secret_key,'HS512');
    $result=array(
      "success"=>true,
      "message"=>"Usuario autentificado",
       "token"=>$jwt,
       "foto"=>$row["foto"],
       "tipo"=>$row["tipo_usuario"],
       "id"=>$row["Id"],
       "name"=>$row["nombre"]
    );
    echo   json_encode($result);
}
else
{
    $result=array(
        "success"=>false,
        "message"=>"Usuario o contraseña incorrecto",
      );
    echo   json_encode($result);
}
}


