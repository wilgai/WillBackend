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

//Blog post query

$result = $modelo->read();
//Get count row

$num =$result->rowCount();

//Check if any posts

if($num > 0)
{
    //Post array
    $marca_arr = array();
    $marca_arr = array();
   
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
      extract($row);
      $marca_item = array(
         'Id'=>$Id,
         'nombre'=>$nombre,
         'marca'=>$marca
         
         
         
      );
      //Push to data
      array_push($marca_arr, $marca_item);
    }
    //Turn to json
  echo json_encode($marca_arr);
}
else{
    echo json_encode(
        array('message'=>'No se ha encontrado ninguna modelo')
    );

}