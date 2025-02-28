<?php
if (isset($_REQUEST["guardar"])) {
  include_once "db_ecommerce.php";
  $conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_database);
  if ($conexion->connect_errno) {
    die("<p>Error de conexión Nº: $conexion->connect_errno - $conexion->connect_error</p>\n</body>\n</html>");
  }
  $nombre = sanitizar($conexion, $_REQUEST["nombre"]);
  $email = sanitizar($conexion, $_REQUEST["email"]);
  $mensaje = sanitizar($conexion, $_REQUEST["mensaje"]);
  $query = "INSERT INTO contacto (nombre,email, mensaje) VALUES (\"$nombre\", \"$email\", \"$mensaje\" )";
  $resultset = mysqli_query($conexion, $query);
  if ($conexion->connect_errno) {
    die("<p>Error de conexión Nº: $conexion->connect_errno - $conexion->connect_error</p>\n</body>\n</html>");
  }

  if ($resultset)
  {
    print "<meta http-equiv=\"refresh\" content=\"0; url=index.php?mensaje=El mensaje se ha recibido\correctamente\" />  ";
    //header("location: panel.php?modulo=clientes&mensaje=Cliente creado exitosamente ");
  }
  else
  {?>
    <div class="alert alert-danger float-right" role="alert">
      <strong>Atención! no se ha enviado el mensaje, Intentelo dentro de unosminutos <?php print mysqli_error($conexion) ?> </strong>
    </div>
<?php }
}
?>

<!-- Content Wrapper. Contains page content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          
          <div class="card-header">
          <script>
            $(".alert").alert();
          </script>
      </div>
    </div>
    
  </div><!-- /.container-fluid -->
</section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Contacto</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form method="get" action="index.php">
              <div class="form-group">
                  <label for="nombre">Nombre:</label>
                  <input type="text" name="nombre" class="form-control"  value="" required>
                </div>
                <div class="form-group">
                  <label for="apellido">Email:</label>
                  <input type="text" name="email" class="form-control"  value="" required>
                </div>
                <div class="form-group">
                  
                  <textarea name="mensaje" rows="10" cols="120">Escribe aquí tus comentarios</textarea>                </div>
                 <div class="form-group">
                  <input type="hidden" name="modulo" value="crearcontacto">
                  <button type="submit" name="guardar" class="btn btn-primary">Guardar</button>
                  <a class="btn btn-danger" href="index.php" role="button">Cancelar</a>
                </div>
              </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>

