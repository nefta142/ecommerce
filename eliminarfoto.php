<?php
include_once "db_connect.php";
$conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_database);
if ($conexion->connect_errno) {
  die("<p>Error de conexión Nº: $conexion->connect_errno - $conexion->connect_error</p>\n</body>\n</html>");
}
if (isset($_REQUEST["modo"])){
  $id = sanitizar($conexion, $_REQUEST["id"]);
  $querytem = "SELECT * FROM fotos WHERE id LIKE $id";
  $resultsettem = mysqli_query($conexion, $querytem);
  $row = mysqli_fetch_assoc($resultsettem);
  $nomfoto = $row["nombre"];
  unlink(".img/".$nomfoto);
  $query = "DELETE FROM fotos WHERE id LIKE $id";
  $resultset = mysqli_query($conexion, $query);
  

}
else{
$id = sanitizar($conexion, $_REQUEST["id"]);
$query = "SELECT * FROM fotos WHERE id lIKE $id ";
$resultset = mysqli_query($conexion, $query);
$row = mysqli_fetch_assoc($resultset);
if ($conexion->connect_errno) {
  die("<p>Error de conexión Nº: $conexion->connect_errno - $conexion->connect_error</p>\n</body>\n</html>");
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
            <h1><i class="fas fa-user-plus"></i> Eliminar Imagen</h1>
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
                <h3 class="card-title"></h3>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <!-- <h1>Eliminar foto</h1> -->
                <div class="col-6">
                <img class="card-img-top img-thumbnail" src="img/<?php print $row["nombre"] ?>" alt="">
                </div>
                <div class="col-6 ">
                  <div class="row">
                    <div class="col-1 container-fluid"> <a  href="panel.php?modulo=eliminarfoto&id=<?php print $row["id"] ?>&modo=definitivo"><button class="btn-danger">eliminar</button></a></div>
                    <div class="col-1 container-fluid"> <a  href="panel.php?modulo=productos_admin"><button class="btn-warning">cancelar</button></a></div>
                  </div>
                </div>
               
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