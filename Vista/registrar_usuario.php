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
              <h3 class="box-title">Mantenimiento de usuarios</h3>

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
                            <button type="button" class="btn btn-success" data-toggle="collapse" data-target="#frmuser"><span class="glyphicon glyphicon-plus"></span></button>
                       </div>
                        <div class="col-md-4">
                          <div class="alert alert-success text-center" id="save" style="display:none;">
                                    <span class="glyphicon glyphicon-ok"> </span><span> El usuario ha sido registrado con exito</span>
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">ok</a>
                                </div>
                                <div class="alert alert-danger text-center" id="unsaved" style="display:none;">
                                    <span class="glyphicon glyphicon-remove"> </span><span> No se pudo registrar este artículo.</span>
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">ok</a>
                                </div>
                                <div class="alert alert-success text-center" id="correo" style="display:none;">
                                    <span class="glyphicon glyphicon-ok"> </span><span> Este correo ya existe elige otro.</span>
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">ok</a>
                                </div>
                                <div class="alert alert-danger text-center" id="notdelete" style="display:none;">
                                    <span class="glyphicon glyphicon-remove"> </span><span> No se pudo borrar este artículo.</span>
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">ok</a>
                                </div>
                                <div class="alert alert-danger text-center" id="nocoincidelascontrasenas" style="display:none;">
                                    <span class="glyphicon glyphicon-remove"> </span><span> No coincide las contraseñas.</span>
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">ok</a>
                                </div>

                                
                        </div>
                       <div class="col-md-4">
                          <form>
                               <div class="input-group ">
                                   <input type="text" id="buscar" onkeyup="lista_articulo(this.value,'1')" class="form-control" placeholder="Buscar">
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
  
              <form action="" id="frmuser" name="frmuser" class="collapse" method="post">
                  <div class="row">
                    <div class="col-md-4">

                        <div class="form-group ">
                              <label for="cod_producto">Nombre:</label>
                              <div id="errornombre_us"></div>
                              <input type="text" class="form-control required" id="username" name="username" placeholder="Nombre del producto" required>
                        </div>
                           <div class="form-group ">
                              <label for="nombre">Identificación:</label>
                              <div id="erroridentificacion"></div>
                              <input type="text" class="form-control required" id="identificacion" placeholder="Identificación" name="identificacion"  >
                        </div>
                       <div class="form-group ">
                              <label for="imagen">Imagen:</label>
                              <input type="file" name="imagen"  id="imagen" >
                        </div>
  
                       
                </div>
                         <div class="col-md-4">

                            <div class="form-group ">
                              <label for="birthday">Fecha de nacimiento:</label>
                              <div class="row">
                              <div class="col-md-4">
                                 <div id="errordia"></div>
                                <select class="form-control" id="dia" name="dia">
                                  <option value="">Día</option>
                                  <option value="01">Lunes</option>
                                                                       
                            </select>
                              </div>
                              <div class="col-md-4">
                               
                                  <div id="errormes"></div>
                                <select class="form-control" id="mes" name="mes">
                                  <option value="">Mes</option>  
                                  <option value="01">Enero</option>              
                            </select>
                              </div>
                              <div class="col-md-4">
                                <div id="errorano"></div>
                                <select class="form-control" id="ano" name="ano">
                                  <option value="2017">2017</option>
                                                                      
                            </select>
                              </div>
                            </div>
                        </div>
                        
                     <div class="form-group ">
                             <label for="cod_presentacion">Dirección:</label>
                             <div id="errordireccion"></div>
                             <input type="text" class="form-control required" id="direccion" name="direccion" placeholder="Dirección" required>
                       </div>
                        <div class="form-group ">
                             <label for="cod_presentacion">Celular:</label>
                             <div id="errorcelular"></div>
                             <input type="text" class="form-control required" id="celular" name="celular" placeholder="Celular" required>
                       </div>
                        <div class="form-group ">
                             <label for="cod_presentacion">Login:</label>
                             <div id="errorcelular"></div>
                             <input type="text" class="form-control required" id="login" name="login" placeholder="Login" required>
                       </div>

                       
                </div>  
                     <div class="col-md-4">
                        <div class="form-group ">
                             <label for="cod_presentacion">Correo:</label>
                             <div id="errorcorreo"></div>
                             <input type="mail" class="form-control required" id="correo" name="correo" placeholder="Correo electrónico" required>
                       </div>
                        <div class="form-group ">
                             <label for="cod_presentacion">Contraseña:</label>
                             <div id="errorcontrasena1"></div>
                             <input type="password" class="form-control required" id="contrasena1" name="contrasena1" placeholder="Contraseña" required>
                       </div>
                        <div class="form-group ">
                             <label for="cod_presentacion">Confirma la contraseña:</label>
                             <div id="errorcontrasena2"></div>
                             <input type="password" class="form-control required" id="contrasena2" name="contrasena2" placeholder="Confirma la contraseña" required>
                       </div>
                         <div class="form-group ">
                          <label for="pwd">Tipo usuario:</label>
                         <div id="errorsuplidor"></div>
                         <select class="form-control" id="tipo_usuario" name="tipo_usuario">
                                <option value="">Elige el tipo de usuario</option>
                                <option value="1">Administrador</option>
                                <option value="2">Limitado</option>
                         </select>
                    </div>

                        <div class="form-group">
                              
                              <input type="hidden" name="boton"  id="boton" value="guardar" >
                        </div>
                           </div>       
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                             <button type="submit"  name="saveuser"   id="saveuser" class="btn btn-primary registrar"data-toggle="collapse"data-target="#form_producto" > <span class="glyphicon glyphicon-floppy-disk"></span> Resgistrar</button>
                          </div>
                          <div class="col-md-5">
                              <fieldset>
                                <legend>Permisos:</legend>
                                 <div class="row">
                                   <div class="col-md-4">
                                     <input type="checkbox" name="vehicle" value="Bike">Mantenimiento<br>
                                <input type="checkbox" name="vehicle" value="Car" checked>Almacén<br>
                                   </div>
                                   <div class="col-md-4">
                                     <input type="checkbox" name="vehicle" value="Bike">Compras<br>
                                <input type="checkbox" name="vehicle" value="Car" checked>Ventas<br>
                                   </div>
                                   <div class="col-md-4">
                                     <input type="checkbox" name="vehicle" value="Bike">Configuracion<br>
                                <input type="checkbox" name="vehicle" value="Car" checked>Seguridad<br>
                                   </div>
                                 </div>
                                </fieldset>
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
                  <div id="lista_usuarios"></div> 
                  <div id="paginador_usuarios" class="text-center"></div> 
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
                                
                                <form action="" id="actualizar_usuario">
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
                          <label for="pwd">Sucursal:</label>
                         <div id="errorsuplidor"></div>
                         <select class="form-control" id="sucursal" name="sucursal">
                                <option value="">Elige un sucursal</option>
                                <option value="1">Sucursal 1</option>
                                
                         </select>
                    </div>

                                       <div class="form-group ">
                                        <label for="nombre" class="control-label col-xs-5">Sueldo:</label>
                                        
                                          <input id="act_sueldo" name="act_sueldo" type="mail" class="form-control" placeholder="Sueldo">
                                       </div>
                    <div class="form-group">
                                          <label for="marca">Estado:</label>
                                          <div id="errormarca"></div>
                                         <select class="form-control" id="act_estado" name="act_estado">
                                                <option value="1">A</option>
                                                <option value="0">C</option>
                                                
                                         </select>
                                      </div>
                                      <fieldset>
                                <legend>Permisos:</legend>
                                 <div class="row">
                                   <div class="col-md-4">
                                     <input type="checkbox" name="vehicle" value="Bike">Mant.<br>
                                <input type="checkbox" name="vehicle" value="Car" checked>Almacén<br>
                                   </div>
                                   <div class="col-md-4">
                                     <input type="checkbox" name="vehicle" value="Bike">Compras<br>
                                <input type="checkbox" name="vehicle" value="Car" checked>Ventas<br>
                                   </div>
                                   <div class="col-md-4">
                                     <input type="checkbox" name="vehicle" value="Bike">Config.<br>
                                <input type="checkbox" name="vehicle" value="Car" checked>Seg.<br>
                                   </div>
                                 </div>
                                </fieldset> 
                                      
                                      
                                      
                                     
                                    </div>
                                   
                                 
                                  </div>
                                  
                                   <input name="boton" type="hidden" value="actualizar">
                                </form>
                               </div>
                            <div class="modal-footer">  
                                <button type="button" class="btn btn-danger"  data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-success" onclick="actualizar_usuario();">Actualizar</button>
                            </div>
    </div>
  </div>
</div>

<?php
include("footer.php");
//include("right_menu.php");
?>