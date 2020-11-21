<?php
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
$data =json_decode(file_get_contents("php://input"));

$usuario->usuario=$data->login;
$usuario->contrasena=$data->clave;

if($usuario->login()->rowCount() > 0)
{
    echo "true";
    $row=$usuario->login()->fetch(PDO::FETCH_ASSOC);

    session_start();
	$_SESSION['login']='true';
	$_SESSION['nombre']=$row['nombre'];
	$_SESSION['Id']=$row['Id'];
	$_SESSION['foto']=$row['foto'];
    $_SESSION['tipo_usuario']=$row['tipo_usuario'];
    
    $usuario_arr=array(
    'Id'=>$row['Id'],
    'nombre'=>$row['nombre'],
    'direccion'=>$row['direccion'],
    'identificacion'=>$row['identificacion'],
    'telefono'=>$row['telefono'],
    'correo'=>$row['correo'],
    'usuario'=>$row['usuario'],
    'tipo_usuario'=>$row['tipo_usuario'],
    'estado'=>$row['estado'],
    'sexo'=>$row['sexo']
    
);
   

}
else
{
    echo "false";
}


//print_r(json_encode($usuario_arr));