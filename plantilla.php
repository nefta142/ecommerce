<?php

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
if (isset($_REQUEST["mensaje"]))
{?>
<!-- lanzamos el mensaje si existe -->
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
                <h3 class="card-title">Plantilla</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <h1>Desarrolla tu Aplicación</h1>
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