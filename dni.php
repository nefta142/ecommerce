<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
      include_once "db_connect.php";
      function validacion_dni($dni) {
        // Eliminar espacios en blanco y convertir a mayúsculas
       
        print $dni;
        // Verificar que el DNI tiene el formato correcto
        if (preg_match('/^[0-9]{8}[A-Z]$/', $dni)) {
            $letras = "TRWAGMYFPDXBNJZSQVHLCKE";
            $numeroDNI = substr($dni, 0, 8);
            print $numeroDNI;
            $letraDNI = substr($dni, -1);
            print "<bre>";
            print $letraDNI;
            $posicion = $numeroDNI % 23;
            print "<br>";
            print $letraDNI;
    
            // Verificar que la letra sea correcta
            if ($letraDNI == $letras[$posicion]) {
                echo 'Este DNI es válido';
            } else {
                echo 'Este DNI no es válido<br>';
                print $letraDNI;
            }
        } else {
            echo 'El formato del DNI es incorrecto<br>';
        }
    }
    Validacion_dni(43666275);
    
    if (isset($_REQUEST["validar"])) {
        $dni = sanitizar($conexion, $_REQUEST["dni"]);
        print $dni;
        Validacion_dni($dni) ;
    }
     else{?>
     <form action="dni.php" method="get">
        <input type="text" name="dni" placeholder="introduce el dni">
        <br><br>
        <button type="submit" name="validar" class="btn btn-primary">Validar</button>
        <button " name="cancelar" class="btn btn-primary">Cancelar</button>
     </form>
     <?php  } ?>
</body>
</html>