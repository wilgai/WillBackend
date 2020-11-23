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

//Get ID
$data =json_decode(file_get_contents("php://input"));
$producto->Id=$data->Id;
//$usuario->Id= isset($_GET['Id']) ? $_GET['Id'] : die();
//Get post

$producto->read_single();

//Create array
$usuario_arr=array(
         'Id'=>$producto->Id,
         'nombre'=>$producto->nombre,
         'codigo_suplidor'=>$producto->codigo_suplidor,
         'usuario_registro'=>$producto->usuario_registro,
         'fecha_registro'=>$producto->fecha_registro,
         'fecha_actualizacion'=>$producto->fecha_actualizacion,
         'tipo_impuesto'=>$producto->tipo_impuesto,
         'codigo_categoria'=>$producto->codigo_categoria,
         'referencia_interna'=>$producto->referencia_interna,
         'estado'=>$producto->estado,
         'referencia_suplidor'=>$producto->referencia_suplidor,
         'foto'=>$producto->foto,
         'oferta'=>$producto->oferta,
         'dirmodificar_precioeccion'=>$producto->modificar_precio,
         'acepta_descuento'=>$producto->acepta_descuento,
         'detalle'=>$producto->detalle,
         'codigo_marca'=>$producto->codigo_marca,
         'porciento_beneficio'=>$producto->porciento_beneficio,
         'porciento_minimo'=>$producto->porciento_minimo,
         'modelo'=>$producto->modelo,
         'Codigo'=>$producto->codigo,
);

//Make Json

print_r(json_encode($usuario_arr));