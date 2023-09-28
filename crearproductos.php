<?php
if (isset($_REQUEST["guardar"])) {
  include_once "db_connect.php";
  $conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_database);
  if ($conexion->connect_errno) {
    die("<p>Error de conexión Nº: $conexion->connect_errno - $conexion->connect_error</p>\n</body>\n</html>");
  }
  $nombre = sanitizar($conexion, $_REQUEST["nombre"]);
  $descripcion = sanitizar($conexion, $_REQUEST["descripcion"]);
  $precio = sanitizar($conexion, $_REQUEST["precio"]);
  $existencias = sanitizar($conexion, $_REQUEST["existencias"]);
  $imagen = sanitizar($conexion, $_REQUEST["imagen"]);

  
 // $query = "INSERT INTO productos (nombre, descripcion, precio, existencias) VALUES (\"$nombre\", \"$descripcion\", \"$precio\", \"$existencias\")";
 // $resultset = mysqli_query($conexion, $query);

 if (isset($_POST['guardar'])) {

  //Recogemos el archivo enviado por el formulario
  $archivo = $_FILES['archivo']['name'];
  print "<p>$archivo</p>";
  //Si el archivo contiene algo y es diferente de vacio
  if (isset($archivo) && $archivo != "") {
     //Obtenemos algunos datos necesarios sobre el archivo
     $tipo = $_FILES['archivo']['type'];
     print "<p>$tipo</p>";
     $tamano = $_FILES['archivo']['size'];
     $temp = $_FILES['archivo']['tmp_name'];
     //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
    if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png") || strpos($tipo, "webp")) && ($tamano < 2000000))) {
       echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
       - Se permiten archivos .gif, .jpg, .png, .webp y de 200 kb como máximo.</b></div>';
    }
 else {
       //Si la imagen es correcta en tamaño y tipo
       //Se intenta subir al servidor
      $logitudPass = 10;
      $newNameFoto= substr( md5(microtime()), 1, $logitudPass);

      $explode= explode('.', $archivo);
      $extension_foto = array_pop($explode);
      $archivo = $newNameFoto.'.'.$extension_foto;

       if (move_uploaded_file($temp, 'img/'.$archivo)) {
           //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
           chmod('img/'.$archivo, 0777);
           //Mostramos el mensaje de que se ha subido con éxito
           echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
           //Mostramos la imagen subida
           echo '<p><img src="img/'.$archivo.'"></p>';
           $imagen = "$archivo";
           $query = "INSERT INTO productos (nombre, descripcion, precio, existencias, imagen) VALUES (\"$nombre\", \"$descripcion\", \"$precio\", \"$existencias\", \"$imagen\")";
           $resultset = mysqli_query($conexion, $query);
           $query2 = "SELECT id FROM productos WHERE imagen LIKE \"$imagen\"";
           $resultset2 = mysqli_query($conexion, $query2);
           $row = mysqli_fetch_assoc($resultset2);
           $idProducto = $row["id"];
           $query3 = "INSERT INTO fotos (idProducto,nombre) values (\"$idProducto\", \"$imagen\")";
           $resultset3 = mysqli_query($conexion, $query3);
           
           echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
       }
       else {
          //Si no se ha podido subir la imagen, mostramos un mensaje de error
          echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
       }
     }
  }
}

if ($resultset)
{
  print "<meta http-equiv=\"refresh\" content=\"0; url=panel.php?modulo=productos_admin&mensaje=Producto creado exitosamente con id: $id_producto\" />  ";
}
else
{?>
  <div class="alert alert-danger float-right" role="alert">
    <strong>Atención! no se ha creado el producto<?php print mysqli_error($con) ?> </strong>
  </div>
<?php }
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><i class="fas fa-user-edit"></i> Crear Producto</h1>
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
              <h3 class="card-title">Crear producto del ecommerce</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form method="post" action="panel.php?modulo=crearproductos" enctype="multipart/form-data"/>
                <div class="form-group">
                  <label for="nombre">nombre</label>
                  <input type="nombre" name="nombre" class="form-control" value="" required>
                </div>
                <div class="form-group">
                  <label for="descripcion">Descripcion</label>
                  <input type="text" name="descripcion" class="form-control"  value="" required>
                </div>
                <div class="form-group">
                  <label for="precio">Precio</label>
                  <input type="text" name="precio" class="form-control"  value="" required>
                </div>
                <div class="form-group">
                  <label for="existencias">existencias</label>
                  <input type="text" name="existencias" class="form-control"  value="" required>
                </div>
                <div class="form-group">
                <label for="archivo">Sube una imagen</label>
                <input name="archivo" id="archivo" type="file"/ required>
              <!--  <input type="submit" name="subir" value="Subir imagen"/> -->
                </div>

                <div class="form-group">
                  <button type="submit" name="guardar" class="btn btn-primary">Guardar</button>
                  <a class="btn btn-danger" href="panel.php?modulo=productos_admin" role="button">Cancelar</a>
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