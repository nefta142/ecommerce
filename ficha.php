
<?php 
    include_once "db_ecommerce.php";
    $conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_database);
    if ($conexion->connect_errno) {
      die("<p>Error de conexión Nº: $conexion->connect_errno - $conexion->connect_error</p>\n</body>\n</html>");
    }
   

    if ($conexion->errno) {
      die("<p>Error en la consulta - $conexion->error </p>\n</body>\n</html>");
    }
   
                if (isset($_REQUEST["id"])) {
                    $id = sanitizar($conexion, $_REQUEST["id"]);  
                    include_once "db_ecommerce.php";
                    $conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_database);
                    if ($conexion->connect_errno) {
                    die("<p>Error de conexión Nº: $conexion->connect_errno - $conexion->connect_error</p>\n</body>\n</html>");
                    }
                    $query = "SELECT id, nombre, descripcion, precio, existencias, imagen FROM productos where id like $id";
                    $resultset = mysqli_query($conexion, $query);
                    $row = mysqli_fetch_assoc($resultset);
                }
                ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="bi bi-bag-fill nav-icon"></i>Gestor de Productos</h1>
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
              <p style="text-align: end;"><a href="panel.php?modulo=productos"><i class="bi bi-file-excel-fill"></i></a></p>
                <h1 class="card-title">Ficha producto</h1>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="row mt-3 mb-3 gx-0" style="flex-wrap: wrap-reverse;">
        
        <div class="col-12 sticky-sm-top col-lg-8  fs-4" style="padding: 0px 2% 0px;  ">
        <p><h1>Producto: <?php print $row["nombre"] ?></h1></p>
                    <p><h3>Descripción: <?php print $row["descripcion"] ?></h3></p>
                    <p style="text-align: end;">Precio: <?php print number_format($row["precio"], 2, ".", ",")?> €</p>
                    <p style="text-align: end;">Existencias: <?php print $row["existencias"] ?></p>
            
    </div> 
    <div class="col-12 col-lg-4 bg-image" >
    <img src="./img/<?php print $row["imagen"] ?>" width="100%" height="100%"></a></p>
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

  