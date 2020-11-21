<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registrar</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link href="css/main.css" rel="stylesheet">
</head>
<body>
	<div class="container">
	<div class="container-fluid  cabeza">
      <header class="col-md-12">
					<div class=" row ">
						<div class="col-md-4"></div>
						<div class="col-md-4">
                <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                  <a href="#">
                <img src="images/logo1.png" width="200px" alt="100x">
                   </a>

                </div>
                <div class="col-md-2"></div>
              </div>
              <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-8">
                  <div class="intro-title"><p>¡Crea tu cuenta gratis!</p></div>
                      <div class="intro-summary"></div>
                      
                </div>
                <div class="col-md-1"></div>
                   <br><br>
              </div>
              <div class="row">
               <div class="col-md-1"></div>
               <div class="col-md-10">
                 
                   

               </div> 
               <div class="col-md-1"></div>

              </div>

              
              <!--Correo o Telefono-->
                          <form id="formulario" name="formulario" method="post">
                            <div class="form-group">
                               <div class="errornam" id="error"></div>
                              <input type="text" name="nam"  id="nam" class=" campo form-control required" placeholder="Nombre"  title="Digite tu nombre.">
                              </div>
                        
                            <div class="form-group">
                               <div class="errorcor" id="error"></div>
                              <input type="text" name="correo"  id="correo" class=" campo form-control required" placeholder="Correo electronico"  title="Digite tu contraseña.">
                              </div>
                                <div class="form-group">
                                <div class="errorcor" id="error"></div>
                              <input type="text" name="login"  id="login" class=" campo form-control required" placeholder="Login"  title="Crea un login">
                              </div>

                              <!--clave-->
                              <div class="form-group">
                                <div class="form-group has-feedback">
                                 <div class="error" id="error"></div>        
                              <input type="password" name="pass"  id="pass" class=" campo form-control required" placeholder="Contraseña"  title="Digite tu contraseña.">
                              </div>
                              <div class="form-group">
                              <div class="form-group has-feedback">
                                 <div class="error" id="error"></div>        
                              <input type="password" name="pass1"  id="pass1" class=" campo form-control required" placeholder="Confirmar contraseña"  title="Confirma contraseña.">
                              <div class="error" id="nocoincide"></div>
                              </div>
                              
                             <!-- Login-->
                
                              <!--Pais-->
                                 <div class="form-group has-feedback">
                                  
                                   <select class="form-control" id="pais" name="pais">
                                  <option>República Dominicana</option>
                                  <option>Haití</option>
                                  <option>Estados Unidos</option>
                                 </select>
          
                                 </div>
                                  <input type="hidden" name="boton"  id="boton" value="registrar" >
                                <input type="submit"class="btn btn-primary"name="registrar" id="registrar" value="REGISTRAR" data-toggle='modal' data-target=''>
                              </form>
                                <br><br>
        <div class="terms">
                Al crear tu cuenta aceptas nuestros
                <a href="#" target="_blank">Términos y Condiciones</a> y <a href="#" target="_blank">Política de Tratamiento de Datos</a>
        </div>
             <hr>
                <div class="user-access-footer">
                  <div class="">¿Ya tienes una cuenta? <a href="login.php">REGISTRAR</a></div>
                </div>
                <div class="user-access-footer">
                  <div class="" id="emailinfo"></div>
                </div>

      </div>
          <div class="col-md-4">
          
            </div>
  </div> 
          
        
				
	     
	    </div>
	 </div>
	  <footer></footer>
	
</div>
</body>
</html>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/mousescroll.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/jquery.inview.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/mijquery/vregistrar.js"></script>
    <script>


        /*$(document).ready(function(){
          
           $("#registrar").click(function(){
             alert("hola");
           });

        });*/


    </script>
