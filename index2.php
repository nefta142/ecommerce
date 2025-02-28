<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log in</title>
  <meta name="keywords" content="practicas, IFCD0210" />
  <meta name="author" content="Constantino Lantigua" />
  <meta name="description" content="ejercicio de clase"/>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<!-- PRÁCTICA: Programar el login del cliente conectando a la base de datos, crear para ello un fichero "db_ecommerce.php" con los datos de la conexión, si falla el login mostrar un alert en la página index, si se identifica correctamente crear una sesión para guardar id, nombre e email y redirigir a la página "panel.php", mostrar el nombre del cliente en el panel de control, como extra controlar si al acceder a la página panel.php si no existe una sesión válida y redirigir al login -->

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="index2.html"><b>Mi</b>ecommerce</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <?php
        session_start();
           if (isset($_REQUEST["entrar"])) {
          include_once "db_ecommerce.php";
          $conexion = new mysqli($db_host, $db_user, $db_pass, $db_database);

          if ($conexion->connect_errno) {
            die("<p>Error de conexión Nº: $conexion->connect_errno - $conexion->connect_error</p>\n</body>\n</html>");
          }
          //print "<p>Conexión exitosa!!</p>";
          $email = sanitizar($conexion, $_REQUEST["email"]);
          $clave = sanitizar($conexion, $_REQUEST["clave"]);
          $clave = md5($clave);

          //print $clave;

          $sql = "SELECT * FROM usuarios WHERE email=\"$email\" and clave=\"$clave\"";
          //print "<p>$sql</p>";

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
            header("location: ./panel.php");
          } else {
            //No se ha identificado
            
            header("location: ./tienda/index.php");?>
              <div class="alert alert-danger" role="alert">
                Identificación incorrecta!
              </div>
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
          <a href="register.html" class="text-center">Registrar nuevo cliente</a>
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