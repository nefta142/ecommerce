
    <?php 
    if (isset ($_REQUEST["msg" ])){
        $msg = $_REQUEST["msg" ];
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><h3>'.$msg.'</h3>';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';

    } 
    ?>

    </div>   
</div>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="fas fa-user    "></i> Usuarios</h1>
            <script>
              $(".alert").alert();
            </script>
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
                <h3 class="card-title">Control de usuarios del ecommerce</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tablausuarios" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Email</th>
                      <th>Tipo</th>
                      <th>Acciones <a href="panel.php?modulo=crearusuario"> <i class="fas fa-plus ml-2"></i></a></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    include_once "db_ecommerce.php";
                    $conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_database);
                    if ($conexion->connect_errno) {
                      die("<p>Error de conexión Nº: $conexion->connect_errno - $conexion->connect_error</p>\n</body>\n</html>");
                    }
                    $query = "select * from usuarios";
                    $resultset = mysqli_query($conexion, $query);

                    if ($conexion->errno) {
                      die("<p>Error en la consulta - $conexion->error </p>\n</body>\n</html>");
                    }

                    while ($row = mysqli_fetch_assoc($resultset)) {
                    ?>
                      <tr>
                        <td><?php print $row["nombre"] ?></td>
                        <td><?php print $row["email"] ?></td>
                        <td><?php print $row["tipo"] ?></td>
                        <td>
                          <a href="panel.php?modulo=editarusuario&id=<?php print $row["id"] ?>"><i class="fas fa-edit mr-2"></i></a> <a href="panel.php?modulo=eliminarusuario&id=<?php print $row["id"] ?>"> <i class="fas fa-trash"></i></a></td>
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