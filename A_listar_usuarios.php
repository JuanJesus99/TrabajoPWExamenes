<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Leer preguntas</title>
</head>
<body>


<?php
    session_start();
    if(!isset($_SESSION['id_usuario']) || $_SESSION['rol'] != 'administrador'){
        header('Location: login.php');
        exit;
    }else{

    include('connect.php');
    error_reporting(E_ALL & ~E_NOTICE);

    print('<div class="container">');
    print('<div class="jumbotron jumbotron-fluid text-center">');
    print('<h3>Usuarios</h3>');
    print('<p>Usuarios del sistema</p>');
    print('</div>');
    print('<div class="container pl-5 text-left">');
    

    $instruccion = "select * from usuario";
    $consulta = mysqli_query ($conexion, $instruccion) or die ("Fallo al realizar la consulta");
    
    $n_filas = mysqli_num_rows($consulta);

    if ($n_filas > 0) {
        print("<TABLE class='table'>\n");
        print("<TR>\n");
        print("<TH scope='col'>Id único</TH>\n");
        print("<TH scope='col'>Nombre</TH>\n");
        print("<TH scope='col'>Nombre de usuario</TH>\n");
        print("<TH scope='col'>rol</TH>\n");
        print("</TR>\n");

        for ($i = 0; $i < $n_filas; $i++) {
            $resultado = mysqli_fetch_array($consulta);
            print("<TR scope='row'>\n");
            print("<TD>" . $resultado['id_usuario'] . "</TD>\n");
            print("<TD>" . $resultado['nombre'] . "</TD>\n");
            print("<TD>" . $resultado['nombre_usuario'] . "</TD>\n");
            print("<TD>" . $resultado['rol'] . "</TD>\n");
            print("</TR>\n");
        }
        print("</TABLE>\n");
    }
    print('<div class="form-group">');
        print('<button onclick=location.href="menu_administrador.php" type="button" class="btn btn-primary">Menú</button>');
    print("</div>\n");
    print("</div>\n");
    print("</div>\n");
    //mysqli_close($conexion);
}
?>
    <footer class="bg-dark text-center text-white mt-5 relative-bottom">
        <div class="container p-4">Exámenes UCA 2020-2021 Copyright-All rights reserved</div>
    </footer>
</body>
</html>