<?php 
error_reporting(0);
  session_start();  


?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Iniciar Sesión</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link rel="icon" type="image/png" href="login/images/icons/WorkeysIcon.png"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="login/vendor/animate/animate.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="login/vendor/select2/select2.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="login/css/util.css">
  <link rel="stylesheet" type="text/css" href="login/css/main.css">


  <link rel="stylesheet" href="sweetalert/sweetalert2.css">

  <script src="sweetalert/sweetalert2.js"></script>

  <script src="js/jquery.js"></script>

  <script src="SuperUsuario/js/alerta.js" ></script>

  <style type="text/css" media="screen">
    *{
      margin: 0;
      padding: 0;
    }
#EstiloAlerta
{
    margin: 0 auto; 
    width: 25%;
    height: 8%;

    position: fixed;
    top: 0; 
    right: 0;
    margin-top: 5%;
    font-family: 'Roboto Light', arial;

}



@media only screen and (max-width: 767px) {

#EstiloAlerta
{
    margin: 0 auto; 
    width: 35%;
    height: 15%;

    position: fixed;
    top: 0; 
    right: 0;
    margin-top: 5%;
    font-family: 'Roboto Light', arial;

}

}
@media screen and (max-width: 980px) {
  #Logo
  {
    display: none;
    position: relative;
    bottom: 30px;
    width: 100%;
  }

}
  </style>

<!--===============================================================================================-->

</head>
<body style="background-color: #2D2D2E;">
  <div class="row mb-5 col-md-12">
    <div class="col-xs-0 col-sm-0 col-md-0 col-lg-7" id="Logo">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" >
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active ">
            <img class=" img-fluid" src="img/fondologin.jpg" alt="First slide" style="height: 540px; width: 1000px; ">
          </div>
          <div class="carousel-item">
            <img class=" img-fluid" src="../SideBySide/SuperUsuario/img/foto3.JPG" alt="Second slide" style="height: 540px; width: 1000px; ">
          </div>
          <div class="carousel-item">
            <img class=" img-fluid" src="../SideBySide/SuperUsuario/img/Super2slider.jpg" alt="Third slide" style="height: 540px; width: 1000px;">
          </div>
        </div>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div
      <img class="img-fluid" src="" >
    </div>
    <div class="col-xs-12 col-sm-10 col-md-8 col-lg-3" style="margin-top: 100px;margin:auto;">
      <form class="login100-form validate-form" action="validar.php" method="POST">
         
          <img class="img-fluid" src="img/SideBySideWhiteVersion.png" alt="IMG" height="90px" style="max-width: 100%;">
        
          <span class="login100-form-title" style="color: white; margin-top: 70px;">
           Inicio Sesión
          </span>

          
          <div class="wrap-input100 validate-input" data-validate = "se requiere un Correo Electrónico">
            <input class="input100" type="text" name="correo" placeholder="Correo Electrónico" value="<?php  if(isset($_SESSION['Iniciado']))
            {
             
             echo $_SESSION['Iniciado'];
            }
            else {
              
            }?>">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-envelope" aria-hidden="true"></i>
            </span>
          </div>
            
          <div class="wrap-input100 validate-input" data-validate = "se requiere una contraseña">
            <input id="contra" class="input100" type="password" name="contrasena" placeholder="Contraseña">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
          </div>
          
          <div class="container-login100-form-btn">
            <input type="submit" value="iniciar" name="iniciar" class="login100-form-btn">
          </div>

          <div class="text-center p-t-12">
            <span class="txt1">
              
            </span>
            <a class="txt2" href="CambiarContrasena/RecuperarCuenta.php" style="color: white;">
              Restablecer la contraseña
            </a>
          </div>

          <div class="text-center p-t-136">
            <a class="txt2" href="#">
              
              
            </a>
          </div>
        </form>
    </div>
  </div>
   
  <!--<div class="limiter">
    <div class="container-login100">
    <img class="img-fluid" src="img/fondologin.jpg" style="width: 830px; height: 800px; float: left; position: static;">

      <div class="wrap-login100">
        <div  class="float-right"> <?php include ('SuperUsuario/Modularidad/Alerta.php') ?> </div>

        <center>
        <form class="login100-form validate-form" action="validar.php" method="POST">
         
          <img class="img-fluid" src="img/SideBySideWhiteVersion.png" alt="IMG" height="90px">
        
          <span class="login100-form-title" style="color: white; margin-top: 70px;">
           Inicio Sesión
          </span>

          
          <div class="wrap-input100 validate-input" data-validate = "se requiere un Correo Electrónico">
            <input class="input100" type="text" name="correo" placeholder="Correo Electrónico" value="<?php  if(isset($_SESSION['Iniciado']))
            {
             
             echo $_SESSION['Iniciado'];
            }
            else {
              
            }?>">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-envelope" aria-hidden="true"></i>
            </span>
          </div>
            
          <div class="wrap-input100 validate-input" data-validate = "se requiere una contraseña">
            <input id="contra" class="input100" type="password" name="contrasena" placeholder="Contraseña">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
          </div>
          
          <div class="container-login100-form-btn">
            <input type="submit" value="iniciar" name="iniciar" class="login100-form-btn">
          </div>

          <div class="text-center p-t-12">
            <span class="txt1">
              
            </span>
            <a class="txt2" href="CambiarContrasena/RecuperarCuenta.php" style="color: white;">
              Restablecer la contraseña
            </a>
          </div>

          <div class="text-center p-t-136">
            <a class="txt2" href="#">
              
              
            </a>
          </div>
        </form>
        </center>
      </div>

    </div>

  </div>-->

  
<?php 
#en casi de que haya fallado la contrasena o el usuario manda un alert
if( $_SESSION['ValidaEntrada'] == 'fallo')
{
 echo "<script>swal({title:'Error',text:'Usser or password incorrect',type:'error'});</script>";
  $_SESSION['ValidaEntrada'] = 'Funciona';
}

 ?>

  

  
<!--===============================================================================================-->  
  <script src="login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
  <script src="login/vendor/bootstrap/js/popper.js"></script>
  <script src="login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
  <script src="login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
  <script src="login/vendor/tilt/tilt.jquery.min.js"></script>
  <script >
    $('.js-tilt').tilt({
      scale: 1.1
    })
  </script>
<!--===============================================================================================-->
  <script src="login/js/main.js"></script>


        <div class="footer-copyright py-3" style="background: black; margin-top: -98px; width: 100%;">
          <img class="img-fluid" src="img/funda.png" width="60px" style="margin-left: 100px;">
          </img>
          <img class="img-fluid" src="img/logoblanco2.png" style="margin-left:30px;"></img>
          <span style="margin-right:50px; margin-left:50px; color:white; font-size: 18px;">©2020 Copyright: Pograma Oportunidades</span>
          <span style="color: white; font-weight: bold; font-size: 18px;">Contáctanos:</span><a href="https://www.facebook.com/exalumnos.ccgk"><img class="img-fluid" src="img/facebook.png" style="margin-left:30px; width:60px;"></img></a>
          <a href="https://instagram.com/bk2oportunidades?igshid=4rmcd55eld5h"><img class="img-fluid" src="img/instagram.png" style="margin-left:30px; width:60px;"></a></img>
  </div>

</body>
</html>