<?php
//Headers
header('Access-Control-Allow-Origin: http://localhost:4200');
header('Content-Type: application/json');


include_once '../../config/Database.php';
include_once '../../Modelo/suplidor.php';

//Instancaite DB & connect

$database =new Database();
$db =$database->connect();

//Instanciate blog post object

$suplidor = new Suplidor($db);

//Blog post query

$result = $suplidor->read();
//Get count row

$num =$result->rowCount();

//Check if any posts

if($num > 0)
{
    //Post array
    $suplidor_arr = array();
    $suplidores_arr = array();
   
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
      extract($row);
      $suplidor_item = array(
         'Id'=>$Id,
         'nombre'=>$nombre,
         'direccion'=>$direccion,
         'rnc'=>$rnc,
         'telefono'=>$telefono,
         'correo'=>$correo,
         'web'=>$web,
         'tipo'=>$tipo,
         'logo'=>$logo,
         
         
      );
      //Push to data
      array_push($suplidores_arr, $suplidor_item);
    }
    //Turn to json
  echo json_encode($suplidores_arr);
}
else{
    echo json_encode(
        array('message'=>'No se ha encontrado ningun suplidor.')
    );

}