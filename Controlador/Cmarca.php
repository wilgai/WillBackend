<?php
require_once('../Modelo/marca.php');
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
    $ins=new Marca();
    $a= $ins->listar_marca($valor,$inicio=FALSE,$limite=FALSE,$nombreEmpresa);
    $b=count($a);
    $c= $ins->listar_marca($valor,$inicio,$limite,$nombreEmpresa);
    
    echo json_encode($c)."*".$b;
  }


if($boton==='guardar')
	{
      $prod=new Marca();
           $empresa=$nombreEmpresa;
           $nombre=$_POST['marca'];
	if($prod->InsertarMarca($empresa,$nombre))
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
    $prod=new Marca();
           $empresa=$nombreEmpresa;
           $codigo_marca=$_POST['codigo_marca'];
           $nombre=$_POST['nombre'];
           
    
  if($prod->Actualizar_marca($empresa,$codigo_marca,$nombre))
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
    $prod=new Marca();
    if($prod->Eliminar_marca($empresa,$codigo_marca))
    {
      echo "true";
    }
    else
    {
      echo "false";
    }
    
   }








?>