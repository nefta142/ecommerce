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
      include_once "../db_ecommerce.php";
  
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
              print "<meta http-equiv=\"refresh\" content=\"0; url=index.php?modulo=productos\"/>  ";
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
        <a href="index.php?modulo=registrocliente" class="text-center">Registro nuevo usuario</a><br>
        <a href="../index2.php" class="text-danger text-center">Iniciar Sesión como admin</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

