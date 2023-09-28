<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .b-example-divider {
      width: 100%;
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
      flex-shrink: 0;
      width: 1.5rem;
      height: 100vh;
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }

    .nav-scroller .nav {
      display: flex;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }

    .btn-bd-primary {
      --bd-violet-bg: #712cf9;
      --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

      --bs-btn-font-weight: 600;
      --bs-btn-color: var(--bs-white);
      --bs-btn-bg: var(--bd-violet-bg);
      --bs-btn-border-color: var(--bd-violet-bg);
      --bs-btn-hover-color: var(--bs-white);
      --bs-btn-hover-bg: #6528e0;
      --bs-btn-hover-border-color: #6528e0;
      --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
      --bs-btn-active-color: var(--bs-btn-hover-color);
      --bs-btn-active-bg: #5a23c8;
      --bs-btn-active-border-color: #5a23c8;
    }
    .bd-mode-toggle {
      z-index: 1500;
    }
  </style>
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="#"><b>Mi</b>ecommerce</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
      <?php

/********************************/  
 /**iniciamos sesión *******/
 /*********************************/  
session_start();
 /*********************************/  
 /**conectamos con la BBDD  *******/
 /*********************************/  
if (isset($_REQUEST["entrar"])) {
 include_once "db_connect.php";
$conexion = new mysqli($db_host, $db_user, $db_pass, $db_database);

 if ($conexion->connect_errno) {
   die("<p>Error de conexión Nº: $conexion->connect_errno - $conexion->connect_error</p>\n</body>\n</html>");
 }
 print "<p><b>Conexión exitosa!!<!b></p>";

 //*********************************/  
 //**empieza la validación del usuario*******/
 //**recogemos los datos del formulario*******/
 /*********************************/  
 
 $email = sanitizar($conexion, $_REQUEST["email"]);
 $clave = sanitizar($conexion, $_REQUEST["clave"]);

/************************************************************************************************************/  
//******comentar para la explotación ******** 
/*********************************/  
$claveSinSanitizar = $_REQUEST["clave"];
       print "<h3>clave sin sanitizar:</h3> ";
       print "<br>"; print "<br>";
       print $claveSinSanitizar;
       print "<br>";
       print "<br>";
       print "clave después de sanitizar:  ";
       print "<br>";print "<br>";
       print $clave;
       print "<br>";
       print "<br>";
/*********************************/

 $clave = md5($clave);


/*********************************/  
//******comentar para la explotación ******** 
/*********************************/  
       print "clave sanitizada encriptada con md5():";
       print "<br>";
       print "<br>";
       print $clave;
       print "<br>";
/*********************************/


 /*********************************/ 
 /*********************************/  
 /**empieza la validación del usuario*******/
  /**ya hemos recogido los datos del formulario lineas 135 y 136  *******/
 /*********************************/  
 
 /*********************************/  
 /**asignamos la consulta a una cadena****/
 /*********************************/  
  
 $sql = "SELECT id, nombre, email, tipo FROM
  usuarios WHERE email=\"$email\" and clave=\"$clave\"";

/*********************************/  
/******comentar para la explotación *******/
/*********************************/  
 print "<br>";
 print "<p>$sql</p>";
/***************************************************************************************************************/   

 /*********************************/  
 /**ejecutamos la consulta****/
 /*********************************/ 
 $resultset = $conexion->query($sql);

 if ($conexion->errno) {
   die("<p>Error en la consulta - $conexion->error </p>\n</body>\n</html>");
 }

 $row = $resultset->fetch_assoc();

 if ($row) {
   //Hay un usuario válido
   /*print "valido";
   print "<pre>";
   print_r($row);
   print "</pre>";*/
   $_SESSION["id"] = $row["id"];
   $_SESSION["email"] = $row["email"];
   $_SESSION["nombre"] = $row["nombre"];
   $_SESSION["tipo"] = $row["tipo"];
   header("location: panel.php");
 } else {
   //No se ha identificado
   ?>
     <div class="alert alert-danger" role="alert">
   
       Identificación incorrecta!
     </div>
     <script>
            $(".alert").alert();
      </script>
   <?php
 }
}
?>

        <p class="login-box-msg">Identifícate para iniciar sesión</p>

        <form method="get">
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" name="email" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="clave" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block" name="entrar">Entrar</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <!-- NUEVO REGISTRO -->
        <p class="mb-0">
          <a href="./tienda/index.php?modulo=crearclientes" class="text-center">Registrar nuevo usuario</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
</body>
</html>
