
<?php
include_once "db_connect.php";
$conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_database);
if ($conexion->connect_errno) {
  die("<p>Error de conexión Nº: $conexion->connect_errno - $conexion->connect_error</p>\n</body>\n</html>");
}

if (isset($_REQUEST["eliminarproducto"])) {
  $id = sanitizar($conexion, $_REQUEST["id"]);
  $query = "DELETE FROM `productos` WHERE `id` LIKE '%".$id."%';"; 
  $resultset = mysqli_query($conexion, $query);

  if ($resultset) {
    print "<meta http-equiv=\"refresh\" content=\"0; url=panel.php?modulo=productos&mensaje=El productos $nombre se eliminado exitosamente\" />  ";
  } else { ?>
    <div class="alert alert-danger float-right" role="alert">
      <strong>Atención! no se ha eliminado el producto <?php print mysqli_error($conexion) ?> </strong>
    </div>
<?php }
}
$id = sanitizar($conexion, $_REQUEST["id"]);
$query = "SELECT * FROM productos WHERE id=$id";
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
          <h1><i class="fas fa-user-edit"></i> Eliminar producto</h1>
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
              <h3 class="card-title">Se eliminara el producto del ecommerce</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form method="post" action="panel.php?modulo=eliminarproducto">
                <input type="hidden" name="id" value="<?php print $row["id"]; ?>">
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" name="nombre" class="form-control"  value="<?php print $row["nombre"]; ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="nombre">Precio</label>
                  <input type="text" name="precio" class="form-control"  value="<?php print number_format($row["precio"], 2, ".", ",")?> €" readonly>
                </div>
                <div class="form-group">
                  <label for="descripcion">Descripción</label>
                  <input type="text" name="descripcion" class="form-control"  value="<?php print $row["descripcion"]; ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="existencias">Existencias</label>
                  <input type="text" name="existencias" class="form-control"  value="<?php print $row["existencias"]; ?>" readonly>
                </div>
                <div class="form-group">
                  <button type="submit" name="eliminarproducto" class="btn btn-danger">Eliminar</button>
                  <a class="btn btn-warning" href="panel.php?modulo=productos" role="button">Cancelar</a>
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