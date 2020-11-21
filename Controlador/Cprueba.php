<?php
require_once('../Modelo/producto.php');
 session_start();
 $idUsuario=$_SESSION['id_usuario'];
 $nombreEmpresa=$_SESSION['empresa'];
 $boton=$_POST['boton'];
 $boton=$_POST['boton'];

if($boton==='buscar')
  {
    $inicio = 0;
        $limite =$_POST['num_fila'];

        if (isset($_POST['pagina'])) {
          $pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
        $valor=$_POST['valor'];
    $ins=new Producto();
    $a= $ins->LlenarDataTable($valor,$inicio=FALSE,$limite=FALSE,$nombreEmpresa);
    $b=count($a);
    $c= $ins->LlenarDataTable($valor,$inicio,$limite,$nombreEmpresa);
    
    echo json_encode($c)."*".$b;
  }

   

   





?>