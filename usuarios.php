  <!-- PRÁCTICA: -->
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
      <div class="container-fluid"><!-- container-fluid -->
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="fas fa-user    "></i> Usuarios</h1>
     
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
                <h3 class="card-title">Control de usuarios del ecommerce</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tablausuarios" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Email</th>
                      <th>Acciones <a href="panel.php?modulo=crearusuario"> <i class="fas fa-plus ml-2"></i></a></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    include_once "db_connect.php";
                    $conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_database);
                    if ($conexion->connect_errno) {
                      die("<p>Error de conexión Nº: $conexion->connect_errno - $conexion->connect_error</p>\n</body>\n</html>");
                    }
                    $query = "select id, nombre, email from usuarios";
                    $resultset = mysqli_query($conexion, $query);

                    if ($conexion->errno) {
                      die("<p>Error en la consulta - $conexion->error </p>\n</body>\n</html>");
                    }

                    while ($row = mysqli_fetch_assoc($resultset)) {
                    ?>
                      <tr>
                        <td><?php print $row["nombre"] ?></td>
                        <td><?php print $row["email"] ?></td>
                        <td><a href="panel.php?modulo=editarusuario&id=<?php print $row["id"] ?> "> <i class="fas fa-edit mr-2"></i></a> <a href="panel.php?modulo=eliminarusuario&id=<?php print $row["id"] ?>"> <i class="fas fa-trash"></i></a></td>
                      </tr>
                    <?php
                    }

                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>