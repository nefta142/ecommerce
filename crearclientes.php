<?php
if ( isset($_SESSION["id"]) == false )
{
  header("location: index.php");
}
//Comprobamos el módulo seleccionado o lo inicializamos vacío si venimos del login
if (isset($_REQUEST["modulo"]))
{
  $modulo = $_REQUEST["modulo"];
}
else
{
  //Aplicamos el módulo por defecto
  $modulo = "estadisticas";
} 

if ( isset($_SESSION["id"]) == false )
{
  header("location: index.php");
}
//Comprobamos el módulo seleccionado o lo inicializamos vacío si venimos del login
if (isset($_REQUEST["modulo"]))
{
  $modulo = $_REQUEST["modulo"];
}
else
{
  //Aplicamos el módulo por defecto
  $modulo = "estadisticas";
} 
if (isset($_REQUEST["mensaje"]))
{?>
<!-- lanzamos el mensaje si existe -->
  <div class="alert alert-success alert-dismissible fade show float-right" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <strong><?php print $_REQUEST["mensaje"] ?></strong> 
  </div>
 <script>
    $(".alert").alert();
  </script>
<?php } 
if (isset($_REQUEST["guardar"])) {
  include_once "db_connect.php";
  $conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_database);
  if ($conexion->connect_errno) {
    die("<p>Error de conexión Nº: $conexion->connect_errno - $conexion->connect_error</p>\n</body>\n</html>");
  }
  $nombre = sanitizar($conexion, $_REQUEST["nombre"]);
  $apellido = sanitizar($conexion, $_REQUEST["apellido"]);
  $email = sanitizar($conexion, $_REQUEST["email"]);
  $clave = sanitizar($conexion, $_REQUEST["clave"]);
  $dni = sanitizar($conexion, $_REQUEST["dni"]);
  $direccion = sanitizar($conexion, $_REQUEST["direccion"]);

  $clave = md5($clave);
  $query = "INSERT INTO clientes (nombre, apellido, email, clave, dni, direccion ) VALUES (\"$nombre\", \"$apellido\", \"$email\", \"$clave\", \"$dni\", \"$direccion\")";
  $resultset = mysqli_query($conexion, $query);
  if ($resultset)
  {
    print "<meta http-equiv=\"refresh\" content=\"0; url=panel.php?modulo=clientes&mensaje=
 Cliente creado exitosamente\" />";
  }
  else
  {?>
    <div class="alert alert-danger float-right" role="alert">
      <strong>Atención! no se ha creado el cliente, El correo electronico ya esta en nuestra base de datos.<?php print mysqli_error($con) ?> </strong>
    </div>
<?php }
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><i class="fas fa-user-plus    "></i> Crear Clientes</h1>
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
              <h3 class="card-title">Crear cliente del ecommerce</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form method="post" action="panel.php?modulo=crearclientes">
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" name="nombre" class="form-control"  value="" required>
                </div>
                <div class="form-group">
                  <label for="apellido">apellido</label>
                  <input type="text" name="apellido" class="form-control"  value="" required>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control" value="" required>
                </div>
                <div class="form-group">
                  <label for="clave">Clave</label>
                  <input type="password" name="clave" class="form-control"  value="" required>
                </div>
                <div class="form-group">
                  <label for="dni">DNI</label>
                  <input type="text" name="dni" class="form-control"  value="" required>
                </div>
                <div class="form-group">
                  <label for="direccion">Direccion</label>
                  <input type="text" name="direccion" class="form-control"  value="" required>
                </div>
                  <button type="submit" name="guardar" class="btn btn-primary">Guardar</button>
                  <a class="btn btn-danger" href="panel.php?modulo=clientes" role="button">Cancelar</a>
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