<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 g-3 card-grid">
  <?php
  include_once "../db_ecommerce.php";
  $conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_database);
  if ($conexion->connect_errno) {
    die("<p>Error de conexión Nº: $conexion->connect_errno - $conexion->connect_error</p>\n</body>\n</html>");
  }
  //AÑADIR A LA CONSULTA LA BUSQUEDA POR NOMBRE
  $where = "";
  if (isset($_REQUEST["nombreproducto"])) {
    $where = " and productos.nombre like \"%$_REQUEST[nombreproducto]%\" ";
  }

  //INICIALIZAR EL PAGINADOR
  $querycuenta = "SELECT COUNT(*) AS cuenta FROM productos WHERE 1=1 $where";
  $resultsetcuenta = mysqli_query($conexion, $querycuenta);
  $row = mysqli_fetch_assoc($resultsetcuenta);
  $totalregistros = $row["cuenta"];

  $elementosporpagina = 3;
  $totalpaginas = ceil($totalregistros/$elementosporpagina);
  $paginasel = $_REQUEST["pagina"]??false;

  if ($paginasel == false)
  {
    $iniciolimite = 0;
    $paginasel = 1;
  }
  else
  {
    $iniciolimite = ($paginasel-1) * $elementosporpagina;
  }

  $limite = " LIMIT $iniciolimite, $elementosporpagina";

  //CONSULTA PARA MOSTRAR LOS PRODUCTOS
  $query = "SELECT productos.id, productos.nombre AS nombreproducto, productos.precio, productos.existencias, fotos.nombre AS nombrefoto  
  FROM productos INNER JOIN fotos 
  WHERE productos.id = fotos.idproducto " . $where .
  " GROUP BY productos.id " . $limite;
  $resultset = mysqli_query($conexion, $query);
  if ($resultset) {
    while ($row = mysqli_fetch_assoc($resultset)) {
  ?>
      <!-- MOSTRAMOS LOS PRODUCTOS -->
      <div class="col my-2">
        <div class="card h-100 my-2">
          <div class="card-body">
            <img class="card-img-top" src="../img/<?php print $row["nombrefoto"] ?>" alt="">
          </div>
          <div class="card-footer">
            <h4 class="card-title"><?php print $row["nombreproducto"] ?></h4>
            <p class="card-text">Precio: <?php print number_format($row["precio"], 2, ",", ".") ?> €</p>
            <p class="card-text"><?php print(($row["existencias"] == 0) ? "No disponible" : "Disponible") ?></p>
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
<?php if ($totalpaginas > 1){ ?>
<nav aria-label="..." class="mt-2">
  <ul class="pagination">

    <li class="page-item <?php print (($paginasel == 1)?" disabled":"") ?>">
    <a class="page-link" href="index.php?modulo=productos&pagina=1&nombreproducto=">Inicio</a>
    </li>
    <?php 
    global $i;
    for ($i=1; $i<=$totalpaginas; $i++){ ?>
    
    
      
      <li class="page-item <?php print (($paginasel == $i)?"active":"") ?>"><a class="page-link" href="<?php print "index.php?modulo=productos&pagina=$i&nombreproducto=" . ($_REQUEST["nombreproducto"]??"") ?>"><?php print $i ?></a></li>
      
    <?php } ?>
    <li class="page-item <?php print (($paginasel == $totalpaginas)?" disabled":"") ?>">
    <a class="page-link" href="index.php?modulo=productos&pagina= <?php print "$totalpaginas"?>&nombreproducto=">Última</a>
    </li>
  </ul>
  <p class="page-item text-primary"> Mostrando <?php print $elementosporpagina ?> productos de un total de <?php print $totalregistros ?> repartidos en <?php print$totalpaginas ?> páginas</p> 
   
</nav>
<?php } ?>