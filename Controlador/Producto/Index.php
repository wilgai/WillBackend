<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../Modelo/producto.php';

//Instancaite DB & connect

$database =new Database();
$db =$database->connect();

//Instanciate blog post object

$producto = new Producto($db);

//Blog post query

$result = $producto->read();
//Get count row

$num =$result->rowCount();

//Check if any posts

if($num > 0)
{
    //Post array
    $productos_arr = array();
    $productos_arr['data'] = array();
   
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
      extract($row);
      $productos_item = array(
         'Id'=>$Id,
         'nombre'=>$nombre,
         'codigo_suplidor'=>$codigo_suplidor,
         'usuario_registro'=>$usuario_registro,
         'fecha_registro'=>$fecha_registro,
         'fecha_actualizacion'=>$fecha_actualizacion,
         'tipo_impuesto'=>$tipo_impuesto,
         'codigo_subcategoria'=>$codigo_subcategoria,
         'referencia_interna'=>$referencia_interna,
         'estado'=>$estado,
         'referencia_suplidor'=>$referencia_suplidor,
         'foto'=>$foto,
         'oferta'=>$oferta,
         'dirmodificar_precioeccion'=>$modificar_precio,
         'acepta_descuento'=>$acepta_descuento,
         'detalle'=>$detalle,
         'codigo_marca'=>$codigo_marca,
         'porciento_beneficio'=>$porciento_beneficio,
         'porciento_minimo'=>$porciento_minimo,
         'modelo'=>$modelo,
         'codigo'=>$Codigo,
      );
      //Push to data
      array_push($productos_arr['data'], $productos_item);
    }
    //Turn to json
  echo json_encode($productos_arr);
}
else{
    echo json_encode(
        array('message'=>'No se ha encontrado ningun usuario')
    );

}