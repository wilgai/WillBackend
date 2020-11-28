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

//Blog post query

$result = $inventario->read();
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
         'nombre'=>$nombre,
         'codigo_suplidor'=>$codigo_suplidor,
         'usuario_registro'=>$usuario_registro,
         'fecha_registro'=>$fecha_registro,
         'fecha_actualizacion'=>$fecha_actualizacion,
         'tipo_impuesto'=>$tipo_impuesto,
         'codigo_categoria'=>$codigo_categoria,
         'referencia_interna'=>$referencia_interna,
         'estado'=>$estado,
         'referencia_suplidor'=>$referencia_suplidor,
         'foto'=>$foto,
         'oferta'=>$oferta,
         'modificar_precio'=>$modificar_precio,
         'acepta_descuento'=>$acepta_descuento,
         'detalle'=>$detalle,
         'codigo_marca'=>$codigo_marca,
         'porciento_beneficio'=>$porciento_beneficio,
         'porciento_minimo'=>$porciento_minimo,
         'modelo'=>$modelo,
         'Codigo'=>$Codigo,
          'IdInventario'=>$IdInventario,
          'IdProducto'=>$IdProducto,
          'PrecioCompra'=>$PrecioCompra,
          'Ganancia'=>$Ganancia,
          'PrecioVenta'=>$PrecioVenta,
          'Descuento'=>$Descuento,
          'PorcientoDescuento'=>$PorcientoDescuento,
          'Cantidad'=>$Cantidad,
          'Fecha'=>$Fecha
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