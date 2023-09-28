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
<?php 
if (isset($_REQUEST["mensaje"])) { ?>
    <div class="alert alert-success alert-dismissible fade show float-right" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <strong><?php print $_REQUEST["mensaje"] ?></strong>
    </div>
<?php } ?>

<div class="login-box pt-5 container justify-content-center align-items-center">
  <div class="login-logo">
    <a href="#"><b>E</b>-commerce</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <?php
      //incluimos los datos de conexion de la bbdd
      include_once "db_connect.php";
  
      //CREAMOS LA CONEXION PASANDO LOS PARAMETROS
      $conexion = new mysqli($db_host, $db_user, $db_pass, $db_database);
                  
      //si hay error, corta el codigo y muestra el error
      if ($conexion->connect_errno) {
          die("<p class=\"error\">Conexion fallida! <b>Error Nº:</b> $conexion->connect_errno -- $conexion->connect_error</p>\n</body>\n</html>");
      }
  
      //si hemos hecho click en enviar, o hay algun campo vacio, o la comprobacion da error
      if (isset($_REQUEST["boton"])) {
        //sanitizamos lo datos
        $email = sanitizar($conexion, $_REQUEST["email"]);
        $passwd = md5(sanitizar($conexion, $_REQUEST["passwd"]));
        //comprobamos si estan vacíos
        if ($email == "" || $passwd == "") {
          print "<div class=\"alert alert-danger\" role=\"alert\">
          Debe de rellenar todos los campos!</div>";
        }
        else {
          //QUERY SQL QUE BUSCA EL NOMBRE EL LA TABLA USUARIOS
          $sql = "SELECT * FROM clientes WHERE email = \"$email\"";
  
          //LANZAR QUERY Y ALMACENAR EN VARIABLE
          $resultSet = $conexion->query($sql);
  
          //si hay algun error dentro de la consulta, corta el codigo y muestra el error
          if ($conexion->errno) {
              die("<p class=\"error\">Error en la consulta! <b>Error Nº:</b> $conexion->errno -- $conexion->error</p>\n</body>\n</html>");
          }
  
          //comprobar si la query encuentra alguna linea en el resultado, de esta forma sabemos si existe el usuario o no
          if ($resultSet->num_rows ) {
            //obtenemos la fila en un array asociativo
            $row = $resultSet->fetch_assoc();
            
            //comprobar el campo clave de la base de datos coincida con el que ingreso el usuario
            if ($row["clave"] == $passwd) { 
              //iniciamos la sesion y guardamos los datos
              //session_start();
              $_SESSION["id"] = $row["id"];
              $_SESSION["nombre"] = $row["nombre"];
              $_SESSION["apellidos"] = $row["apellido"];
              $_SESSION["email"] = $row["email"];

              //redirigimos al index
              print "<meta http-equiv=\"refresh\" content=\"0; url=./tienda/index.php?modulo=productos\"/>  ";
            }
            else {
              session_destroy();
              print "<div class=\"alert alert-danger\" role=\"alert\">
              Identificación incorrecta!</div>";
            }
          } else {
            session_destroy();
            print "<div class=\"alert alert-danger\" role=\"alert\">
                Identificación incorrecta!</div>";
          }
        } 
      }
      ?>

      <p class="login-box-msg">Identifícate para iniciar sesión</p>

      <form method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="passwd" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row align-items-center justify-content-center">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" name="boton" >Entrar</button>
            <a href="./index.php"   class="btn btn-warning btn-block">Saltar</a>

          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- nuevo registro -->
      <p class="mb-0 mt-2 text-center">
        <a href="./tienda/index.php?modulo=crearclientes" class="text-center">Registro nuevo usuario</a><br>
        <a href="index2.php" class="text-danger text-center">Iniciar Sesión como admin</a>
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


