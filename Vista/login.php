

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
	<div class="container-fluid row cabeza">
      <header class="col-md-12">
					<div class=" row ">
						<div class="col-md-4"></div>
						<div class="col-md-4">
							<form action="">
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
								<div class="col-md-2"></div>
								<div class="col-md-9">
									<div class="intro-title"><p>Identifícate ante el sistema</p></div>
							        <div class="intro-summary"></div>
								</div>
								<div class="col-md-1"></div>
							     <br><br>
							</div>
							<div class="row">
               <div class="col-md-1"></div>
               <div class="col-md-10">
                 
                 <div class="mensaje" id="mensaje"></div>
               </div> 
               <div class="col-md-1"></div>

              </div>
							
                  <form   id="formulario" method="post">
                  <div class="user-access-footer">
                  <div class="" id="logininfo"></div>
                </div>
      <div class="container" id="resultado"></div>
      <div class="form-group has-feedback">
        <div class="log" id="log"></div>
        <input type="text" class="form-control" name="loginus"  id="loginus" placeholder="Nombre usuario">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <div class="loginpass" id="loginpass"></div>
        <input type="password" name="clave"  id="clave" class="form-control required" placeholder="Contraseña"  title="Digite tu contraseña.">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

      </div>
      <input type="submit"class="btn btn-primary"name="login" id="login" value="ENTRAR">
      <br> <br>
      <div class="user-access-footer">

                <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                  <div><a href="#">¿Olvidaste tu contraseña?</a></div>
                </div>
                 <div class="col-md-2"></div>
              </div>
                
                <hr />
                <div>¿Aún no tienes una cuenta? <a href="registrar.php">CREAR CUENTA</a></div>
            
    </form>
							
	         </div>
		   
            <div class="col-md-4"></div>
          
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
    
       <script src="js/mijquery/validaLogin.js"></script>