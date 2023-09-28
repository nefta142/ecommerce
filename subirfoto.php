
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
    <?php
$id = $_REQUEST["id"];
print "<p>$id</p>";
if (isset($_REQUEST["guardar"])) {
  include_once "db_connect.php";
  $conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_database);
  if ($conexion->connect_errno) {
    die("<p>Error de conexión Nº: $conexion->connect_errno - $conexion->connect_error</p>\n</body>\n</html>");
  }
  
 if (isset($_POST['guardar'])) {

    /*************************************************************/
    /****** Recogemos el archivo enviado por el formulario *******/
    /******     al ser un fichero multipar es un array     *******/
    /*************************************************************/

    $archivo = $_FILES['archivo']['name'];
    //print "<p>$archivo</p>";
    //Si el archivo contiene algo y es diferente de vacio
    if (isset($archivo) && $archivo != "") {
    //Obtenemos algunos datos necesarios sobre el archivo
    $tipo = $_FILES['archivo']['type'];
    //print "<p>$tipo</p>";
    $tamano = $_FILES['archivo']['size'];
    //print "<p>$tamano</p>";
    $temp = $_FILES['archivo']['tmp_name'];
    //print "<p>$tmp_name</p>";
    //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
    if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png") || strpos($tipo, "webp")) && ($tamano < 2000000))) {
       echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
       - Se permiten archivos .gif, .jpg, .png, .webp y de 200 kb como máximo.</b></div>';
    }
 else {
       //Si la imagen es correcta en tamaño y tipo
       
        /********************************************************/
        /**** encriptamos con nmd5() la fución microtime() y ***/
        /****          componemos un nuevo nombre           ***/
        /*****************************************************/
      $logitudPass = 10;
      $newNameFoto= substr( md5(microtime()), 1, $logitudPass);
      $explode= explode('.', $archivo);
      $extension_foto = array_pop($explode);
      $archivo = $newNameFoto.'.'.$extension_foto;
      //Se intenta subir al servidor
       if (move_uploaded_file($temp, 'img/'.$archivo)) {
           //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
           chmod('img/'.$archivo, 0777);
           
           //Mostramos la imagen subida
           ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              
            <?php
          //Mostramos el mensaje de que se ha subido con éxito
          echo '<p><b>Se ha subido correctamente la imagen.</b></p>';
           echo '<p><img src="img/'.$archivo.'"></p>';
           
          
           // innsertamos una linea en la tabla foto
           $imagen = "$archivo";
           //print "<p>$imagen</p>";
           //print "<p>idproducto:<br>$id</p>";
           $query3 = "INSERT INTO fotos (idProducto,nombre) values (\"$id\", \"$imagen\")";
           //print "<p>$query3</p>";
           $resultset3 = mysqli_query($conexion, $query3);
       }
       if ($resultset3 ){
        echo '<div><b>Se ha insertado correctamente la imagen.</b></div>';
        $query4 = "UPDATE productos SET imagen = \"$imagen\" WHERE id=\"$id\";";
        $resultset4 = mysqli_query($conexion, $query4);
       }
       else {
        echo '<div><b>Ocurrió algún error al insertat el registro del fichero. No pudo guardarse.</b></div>';
       }
     }
  }
}
 
}
?>
       <div class=" card-heade">
        <div class="card-body">
          <h1><i class="fas fa-user-edit"></i>Subir imagen del producto</h1>
        </div>
        </div>
          <script>
            $(".alert").alert();
          </script>
        
    

  <!-- Main content -->
            
            <div class="card-body">
              <form method="post" action="panel.php?modulo=subirfoto&id=<?php print $id ?>" enctype="multipart/form-data"/>
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