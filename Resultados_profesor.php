<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title> Ver resultados</title>
</head>
<body>

<?php
    session_start();
    if(!isset($_SESSION['id_usuario'])){
        header('Location: login.php');
        exit;
    }
    else
    {

        include('connect.php');
        error_reporting(E_ALL & ~E_NOTICE);

        // $id_profesor = 3;
        $id_profesor = $_SESSION['id_usuario'];

        $Selecion_examen = $_POST['id_examen'];
        $envio_examen = $_POST['Calificar'];
        //print(isset($Selecion_examen));

        if ((!isset($Selecion_examen)))
        {
            print('<div class="container">');
            print('<div class="jumbotron jumbotron-fluid text-center">');
            print('<h3>Exámenes</h3>');
            print('<p>Exámenes disponibles</p>');
            print('</div>');
            print('<div class="container pl-5 text-left">');

            print("<FORM ACTION='Resultados_profesor.php' METHOD='POST'>");

            $consulta_1 =  "select id_asignatura from profesor_asignatura where id_profesor = '$id_profesor' ";
            $ids_asignatura = mysqli_query ($conexion, $consulta_1) or die ("Fallo al realizar la consulta1");
 
            print("<P>Selecciona el examen que desee ver los resultados </P>");

            $n_filas_1 = mysqli_num_rows($ids_asignatura);

            if($n_filas_1 > 0)
            {
                for ($i=0; $i<$n_filas_1; $i++)
                {
                    /*Id de la asignatura*/
                    $resultado_1 = mysqli_fetch_array ($ids_asignatura);
                    $consulta_id_asig_1 = $resultado_1['id_asignatura'];

                    /*Nombre de la asignatura*/
                    $name_consulta =  "select nombre from asignatura where id_asignatura = '$consulta_id_asig_1'";
                    $name_result = mysqli_query($conexion, $name_consulta) or die("Fallo al realizar la consulta2");
                    $fetched_name = mysqli_fetch_array($name_result);
                    $nombre_asignatura = $fetched_name['nombre'];

                    /*Exámenes de la asignatura*/
                    $instruccion_examen = "select * from examenes where id_asignatura='$consulta_id_asig_1'";
                    $consulta_examen  = mysqli_query ($conexion, $instruccion_examen ) or die ("Fallo al realizar la consulta3");

                    $n_filas_examen  = mysqli_num_rows($consulta_examen);
                    if($n_filas_examen  > 0)
                    {
                        for ($j=0; $j<$n_filas_examen; $j++)
                        {
                            print('<div class="container-fluid border border-secondary rounded mb-1">');
                            print('<div class="row">');
                                print('<div class="col-md-10">');
                                    $resultado_examen  = mysqli_fetch_array ($consulta_examen );
                                    print("<div class='mt-2'>Exámen de ".$consulta_id_asig_1." ".$nombre_asignatura.". Fecha: ".$resultado_examen['fecha_inicio'].". </div>");
                                print('</div>');
                                print('<div class="col-md-2">');
                                    print("<button type='submit' class='btn btn-success m-1' name='id_examen' value='".$resultado_examen['id_examen']."'>Ver</button>");
                                    print("<br>");
                                print('</div>');
                            print('</div>');
                                
                            print('</div>');
                        }
                    }
                }
            }
            print('<button onclick=location.href="menu_profesor.php" type="button" class="btn btn-primary my-4">Menú</button>');
            print("</form>");
            print('</div>');
            print('</div>');
        }
        else
        {
            //print("$Selecion_examen");

            print('<div class="container">');
            print('<div class="jumbotron jumbotron-fluid text-center">');
            print('<h3>Resultados</h3>');
            print('<p>Resultados y estadísticas del examen</p>');
            print('</div>');

            print('<div class="container pl-5 text-left">');

            $instruccion_examen = "select * from examen_calificacion where id_examen='$Selecion_examen'";
            $consulta_examen  = mysqli_query ($conexion, $instruccion_examen ) or die ("Fallo al realizar la consulta de calificacion");

            $n_filas_examen  = mysqli_num_rows($consulta_examen);

            if($n_filas_examen  > 0)
            {
                $nota_acumulada = 0;
                $suspenso = 0;
                $aprobado = 0;
                $notable = 0;
                $sobresaliente = 0;

                print("<h4>Calificaciones por alumno</h4>");

                for ($j=0; $j<$n_filas_examen; $j++)
                {
                    $resultado_examen  = mysqli_fetch_array ($consulta_examen);
                    $id_estudiante = $resultado_examen['id_estudiante'];

                    //Nombre del estudiante
                    $instruccion_nombre = "select nombre from usuario where id_usuario = '$id_estudiante'";
                    $consulta_nombre = mysqli_query ($conexion, $instruccion_nombre ) or die ("Fallo al realizar la consulta de obtencion del nombre del estudiante");
                    $resultado_nombre  = mysqli_fetch_array ($consulta_nombre);
                    $nombre_alumno = $resultado_nombre['nombre'];
                    $nota = $resultado_examen['nota'];

                    print('<div class="container-fluid border border-secondary rounded mb-1">');
                    print("Alumno: $nombre_alumno NOTA: $nota <br>");
                    print('</div>');
                    //Vamos sumando para hacer la media
                    $nota_acumulada += $nota;

                    //Metemos la nota en su grupo
                    if($nota >= 9)
                        $sobresaliente++;
                    else if($nota < 9 && $nota >=7)
                        $notable++;
                    else if($nota < 7 && $nota >=5)
                        $aprobado++;
                    else if($nota < 5)
                        $suspenso++;
                }
                /*Estadísticas*/
                $n_filas_examen;

                print("<h4 class='my-3'>Estadísticas</h4>");
                /*print("<br>Sobresalientes: $sobresaliente");
                print("<br>Notables: $notable");
                print("<br>Aprobados: $aprobado");
                print("<br>Suspensos: $suspenso");*/

                $sobresaliente_ = $sobresaliente*100/$n_filas_examen;
                $notable_ = $notable*100/$n_filas_examen;
                $aprobado_ = $aprobado*100/$n_filas_examen;
                $suspenso_ = $suspenso*100/$n_filas_examen;

                print("<h5 class=>Calificaciones</h5>");
                print('<div class="progress my-3">');
                    print('<div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: '.$sobresaliente_.'%" aria-valuenow="'.$sobresaliente_.'" aria-valuemin="0" aria-valuemax="100">Sobresaliente '.$sobresaliente.'</div>');
                    print('<div class="progress-bar progress-bar-striped" role="progressbar" style="width: '.$notable_.'%" aria-valuenow="'.$notable_.'" aria-valuemin="0" aria-valuemax="100">Notable '.$notable.'</div>');
                    print('<div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: '.$aprobado_.'%" aria-valuenow="'.$aprobado_.'" aria-valuemin="0" aria-valuemax="100">Apto '.$aprobado.'</div>');
                    print('<div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: '.$suspenso_.'%" aria-valuenow="'.$suspenso_.'" aria-valuemin="0" aria-valuemax="100">Suspenso '.$suspenso.'</div>');
                print('</div>');

                $media = $nota_acumulada / $n_filas_examen;
                $media_ = $media*10;
                print("<h5 class=>Media</h5>");
                print('<div class="progress">');
                    print('<div class="progress-bar progress-bar-striped" role="progressbar" style="width: '.$media_.'%" aria-valuenow="'.$media_.'" aria-valuemin="0" aria-valuemax="100">Media '.$media.'</div>');
                print('</div>');
            }
            else
            {
                print("Este examen aún no se ha realizado");
            }

            print('<button onclick=location.href="Resultados_profesor.php" type="button" class="btn btn-primary my-4 mr-4">Volver</button>');
            print('<button onclick=location.href="menu_profesor.php" type="button" class="btn btn-primary my-4">Menú</button>');
            print("</div>");
            print("</div>");
        }
    }
    ?>
    <footer class="bg-dark text-center text-white mt-5 relative-bottom">
        <div class="container p-4">Exámenes UCA 2020-2021 Copyright-All rights reserved</div>
    </footer>
</body>
</html>