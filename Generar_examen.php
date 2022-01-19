<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title> Generar Examen</title>
</head>
<body>

<?php
    session_start();
    if(!isset($_SESSION['id_usuario']) || $_SESSION['rol'] != 'profesor'){
        header('Location: login.php');
        exit;
    }
    else
    {
        include('connect.php');
        error_reporting(E_ALL & ~E_NOTICE);
        $enviar = $_POST['Confirmar'];
        $Selecion_asignatura = $_POST['Selecion_asignatura'];
        //Datos a meter en la base de datos
        $id_asignatura = $_REQUEST['id_asignatura'];
        $numero_preguntas = $_REQUEST['numero_preguntas'];
        $fecha_inicio = $_REQUEST['fecha_inicio'];
        
    
        //print(isset($enviar));
        //print(isset($Selecion_asignatura));
        $error = false;

        if ((!isset($Selecion_asignatura)))
        {
        ?>
            <FORM ACTION="Generar_examen.php" METHOD="POST">
        <?php

            print('<div class="container">');
            print('<div class="jumbotron jumbotron-fluid text-center">');
            print('<h3>Generar exámen</h3>');
            print('<p>Planificación de exámenes</p>');
            print('</div>');
            print('<div class="container pl-5 text-left">');

            //$conexion_1 = mysqli_connect("localhost","cursophp", "","examenes_online")  or die ("No se puede conectar con el servidor");
            $id_profesor = $_SESSION['id_usuario'];
            $instruccion_1 = "select id_asignatura from profesor_asignatura where id_profesor='$id_profesor'";
            //$instruccion_1 = "select id_asignatura from profesor_asignatura where id_profesor=3";
            $consulta_1 = mysqli_query ($conexion, $instruccion_1) or die ("Fallo al realizar la consulta");

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
            // $instruccion_1 = "select id_asignatura from profesor_asignatura where id_profesor=3";
            $consulta_1 = mysqli_query ($conexion, $instruccion_1) or die ("Fallo al realizar la consulta");

            $n_filas_1 = mysqli_num_rows($consulta_1);
            print("<div class='mt-3'>Seleccione le codigo de la asignatura donde quiere crear el examen: ");
            if($n_filas_1 > 0)
            {   
                print("<select name='id_asignatura' class='form-select'>>");
                for ($i=0; $i<$n_filas_1; $i++)
                {
                    $resultado_3 = mysqli_fetch_array ($consulta_1);
                    print("<option>".$resultado_3['id_asignatura']."</option>");
                }
                print("</select>");
                print("</div>");
            }
            
        ?>

            
        <div class="form-row align-items-center">
            <div class="col-sm-3 my-1">
                <br>Indique el numero de preguntas: <input class="form-control" type="number" name="numero_preguntas"> <br>
            </div>
            <div class="col-sm-3 my-1">
                Indique la fecha del examen:
                <?php
                $fecha_actual = date("Y-m-d");
                print("<label for='start'></label>");
                print("<input type='date' class='form-control' id='start' name='fecha_inicio' value='$fecha_actual' min='$fecha_actual' max='2022-12-31'>");
                ?>
            </div>
                <!-- <label for="start">Start date:</label>
                
                <input type="date" id="start" name="trip-start"
                    value="2018-07-22"
                    min="2018-01-01" max="2018-12-31"> -->
            <div class="col-sm-3 my-1">
                <input type="submit" name="Selecion_asignatura" class="btn btn-primary ml-5 mt-4" value="Confirmar">
            </div>
        </div>

        </FORM>
        </div>
        </div>

    <?php
        }
        else 
        {
            print('<div class="container">');
            print('<div class="jumbotron jumbotron-fluid text-center">');
            print('<h3>Generar exámen</h3>');
            print('<p>Resultado de la generación</p>');
            print('</div>');
            print('<div class="container pl-5 text-left">');

            

            $instruccion = "select id_pregunta from preguntas where id_asignatura='$id_asignatura'";
            $consulta = mysqli_query ($conexion, $instruccion) or die ("Fallo al realizar la consulta");

            $n_filas = mysqli_num_rows($consulta);
            $listid;

            if($n_filas >= $numero_preguntas)
            {
                print("Generando examen de la asignatura: $id_asignatura con $numero_preguntas preguntas. <br>");
                if($n_filas > 0)
                {   
            
                    for ($i=0; $i<$n_filas; $i++)
                    {
                        $resultado = mysqli_fetch_array ($consulta);
                        $listid[$i] = $resultado['id_pregunta'];
                    }    
                }

                //Mostrando que se guarda bien en el vector
                // print("<br> Lo que guardamos de la consulta");
                // for ($i=0; $i<$n_filas; $i++)
                // {
                //     print("<br> Posicion $i, valor: $listid[$i]");
                // }

                
                //Creamos el examen sin preguntas
                $instruccion = "insert into examenes (id_asignatura, fecha_inicio) values ('$id_asignatura', '$fecha_inicio')";
                $insercion = mysqli_query ($conexion, $instruccion) or die ("Fallo al realizar la generacion del examen");

                //Buscamos el id del examen creado para meter las preguntas correspondientes
                $instruccion = "select id_examen from examenes where id_asignatura='$id_asignatura' and fecha_inicio='$fecha_inicio'";
                $consulta = mysqli_query ($conexion, $instruccion) or die ("Fallo al realizar la consulta de obtencion de id_examen");

                $n_filas = mysqli_num_rows($consulta);
                if($n_filas > 0)
                {   
            
                    for ($i=0; $i<$n_filas; $i++)
                    {
                        $resultado = mysqli_fetch_array ($consulta);
                        $id_examen = $resultado['id_examen'];
                    }    
                }

            
                //Vamos metiendo las preguntas en el examen
                for($i=0; $i<$numero_preguntas; $i++)
                {
                    $pregunta = rand(0,count($listid)-1);
                    $instruccion = "insert into examen_pregunta (id_examen, id_pregunta) values ('$id_examen', '$listid[$pregunta]')";
                    $insercion = mysqli_query ($conexion, $instruccion) or die ("Fallo al realizar la insercion de la pregunta");

                    array_splice($listid,$pregunta,1);
                }
                
                print("<br> Su examen se ha generado correctamente");
                print('<button onclick=location.href="menu_profesor.php" type="button" class="btn btn-primary ml-5">Menú</button>');
                print("</div>");
                print("</div>");

                // $a = count($listid);
                // print("<br><br> Preguntas aleatorias que saca de $a");
                // for($i=0; $i<$numero_preguntas; $i++)
                // {
                //     $pregunta = rand(0,count($listid)-1);
                //     print("<br>Pregunta $i. Id: $listid[$pregunta]. Numero aleatorio: $pregunta");
                //     //unset($listid[$pregunta]);
                //     array_splice($listid,$pregunta,1);
                // }

                // $a = count($listid);
                // print("<br><br> Las preguntas que no se han sacado: $a ");
                // for ($i=0; $i<count($listid); $i++)
                // {
                //     print("<br> Posicion $i, valor: $listid[$i]");
                // }
            }
            else
            {
                print("No hay preguntas suficientes para crear el examen. El número de preguntas en el sistema es de $n_filas <br>");
                print('<button onclick=location.href="menu_profesor.php" type="button" class="btn btn-primary ml-5">Menú</button>');
                print("</div>");
                print("</div>");
            }

            
        }
    }
    ?>
    <footer class="bg-dark text-center text-white mt-5 relative-bottom">
    <div class="container p-4">Exámenes UCA 2020-2021 Copyright-All rights reserved</div>
    </footer>
</body>
</html>