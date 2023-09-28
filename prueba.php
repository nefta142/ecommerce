<!doctype html>
<html lang="en">
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>pruebas PHP</title>
  <meta name="keywords" content="practicas, IFCD0210" />
  <meta name="author" content="Constantino Lantigua" />
  <meta name="description" content="ejercicio de clase"/>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
    
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">variables PHP</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <?php 

//print "<h2>";
$a = 5;
$b = 6;
echo "\$a = " .$a;
echo "<br>";
echo "\$b = " .$b;
echo "<br>";


echo "<br>";
echo "********************************************";
echo "<br>"; 

echo"\$a = \$b";
$a = $b;
echo "<br>";
echo "\$a = " .$a;
echo "<br>";
echo "\$b = " .$b. "\n";
echo "<br>";


echo "<br>";
echo "********************************************";
echo "<br>"; 

echo "\$b = 10";
$b = 10;
echo "<br>";
echo "\$a = " .$a;
echo "<br>";
echo "\$b = " .$b;
echo "<br>";


echo "<br>";
echo "********************************************";
echo "<br>"; 

echo"\$a = &\$b";
$a = &$b;
echo "<br>";
echo "\$a = " .$a;
echo "<br>";
echo "\$b = " .$b. "\n";
echo "<br>";

echo "<br>";
echo "********************************************";
echo "<br>"; 

echo "\$b = 100";
$b = 100;
echo "<br>";
echo "\$a = " .$a;
echo "<br>";
echo "\$b = " .$b;
echo "<br>";

echo "<br>";
echo "********************************************";
echo "<br>"; 


echo "\$a = 555";
$a = 555;
echo "<br>";
echo "\$a = " .$a;
echo "<br>";
echo "\$b= " . $b;
echo "<br>";

echo "<br>";
echo "********************************************";
echo "<br>"; 


echo "el valor de \"\$a\" con comillas dobles es $a.";
echo "<br>";
echo "<br>";
echo 'el valor de \'$a\' con comillas simples es $a.';
echo "<br>";
echo "<br>";
//print "</h2>";
echo "<h1>Estos detalles desquizian al programador, cuidado con ellos</h1>";

//print "<h2>";

echo "<br>";
echo "********************************************";
echo "<br>"; 

echo "echo \"\$b\" = " . "$b";
echo "<br>";
echo "<br>";
echo 'echo \'$b\' = ' . '$b';
echo "<br>";
echo "<br>";

echo "<br>";
echo "********************************************<br>";
echo "VECTORES Y MATRICES<br>";
echo "********************************************<br>";
echo "<br>"; 

echo "\$X = [1,2,3,4,5]; ";
$X = [1,2,3,4,5];
echo "<br>";
print 'Print $X[0] =' . $X[0];
echo "<br>";
print 'Print $X[1] =' . $X[1];
echo "<br>";
print 'Print $X[2] =' . $X[2];
echo "<br>";
print 'Print $X[3] =' . $X[3];
echo "<br>";
print 'Print $X[4] =' . $X[4];
echo "<br>";
echo "<br>";
echo "********************************************";

echo "********************************************";
echo "<br>"; 
$Y = [
  ["nombre","apellido","localidad"],
  ["Constantino","Lantigua","Ingenio"],
  ["Paco","López","Ingenio"],
  ["Juana","Santana","Las Palmas"]
  ];


print '$Y = [<br>
  ["nombre","apellido","localidad"],<br>
  ["Constantino","Lantigua","Ingenio"],<br>
  ["Paco","López","Ingenio"],<br>
  ["Juana","Santana","Las Palmas"]<br>
];<br><br><br>';


print "<pre>";
print_r($Y);
print "</pre>";

echo "<br>";
print $Y[0][0] ." ";
print $Y[0][1] ." ";
print $Y[0][2] ."<br> ";
print $Y[1][0] ." ";
print $Y[1][1] ." ";
print $Y[1][2] ."<br> ";
print $Y[2][0] ." ";
print $Y[2][1] ." ";
print $Y[2][2] ."<br> ";
print $Y[3][0] ." ";
print $Y[3][1] ." ";
print $Y[3][2] ."<br> ";
echo "<br>";
echo "<br>";

$X = [ 
    ["nombre"=>"constantino","apellido"=>"Lantigua","localidad"=>"Ingenio"],
    ["nombre"=>"Paco","apellido"=>"López","localidad"=>"Ingenio"],
    ["nombre"=>"Juana","apellido"=>"Santana","localidad"=>"El Cuarto"]
];
print '$X = [ 
    ["nombre"=>"constantino","apellido"=>"Lantigua","localidad"=>"Ingenio"],
    ["nombre"=>"Paco","apellido"=>"López","localidad"=>"Ingenio"],
    ["nombre"=>"Juana","apellido"=>"Santana","localidad"=>"El Cuarto"]
];';

echo "<br>";
echo "<br>";
print "<pre>";
print_r($X);
print "</pre>";
echo "<br>";
echo "<br>";
print "____________________________________<br>";
 print $X[0]["nombre"] ." ";
 print $X[0]["apellido"] ." ";
 print $X[0]["localidad"] ."<br> ";
 print "____________________________________<br>";
 print $X[1]["nombre"] ." ";
 print $X[1]["apellido"] ." ";
 print $X[1]["localidad"] ."<br> ";
 print "____________________________________<br>";

 print $X[2]["nombre"] ." ";
 print $X[2]["apellido"] ." ";
 print $X[2]["localidad"] ."<br> ";
 print "____________________________________<br>";

 echo "<br>";
 echo "<br>";

 echo "<br>"; 



 echo "<br>";

echo "********************************************<br>";
echo "********************************************<br>";

echo "            bucles para leer matrices<br>           ";
echo "********************************************<br>";
echo "<br>";


echo "********************************************<br>";
echo "            bucles For         <br> ";
echo "********************************************<br>";


// Define un array de 5 columnas por 4 filas
$array = array(
array(1, 2, 3, 4, 5),
array(6, 7, 8, 9, 10),
array(11, 12, 13, 14, 15),
array(16, 17, 18, 19, 20)
);

// Obtén el número de filas y columnas en el array
$numFilas = count($array);
$numColumnas = count($array[0]);

// Recorre el array utilizando un bucle for
for ($fila = 0; $fila < $numFilas; $fila++) {
for ($columna = 0; $columna < $numColumnas; $columna++) {
   // Accede a cada elemento del array y haz lo que necesites con él
   $elemento = $array[$fila][$columna];
   echo "Fila: $fila, Columna: $columna, Valor: $elemento &nbsp;";
    if ($columna == 4)
    {print "<br>______________________________________________________________________________________________________________________________________________________<br>";}
    }
    
}
print "<br>";

echo "********************************************<br>";
echo "            bucles While         <br> ";
echo "********************************************<br>";
// Define un array de 5 columnas por 4 filas
$array = array(
array(1, 2, 3, 4, 5),
array(6, 7, 8, 9, 10),
array(11, 12, 13, 14, 15),
array(16, 17, 18, 19, 20)
);

// Obtén el número de filas y columnas en el array
$numFilas = count($array);
$numColumnas = count($array[0]);

// Inicializa las variables de fila y columna
$fila = 0;
$columna = 0;

// Utiliza un bucle while para recorrer el array
while ($fila < $numFilas) {
$elemento = $array[$fila][$columna];
echo "Fila: $fila, Columna: $columna, Valor: $elemento &nbsp";

// Actualiza la columna y fila según sea necesario
$columna++;
if ($columna >= $numColumnas) {
  print "<br>______________________________________________________________________________________________________________________________________________________<br>";
 $columna = 0;
 $fila++;
}
}

 echo "********************************************<br>";
 echo "********************************************<br>";

 echo "            MATRICES SQL<br>           ";
 echo "********************************************<br>";
 echo "********************************************<br>";

 echo "<br>";


 include_once "db_connect.php";
 $conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_database);
 if ($conexion->connect_errno) {
   die("<p>Error de conexión Nº: $conexion->connect_errno - $conexion->connect_error</p>\n</body>\n</html>");
 }
 $query = "select id, nombre, apellido, email, clave, dni, direccion from clientes";
 $resultset = mysqli_query($conexion, $query);

 if ($conexion->errno) {
   die("<p>Error en la consulta - $conexion->error </p>\n</body>\n</html>");
 }
print $query;
print "<pre>";
print_r ($resultset);
print "</pre>";
print "<br>";
?>
 <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h1 class="card-title">class="table"</h1>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
<table class="table">
<thead>
<tr>
  <th>Nombre</th>
  <th>Apellido</th>
  <th>Email</th>
 <!-- <th>clave</th> -->
  <th>dni</th>
  <th>dirección</th>
 <!-- <th>Acciones <a href="panel.php?modulo=crearclientes"> <i class="fas fa-plus ml-2"></i></a></th>-->
</tr>
</thead>
<tbody>
<?php 
 while ($row = mysqli_fetch_assoc($resultset)) {
 
 ?>
<tr>
     <td><?php print $row["nombre"] ?></td>
     <td><?php print $row["apellido"] ?></td>
     <td><?php print $row["email"] ?></td>
     <!--<td><?php /*print $row["clave"] */?></td> -->
     <td><?php print $row["dni"] ?></td>
     <td><?php print $row["direccion"] ?></td>
</tr>
     <?php } ?>
 </tbody>
 </table>
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
              </div>
 <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h1 class="card-title">class="table table-success table-striped table-hover"</h1>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="usuarios" class="table table-success table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Email</th>
                     <!-- <th>clave</th> -->
                      <th>dni</th>
                      <th>dirección</th>
                     <!-- <th>Acciones <a href="panel.php?modulo=crearclientes"> <i class="fas fa-plus ml-2"></i></a></th>-->
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    include_once "db_connect.php";
                    $conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_database);
                    if ($conexion->connect_errno) {
                      die("<p>Error de conexión Nº: $conexion->connect_errno - $conexion->connect_error</p>\n</body>\n</html>");
                    }
                    $query = "select * from clientes";
                    $resultset = mysqli_query($conexion, $query);

                    if ($conexion->errno) {
                      die("<p>Error en la consulta - $conexion->error </p>\n</body>\n</html>");
                    }

                    while ($row = mysqli_fetch_assoc($resultset)) {
                    ?>
                      <tr>
                        <td><?php print $row["nombre"] ?></td>
                        <td><?php print $row["apellido"] ?></td>
                        <td><?php print $row["email"] ?></td>
                        <!--<td><?php /*print $row["clave"] */?></td> -->
                        <td><?php print $row["dni"] ?></td>
                        <td><?php print $row["direccion"] ?></td>
                       <!-- <td><a href="panel.php?modulo=editarclientes&id=<?php print $row["id"] ?> "> <i class="fas fa-edit mr-2"></i></a> <a href="panel.php?modulo=eliminarclientes&id=<?php print $row["id"] ?>"> <i class="fas fa-trash"></i></a></td>-->
                      </tr>
                    <?php
                    }

                    ?>
                  </tbody>

                </table>
                <div class="card-body">
                <div class="card-header">
                <h1 class="card-title">class="table table-dark table-hover"</h1>
              </div>
                <table id="usuarios" class="table table-dark table-hover">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Email</th>
                     <!-- <th>clave</th> -->
                      <th>dni</th>
                      <th>dirección</th>
                    <th>Acciones <a href="panel.php?modulo=crearclientes"> <i class="fas fa-plus ml-2"></i></a></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                $resultset = mysqli_query($conexion, $query);
                while ($row = mysqli_fetch_assoc($resultset)) {
                    ?>
                      <tr>
                        <td><?php print $row["nombre"] ?></td>
                        <td><?php print $row["apellido"] ?></td>
                        <td><?php print $row["email"] ?></td>
                        <!--<td><?php /*print $row["clave"] */?></td> -->
                        <td><?php print $row["dni"] ?></td>
                        <td><?php print $row["direccion"] ?></td>
                    <td><a href="panel.php?modulo=editarclientes&id=<?php print $row["id"] ?> "> <i class="fas fa-edit mr-2"></i></a> <a href="panel.php?modulo=eliminarclientes&id=<?php print $row["id"] ?>"> <i class="fas fa-trash"></i></a></td>
                      </tr>
                    <?php
                    }

                    ?>
                  </tbody>
                  
                </table>
                </div>
              </div>
              <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h1 class="card-title">Prueba lógica IF</h1>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php 
                $a= 10;
                if ($a<=5){
                  echo '$a es menor o igual a cinco';
                }
                else {
                  if ($a>5 & $a<10){
                    echo '$a es mayor a cinco y menor que 10';
                  }
                  else {
                    echo '$a es mayor o igual a 10';
                  }
                }
                echo "<br>";
                echo "<br>";
                //**************************unset($a);
                $a=17;
                $b =195;
                
                if ($a < $b) {
                    echo "a es menor que b<br>";
                    echo "a = $a <br>";
                    echo "b = $b <br>";
                } 
                else {
                  if ($a <> $b) {
                  echo "a es mayor que b<br>";
                  echo "a = $a <br>";
                  echo "b = $b <br>";                 }
                 else {
                  echo "a es igual a b<br>";
                  echo "a = $a <br>";
                  echo "b = $b <br>";                }} 
                ?>
                
           
                


                </div>
              </div> 
   

<?php
//print "</h2>";

?>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>