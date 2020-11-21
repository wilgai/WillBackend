<?php
include("header.php");
include("left_menu.php");
?>

   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <!-- /.row -->
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Mantenimiento de suplidores</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  
                <div class="panel-group">
                     <div class="panel panel-default">
                     <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-4">
                        
                        <button type="button" class="btn btn-success" data-toggle="collapse" data-target="#frmuSuplidores"><span class="glyphicon glyphicon-plus"></span></button>
                       </div>
                        <div class="col-md-4">

                        </div>
                       <div class="col-md-4">
                          <form>
                               <div class="input-group ">
                                   <input type="text" id="buscar" onkeyup="lista_supl(this.value,'1')" class="form-control" placeholder="Buscar">
                                   <div class="input-group-btn">
                                   <button class="btn btn-default" type="submit">
                                   <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                   </div>
                              </div>
                      </form>
                       </div>               
                    </div>

                     </div>
                <div class="panel-body">  
  
              <form action="" id="frmuSuplidores" name="frmuSuplidores" class="collapse" method="post">
                  <div class="row">
                    <div class="col-md-4">

                        <div class="form-group ">
                              <label for="cod_producto">Nombre:</label>
                              <div id="errornombre_sup"></div>
                              <input type="text" class="form-control " id="nombreSuplidor" name="nombreSuplidor" placeholder="Nombre del producto"  >
                        </div>
                           <div class="form-group ">
                              <label for="nombre">RNC:</label>
                              <div id="error_rnc"></div>
                              <input type="text" class="form-control " id="rnc" placeholder="RNC" name="rnc"  >
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                        <div class="form-group ">
                              <label for="imagen">Logo:</label>
                             
                              <input type="file" class="form-control " id="selectImg">
                              
                        </div>
                        </div>
                        <div class="col-md-6">
                        <img id="myimg" style="width:100px;height:100px; border: 0px solid black"><label id="upProgess"></label>
                        </div>
                        </div>
                      
  
                       
                </div>
                         <div class="col-md-4">

                        
                     <div class="form-group ">
                             <label for="cod_presentacion">Dirección:</label>
                             <div id="errordireccion_sup"></div>
                             <input type="text" class="form-control " id="direccionSuplidor" name="direccionSuplidor" placeholder="Dirección" >
                       </div>
                        <div class="form-group ">
                             <label for="cod_presentacion">Teléfono:</label>
                             <div id="errortelefono_sup"></div>
                             <input type="text" class="form-control " id="telefonoSuplidor" name="telefonoSuplidor" placeholder="Telefono" >
                       </div>
                       <div class="form-group ">
                             <label for="cod_presentacion">Tipo suplidor:</label>
                             <div id="errortipoSup"></div>
                             <select name="tipoSup" id="tipoSup"class="form-control">
                               <option value="">Elige el tipo de suplidor</option>
                               <option value="4">Suplidor de mercancia</option>
                               <option value="5">Suplidor de servicio</option>
                             </select>
                       </div>

                       
                </div>  
                     <div class="col-md-4">
                        <div class="form-group ">
                             <label for="cod_presentacion">Correo:</label>
                             <div id="errorcorreo_sup"></div>
                             <input type="text" class="form-control " id="correoSuplidor" name="correoSuplidor" placeholder="Correo electrónico" >
                       </div>
                       <div class="form-group ">
                             <label for="cod_presentacion">Web:</label>
                             <div id="errorweb"></div>
                             <input type="text" class="form-control " id="web" name="web" placeholder="Dirección web" >
                       </div>

                        <div class="form-group">
                              
                              <input type="hidden" name="boton"  id="boton" value="guardar" >
                        </div>
                           </div>       
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                             <button type="submit"  name="saveCliente"   id="saveSuplidor" class="btn btn-primary registrar" > <span class="glyphicon glyphicon-floppy-disk"></span> Resgistrar</button>
                          </div>
                          <div class="col-md-5">
                          
                            
                          </div>
                          <div class="col-md-4">
                       
                          </div>
                        </div>
  </form>
          </div>
         </div>
        </div>
        <div class="boton">
          <input type="button" class="btn btn-success" id="excel" name="excel" value="Excel">
          <input type="button" class="btn btn-default" id="pdf" name="pdf" value="PDF">
        </div>
              <div class="form-group">
             
              <table id="lista_sup" class="table table-striped table-bordered" style="width:100%">
                  <thead><tr>
                     <th>Nº</th>
                     <th>Nombre</th>
                     <th>RNC</th>
                     <th>Teléfono</th>
                     <th>Correo</th>
                     <th>URL</th>
                     <th>Dirección</th>
                     <th>Logo</th>
                     <th>Opciones</th>
                     </tr>
                  </thead>
                  <tbody id="filas">

                  </tbody>
              <table>
 
              </div> 
             
              <!--Formulario modal-->
 

<!-- /.chart-responsive -->
      </div>
                <!-- /.col -->
                
                <!-- /.col -->
      </div>
              <!-- /.row -->
    </div>
            <!-- ./box-body -->
            <!--alli va el pied--> 
            <!-- /.box-footer -->
  </div>
          <!-- /.box -->
 </div>
        <!-- /.col -->
</div>
      <!-- /.row -->

      
          
        <!-- /.col -->
      
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  




<div class="modal fade bd-example-modal-lg" id="articulos" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
         <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h2 class="modal-title">Modificar usuario</h2>
                            </div>
                            <div class="modal-body">
                                <div class="alert alert-success fade in alert-dismissable text-center" id="exito" style="display:none;">
                                    <span class="glyphicon glyphicon-ok"> </span><span> El articulo ha sido actualizado con exito</span>
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">ok</a>
                                </div>
                                <div class="alert alert-danger fade in alert-dismissable text-center" id="fail" style="display:none;">
                                    <span class="glyphicon glyphicon-remove"> </span><span> No se pudo actualizar este artículo.</span>
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">ok</a>
                                </div>
                                
                                <form action="" id="actualizar_cliente">
                                  <div class="row">
                                    <div class="col-md-4">
                                      <div class="form-group ">
                                        <label for="nombre">Nombre:</label>
                                          <input  type="hidden" id="act_codigo_usuario" name="codigo_usuario"/>
                                          <input id="act_nombre" name="act_nombre" type="text" class="form-control" placeholder="Nombre">
                                       </div>
                                           <div class="form-group">
                                          <label for="marca">Sexo:</label>
                                          <div id="errormarca"></div>
                                         <select class="form-control" id="sexo" name="sexo">
                                                <option value="M">Hombre</option>
                                                <option value="
                                                F">Mujer</option>
                                                
                                         </select>
                                      </div>
                                       <div class="form-group ">
                                        <label for="nombre" class="">Identificación:</label>
                                          
                                          <input id="act_identificacion" name="act_identificacion" type="text" class="form-control" placeholder="Identificación">
                                       </div>
                                       <div class="form-group ">
                                        <label for="nombre" class="">Dirección:</label>
                                        
                                          <input id="act_direccion" name="act_direccion" type="text" class="form-control" placeholder="Dirección">
                                       </div>
                                         <div class="form-group ">
                                        <label for="nombre" class="">Correo:</label>
                                        
                                          <input id="act_correo" name="act_correo" type="mail" class="form-control" placeholder="Correo">
                                       </div>
                                       
                                    
                                  </div>
                                    <div class="col-md-4">

                                       
                                       <div class="form-group ">
                                        <label for="nombre" class="">Login:</label>
                                        
                                          <input id="act_login" name="act_login" type="mail" class="form-control" placeholder="Nombre usuario">
                                       </div>
                                     <div class="form-group ">
                                        <label for="nombre" class=""> Celular:</label>
                                        
                                          <input id="act_celular" name="act_celular" type="text" class="form-control" placeholder="Num. celular">
                                       </div>
                                       <div class="form-group ">
                                        <label for="nombre" class="">Teléfono:</label>
                                        
                                          <input id="act_telefono" name="act_telefono" type="text" class="form-control" placeholder="Num. telefono">
                                       </div>
                                        <div class="form-group ">
                                        <label for="nombre" class="">Whatsapp:</label>
                                        
                                          <input id="act_whatsapp" name="act_whatsapp" type="text" class="form-control" placeholder="Num. whatsapp">
                                       </div>
                                           <div class="form-group ">
                          <label for="pwd">Tipo usuario:</label>
                         <div id="errorsuplidor"></div>
                         <select class="form-control" id="act_tipo_usuario" name="act_tipo_usuario">
                                <option value="">Elige el tipo de usuario</option>
                                <option value="1">Administrador</option>
                                <option value="2">Limitado</option>
                         </select>
                    </div>
                                      
                                     
                                    </div>
                                    <div class="col-md-4">
                              <div class="form-group ">
                                        <label for="nombre" class="">Condicion de pago:</label>
                                        
                                          <input id="act_condicionPago" name="act_condicionPago" type="text" class="form-control" placeholder="Condicion de pago">
                                       </div>

                                       <div class="form-group ">
                                        <label for="nombre" class="">Limite de credito:</label>
                                        
                                          <input id="act_limiteCredito" name="act_limiteCredito" type="text" class="form-control" placeholder="Limite de credito">
                                       </div>
                    <div class="form-group">
                                          <label for="marca">Estado:</label>
                                          <div id="errormarca"></div>
                                         <select class="form-control" id="act_estado" name="act_estado">
                                                <option value="1">A</option>
                                                <option value="0">C</option>
                                                
                                         </select>
                                      </div>
                                     
                                      
                                    </div>
                                   
                                 
                                  </div>
                                  
                                   <input name="boton" type="hidden" value="actualizar">
                                </form>
                               </div>
                            <div class="modal-footer">  
                                <button type="button" class="btn btn-danger"  data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-success" onclick="actualizar_cliente();">Actualizar</button>
                            </div>
    </div>
  </div>
</div>

<?php
include("footer.php");
//include("right_menu.php");
?>