<!DOCTYPE html>
<html lang="es">



<?php
//Para que funcione el carrito como objeto en la sesión tenemos que incluir la definición del objeto antes de abrir la sesión
include_once "../db_ecommerce.php";
//Iniciamos la sesión y comprobamos que el usuario se ha identificado
session_start();
session_regenerate_id();

$borrarcarrito = false;

if (isset($_REQUEST["carrito"]) && $_REQUEST["carrito"] == "vaciar") {
  $borrarcarrito = true;
}

$carrito = new carrito();
if (isset($_SESSION["carrito"]) && !$borrarcarrito) {
  $idproducto = $_REQUEST["id"]; 
  $carrito = $_SESSION["carrito"];
} else {
  $_SESSION["carrito"] = $carrito;
}

$modulo = $_REQUEST["modulo"] ?? "productos";
?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mi E-commerce</title>
  <meta name="keywords" content="practicas, IFCD0210" />
  <meta name="author" content="Constantino Lantigua" />
  <meta name="description" content="ejercicio de clase"/>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini">
  <div class="container">
    <div class="col-12">
      <!-- Navbar -->
      <nav class="navbar navbar-expand navbar-dark navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="index.php" class="nav-link">Inicio</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="../index2.php" class="nav-link">Administradores</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="./index.php?modulo=crearcontacto" class="nav-link">Contacto</a>
          </li>
          <?php
          //Comprobamos si hay que cerrar la sesión
          if (isset($_REQUEST["sesion"]) && $_REQUEST["sesion"] == "cerrar") {
            session_destroy();
            header("location: ./index.php");
          }

          //comprobamos que es una sesion valida
          if (isset($_SESSION["id"]) == false) { ?>
            <li class="nav-item d-none d-sm-inline-block">
              <a href="index.php?modulo=iniciosesion" class="nav-link">Iniciar Sesión</a>
            </li>
          <?php } else { ?>
            <li class="nav-item d-none d-sm-inline-block">
               
              <a href="index.php?modulo=perfil&id=<?php print "$_SESSION[id]" ?>"class="nav-link"><?php print "$_SESSION[nombre] $_SESSION[apellidos]" ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-danger" data-toggle="tooltip" data-placement="top" title="Cerrar sesión" href="index.php?modulo=&sesion=cerrar"><i class="fas fa-door-closed"></i></a>
            </li>
          <?php } ?>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">

          <!-- FORMULARIO DE BÚSQUEDA -->
          <form class="form-inline ml-3" action="index.php">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar bg-gray" type="search" placeholder="Buscar producto" aria-label="Search" name="nombreproducto" value="<?php print $_REQUEST["nombreproducto"] ?? "" ?>">
              <input type="hidden" name="modulo" value="productos">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Carrito Dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="fas fa-shopping-cart    "></i>
              <span class="badge badge-danger navbar-badge"><?php print $carrito->numeroproductos; ?></span>
            </a>
            <?php if ($carrito->numeroproductos != 0) { ?>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                  <!-- Message Start -->
                  <?php foreach ($carrito->productos as $indice => $producto) { 
                   
                    ?>
                    <div class="media">
                      
                      <img src="../img/<?php print $producto["foto"]; ?>" alt="User Avatar" class="img-size-50 mr-3">
                      <div class="media-body">
                        <h3 class="dropdown-item-title">
                          <?php print $producto["nombre"]; ?>
                        </h3>
                        <p class="text-sm">Precio: <?php print number_format($producto["precio"], "2", ",", "."); ?> €</p>
                        <p class="text-sm">Cantidad: <?php print $producto["cantidad"]; ?></p>
                        <p class="text-sm">Total: <?php print number_format($producto["cantidad"] * $producto["precio"], "2", ",", "."); ?> €</p>
                        
                        <p class="text-sm"><a href="index.php?modulo=detalleproducto&id=<?php print $indice; ?>" class="mr-2" title="Ver detalles"><i class="fas fa-eye    "></i></a></p>  
                      </div>
                    </div>
                  <?php } ?>
                  <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="index.php?modulo=productos&carrito=vaciar" class="dropdown-footer text-danger"><i class="fas fa-trash    "></i> Vaciar Carrito</a>
                <div class="dropdown-divider"></div>
                <a href="index.php?modulo=detallecarrito" class="dropdown-footer text-primary"><i class="fas fa-eye"></i> Ver carrito</a>
              </div>
    </div>
  <?php } ?>
  </li>
  </ul>
  </nav>
  <?php

if (isset($_REQUEST["mensaje"]))

{?>

  <!-- <div class="alert alert-success alert-dismissible fade show float-right" role="alert">-->
  <div class="col-12 alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"
      <span aria-hidden="true">&times;</span>
    </button>
    <strong><?php print $_REQUEST["mensaje"] ?></strong> 
  </div>
  <script>
    $(".alert").alert();
  </script>
<?php } ?>

  <!-- Contenido -->
  <?php
  if ($modulo == "productos") include_once "productos.php";
  if ($modulo == "detalleproducto") include_once "detalleproducto.php";
  if ($modulo == "iniciosesion") include_once "iniciosesion.php";
  if ($modulo == "registrocliente") include_once "registrocliente.php";
  if ($modulo == "detallecarrito") include_once "detallecarrito.php";
  if ($modulo == "confirmacioncompra") include_once "confirmacioncompra.php";
  if ($modulo == "crearcontacto") include_once "crearcontacto.php";
  if ($modulo == "actualizar") include_once "perfil.php";
  if ($modulo == "perfil") include_once "perfil2.php";
  ?>
  </div>
  </div>
  <!-- /.navbar -->

  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <!-- <script src="../dist/js/demo.js"></script> -->
  <script>
    $(document).ready(function() {
      $('.product-image-thumb').on('click', function() {
        var $image_element = $(this).find('img')
        $('.product-image').prop('src', $image_element.attr('src'))
        $('.product-image-thumb.active').removeClass('active')
        $(this).addClass('active')
      })
    })
  </script>
  <!-- DataTables  & Plugins -->
  <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../plugins/jszip/jszip.min.js"></script>
  <script src="../plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../plugins/pdfmake/vfs_fonts.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- Declaración de los DATATABLE -->
  <script>
    $(function() {
      $('#tablacarrito').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>

</body>

</html>