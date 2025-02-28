<?php
include_once "db_ecommerce.php";
$conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_database);
if ($conexion->connect_errno) {
  die("<p>Error de conexión Nº: $conexion->connect_errno - $conexion->connect_error</p>\n</body>\n</html>");
}
$query = "SELECT * FROM clientes INNER JOIN ventas WHERE clientes.id = ventas.idcliente and ventas.id = $_REQUEST[id]";
$resultset = mysqli_query($conexion, $query);
$row = mysqli_fetch_assoc($resultset);
$formadepago = $row["formadepago"];
$query = "SELECT productos.nombre, fotos.nombre as nombrefoto, detalleventas.cantidad, detalleventas.precio, detalleventas.subtotal, ventas.formadepago
FROM detalleventas INNER JOIN ventas INNER JOIN productos INNER JOIN fotos 
WHERE detalleventas.idventa = ventas.id and detalleventas.idproducto = productos.id and productos.id = fotos.idproducto and ventas.id = $_REQUEST[id]
GROUP BY productos.id";
$resultset = mysqli_query($conexion, $query);

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><i class="bi bi-cart-fill nav-icon"></i> Detalle Venta</h1>
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
              <h3 class="card-title">Detalle de Venta del ecommerce</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <ul class="list-group">
                    <li class="list-group-item active" aria-current="true">Datos del cliente</li>
                    <li class="list-group-item">Nombre: <?php print $row["nombre"] ?></li>
                    <li class="list-group-item">Email: <?php print $row["email"] ?></li>
                    <li class="list-group-item">DNI: <?php print $row["dni"] ?></li>
                    <li class="list-group-item">Dirección: <?php print $row["direccion"] ?></li>
                  </ul>
                  <ul class="list-group">
                    <li class="list-group-item active" aria-current="true">Datos de la venta</li>
                    <li class="list-group-item">Fecha: <?php print $row["fecha"] ?></li>
                    <li class="list-group-item">Código de operación: <?php print $row["codoperacion"] ?></li>
                  </ul>
                </div>
              </div>
              <table  class="table table-bordered table-hover col-4">
                  <tr>
                  <?php 
                  $total = 0;
                  while ($row = mysqli_fetch_assoc($resultset)) 
                  {
                    $total += $row["subtotal"];
                  } 
                  ?>
                 
                    <th colspan=4 class="text-right">Total: </th>
                    <th class="text-right"><?php print number_format($total, 2, ",", "."); ?> €</th>
                  </tr>
                  <tr>
                    <th colspan=4 class="text-right">Forma de pago: </th>
                    <th class="text-right"><?php print $formadepago ?></th>
                  </tr>
              </table>

              <table id="tabladetalleventa" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $resultset = mysqli_query($conexion, $query);
                  $total = 0;
                  while ($row = mysqli_fetch_assoc($resultset)) 
                  {
                    $total += $row["subtotal"];
                  ?>
                    <tr>
                      <td><img class="img-thumbnail" width=50 src="./img/<?php print $row["nombrefoto"] ?>" alt=""></td>
                      <td><?php print $row["nombre"] ?></td>
                      <td class="text-right"><?php print number_format($row["precio"], 2, ",", ".") ?> €</td>
                      <td class="text-right"><?php print $row["cantidad"] ?> </td>
                      <td class="text-right"><?php print number_format($row["subtotal"], 2, ",", ".") ?> €</td>
                    </tr>
                  <?php } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th colspan=4 class="text-right">Total: </th>
                    <th class="text-right"><?php print number_format($total, 2, ",", "."); ?> €</th>
                  </tr>
                  <tr>
                    <th colspan=4 class="text-right">Forma de pago: </th>
                    <th class="text-right"><?php print $formadepago ?></th>
                  </tr>
                </tfoot>
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