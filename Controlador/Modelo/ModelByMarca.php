<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../Modelo/modelo.php';

//Instancaite DB & connect

$database =new Database();
$db =$database->connect();

//Instanciate blog post object

$modelo = new Modelo($db);
//$data =json_decode(file_get_contents("php://input"));
$modelo->marca= isset($_GET['marca']) ? $_GET['marca'] : die();
//$modelo->marca=$data->marca;

//Blog post query

$result = $modelo->modeloByMarca();
//Get count row

$num =$result->rowCount();

//Check if any posts

if($num > 0)
{
    //Post array
    $modelo_arr = array();
    $modelo_arr = array();
   
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
      extract($row);
      $modelo_item = array(
         'Id'=>$Id,
         'nombre'=>$nombre,
         'marca'=>$marca
         
         
         
      );
      //Push to data
      array_push($modelo_arr, $modelo_item);
    }
    //Turn to json
  echo json_encode($modelo_arr);
}
else{
    echo json_encode(
        array('message'=>'No se ha encontrado ninguna modelo')
    );

}