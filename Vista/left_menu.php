<aside class="main-sidebar left-menu ">
    <section class="sidebar">
      <!-- Sidebar user panel -->
      
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../Resources/img/usuarios/Wilgai.jpeg" class="img-circle" alt="">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['nombre'];  ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> En linea</a>
        </div>
      </div>
      <!-- search form -->
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">Menu Principal</li>
         <?php
               /*if($_SESSION['tipo_usuario']=='1')
               {*/
            ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-th-large"></i> <span>Venta</span>
           
          </a>
        </li>

         <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Consultas</span>
            
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Compra</span>
            
          </a>
          
        </li>
        <?php
               //}
            ?>
        <li class="treeview">
          <a href="suplidor.php">
            <i class="fa fa-pie-chart"></i>
            <span>Suplidores</span>
            
          </a>
         
        </li>
       
        
        
        <li>
          <a href="pages/mailbox/mailbox.html">
            <i class="fa fa-envelope"></i> <span>Correos</span>
            <span class="pull-right-container">
              
              <small class="label pull-right bg-green">5</small>
             
            </span>
          </a>
        </li>
    </section>
    <!-- /.sidebar -->
  </aside>