<?php
require_once('../Modelo/subcategoria.php');
 session_start();
 $idUsuario=$_SESSION['id_usuario'];
 $nombreEmpresa=$_SESSION['empresa'];
 $boton=$_POST['boton'];

 

 if($boton==='buscarCategoria')
  {
   $ins=new Subcategoria();
   $categoria=$ins->LlenarCategoria($nombreEmpresa);
   echo json_encode($categoria);
  }


if($boton==='buscar')
  {
    $inicio = 0;
        $limite = 6;
        if (isset($_POST['pagina'])) {
          $pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
        $valor=$_POST['valor'];
    $ins=new Subcategoria();
    $a= $ins->listar_SubCategoria($valor,$inicio=FALSE,$limite=FALSE,$nombreEmpresa);
    $b=count($a);
    $c= $ins->listar_SubCategoria($valor,$inicio,$limite,$nombreEmpresa);
    
    echo json_encode($c)."*".$b;
  }


if($boton==='guardar')
	{
      $prod=new Subcategoria();
           $empresa=$nombreEmpresa;
           $nombre=$_POST['nombre'];
           $codigo_cat=$_POST['codigo_cat'];
           //echo $prod->InsertarSubCategoria($empresa,$nombre,$codigo_cat);
	if($prod->InsertarSubCategoria($empresa,$nombre,$codigo_cat))
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
    $prod=new Subcategoria();
           $empresa=$nombreEmpresa;
           $codigo_categoria=$_POST['codigo_cat'];
           $nombre=$_POST['nombre'];
           $codigo_subcategoria=$_POST['codigo_subcategoria'];
           
    
  if($prod->Actualizar_Subcategoria($empresa,$codigo_categoria,$nombre,$codigo_subcategoria))
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
    $codigo_subcategoria=$_POST['codigo_subcategoria'];
    $prod=new Categoria();
    if($prod->Eliminar_Subcategoria($empresa,$codigo_subcategoria))
    {
      echo "true";
    }
    else
    {
      echo "false";
    }
    
   }








?>