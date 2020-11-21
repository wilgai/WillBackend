<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:POST ');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../Modelo/producto.php';

//Instancaite DB & connect
$database =new Database();
$db =$database->connect();
//Instanciate blog post object
$producto = new Producto($db);
//Get raw posted data
$data =json_decode(file_get_contents("php://input"));
$producto->nombre=$data->nombre;
$producto->codigo_suplidor=$data->codigo_suplidor;
$producto->usuario_registro=$data->usuario_registro;
$producto->fecha_registro=$data->fecha_registro;
$producto->fecha_actualizacion=$data->fecha_actualizacion;
$producto->tipo_impuesto=$data->tipo_impuesto;
$producto->codigo_subcategoria=$data->codigo_subcategoria;
$producto->referencia_interna=$data->referencia_interna;
$producto->referencia_suplidor=$data->referencia_suplidor;
$producto->estado=$data->estado;
$producto->foto=$data->foto;
$producto->oferta=$data->oferta;
$producto->acepta_descuento=$data->acepta_descuento;
$producto->modificar_precio= $data->modificar_precio;
$producto->detalle=$data->detalle;
$producto->codigo_marca=$data->codigo_marca;
$producto->porciento_beneficio=$data->porciento_beneficio;
$producto->porciento_minimo=$data->porciento_minimo;
$producto->modelo=$data->modelo;
$producto->codigo=$data->codigo;

//Check if email is alredy exist
$name=$producto->CheckName()->rowCount();
$code=$producto->CheckCode()->rowCount();
if($name > 0)
{
    echo json_encode(
        array('message' => 'Existe un producto con este nombre')
    );
}
elseif($code > 0)
{
    echo json_encode(
        array('message' => 'Este producto ya existe')
    );
}
else 
{
    // Create post
    if($producto->update()){
        echo json_encode(
            array('message' => 'Se registro el producto')
        );
    }
    else{
        echo json_encode(
            array('message' => 'No se pudo registrar el producto')
        );
    }
}


