<?php
require_once('../Modelo/categoria.php');

       
 session_start();
 $idUsuario=$_SESSION['id_usuario'];
 $nombreEmpresa=$_SESSION['empresa'];

        /*$cat=new Categoria();
        $categoria=$cat->LlenarCategoria($nombreEmpresa);
        require_once("../Vista/subcategoria.php");*/

 $boton=$_POST['boton'];
if($boton==='buscar')
  {
    $inicio = 0;
        $limite = 4;
        if (isset($_POST['pagina'])) {
          $pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
        $valor=$_POST['valor'];
    $ins=new Categoria();
    $a= $ins->listar_categoria($valor,$inicio=FALSE,$limite=FALSE,$nombreEmpresa);
    $b=count($a);
    $c= $ins->listar_categoria($valor,$inicio,$limite,$nombreEmpresa);
    
    echo json_encode($c)."*".$b;
  }


if($boton==='guardar')
	{
      $prod=new Categoria();
           $empresa=$nombreEmpresa;
           $usuario=$idUsuario;
           $nombre=$_POST['nombre'];
	if($prod->InsertarCategoria($empresa,$nombre,$usuario))
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
    $prod=new Categoria();
           $empresa=$nombreEmpresa;
           $codigo_categoria=$_POST['codigo_categoria'];
           $nombre=$_POST['nombre'];
           
    //echo $prod->Actualizar_categoria($empresa,$codigo_categoria,$nombre);
  if($prod->Actualizar_categoria($empresa,$codigo_categoria,$nombre))
   {
    echo "true";
   }
   else
   {
    echo "false";
   }
} 
if ($boton==='eliminar')
   {
    $empresa=$nombreEmpresa;
    $codigo_articulo=$_POST['codigo_categoria'];
    $prod=new Categoria();
    if($prod->Eliminar_categoria($empresa,$codigo_categoria))
    {
      echo "true";
    }
    else
    {
      echo "false";
    }
    
   }








?>