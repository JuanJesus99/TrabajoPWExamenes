<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Eliminar Preguntas</title>
</head>
<body>

<?php

    session_start();
    if(!isset($_SESSION['id_usuario']) || $_SESSION['rol'] != 'profesor'){
        header('Location: login.php');
        exit;
    }else{

    error_reporting(E_ALL & ~E_NOTICE);
    $enviar = $_POST['Confirmar'];
    $Selecion_asignatura = $_POST['Selecion_asignatura'];
    $Selecion_tema = $_POST['Selecion_tema'];
    //Datos a meter en la base de datos
    $id_asignatura = $_REQUEST['id_asignatura'];
    $id_tema = $_REQUEST['id_tema'];

    include('connect.php');
 
    print(isset($enviar));
    print(isset($Selecion_asignatura));
    $error = false;

    if ((!isset($Selecion_asignatura)))
    {
    ?>
        <FORM ACTION="Consulta_Eliminar_preguntas.php" METHOD="POST">
    <?php
        //$conexion_1 = mysqli_connect("localhost","root", "12root43","colegio")  or die ("No se puede conectar con el servidor");
        $id_profesor = $_SESSION['id_usuario'];
        $instruccion_1 = "select id_asignatura from profesor_asignatura where id_profesor='$id_profesor'";
        $consulta_1 = mysqli_query ($conexion, $instruccion_1) or die ("Fallo al realizar la consulta");

        print('<div class="container">');
        print('<div class="jumbotron jumbotron-fluid text-center">');
        print('<h3>Asignaturas</h3>');
        print('<p>Selecciona la asignatura de la pregunta</p>');
        print('</div>');

        print('<div class="container pl-5 text-left">');
        print("<P>Estas son las asignaturas que impartes: </P>");

        $n_filas_1 = mysqli_num_rows($consulta_1);

        if($n_filas_1 > 0)
        {
            for ($i=0; $i<$n_filas_1; $i++)
            {
                print('<div class="container-fluid border border-secondary rounded mb-1">');
                print('<div class="row">');
                $resultado_1 = mysqli_fetch_array ($consulta_1);
                $consulta_id_asig_1 = $resultado_1['id_asignatura'];
                print ("Codigo de la asignatura: $consulta_id_asig_1");

                print('</div>');
                print('<div class="row">');

                //Sacamos el nombre de la asignatura
                $instruccion_2 = "select nombre from asignatura where id_asignatura='$consulta_id_asig_1'";
                $consulta_2 = mysqli_query ($conexion, $instruccion_2) or die ("Fallo al realizar la insercion");
                $resultado_2 = mysqli_fetch_array ($consulta_2);
                print("  Nombre: ". $resultado_2['nombre']."<br>");

                print('</div>');
                print('</div>');
            }
        }   

        $instruccion_1 = "select id_asignatura from profesor_asignatura where id_profesor='$id_profesor'";
        $consulta_1 = mysqli_query ($conexion, $instruccion_1) or die ("Fallo al realizar la consulta");

        $n_filas_1 = mysqli_num_rows($consulta_1);
        print("<P>Seleccione le codigo de la asignatura donde quiere insertar preguntas: </P>");
        if($n_filas_1 > 0)
        {   
            print("<select name='id_asignatura' class='form-select'>");
            for ($i=0; $i<$n_filas_1; $i++)
            {
                $resultado_3 = mysqli_fetch_array ($consulta_1);
                print("<option>".$resultado_3['id_asignatura']."</option>");
            }
            print("</select>");
                
        }
    ?>
    <input type="submit" class="btn btn-primary ml-5" name="Selecion_asignatura" value="Confirmar">

    </FORM>
<?php
    }
    else if(!isset($Selecion_tema))
    {
        ?>

        <FORM ACTION="Eliminar_preguntas.php" METHOD="POST">
    <?php
        //$conexion_tema = mysqli_connect("localhost","root", "12root43","colegio")  or die ("No se puede conectar con el servidor");

        $instruccion_tema  = "select id_tema, nombre from temas where id_asignatura='$id_asignatura'";
        $consulta_tema = mysqli_query ($conexion , $instruccion_tema ) or die ("Fallo al realizar la consulta");

        print('<div class="container">');
        print('<div class="jumbotron jumbotron-fluid text-center">');
        print('<h3>Temas</h3>');
        print('<p>Seleccione el tema de la asignatura seleccionada</p>');
        print('</div>');
        print("<P>Estos son los temas de la asignatura seleccionada: </P>");

        $n_filas_tema = mysqli_num_rows($consulta_tema);

        if($n_filas_tema  > 0)
        {
            print ("<TABLE class='table'>\n");
            print ("<TR>\n");
            print ("<TH scope='col'>Codigo del Tema</TH>\n");
            print ("<TH scope='col'>Nombre del tema</TH>\n");
            print ("</TR>\n");

            for ($j=0; $j<$n_filas_tema ; $j++)
            {
                $resultado_tema  = mysqli_fetch_array ($consulta_tema );
                print ("<TR scope='row'>\n");
                print ("<TD>" . $resultado_tema ['id_tema'] . "</TD>\n");
                print ("<TD>" . $resultado_tema ['nombre'] . "</TD>\n");
                print ("</TR>\n");

            }
            print ("</TABLE>\n");
        } 

        $instruccion_tema  = "select id_tema, nombre from temas where id_asignatura='$id_asignatura'";
        $consulta_tema = mysqli_query ($conexion, $instruccion_tema ) or die ("Fallo al realizar la consulta");

        print("<P>Seleccione le codigo del tema donde quieres modificar preguntas: </P>");

        $n_filas_tema = mysqli_num_rows($consulta_tema);

        if($n_filas_tema  > 0)
        {   
            print("<select name='id_tema' class='form-select'>");
            for ($i=0; $i<$n_filas_tema; $i++)
            {
                $resultado_tema = mysqli_fetch_array ($consulta_tema);
                print("<option>".$resultado_tema['id_tema']."</option>");
            }
            print("</select>");
                
        }
        print("<input TYPE='hidden' NAME='id_asignatura' VALUE='$id_asignatura'>")
    ?>
  
    <input type="submit" class="btn btn-primary ml-5" name="Selecion_tema" value="Selecion_tema">

    </FORM>
    </div>
    </div>
<?php
    }
    }
?>
    <footer class="bg-dark text-center text-white mt-5 relative-bottom">
        <div class="container p-4">Exámenes UCA 2020-2021 Copyright-All rights reserved</div>
</body>
</html>