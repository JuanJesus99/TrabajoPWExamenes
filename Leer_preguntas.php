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
    if(!isset($_SESSION['id_usuario']) || $_SESSION['rol'] != 'profesor'){
        header('Location: login.php');
        exit;
    }else{

    include('connect.php');
    error_reporting(E_ALL & ~E_NOTICE);
    $enviar = $_POST['Confirmar'];
    $Seleccion_pregunta = $_POST['Seleccion_pregunta'];

    //Datos a meter en la base de datos
    $id_tema = $_REQUEST['id_tema'];
    $id_asignatura = $_REQUEST['id_asignatura'];

    print('<div class="container">');
    print('<div class="jumbotron jumbotron-fluid text-center">');
    print('<h3>Preguntas</h3>');
    print('<p>Genere la pregunta</p>');
    print('</div>');
    print('<div class="container pl-5 text-left">');
    
    print ("<TH>Estas son las preguntas del tema $id_tema y asignatura seleccionadas $id_asignatura</TH>\n");
    //$conexion = mysqli_connect("localhost","Profesor1", "123456abc","examenes_online")  or die ("No se puede conectar con el servidor");

    $instruccion_id_pregunta = "select * from preguntas where id_tema='$id_tema' and id_asignatura='$id_asignatura'";
    $consulta_id_pregunta = mysqli_query ($conexion, $instruccion_id_pregunta) or die ("Fallo al realizar la insercion");
    
    $n_filas_id_pregunta = mysqli_num_rows($consulta_id_pregunta);

    if ($n_filas_id_pregunta > 0) {
        print("<TABLE class='table'>\n");
        print("<TR>\n");
        print("<TH scope='col'>Codigo de la pregunta</TH>\n");
        print("<TH scope='col'>Codigo del Tema</TH>\n");
        print("<TH scope='col'>Codigo de la asignatura</TH>\n");
        print("<TH scope='col'>Enunciado</TH>\n");
        print("<TH scope='col'>Opcion A</TH>\n");
        print("<TH scope='col'>Opcion B</TH>\n");
        print("<TH scope='col'>Opcion C</TH>\n");
        print("<TH scope='col'>Opcion D</TH>\n");
        print("<TH scope='col'>Correcta</TH>\n");

        print("</TR>\n");

        for ($i = 0; $i < $n_filas_id_pregunta; $i++) {
            $resultado_id_pregunta = mysqli_fetch_array($consulta_id_pregunta);
            print("<TR scope='row'>\n");
            print("<TD>" . $resultado_id_pregunta['id_pregunta'] . "</TD>\n");
            print("<TD>" . $resultado_id_pregunta['id_tema'] . "</TD>\n");
            print("<TD>" . $resultado_id_pregunta['id_asignatura'] . "</TD>\n");
            print("<TD>" . $resultado_id_pregunta['enunciado'] . "</TD>\n");
            print("<TD>" . $resultado_id_pregunta['opA'] . "</TD>\n");
            print("<TD>" . $resultado_id_pregunta['opB'] . "</TD>\n");
            print("<TD>" . $resultado_id_pregunta['opC'] . "</TD>\n");
            print("<TD>" . $resultado_id_pregunta['opD'] . "</TD>\n");
            print("<TD>" . $resultado_id_pregunta['correcta'] . "</TD>\n");
            print("</TR>\n");
        }
        print("</TABLE>\n");
    }
    print('<div class="form-group">');
        print('<button onclick=location.href="menu_profesor.php" type="button" class="btn btn-primary">Menú</button>');
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