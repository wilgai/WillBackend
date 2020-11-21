<?php
require_once('../Modelo/empresa.php');

	$boton= $_POST['boton'];
	if($boton==='registrar')
	{
		$empresa=$_POST['negocio'];
		$correo=$_POST['correo'];
		$clave=$_POST['pass'];
		$login=$_POST['login'];
	$emp=new Empresa();
     echo $emp->Resgistrar($empresa,$login,$correo,$clave);
    }
    //$emp=new Empresa();
    //echo $emp->Resgistrar("www","wwww@gami.com","123");
?>