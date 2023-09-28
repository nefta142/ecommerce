
<?php
include_once "db_connect.php";
$conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_database);
if ($conexion->connect_errno) {
  die("<p>Error de conexión Nº: $conexion->connect_errno - $conexion->connect_error</p>\n</body>\n</html>");
}
$id = sanitizar($conexion, $_REQUEST["id"]);


if (isset($_REQUEST["actualizar"])) {
  $nombre = sanitizar($conexion, $_REQUEST["nombre"]);
  $descripcion = sanitizar($conexion, $_REQUEST["descripcion"]);
  $precio = sanitizar($conexion, $_REQUEST["precio"]);
  $existencias = sanitizar($conexion, $_REQUEST["existencias"]);
  $query = "UPDATE productos SET nombre=\"$nombre\", descripcion=\"$descripcion\", precio=\"$precio\", existencias=\"$existencias\"
  WHERE id=\"$id\";";
  $resultset = mysqli_query($conexion, $query);

  if ($resultset) {
    //Actualizamos el nombre del producto en la sesión si es el usuario actual
    if ($_SESSION["id"] == $id) $_SESSION["nombre"] = $nombre; 

    print "<meta http-equiv=\"refresh\" content=\"0; url=panel.php?modulo=productos&mensaje=El producto $nombre se actualizado exitosamente\" />  ";
  } else { ?>
    <div class="alert alert-danger float-right" role="alert">
      <strong>Atención! no se ha actualizado el producto <?php print mysqli_error($conexion) ?> </strong>
    </div>
<?php }
}

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
          <h1><i class="fas fa-user-edit    "></i> Editar Productos</h1>
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
              <h3 class="card-title">Editar producto del ecommerce</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form method="post" action="panel.php?modulo=editarproducto">
                <input type="hidden" name="id" value="<?php print $row["id"]; ?>">
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" name="nombre" class="form-control" required value="<?php print $row["nombre"]; ?>">
                </div>
                <div class="form-group">
                  <label for="descripcion">Descripcion</label>
                  <input type="text" name="descripcion" class="form-control" required value="<?php print $row["descripcion"]; ?>">
                </div>
                <div class="form-group">
                  <label for="precio">Precio</label>
                  <input type="text" name="precio" class="form-control" required value="<?php print number_format($row["precio"], 2, ".", ",")?> €">
                  
                </div>
                <div class="form-group">
                  <label for="existencias">Existencias</label>
                  <input type="text" name="existencias" class="form-control" required value="<?php print $row["existencias"]; ?>">
                </div>
                <div class="form-group">
                  <button type="submit" name="actualizar" class="btn btn-primary">Actualizar</button>
                  <a class="btn btn-warning" href="panel.php?modulo=productos" role="button">Cancelar</a>
                </div>
        </form> 
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
    <div class="card-body">
    
    <div class="row">
                  <?php
                  $query = "SELECT * FROM fotos WHERE idproducto=" . $row["id"];
                  $resultset = mysqli_query($conexion, $query);
                  while ($row = mysqli_fetch_assoc($resultset)) {
                  ?>
                    <div class="card col-12 col-md-6 col-lg-4 mx-2">
                      <img class="card-img-top img-thumbnail" src="img/<?php print $row["nombre"] ?>" alt="">
                      <div class="card-body">
                        <h4 class="card-title mr-2"><?php print $row["nombre"] ?></h4>
                        <a href="panel.php?modulo=eliminarfoto&id=<?php print $row["id"]?>"><i class="fas fa-trash"></i></a>
                      </div>
                    </div>
                  <?php } ?>
                </div>
             
                <div class="form-group">
                <a href="panel.php?modulo=subirfoto&id=<?php print $id?>"><button  class="btn btn-primary">Añadir Imagen</button></a>
                </div>
            </div>

  </section>
  <!-- /.content -->
</div>