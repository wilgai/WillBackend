<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../Modelo/reparacion.php';


//Instancaite DB & connect

$database =new Database();
$db =$database->connect();

//Instanciate blog post object

$reparacion = new Reparacion($db);

//Blog post query
$result = $reparacion->read();
//Get count row
$num =$result->rowCount();
//Check if any posts
if($num > 0)
{
    //Post array
    $reparaciones_arr = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
      extract($row);
      $reparacion_item = array(
        'Id'=>$Id,
        'cliente'=>$cliente,
        'detalle'=>$detalle,
        'numero'=>$numero,
        'total'=>$total,
        'resgistradoPor'=>$resgistradoPor,
        'fecha'=>$fecha,
        'estado'=>$estado,
        'metPago'=>$metPago,
         );
      //Push to data
      array_push($reparaciones_arr, $reparacion_item);
    }
    //Turn to json
  echo json_encode($reparaciones_arr);
}
else{
    echo json_encode(
        array('message'=>'No se ha encontrado ninguna factura')
    );

}