<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="fas fa-user-plus    "></i>Gestor de Clientes</h1>
            <script>
              $(".alert").alert();
            </script>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<!-- Main content -->
<section class="content py-3">
    <div class="container-fluid">
      <div class="row justify-content-center align-items-center">
        <div class="col-8">
            <?php
            if (isset($_REQUEST["guardar"])) {
            //incluimos los datos de conexion de la bbdd
            include_once "db_connect.php";

            //CREAMOS LA CONEXION PASANDO LOS PARAMETROS
            $conexion = new mysqli($db_host, $db_user, $db_pass, $db_database);
                        
            //si hay error, corta el codigo y muestra el error
            if ($conexion->connect_errno) {
                die("<p class=\"error\">Conexion fallida! <b>Error Nº:</b> $conexion->connect_errno -- $conexion->connect_error</p>\n</body>\n</html>");
            }

            $email = sanitizar($conexion, $_REQUEST["email"]);
            $id = sanitizar($conexion, $_REQUEST["id"]);

            //BUSCAMOS SI EL EMAIL YA EXISTE
            $sql = "SELECT * FROM clientes WHERE email=\"$email\"";
                        
            //LANZAR QUERY
            $resultset = mysqli_query($conexion, $sql);

            //comprobar si la query encuentra alguna linea en el resultado, de esta forma sabemos si existe el usuario o no
                if ($row = $resultset->fetch_assoc() ) { 
                    $sql = "SELECT * FROM clientes WHERE email=\"$email\" and $id = \"$id\"";
                    $resultset = mysqli_query($conexion, $sql);
                    if ($row = $resultset->fetch_assoc() ) { 
                   
                    $nombre = sanitizar($conexion, $_REQUEST["nombre"]);
                    $apellidos = sanitizar($conexion, $_REQUEST["apellidos"]);
                    $dni = sanitizar($conexion, $_REQUEST["dni"]);
                    $direccion = sanitizar($conexion, $_REQUEST["direccion"]);
                    $clave = sanitizar($conexion, $_REQUEST["clave"]);
                    $clave2 = sanitizar($conexion, $_REQUEST["clave2"]);

                    if ($clave != $clave2) { ?>
                        <div class="alert alert-danger" role="alert">
                        <strong>Atención! las claves no coinciden</strong>
                        </div>
                    <?php }
                    else {
                
                        $clave = md5($clave);
                        
                        //QUERY SQL QUE INSERTA LOS DATOS EN LA TABLA CLIENTES
                        $sql = "UPDATE clientes SET  nombre = \"$nombre\", apellido = \"$apellidos\" , email = \"$email\", clave = \"$clave\" , dni = \"$dni\", direccion = \"$direccion\" WHERE id = \"$id\" ";
                            
                        //LANZAR QUERY
                        $resultset = mysqli_query($conexion, $sql);

                        if ($resultset) {
                        print "<meta http-equiv=\"refresh\" content=\"0; url=index.php?modulo=iniciosesion&mensaje=Cliente actualizado exitosamente, ya puede iniciar sesión\"/>  ";
                        }
                        else { ?>
                            <div class="alert alert-danger float-right" role="alert">
                                <strong>Atención! no se ha actualizado correctamente, informe al administrador de la web <?php  print mysqli_error($conexion)  ?> </strong>
                            </div>
                        <?php }
                    }
                    ?>
                    </div>
                <?php }}
                else {?>
                    <div class="alert alert-danger" role="alert">
                        <strong>Atención! El email ya esta registrado</strong>
                        <?php }
            }
            ?>

           <?php 
            
            include_once "./db_ecommerce.php";
            $conexion = new mysqli($db_host, $db_user, $db_pass, $db_database);
            if ($conexion->connect_errno) {
                die("<p class=\"error\">Conexion fallida! <b>Error Nº:</b> $conexion->connect_errno -- $conexion->connect_error</p>\n</body>\n</html>");
            }
            else
            {
                $id = sanitizar($conexion, $_REQUEST["id"]);
                $sql = "SELECT * FROM clientes WHERE id = \"$id\" ";
                $resultset = mysqli_query($conexion, $sql);
                $row = $resultset->fetch_assoc();

            } 
           ?>
    
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Actualizar Cuenta</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form method="post" action="panel.php?modulo=perfil">
                <input type="hidden" name="id" value ="<?php print $id ?>" >
              <div class="form-group">
                    <div class="row">
                        <div class="col-8">
                            <label for="email" class="m-0">Email</label>
                            <input type="email" name="email" class="form-control" required value="<?php print $row["email"];  ?> " >
                        </div>
                        <div class="col-4">
                            <label for="dni" class="m-0">DNI</label>
                            <input type="text" name="dni" maxlength="9" class="form-control" required value="<?php print $row["dni"];  ?> ">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-5">
                            <label for="nombre" class="m-0">Nombre</label>
                            <input type="text" name="nombre" class="form-control" required value="<?php print $row["nombre"];  ?> ">
                        </div>
                        <div class="col-7">
                            <label for="apellidos" class="m-0">Apellidos</label>
                            <input type="text" name="apellidos" class="form-control" required value="<?php print $row["apellido"];  ?> " >
                        </div>
                    </div>
                </div>
               
                <div class="form-group">
                  <label for="direccion" class="m-0">Dirección</label>
                  <input type="text" name="direccion" class="form-control" required value="<?php print $row["direccion"];  ?>">
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label for="clave" class="m-0">Clave</label>
                            <input type="password" name="clave" class="form-control" required>
                        </div>
                        <div class="col">
                            <label for="clave2" class="m-0"> Confirmar Clave</label>
                            <input type="password" name="clave2" class="form-control" required>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                  <button type="submit" name="guardar" class="btn btn-primary mr-2">Guardar</button>
                  <a class="btn btn-danger" href="index.php" role="button">Cancelar</a>
                </div>
              </form>
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


