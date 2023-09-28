
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
  $apellido = sanitizar($conexion, $_REQUEST["apellido"]);
  $email = sanitizar($conexion, $_REQUEST["email"]);
  $clave = sanitizar($conexion, $_REQUEST["clave"]);
  $dni = sanitizar($conexion, $_REQUEST["dni"]);
  $direccion = sanitizar($conexion, $_REQUEST["direccion"]);
  $id = sanitizar($conexion, $_REQUEST["id"]);
  $clave = md5($clave);
  $query = "UPDATE `clientes` SET `nombre`='$nombre',`apellido`='$apellido',`email`='$email',`clave`='$clave',`dni`='$dni',`direccion`='$direccion' WHERE `id`='$id'";
   mysqli_query($conexion, $query);
        if ($conexion->connect_errno) {
          die("<p>Error de conexión Nº: $conexion->connect_errno - $conexion->connect_error</p>\n</body>\n</html>");
        }
        else {
          print "<meta http-equiv=\"refresh\" content=\"0; url=panel.php?modulo=clientes&mensaje=Cliente actualizado exitosamente\" />  ";}
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
          $query = "select * from `clientes` WHERE `id`= $id";
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
        $apellido = sanitizar($conexion, $row["apellido"]);
        $email = sanitizar($conexion, $row["email"]);
        $clave = sanitizar($conexion, $row["clave"]);
        $clave = md5($clave);
        $id = sanitizar($conexion, $row["id"]); 
        $dni = sanitizar($conexion, $row["dni"]);
        $direccion = sanitizar($conexion, $row["direccion"]);
        ?>
            <div class="card-body">
              <form method="get" action="panel.php?modulo=editarclientes">
                <div class="form-group">
                <input type="hidden" name="modulo" class="form-control" value="editarclientes" >
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control" value="<?php print "$email"; ?>" required>
                </div>
                <div class="form-group">
                  <label for="clave">Clave</label>
                  <input type="password" name="clave" class="form-control" value="<?php print "$clave"; ?>" required >
                </div>
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="password" name="nombre" class="form-control" value="<?php print "$nombre"; ?>" required >
                </div>
                <div class="form-group">
                  <label for="apellido">apellido</label>
                  <input type="text" name="apellido" class="form-control" value="<?php print "$apellido";  ?>" required>
                </div>
                <div class="form-group">
                  <label for="dni">DNI</label>
                  <input type="text" name="dni" class="form-control" value="<?php print "$dni";  ?>" required>
                </div>
                <div class="form-group">
                  <label for="direccion">Direccion</label>
                  <input type="text" name="direccion" class="form-control" value="<?php print "$direccion";  ?>" required>
                </div>
                <input type="hidden" name="id" class="form-control" value="<?php print "$id";  ?>" 

                
                <div class="form-group">
                  <button type="submit" name="actualizar" class="btn btn-primary">Actualizar</button>
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