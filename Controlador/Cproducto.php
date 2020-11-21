<?php
require_once('../Modelo/producto.php');
 session_start();
 $idUsuario=$_SESSION['id_usuario'];
 $nombreEmpresa=$_SESSION['empresa'];
 $boton=$_POST['boton'];

if($boton==='buscar')
  {
    $inicio = 0;
        $limite = 6;
        if (isset($_POST['pagina'])) {
          $pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
        $valor=$_POST['valor'];
    $ins=new Producto();
    $a= $ins->listar_articulo($valor,$inicio=FALSE,$limite=FALSE,$nombreEmpresa);
    $b=count($a);
    $c= $ins->listar_articulo($valor,$inicio,$limite,$nombreEmpresa);
    
    echo json_encode($c)."*".$b;
  }
  if($boton==='buscar1')
  {
    
    $ins=new Producto();
    
    echo json_encode($ins->LlenarDataTable($nombreEmpresa));
  }



if($boton==='guardar')
	{
      $prod=new Producto();
           $empresa=$nombreEmpresa;
           $nombre=$_POST['nombre'];
           $codigo_suplidor=$_POST['suplidor'];
           $usuario_registro=$idUsuario;
           $fecha_registro='';
           $fecha_actualizacion='';
           $tipo_impuesto=$_POST['impuesto'];
           $estado='1';
           $referencia_suplidor=$_POST['ref_suplidor'];
           $referencia_interna=$_POST['ref_interna'];
           $codigo_subcategoria=$_POST['categoria'];
           $reorden='5';
           $oferta='';
           $modificar_precio='';
           $acepta_descuento='';
           $detalle=$_POST['detalle'];
           $codigo_marca=$_POST['marca'];
           $porciento_beneficio='';
           $porciento_minimo='';
           $modelo=$_POST['modelo'];

            $img=$_FILES["imagen"]["name"];
    if($img==='')
    {
      $foto="sinimagen.jpg";
    }
    else
    {
           $foto=uniqid()."-".$_FILES["imagen"]["name"];
           $ruta="../Resources/img/usuarios/".$foto;
           move_uploaded_file($_FILES["imagen"]["tmp_name"],$ruta);
    }
     
	
	if($prod->InsertarProducto
		(
		       $empresa,
           $nombre,
           $codigo_suplidor,
           $usuario_registro,
           $fecha_registro,
           $fecha_actualizacion,
           $tipo_impuesto,
           $estado,
           $codigo_subcategoria,
           $referencia_interna,
           $referencia_suplidor,
           $foto,
           $reorden,
           $oferta,
           $modificar_precio,
           $acepta_descuento,
           $detalle,
           $codigo_marca,
           $porciento_beneficio,
           $porciento_minimo,
           $modelo

		))
	 {
	 	echo "true";
	 }
	 else
	 {
	 	echo "false";
	 }
} 
  if($boton==='actualizar')
  {
    $prod=new Producto();
           $empresa=$nombreEmpresa;
           $codigo_articulo=$_POST['codigo_articulo'];
           $nombre=$_POST['act_nombre'];
           $codigo_suplidor=$_POST['act_suplidor'];
           $tipo_impuesto=$_POST['act_impuesto'];
           $estado=$_POST['act_estado'];
           $costo=$_POST['act_costo'];
           $precio=$_POST['act_precio'];
           $codigo_subcategoria=$_POST['act_categoria'];
           $referencia_interna=$_POST['act_referencia_interna'];
           $referencia_suplidor=$_POST['act_referencia_suplidor'];
           $reorden=$_POST['act_reorden'];
           $oferta=$_POST['act_oferta'];
           $modificar_precio=$_POST['act_modificar_precio'];
           $acepta_descuento=$_POST['act_descuento'];
           $detalle=$_POST['act_detalle'];
           $codigo_marca=$_POST['act_marca'];
           $porciento_beneficio=$_POST['act_beneficio'];
           $porciento_minimo=$_POST['act_beneficio_minimo'];
           $modelo=$_POST['act_modelo'];
    
  if($prod->Actualizar_articulo($empresa,$codigo_articulo,$nombre,$codigo_suplidor,$tipo_impuesto,$estado,$costo,$precio,$codigo_subcategoria,$referencia_interna,$referencia_suplidor,$reorden,$oferta,$modificar_precio,$acepta_descuento,$detalle,$codigo_marca,$porciento_beneficio,$porciento_minimo,$modelo))
   {
    echo "true";
   }
   else
   {
    echo "false";
   }
} 

  if($boton==='cambiar_prec')
  {
    $prod=new Producto();
           $empresa=$nombreEmpresa;
           $codigo_articulo=$_POST['cod_producto'];
           $precio=$_POST['precio'];
           $prec_com=$_POST['prec_com'];
         
           echo $prod->Cambiar_precio($empresa,$codigo_articulo,$precio,$prec_com);
    
  /*if($prod->Cambiar_precio($empresa,$codigo_articulo,$precio))
   {
    echo "true";
   }
   else
   {
    echo "false";
   }*/
} 
if ($boton==='eliminar')
   {
    $empresa=$nombreEmpresa;
    $codigo_articulo=$_POST['codigo_articulo'];
    $prod=new Producto();
    if($prod->Eliminar_articulo($empresa,$codigo_articulo))
    {
      echo "true";
    }
    else
    {
      echo "false";
    }
    
   }
    if($boton==='buscarSubCategoria')
  {
   $ins=new Producto();
   $subcategoria=$ins->LlenarSubCategoria($nombreEmpresa);
   echo json_encode($subcategoria);
  }
  if($boton==='buscarMarca')
  {
   $ins=new Producto();
   $marca=$ins->LlenarMarca($nombreEmpresa);
   echo json_encode($marca);
  }
  if($boton==='buscarSuplidor')
  {
   $ins=new Producto();
   $suplidor=$ins->LlenarSuplidor($nombreEmpresa);
   echo json_encode($suplidor);
  }








?>