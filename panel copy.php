<!DOCTYPE html>
<html lang="en">
<?php 
    //Iniciamos la sesión y comprobamos que el usuario se ha identificado IMPRESINDIBLE
    session_start();
    if ( isset($_SESSION["id"]) == false )
    {
      header("location: index.php");
    }
    //Comprobamos el módulo seleccionado o lo inicializamos vacío si venimos del login
    if (isset($_REQUEST["modulo"]))
    {
      $modulo = $_REQUEST["modulo"];
    }
    else
    {
      //Aplicamos el módulo por defecto
      $modulo = "estadisticas";
    }
    
  ?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Panel de control</title>

</a>
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
  <nav class="main-header navbar navbar-expand navbar-white navbar-light fixed-top">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      

      <!-- Messages Dropdown Menu -->
     
      <!-- Notifications Dropdown Menu -->
      
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="panel.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        
        <div class="info">
          <a href="#" class="d-block"><?php print $_SESSION["nombre"]; ?> </a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
     

      <!-- Sidebar Menu -->
      <ul class="nav nav-treeview">
      <li class="nav-item">
                <a href="panel.php?modulo=estadisticas" class="nav-link ">
                <i class="bi bi-clipboard2-data-fill nav-icon"></i>
                  <p>Estadísticas</p>
                </a>
        </li>
        <li class="nav-item">
                <a href="panel.php?modulo=usuarios" class="nav-link ">
                  <i class="fas fa-user    ">&nbsp;</i>Usuarios
                </a>
        </li>
        <li class="nav-item">
                <a href="panel.php?modulo=clientes" class="nav-link ">
                <i class="fas fa-user    ">&nbsp;</i>
                  Clientes
                </a>
        </li>
        <li class="nav-item">
                <a href="panel.php?modulo=productos" class="nav-link ">
                <i class="bi bi-bag-fill nav-icon"></i>
                  <p>Productos</p>
                </a>
        </li>
        <li class="nav-item">
                <a href="#" class="nav-link ">
                <i class="bi bi-cart-fill nav-icon"></i>
                  Ventas
                </a>
        </li>
     
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  
<!-- CONTENIDO -->
<?php 
    if ($modulo == "estadisticas")
    {
      include "estadisticas.php";
    }
    if ($modulo == "usuarios")
    {
      include "usuarios.php";
    }
    if ($modulo == "editarusuario")
    {
      include "editarusuario.php";
    }
   if ($modulo == "crearusuario")
    {
      include "crearusuario.php";
    }
    if ($modulo == "eliminarusuario")
    {
      include "eliminarusuario.php";
    }
    if ($modulo == "clientes")
    {
      include "clientes.php";
    }
    if ($modulo == "crearclientes")
    {
      include "crearclientes.php";
    }
    if ($modulo == "editarclientes")
    {
      include "editarclientes.php";
    }
    if ($modulo == "eliminarclientes")
    {
      include "eliminarclientes.php";
    }
    if ($modulo == "plantilla")
    {
      include "plantilla.php";
    }
    if ($modulo == "productos")
    {
      include "productos.php";
    }
    if ($modulo == "productos_admin")
    {
      include "productos.php";
    }
    if ($modulo == "editarproducto")
    {
      include "editarproducto.php";
    }
    if ($modulo == "crearproductos")
    {
      include "crearproductos.php";
    } 
    if ($modulo == "eliminarproducto")
    {
      include "eliminarproducto.php";
    }
    if ($modulo == "subirfoto")
    {
      include "subirfoto.php";
    }
    if ($modulo == "eliminarfoto")
    {
      include "eliminarfoto.php";
    }
 
  ?>

<footer class="main-footer">
    <strong>Copyright &copy; 2023 <a href="#">Constantinno Lantigua</a>.</strong>
    Todos derechos reservados.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>
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

</body>
</html>
