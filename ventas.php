<?php
  include_once "db_ecommerce.php";
  $conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_database);
  if ($conexion->connect_errno) 
  {
    die("<p>Error de conexión Nº: $conexion->connect_errno - $conexion->connect_error</p>\n</body>\n</html>");
  }

  if (isset($_REQUEST["id"]))
  {
    $query = "SELECT ventas.id, ventas.fecha, ventas.codoperacion, ventas.formadepago, clientes.nombre, clientes.apellido, clientes.email, clientes.id as idcliente FROM ventas INNER JOIN clientes WHERE idcliente = $_REQUEST[id] and ventas.idcliente = clientes.id";
    $resultset = mysqli_query($conexion, $query);
  
    
  }
  else
  {
    $query = "SELECT ventas.id, ventas.fecha, ventas.codoperacion, ventas.formadepago, clientes.nombre, clientes.apellido, clientes.email, clientes.id as idcliente FROM ventas INNER JOIN clientes WHERE ventas.idcliente = clientes.id";
    $resultset = mysqli_query($conexion, $query);

    
  }
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="bi bi-cart-fill nav-icon"></i> Ventas</h1>
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
            <?php 
            if (isset($_REQUEST["id"])){
              $row = mysqli_fetch_assoc($resultset);

              print "Listado de ventas de $row[nombre]";
              } 
            else{ ?>
                <h3 class="card-title">Ventas del ecommerce</h3>
                <?php }  ?>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tablaventas" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Fecha</th>
                      <th>Código de operación</th>
                      <th>Nombre</th>
                      <th>Apellidos</th>
                      <th>Email</th>
                      <th>Forma de pago</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $resultset = mysqli_query($conexion, $query);
                    while ($row = mysqli_fetch_assoc($resultset)) {
                    ?>
                      <tr>
                        <td><a href="panel.php?modulo=detalleventa&id=<?php print $row["id"] ?>" class="text-primary"><i class="fas fa-eye    "></i></a><a href="panel.php?modulo=ventas&id=<?php print $row["idcliente"] ?>" class="text-primary">     <i class="bi bi-file-person"></i></a></td>
                        <td><?php print $row["fecha"] ?></td>
                        <td><?php print $row["codoperacion"] ?></td>
                        <td><?php print $row["nombre"] ?> </td>
                        <td><?php print $row["apellido"] ?> </td>
                        <td><?php print $row["email"] ?> </td>
                        <td><?php print $row["formadepago"] ?> </td>

                      </tr>
                    <?php } ?>
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