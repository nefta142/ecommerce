
<?php
include_once "db_connect.php";
$conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_database);
if ($conexion->connect_errno) {
  die("<p>Error de conexión Nº: $conexion->connect_errno - $conexion->connect_error</p>\n</body>\n</html>");
}

if (isset($_REQUEST["eliminarclientes"])) {
  $id = sanitizar($conexion, $_REQUEST["id"]);
  $query = "DELETE FROM `clientes` WHERE `id` LIKE '%".$id."%';"; 
  $resultset = mysqli_query($conexion, $query);

  if ($resultset) {
    print "<meta http-equiv=\"refresh\" content=\"0; url=panel.php?modulo=clientes&mensaje=El cliente  se ha eliminado exitosamente\" />  ";
  } else { ?>
    <div class="alert alert-danger float-right" role="alert">
      <strong>Atención! no se ha eliminado el cliente <?php print mysqli_error($conexion) ?> </strong>
    </div>
<?php }
}
$id = sanitizar($conexion, $_REQUEST["id"]);
$query = "SELECT * FROM clientes WHERE id=$id";
$resultset = mysqli_query($conexion, $query);
$row = mysqli_fetch_assoc($resultset);
if (!$row) {?>
  <div class="alert alert-danger float-right" role="alert">
    <strong>Atención! la consulta ha fallado <?php print mysqli_error($con) ?> </strong>
  </div>
<?php } 
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><i class="fas fa-user-edit"></i> Eliminar Usuario</h1>
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
              <h3 class="card-title">Se eliminara el cliente del ecommerce</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form method="post" action="panel.php">
                <input type="hidden" name="id" value="<?php print $row["id"]; ?>">
                <div class="form-group">
                  <label for="email"><?php print $row["email"]; ?></label>
                 <!--  <input type="email" name="email" class="form-control"  value="<?php print $row["email"]; ?>" readonly> -->
                </div>
                <div class="form-group">
                  <label for="nombre"><?php print $row["nombre"]; ?></label>
                  <!-- <input type="text" name="nombre" class="form-control"  value="<?php print $row["nombre"]; ?>" readonly> -->
                </div>
                <div class="form-group">
                  <input type="hidden" name="modulo" value="eliminarclientes">
                  <button type="submit" name="eliminarclientes" class="btn btn-danger">Eliminar</button>
                  <a class="btn btn-warning" href="clientes.php?modulo=usuarios&mensaje=operación cancelada por el usuario." role="button">Cancelar</a>
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