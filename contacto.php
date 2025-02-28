
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
            <h1><i class="fa-solid fa-envelopes-bulk"></i> Contactos</h1>
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
                <h3 class="card-title">Control de mensajería del ecommerce</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tablaclientes" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>Nombre</th>
                      <th>Email</th>
                      <th>Mensaje</th>
                      <th>Fecha y Hora  </th>
                      <?php if($_SESSION["tipo"]=="administrador")  {  ?>
                      <th>
                        Acciones
                     </th>
                      <?php  } ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    include_once "db_ecommerce.php";
                    $conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_database);
                    if ($conexion->connect_errno) {
                      die("<p>Error de conexión Nº: $conexion->connect_errno - $conexion->connect_error</p>\n</body>\n</html>");
                    }
                    $query = "select * from contacto";
                    $resultset = mysqli_query($conexion, $query);

                    if ($conexion->errno) {
                      die("<p>Error en la consulta - $conexion->error </p>\n</body>\n</html>");
                    }

                    while ($row = mysqli_fetch_assoc($resultset)) {
                    ?>
                      <tr>
                        <td><?php print $row["id"] ?></td>
                        <td><?php print $row["nombre"] ?></td>
                        <td><?php print $row["email"] ?></td>
                        <td><?php print $row["mensaje"] ?></td>
                        <td><?php print $row["fecha"] ?></td>
                        <?php if($_SESSION["tipo"]=="administrador")  {  ?>
                        <td>
                          <a href="panel.php?modulo=editarcontacto&id=<?php print $row["id"] ?>"><i class="fas fa-edit mr-2"></i></a>
                          <a href="panel.php?modulo=eliminarcontacto&id=<?php print $row["id"] ?>"> <i class="fas fa-trash"></i></a>
                        </td>
                        <?php  } ?>
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