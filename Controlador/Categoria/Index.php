<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../Modelo/categoria.php';

//Instancaite DB & connect

$database =new Database();
$db =$database->connect();

//Instanciate blog post object

$cat = new Categoria($db);

//Blog post query

$result = $cat->read();
//Get count row

$num =$result->rowCount();

//Check if any posts

if($num > 0)
{
    //Post array
    $cat_arr = array();
    $cat_arr['data'] = array();
   
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
      extract($row);
      $cat_item = array(
         'Id'=>$Id,
         'nombre'=>$nombre,
         
         
         
      );
      //Push to data
      array_push($cat_arr['data'], $cat_item);
    }
    //Turn to json
  echo json_encode($cat_arr);
}
else{
    echo json_encode(
        array('message'=>'No se ha encontrado ningun usuario')
    );

}