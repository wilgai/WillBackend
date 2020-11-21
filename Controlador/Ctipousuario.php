<?php
require_once('../Modelo/tipousuario.php');
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
    $ins=new TipoDocumento();
    $a= $ins->listar_TipoDocumento($valor,$inicio=FALSE,$limite=FALSE,$nombreEmpresa);
    $b=count($a);
    $c= $ins->listar_TipoDocumento($valor,$inicio,$limite,$nombreEmpresa);
    
    echo json_encode($c)."*".$b;
  }


if($boton==='guardar')
	{
      $prod=new TipoDocumento();
           $empresa=$nombreEmpresa;
           $nombre=$_POST['tipousuario'];
	if($prod->InsertarTipoDocumento($empresa,$nombre))
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
    $prod=new TipoDocumento();
           $empresa=$nombreEmpresa;
           $tipo_documento=$_POST['tipo_documento'];
           $nombre=$_POST['act_nombre'];
           
    
  if($prod->Actualizar_categoria($empresa,$tipo_documento,$nombre))
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
    $tipo_documento=$_POST['tipo_documento'];
    $prod=new TipoDocumento();
    if($prod->Eliminar_tipodocumento($empresa,$tipo_documento))
    {
      echo "true";
    }
    else
    {
      echo "false";
    }
    
   }








?>