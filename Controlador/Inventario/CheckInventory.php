<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../Modelo/inventario.php';


//Instancaite DB & connect

$database =new Database();
$db =$database->connect();

//Instanciate blog post object

$inventario = new Inventario($db);
$data =json_decode(file_get_contents("php://input"));
//Blog post query
$inventario->Id= isset($_GET['Id']) ? $_GET['Id'] : die();
$result = $inventario->CheckInventory();
//Get count row

$num =$result->rowCount();

//Check if any posts

if($num > 0)
{
    //Post array
    $inventarios_arr = array();
    $inventarios_arr = array();
   
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
      extract($row);
      $inventarios_item = array(
         'Id'=>$Id,
         'IdProducto'=>$IdProducto,
         'PrecioCompra'=>$PrecioCompra,
         'Ganancia'=>$Ganancia,
         'PrecioVenta'=>$PrecioVenta,
         'Itbis'=>$Itbis,
         'Cantidad'=>$Cantidad,
         'Fecha'=>$Fecha,
         'ref'=>$ref,
         'IdFactura'=>$IdFactura,
        
      );
      //Push to data
      array_push($inventarios_arr, $inventarios_item);
    }
    //Turn to json
  echo json_encode($inventarios_arr);
}
else{
    echo json_encode(
        array('message'=>'No hay inventario')
    );

}