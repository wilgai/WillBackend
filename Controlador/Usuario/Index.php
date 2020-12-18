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

//Blog post query

$result = $usuario->read();
//Get count row

$num =$result->rowCount();

//Check if any posts

if($num > 0)
{
    //Post array
    $usuarios_arr = array();
    $usuarios_arr = array();
   
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
      extract($row);
      $usuario_item = array(
         'Id'=>$Id,
         'nombre'=>$nombre,
         'direccion'=>$direccion,
         'identificacion'=>$identificacion,
         'telefono'=>$telefono,
         'correo'=>$correo,
         'usuario'=>$usuario,
         'tipo_usuario'=>$tipo_usuario,
         'contrasena'=>$contrasena,
         'estado'=>$estado,
         'sexo'=>$sexo,
         'foto'=>$foto,
         
         
      );
      //Push to data
      array_push($usuarios_arr, $usuario_item);
    }
    //Turn to json
  echo json_encode($usuarios_arr);
}
else{
    echo json_encode(
        array('message'=>'No se ha encontrado ningun usuario')
    );

}