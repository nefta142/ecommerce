
<?php
include_once "db_ecommerce.php";
$conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_database);
if ($conexion->connect_errno) {
  die("<p>Error de conexión Nº: $conexion->connect_errno - $conexion->connect_error</p>\n</body>\n</html>");
}
$id = sanitizar($conexion, $_REQUEST["id"]);


if (isset($_REQUEST["actualizar"])) {
  $nombre = sanitizar($conexion, $_REQUEST["nombre"]);
  $email = sanitizar($conexion, $_REQUEST["email"]);
  $mensaje = sanitizar($conexion, $_REQUEST["mensaje"]);
  $query = "UPDATE contacto SET nombre=\"$nombre\", email=\"$email\"
  WHERE id=\"$id\";";
  $resultset = mysqli_query($conexion, $query);

  if ($resultset) {
    //Actualizamos el nombre del mensaje en la sesión si es el usuario actual
    if ($_SESSION["id"] == $id) $_SESSION["nombre"] = $nombre; 

    print "<meta http-equiv=\"refresh\" content=\"0; url=panel.php?modulo=contacto&mensaje=El mensaje se actualizado exitosamente\" />  ";
  } else { ?>
    <div class="alert alert-danger float-right" role="alert">
      <strong>Atención! no se ha actualizado el mensaje <?php print mysqli_error($conexion) ?> </strong>
    </div>
<?php }
}

$query = "SELECT * FROM contacto WHERE id=$id";
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
          <h1><i class="fas fa-user-edit    "></i> Editar Mensaje</h1>
          <script>
            $(".alert").alert();
          </script>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Editar mensaje del ecommerce</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form method="post" action="panel.php?modulo=editarcontacto">
                <input type="hidden" name="id" value="<?php print $row["id"]; ?>">
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" name="nombre" class="form-control" required value="<?php print $row["nombre"]; ?>">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" name="email" class="form-control" required value="<?php print $row["email"]; ?>">
                </div>
          
                <div class="form-group">
                  
                  <textarea name="mensaje" rows="10" cols="120"  class="form-control"  value="<?php print $row["mensaje"]?>" readonly><?php print $row["mensaje"]?></textarea>                
                </div>
                 <div class="form-group">
                <div class="form-group">
                  <button type="submit" name="actualizar" class="btn btn-primary">Actualizar</button>
                  <a class="btn btn-danger" href="panel.php?modulo=contacto" role="button">Cancelar</a>
                </div>
           <!--   </form> -->
            </div>
            
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