<?php 
session_start();
  if ($_SESSION['login']!='true')
  {
    
    header("location:login.php");
  }
  
    ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Mastertech</title>

    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="main.css">  
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
  

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Gives the icons on the main page-->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Admin LTE -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
<!--Add style to sometext-->
<link rel="stylesheet" href="css/datatable/bootstrap.min.css">
<link href="css/configuracion.css" rel="stylesheet">
</head>
<body class="hold-transition skin-blue sidebar-mini" >
<div class="wrapper">
<header class="main-header top-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      
      		
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><?php /*echo $_SESSION['empresa'];*/?></b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
    
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
                  <!-- end message -->
                  
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">0</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Tienes 0 notificaciones</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 nuevos mienbros
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Ahi va un texto
                     
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 nuevo miembro
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 ventas han hecho
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> Has cambiado tu nombre de usuario
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">Ver todo</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less --> 
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../Resources/img/usuarios/Wilgai.jpeg" class="user-image" alt="User Image">
              <span class="hidden-xs">
              <?php 
              
              if($_SESSION['nombre']=='')
              {
                echo 'Desconocido';
              }

              else
              {
                 echo $_SESSION['nombre'];
              }
              ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../Resources/img/usuarios/Wilgai.jpeg" alt="User Image">

                <p>
                   <?php 
              
             /* if($_SESSION['nombre']=='')
              {
                echo 'Desconocido';
              }

              else
              {
                 echo $_SESSION['nombre'];
              }*/
              ?>
                  <small>Miembro desde 2017</small>
                </p>
              <!--</li>
              <!-- Menu Body -->
              <!--<li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row 
              </li>-->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <!--<a href="#"  class="btn btn-default btn-flat">Salir</a>-->
                  <button  type="button" id="cerrar" name="cerrar"  class="btn btn-default btn-flat">Salir</button>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
           <?php
               /*if($_SESSION['tipo_usuario']=='1')
               {*/
            ?>
          <li>
            <a href="configurar.php"><i class="glyphicon glyphicon-cog">Confuguración</i></a>
          </li>
            <?php
               //}
            ?>
        </ul>
      </div>

    </nav>
  </header>