<?php
include_once"../db_ecommerce.php"; 
$conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_database);
if ($conexion->connect_errno) {
  die("<p>Error de conexión Nº: $conexion->connect_errno - $conexion->connect_error</p>\n</body>\n</html>");
}
//SANITIZAMOS LOS DATOS DEL FORMULARIO

$idcliente = $_SESSION["id"];
$fecha = date("Y-m-d H:i:s");
$codoperacion = $_REQUEST["codoperacion"];
$totalcompra =  $_REQUEST["totalcompra"];
$formadepago = $_REQUEST["formadepago"];

//GUARDAMOS LA VENTA PARA PODER ACCEDER AL ID DE LA VENTA Y ASIGNARLO A LOS DATALLES DE VENTA
$query = "INSERT INTO ventas (`idcliente`, fecha, codoperacion,total,formadepago ) VALUES (\"$idcliente\", \"$fecha\", \"$codoperacion\", \"$totalcompra\",\"$formadepago\" )";
$resultset = mysqli_query($conexion, $query);
if ($conexion->errno) {
  print "<br>" ;
  print "<br>" ;
  print "<br>" ;
  print  "$query";
  print "<br>" ;
  print "<br>" ;
  print "<br>" ;
  print  "<h1>El usuario que está usando es administrador y  necesita logearse como  cliente para formalizar una compra.!!!</h1>";
  print "<br>" ;
  print "<br>" ;
  print "<br>" ;
  die("<p>Error de conexión Nº: $conexion->errno - $conexion->error</p>\n</body>\n</html>");
}

if ($resultset) {
  $idventa = $conexion->insert_id;

  foreach ($carrito->productos as $idproducto => $producto) {
    $cantidad = $producto["cantidad"];
    $precio = $producto["precio"];
    $subtotal = $cantidad * $precio;

    $query = "INSERT INTO detalleventas (idproducto, idventa, cantidad, precio, subtotal) VALUES (\"$idproducto\", \"$idventa\", \"$cantidad\", \"$precio\", \"$subtotal\");";
    $resultset = mysqli_query($conexion, $query);
  }
}
?>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">

          <div class="card-header">
            <?php if ($formadepago == "transferencia"){?>
              <h1 class="card-title"><i class="fas fa-file-invoice    "></i> Confirmacion pendiente de la recepción de la transferencia.</h1>           
            <?php
            } 
            else{?>
              <h1 class="card-title"><i class="fas fa-file-invoice    "></i> Pago realizado con éxito</h1>  
            <?php 
            
            } 
            ?>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <h1><i class="fas fa-user    "></i> Datos de facturación</h1>
          <table id="tablacliente" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Apellidos</th>
                  <th>Email</th>
                  <th>DNI</th>
                  <th>Dirección</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $query = "SELECT * FROM clientes WHERE id=$idcliente";
                  $resultset = mysqli_query($conexion, $query);
                  $row = mysqli_fetch_assoc($resultset);
                ?>
                <tr>
                  <td><?php print $row["nombre"]; ?></td>
                  <td><?php print $row["apellido"]; ?></td>
                  <td><?php print $row["email"]; ?></td>
                  <td><?php print $row["dni"]; ?></td>
                  <td><?php print $row["direccion"]; ?></td>
                </tr>
              </tbody>
            </table>
            <h1 class="mt-2"><i class="fas fa-file-invoice    "></i> Detalles de la compra</h1>
            <table id="tablacompra" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Foto</th>
                  <th>Nombre</th>
                  <th>Precio</th>
                  <th>Cantidad</th>
                  <th>Total</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $total = 0;
                foreach ($carrito->productos as $indice => $producto) {
                  $total += $producto["precio"] * $producto["cantidad"];
                ?>
                  <tr>
                    <td class="text-center"><img src="../img/<?php print $producto["foto"] ?>" alt="" class="img-thumbnail" width=50></td>
                    <td><?php print $producto["nombre"] ?></td>
                    <td class="text-right"><?php print number_format($producto["precio"], 2, ",", ".") ?> €</td>
                    <td class="text-center"> <?php print $producto["cantidad"] ?></td>
                    <td class="text-right"><?php print number_format($producto["precio"] * $producto["cantidad"], 2, ",", ".") ?> €</td>
                    <td class="text-center"><a href="index.php?modulo=detalleproducto&id=<?php print $indice ?>" class="mr-2" title="Ver detalles"><i class="fas fa-eye    "></i></a></td>
                  </tr>
                <?php } ?>
              </tbody>
              <tfoot>
                <tr>
                  <th colspan=4 class="text-right">Total</th>
                  <th class="text-right"><?php print number_format($total, 2, ",", ".") ?> €</th>
                  <th></th>
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



