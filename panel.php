<!DOCTYPE html>
<html lang="es">
<?php
//Iniciamos la sesión y comprobamos que el usuario se ha identificado
session_start();
session_regenerate_id(true);
//Comprobamos si hay que cerrar la sesión
if (isset($_REQUEST["sesion"]) && $_REQUEST["sesion"] == "cerrar")
{
  session_destroy();
  header("location: index.php");
}
//Si no hay sesión de manda al login
if (isset($_SESSION["id"]) == false) {
  header("location: index.php");
}
//Comprobamos el módulo seleccionado o lo inicializamos vacío si venimos del login
if (isset($_REQUEST["modulo"])) {
  $modulo = $_REQUEST["modulo"];
} else {
  //Aplicamos el módulo por defecto
  $modulo = "perfil";
}

?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mi ecommerce</title>
  <meta name="keywords" content="practicas, IFCD0210" />
  <meta name="author" content="Constantino Lantigua" />
  <meta name="description" content="ejercicio de clase"/>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link text-primary" title="Editar perfil" href="panel.php?modulo=editarusuario&id=<?php print $_SESSION["id"] ?>"><i class="bi bi-person-fill"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-danger" title="Cerrar sesión" href="panel.php?modulo=&sesion=cerrar"><i class="fas fa-door-closed    "></i></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="./tienda/index.php" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Ver Tienda</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="info">
            <a href="#" class="d-block"> <?php print $_SESSION["nombre"]; ?> </a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
                <i class="bi bi-house-door-fill nav-icon"></i>
                <p>
                  Mi ecommerce
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="panel.php?modulo=estadisticas" class="nav-link <?php print ($modulo == "estadisticas") ? " active " : ""; ?> ">
                    <i class="bi bi-clipboard2-data-fill nav-icon"></i>
                    <p>Estadísticas</p>
                  </a>
                </li>
                <?php if($_SESSION["tipo"]=="administrador")  {  ?>
                <li class="nav-item">
                  <a href="panel.php?modulo=usuarios" class="nav-link <?php print ($modulo == "usuarios" || $modulo == "crearusuario" || $modulo == "editarusuario") ? " active " : ""; ?> ">
                    <i class="bi bi-person-fill nav-icon"></i>
                    <p>Usuarios</p>
                  </a>
                </li>
                <?php  } ?>
                <li class="nav-item">
                  <a href="panel.php?modulo=clientes" class="nav-link <?php print ($modulo == "clientes") ? " active " : ""; ?> ">
                    <i class="bi bi-person-fill nav-icon"></i>
                    <p>Clientes</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="panel.php?modulo=productos" class="nav-link <?php print ($modulo == "productos" || $modulo == "crearproducto" || $modulo == "editarproducto") ? " active " : ""; ?> ">
                    <i class="bi bi-bag-fill nav-icon"></i>
                    <p>Productos</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="panel.php?modulo=ventas" class="nav-link <?php print ($modulo == "ventas" || $modulo == "detalleventa") ? " active " : ""; ?> ">
                    <i class="bi bi-cart-fill nav-icon"></i>
                    <p>Ventas</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="panel.php?modulo=contacto" class="nav-link <?php print ($modulo == "contacto" || $modulo == "contacto") ? " active " : ""; ?> ">
                  <i class="bi bi-envelope-open-fill nav-icon"></i>
                  <p>Contactos</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- CONTENIDO -->
    <?php
    if ($modulo == "estadisticas") {
      include "estadisticas.php";
    }
    if ($modulo == "usuarios") {
      include "usuarios.php";
    }
    if ($modulo == "crearusuario") {
      include "crearusuario.php";
    }
    if ($modulo == "editarusuario") {
      include "editarusuario.php";
    }
    if ($modulo == "eliminarusuario") {
      include "eliminarusuario.php";
    }
    if ($modulo == "productos") {
      include "productos.php";
    }
    if ($modulo == "crearproductos") {
      include "crearproductos.php";
    }
    if ($modulo == "eliminarproducto") {
      include "eliminarproducto.php";
    }
    if ($modulo == "editarproducto") {
      include "editarproducto.php";
    }
    if ($modulo == "ventas") {
      include "ventas.php";
    }
    if ($modulo == "detalleventa") {
      include "detalleventa.php";
    }
    if ($modulo == "clientes") {
      include "clientes.php";
    }
    if ($modulo == "crearclientes") {
      include "crearclientes.php";
    }
    if ($modulo == "editarclientes") {
      include "editarclientes.php";
    }
    if ($modulo == "eliminarclientes") {
      include "eliminarclientes.php";
    }
    if ($modulo == "ficha") {
      include "ficha.php";
    }
    if ($modulo == "contacto") {
      include "contacto.php";
    }
    if ($modulo == "crearcontacto") {
      include "crearcontacto.php";
    }
    if ($modulo == "editarcontacto") {
      include "editarcontacto.php";
    }
    if ($modulo == "eliminarcontacto") {
      include "eliminarcontacto.php";
    }
    if ($modulo == "perfil") {
      include "./perfil2.php";
    }


    ?>



    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2025 <a href="#">Constantino Lantigua</a>.</strong>
      Todos derechos reservados.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="dist/js/demo.js"></script>-->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Page specific script -->
    <script>
      $(document).ready(function() {
        $(".borrarusuario").click(function(e) {
          e.preventDefault();
          var res = confirm("Realmente quieres borrar este usuario?");
          if (res == true) {
            var link = $(this).attr("href");
            window.location = link;
          }
        });
      });
      $(document).ready(function() {
        $(".borrarproducto").click(function(e) {
          e.preventDefault();
          var res = confirm("Realmente quieres borrar este producto?");
          if (res == true) {
            var link = $(this).attr("href");
            window.location = link;
          }
        });
      });
    </script>
    <!-- Declaración de los DATATABLE -->
    <script>
      $(function() {
        $('#tablausuarios').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });
      });
      $(function() {
        $('#tablaproductos').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });
      });
      $(function() {
        $('#tablaclientes').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });
      });
      $(function() {
        $('#tablaventas').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });
      });
      $(function() {
        $('#tabladetalleventa').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });
      });
    </script>
</body>

</html>