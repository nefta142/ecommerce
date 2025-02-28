<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 card-grid">
  <?php
  include_once "../db_ecommerce.php";
  $conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_database);
  if ($conexion->connect_errno) {
    die("<p>Error de conexión Nº: $conexion->connect_errno - $conexion->connect_error</p>\n</body>\n</html>");
  }
  //AÑADIR A LA CONSULTA LA BUSQUEDA POR NOMBRE
  $where = "";
  if (isset($_REQUEST["nombre"])) {
    $where = " and productos.nombre like \"%$_REQUEST[nombre]%\" ";
  }

  $query = "SELECT productos.id, productos.nombre AS nombreproducto, productos.precio, productos.existencias, fotos.nombre AS nombrefoto  
                  FROM productos INNER JOIN fotos 
                  WHERE productos.id = fotos.idProducto " . $where .
    " GROUP BY productos.id";
  $resultset = mysqli_query($conexion, $query);
  if ($resultset) {
    while ($row = mysqli_fetch_assoc($resultset)) {
  ?>
      <!-- MOSTRAMOS LOS PRODUCTOS -->
      <div class="col">
        <div class="card h-100 my-2">
          <div class="card-body">
            <img class="card-img-top" src="../img/<?php print $row["nombrefoto"] ?>" alt="">
          </div>
          <div class="card-footer">
            <h4 class="card-title"><?php print $row["nombreproducto"] ?></h4>
            <p class="card-text">Precio: <?php print number_format($row["precio"], 2, ",", ".") ?> €</p>
            <p class="card-text">
            <?php 
              if ($row["existencias"] >=1 )
              {
                ?>
              <small>Disponible</small>
              <?php 
              }
              else  { ?>
              <small>No disponible</small>
              <?php } ?>
          </p>
            <a class="btn btn-primary" href="index.php?modulo=detalleproducto&id=<?php print $row["id"] ?>">Ver</a>
          </div>
        </div>
      </div>
    <?php
    }
  } else { ?>
    <div class="alert alert-danger float-right" role="alert">
      <strong>Atención! no se ha podido hacer la consulta <?php print mysqli_error($conexion) ?> </strong>
    </div>
  <?php } ?>

</div>