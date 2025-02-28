<?php
//COMPROBAR SI HEMOS PULSADO PAGAR
if (isset($_REQUEST["pagar"])) { //COMPROBAR SI HAY UNA SESIÓN DE CLIENTE ACTIVA
  if (isset($_SESSION["nombre"])) { //MANDAMOS A LA PASARELA LOS DATOS DEL PAGO
    $pasarela = new pasarela();
    $pasarela->cobrar($_REQUEST["total"], $_REQUEST["tarjeta"], "cod-4563");
    if ($pasarela->codoperacion == "ERROR") {
      print "<meta http-equiv=\"refresh\" content=\"0; url=index.php?modulo=detallecarrito&mensaje=El pago ha fallado, utilice otra tarjeta\" />  ";
    }
    else
    {//El pago está confirmado y guardamos la compra
      $total = $_REQUEST["total"];
      $formadepago = $_REQUEST["formadepago"];
      print "<meta http-equiv=\"refresh\" content=\"0; url=index.php?modulo=confirmacioncompra&totalcompra=$total&formadepago=$formadepago&codoperacion=$pasarela->codoperacion\" />  ";
    }
  } 
  else {
   
    print "<meta http-equiv=\"refresh\" content=\"0; url=index.php?modulo=iniciosesion&mensaje=Debe iniciar sesión antes de terminar la compra\" />  ";
  }
}

if (isset($_REQUEST["incrementar"])) {
  $carrito->agregarproducto($_REQUEST["incrementar"], "", "", "", 1);
  print "<meta http-equiv=\"refresh\" content=\"0; url=index.php?modulo=detallecarrito\" />  ";
  //print "<script>window.location.href='index.php?modulo=detallecarrito</script>";
}
if (isset($_REQUEST["decrementar"])) {
  $carrito->agregarproducto($_REQUEST["decrementar"], "", "", "", -1);
  print "<meta http-equiv=\"refresh\" content=\"0; url=index.php?modulo=detallecarrito\" />  ";
  //print "<script>window.location.href='index.php?modulo=detallecarrito</script>";
}
if (isset($_REQUEST["eliminarproducto"])) {
  $carrito->eliminarproducto($_REQUEST["eliminarproducto"]);
  print "<meta http-equiv=\"refresh\" content=\"0; url=index.php?modulo=detallecarrito\" />  ";
  //print "<script>window.location.href='index.php?modulo=detallecarrito</script>";
}
?>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          
          <div class="card-header">
          <?php
          if (isset($_REQUEST["mensaje"])) { ?>
            <div class="alert alert-danger alert-dismissible fade show float-right" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <strong><?php print $_REQUEST["mensaje"] ?></strong>
            </div>
          <?php } ?>
            <h1 class="card-title"><i class="fas fa-cart-plus    "></i> Detalle del carrito</h1>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="tablacarrito" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Foto</th>
                  <th>Nombre</th>
                  <th>Precio</th>
                  <th>Cantidad</th>
                  <th>Total</th>
                  <th>Acciones <a href="panel.php?modulo=crearproducto"><i class="bi bi-bag-plus-fill ml-2"></i></a></th>
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
                    <td class="text-center"> <a class="btn btn-primary mr-2" href="index.php?modulo=detallecarrito&incrementar=<?php print $indice ?>">+</a> <?php print $producto["cantidad"] ?> <a class="btn btn-danger ml-2" href="index.php?modulo=detallecarrito&decrementar=<?php print $indice ?>">-</a></td>
                    <td class="text-right"><?php print number_format($producto["precio"] * $producto["cantidad"], 2, ",", ".") ?> €</td>
                    <td class="text-center"><a href="index.php?modulo=detalleproducto&id=<?php print $indice ?>" class="mr-2" title="Ver detalles"><i class="fas fa-eye    "></i></a> <a href="index.php?modulo=detallecarrito&eliminarproducto=<?php print $indice ?>" class="text-danger" title="Eliminar del carrito"><i class="fas fa-trash    "></i></a></td>
                  </tr>
                <?php } ?>
              </tbody>
              <tfoot>
                <tr>
                  <th colspan=4 class="text-right">Total</th>
                  <th class="text-right"><?php print number_format($total, 2, ",", ".") ?> €</th>
                  <th><a href="index.php?modulo=productos&carrito=vaciar" class="dropdown-footer text-danger"><i class="fas fa-trash    "></i> Vaciar Carrito</a></th>
                </tr>
              </tfoot>
            </table>
            <input type="radio" name="check" id="check" value="1" onchange="javascript:showTarjeta();showTransferencia()" />  
<b>Pago con Transferencia </b><br>
<div id="pagotarjeta" style="display: none;">
<div class="container-fluid">
            <form action="index.php?modulo=detallecarrito&formadepago=transferencia" method="post">
            <input type="hidden" name="total" value="<?php print $total ?>">      
            <input type="hidden" name="tarjeta" value="0000000000000000">      

            <button name="pagar" type=submit class="btn btn-success">Finalizar pedido</button>
            </form>
           
          </div>
 </div>
<input type="radio" name="check" id="check2" value="1" onchange="javascript:showTransferencia();javascript:showTarjeta()" />  
<b>Pago con Tarjeta</b><br>
 <div id="pagotransferencia" style="display: none;">
 <form action="index.php?modulo=detallecarrito&formadepago=tarjeta" method="post">
                <div class="form-group col-6">
                <input type="hidden" name="total" value="<?php print $total ?>">      
                <label for="tarjeta">Nº tarjeta</label>
                <input type="text" name="tarjeta" class="form-control" placeholder="" aria-describedby="helpId">
                <small id="helpId" class="text-muted">Intoduzca los datos de su tarjeta</small>
                </div>
              <button name="pagar" type=submit class="btn btn-success">pagar</button>
            </form>
 </div>
 <script type="text/javascript">
    function showTarjeta() {
        element = document.getElementById("pagotarjeta");
        
        check = document.getElementById("check");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }
    
    function showTransferencia() {
        element = document.getElementById("pagotransferencia");  
        check = document.getElementById("check2");
        if (check2.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }

</script>
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





