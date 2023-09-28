
<?php
  if (isset($_REQUEST["mensaje"]))
  {?>
    <div class="alert alert-success alert-dismissible fade show float-right" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <strong><?php print $_REQUEST["mensaje"] ?></strong> 
    </div>
    
    <script>
      $(".alert").alert();
    </script>
  <?php } ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="bi bi-bag-fill nav-icon"></i> Productos</h1>
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
                <h3 class="card-title">Control de productos del ecommerce</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tablaproductos" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Descripción</th>
                      <th>Precio</th>
                      <th>Existencias</th>
                      <th>Imagen</th>
                      <th>Acciones <a href="panel.php?modulo=crearproductos"> <i class="fas fa-plus ml-2"></i></a></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    include_once "db_connect.php";
                    $conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_database);
                    if ($conexion->connect_errno) {
                      die("<p>Error de conexión Nº: $conexion->connect_errno - $conexion->connect_error</p>\n</body>\n</html>");
                    }
                    $query = "SELECT id, nombre, descripcion, precio, existencias, imagen FROM productos";
                    $resultset = mysqli_query($conexion, $query);


                    if ($conexion->errno) {
                      die("<p>Error en la consulta - $conexion->error </p>\n</body>\n</html>");
                    }

                    while ($row = mysqli_fetch_assoc($resultset)) {
                    ?>
                      <tr>
                      <?php $id =$row["id"];
                            $foto =$row["imagen"];?>
                        <td><?php print $row["nombre"] ?></td>
                        <td><?php print $row["descripcion"] ?></td>
                        <td style="text-align: end;"><?php print number_format($row["precio"], 2, ".", ",")?> €</td>
                        <td style="text-align: end;"><?php print $row["existencias"] ?></td>
                       
                        <td style="text-align: center;"><a href="panel.php?modulo=subirfoto&id=<?php print $row["id"] ?>"><img src="./img/<?php print $row["imagen"] ?>" width="50px" height="50px" ></a></td>                        
                        <td>
                          <a href="panel.php?modulo=editarproducto&id=<?php print $id ?>"><i class="fas fa-edit mr-2"></i></a> 
                          <?php if($_SESSION["tipo"]=="administrador")  {  ?>
                          <a href="panel.php?modulo=eliminarproducto&id=<?php print $row["id"] ?>"> <i class="fas fa-trash"></i></a>
                          <?php  } ?>
                        </td>
                        
                      </tr>
                    <?php
                    }

                    ?>
                  </tbody>
                </table>
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
  

  