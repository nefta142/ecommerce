
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
include_once "db_connect.php";
$conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_database);
if ($conexion->connect_errno) {
  die("<p>Error de conexión Nº: $conexion->connect_errno - $conexion->connect_error</p>\n</body>\n</html>");  }
else{
if (isset($_REQUEST["actualizar"])) {
  $nombre = sanitizar($conexion, $_REQUEST["nombre"]);
  $email = sanitizar($conexion, $_REQUEST["email"]);
  $clave = sanitizar($conexion, $_REQUEST["clave"]);
  $tipo = sanitizar($conexion, $_REQUEST["tipo"]);
  $clave = md5($clave);
  $id = sanitizar($conexion, $_REQUEST["id"]);
  $query = "UPDATE `usuarios` SET `nombre`='$nombre',`email`='$email',`clave`='$clave', `tipo`='$tipo' WHERE `id`='$id'";
   mysqli_query($conexion, $query);
        if ($conexion->connect_errno) {
          die("<p>Error de conexión Nº: $conexion->connect_errno - $conexion->connect_error</p>\n</body>\n</html>");
        }
        else {
          print "<meta http-equiv=\"refresh\" content=\"0; url=panel.php?modulo=usuarios&mensaje=Usuario actualizado exitosamente\" />  ";}
        } 
     }

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><i class="fas fa-user-edit    "></i> Editar Usuario</h1>
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
              <h3 class="card-title">Editar usuario del ecommerce</h3>
            </div>
            <!-- /.card-header -->
            <?php 
            include_once "db_connect.php";
            
          $id = sanitizar($conexion, $_REQUEST["id"]);        
          $query = "select * from `usuarios` WHERE `id`= $id";
          mysqli_query($conexion, $query);
          if ($conexion->connect_errno) {
        die("<p>Error de conexión Nº: $conexion->connect_errno - $conexion->connect_error</p>\n</body>\n</html>");
           }
        $resultset = mysqli_query($conexion, $query);
        $row = mysqli_fetch_assoc($resultset);
        $id = sanitizar($conexion,$row["id"]);
        //print $id;
        $nombre = sanitizar($conexion, $row["nombre"]);
        //print $nombre;
        $email = sanitizar($conexion, $row["email"]);
        $clave = sanitizar($conexion, $row["clave"]);
        $clave = md5($clave);
        $id = sanitizar($conexion, $row["id"]); ?>
            <div class="card-body">
              <form method="post" action="panel.php?modulo=editarusuario">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control" value="<?php print "$email"; ?>" required>
                </div>
                <div class="form-group">
                  <label for="clave">Clave</label>
                  <input type="password" name="clave" class="form-control" value="<?php print "$clave"; ?>" required >
                </div>
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" name="nombre" class="form-control" value="<?php print "$nombre";  ?>" required>
                </div>
                <input type="hidden" name="id" class="form-control" value="<?php print "$id";  ?>" >
                <div class="form-group">
                <div class="form-group">
                <div class="form-group">
                <input type="radio" name="tipo" value="empleado" checked> Empleado<br>
                <input type="radio" name="tipo" value="administrador"> Administrador<br>
                </div>
                <div class="form-group">
                  <button type="submit" name="actualizar" class="btn btn-primary">Actualizar</button>
                  <a class="btn btn-danger" href="panel.php?modulo=usuarios&mensaje=operación cancelada por el usuario." role="button">Cancelar</a>
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