<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title> Realizar Examen</title>
</head>
<body>

<?php
    session_start();
    if(!isset($_SESSION['id_usuario']) || $_SESSION['rol'] != 'estudiante'){
        header('Location: login.php');
        exit;
    }
    else
    {
        include('connect.php');
        error_reporting(E_ALL & ~E_NOTICE);

        $id_estudiante = $_SESSION['id_usuario'];

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

            print("<FORM ACTION='Examen_estudiante.php' METHOD='POST'>");

            $consulta_1 =  "select id_asignatura from estudiantes_asignaturas where id_estudiante = '".$id_estudiante."' ";
            $ids_asignatura = mysqli_query ($conexion, $consulta_1) or die ("Fallo al realizar la consulta1");
 
            $n_filas_1 = mysqli_num_rows($ids_asignatura);

            if($n_filas_1 > 0)
            {
                print("<P>Selecciona el examen que desee realizar: </P>");

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
                    $fecha_actual = date("Y-m-d");
                    $instruccion_examen = "select * from examenes where id_asignatura='$consulta_id_asig_1' and fecha_inicio <= '$fecha_actual'";
                    $consulta_examen  = mysqli_query ($conexion, $instruccion_examen ) or die ("Fallo al realizar la consulta3");

                $n_filas_examen  = mysqli_num_rows($consulta_examen);
                if ($n_filas_examen  > 0) {
                    for ($j = 0; $j < $n_filas_examen; $j++) {

                        $resultado_examen  = mysqli_fetch_array($consulta_examen);
                        if ($fecha_actual >= $resultado_examen['fecha_inicio']) {

                            $c_ = "select * from examen_calificacion where id_examen = '" . $resultado_examen['id_examen'] . "' and id_estudiante = '$id_estudiante'";
                            $res_c = mysqli_query($conexion, $c_);
                            $num_rows_ = mysqli_num_rows($res_c);
                            if ($num_rows_) {

                                print('<div class="container-fluid border border-secondary rounded mb-1">');
                                print('<div class="row">');
                                print('<div class="col-md-10">');
                                print("<div class='mt-2'>Examen de " . $consulta_id_asig_1 . " " . $nombre_asignatura . ". Fecha: " . $resultado_examen['fecha_inicio'] . ". </div>");
                                print('</div>');
                                print('<div class="col-md-2">');
                                print("<button type='submit' class='btn btn-warning m-1' name='id_examen' value='" . $resultado_examen['id_examen'] . "'>Revisar</button>");
                                print("<br>");
                                print('</div>');
                                print('</div>');
                                print('</div>');
                            } else {
                                if ($fecha_actual == $resultado_examen['fecha_inicio']) {
                                    print('<div class="container-fluid border border-secondary rounded mb-1">');
                                    print('<div class="row">');
                                    print('<div class="col-md-10">');
                                    print("<div class='mt-2'>Examen de " . $consulta_id_asig_1 . " " . $nombre_asignatura . ". Fecha: " . $resultado_examen['fecha_inicio'] . ". </div>");
                                    print('</div>');
                                    print('<div class="col-md-2">');
                                    print("<button type='submit' class='btn btn-success m-1' name='id_examen' value='" . $resultado_examen['id_examen'] . "'>Realizar</button>");
                                    print("<br>");
                                    print('</div>');
                                    print('</div>');
                                    print('</div>');
                                }
                            }
                        }
                    }
                }
            }
        }
            print("</form>");

            print('<button onclick=location.href="menu_alumno.php" type="button" class="btn btn-primary">Menú</button>');

            print('</div>');
            print('</div>');
        }
        else
        {
            /*SI EL EXÁMEN HA SIDO RESUELTO POR EL ALUMNO ÚNICAMENTE MOSTRARÁ UNA REVISIÓN DEL MISMO*/

            

            $consulta_comprobar_examen_resuelto = "select id_pregunta, respuesta_alumno from examen_respuesta where id_examen='$Selecion_examen' and id_estudiante='$id_estudiante'";
            $resultado_comprobar_examen_resuelto = mysqli_query($conexion, $consulta_comprobar_examen_resuelto) or die("Error al comprobar la realización del exámen");
            $n_filas_resultado_comprobar_er = mysqli_num_rows($resultado_comprobar_examen_resuelto);
            
            if($n_filas_resultado_comprobar_er != 0)
            {
                print('<div class="container">');
                print('<div class="jumbotron jumbotron-fluid text-center">');
                print('<h3>Revisión de exámen</h3>');
                print('<p>A continuación se muestran los detalles de su exámen</p>');
                print('</div>');

                print('<div class="container pl-5 text-left">');
                print('<h4>Preguntas erradas</h4>');

                for($i=0;$i<$n_filas_resultado_comprobar_er;$i++)
                {
                    $fetch_comprobar_examen_resuelto = mysqli_fetch_array($resultado_comprobar_examen_resuelto);
                    $id_pregunta = $fetch_comprobar_examen_resuelto['id_pregunta'];
                    $respuesta_a_comprobar = $fetch_comprobar_examen_resuelto['respuesta_alumno'];
                    
                    /*Consulta Respuesta*/
                    $consulta_respuesta = "select enunciado, opA, opB, opC, opD, correcta from preguntas where id_pregunta='$id_pregunta'";
                    $resultado_respuesta = mysqli_query($conexion, $consulta_respuesta) or die("Error al obtener la respuesta (Ver notas)");
                    $fetch_respuesta = mysqli_fetch_array($resultado_respuesta);
                    $respuesta_check = $fetch_respuesta['correcta'];

                    if($respuesta_a_comprobar != 0){
                        if($respuesta_a_comprobar != $respuesta_check)
                        {
                            print('<div class="container-fluid border border-secondary rounded mb-1">');
                            print('<div class="input-group m-2">');
                            print('<div class="form-check">');

                            print("<label class='font-weight-bold'>".$fetch_respuesta['enunciado']."</label><br>");       // Enunciado
                            print("<label class='form-check-label'>No responder</label><br>");
                            print("<label class='form-check-label'>".$fetch_respuesta['opA']."</label><br>");
                            print("<label class='form-check-label'>".$fetch_respuesta['opB']."</label><br>");
                            print("<label class='form-check-label'>".$fetch_respuesta['opC']."</label><br>");
                            print("<label class='form-check-label'>".$fetch_respuesta['opD']."</label><br>");

                            print('</div>');
                            print('</div>');
                            print('</div>');

                            print('<div class="container-fluid border border-secondary rounded mb-1 bg-danger text-white opacity-2 font-weight-bold">');
                            print("Respuesta seleccionada <br>");
                            switch($respuesta_a_comprobar){

                                case 0: print("No responder <br>");
                                    break;
                                case 1: print("<label>".$fetch_respuesta['opA']."</label><br>");
                                    break;
                                case 2: print("<label>".$fetch_respuesta['opB']."</label><br>");
                                    break;
                                case 3: print("<label>".$fetch_respuesta['opC']."</label><br>");
                                    break;
                                case 4: print("<label>".$fetch_respuesta['opD']."</label><br>");
                                    break;
                            }
                            print('</div>');

                            print('<div class="container-fluid border border-secondary rounded mb-1 bg-success  text-white opacity-2 font-weight-bold">');
                            print("Respuesta correcta <br>");
                            switch($respuesta_check){

                                case 0: print("No responder <br>");
                                    break;
                                case 1: print("<label>".$fetch_respuesta['opA']."</label><br>");
                                    break;
                                case 2: print("<label>".$fetch_respuesta['opB']."</label><br>");
                                    break;
                                case 3: print("<label>".$fetch_respuesta['opC']."</label><br>");
                                    break;
                                case 4: print("<label>".$fetch_respuesta['opD']."</label><br>");
                                    break;
                            }
                            print('</div>');
                        }
                    }
                }
                $consuta_nota = "select nota from examen_calificacion where id_examen='$Selecion_examen' and id_estudiante='$id_estudiante'";
                $resultado_consulta_nota = mysqli_query($conexion, $consuta_nota) or die("Error al obtener la nota");
                $fetch_nota = mysqli_fetch_array($resultado_consulta_nota);
                $nota = $fetch_nota['nota'];

                print('<div class="text-dark font-weight-bold mt-3 mb-3">');
                print("<h3>Nota: ".$nota."</h3>");
                print('</div>');

                print('<div class="form-group">');
                print('<button onclick=location.href="menu_alumno.php" type="button" class="btn btn-primary">Menú</button>');
                print("</div>\n");

                print('</div>');
                print('</div>');
            }
            else
            {
                if(!isset($envio_examen))
                {
                    print("<FORM ACTION='Examen_estudiante.php' METHOD='POST'>");

                    print('<div class="container">');
                    print('<div class="jumbotron jumbotron-fluid text-center">');
                    print('<h3>Examen</h3>');
                    print('<p>Examen en curso</p>');
                    print('</div>');
                    print('<div class="container pl-5 text-left">');

                    //print("Exámen ".$Selecion_examen);

                    /*Id pregunta*/
                    $consulta_id_preguntas = "select id_pregunta from examen_pregunta where id_examen='$Selecion_examen'";
                    $resultado_id_preguntas = mysqli_query($conexion, $consulta_id_preguntas) or die("Error al obtener id preguntas");

                    $n_filas_1 = mysqli_num_rows($resultado_id_preguntas);
                    if($n_filas_1>0)
                    {
                        for ($i=0; $i<$n_filas_1; $i++)
                        {
                            /*Id pregunta*/
                            $fetch_preguntas = mysqli_fetch_array($resultado_id_preguntas);
                            $id_pregunta = $fetch_preguntas['id_pregunta'];
                            //print($id_pregunta);
                            /*Campos de pregunta*/
                            $consulta_campos_pregunta = "select enunciado, opA, opB, opC, opD from preguntas where id_pregunta='$id_pregunta'";
                            $resultado_campos_pregunta = mysqli_query($conexion, $consulta_campos_pregunta) or die("Error al obtener campos de pregunta");
                            $fetched_campos = mysqli_fetch_array($resultado_campos_pregunta);

                            /*Pregunta*/
                            print('<div class="container-fluid border border-secondary rounded mb-1">');
                            print('<div class="input-group m-2">');
                            
                                print("<p  class='form-check-label font-weight-bold'>Pregunta ".($i+1).":<br><p>");
                            print('<div class="form-check">');
                                print("<label class='form-check-label font-weight-bold'>".$fetched_campos['enunciado']."</label><br>");       // Enunciado

                                print('<input class="form-check-input" type="radio" name="'.$id_pregunta.'" value="0">');    // OpA
                                print("<label class='form-check-label'>No responder</label><br>");

                                print('<input class="form-check-input" type="radio" name="'.$id_pregunta.'" value="1">');    // OpA
                                print("<label class='form-check-label'>".$fetched_campos['opA']."</label><br>");

                                print('<input class="form-check-input" type="radio" name="'.$id_pregunta.'" value="2">');    // OpB
                                print("<label class='form-check-label'>".$fetched_campos['opB']."</label><br>");

                                print('<input class="form-check-input" type="radio" name="'.$id_pregunta.'" value="3">');    // OpC
                                print("<label class='form-check-label'>".$fetched_campos['opC']."</label><br>");

                                print('<input class="form-check-input" type="radio" name="'.$id_pregunta.'" value="4">');    // OpD
                                print("<label class='form-check-label'>".$fetched_campos['opD']."</label><br>");
                            print('</div>');
                                print("<br>");
                            print('</div>');
                            print('</div>');
                        }
                    }
                        print('<input type="hidden" name="id_examen" value="'.$Selecion_examen.'">');
                        print('<input type="submit" class="btn btn-primary mb-5 mt-3" name="Calificar" value="Enviar">');
                    print("</form>");
                    print('</div>');
                    print('</div>');

                }
                else
                {
                    /*Calificar exámen*/

                    /*Id preguntas*/
                    $consulta_id_preguntas = "select id_pregunta from examen_pregunta where id_examen='".$_POST['id_examen']."'";
                    $resultado_id_preguntas = mysqli_query($conexion, $consulta_id_preguntas) or die("Error al obtener id preguntas");
                    
                    $n_filas_1 = mysqli_num_rows($resultado_id_preguntas);

                    print('<div class="container">');
                    print('<div class="jumbotron jumbotron-fluid text-center">');
                    print('<h3>Examen finalizado</h3>');
                    print('<p>El examen ha concluido correctamente, continue para revisión</p>');
                    print('</div>');
                    
                    /*Ponderación*/
                    $bien = 10/$n_filas_1;
                    $mal = $bien/3;
                    $nota = 0;

                    if($n_filas_1>0)
                    {
                        for($i=0;$i<$n_filas_1;$i++)
                        {
                            $fetch_id_preguntas = mysqli_fetch_array($resultado_id_preguntas);
                            $id_pregunta = $fetch_id_preguntas['id_pregunta'];

                            /*Consulta Respuesta*/
                            $consulta_respuesta = "select correcta from preguntas where id_pregunta='$id_pregunta'";
                            $resultado_respuesta = mysqli_query($conexion, $consulta_respuesta) or die("Error al obtener la respuesta");
                            $fetch_respuesta = mysqli_fetch_array($resultado_respuesta);
                            $respuesta_check = $fetch_respuesta['correcta'];

                            /*Almacenamiento de las respuestas*/
                            $respuesta_alumno = 0;
                            if(!empty($_POST[$id_pregunta])){
                                $respuesta_alumno = $_POST[$id_pregunta];
                            }
                            $consulta_almacenar_respuesta = "insert into examen_respuesta (id_examen, id_estudiante, id_pregunta, respuesta_alumno) values(".$_POST['id_examen'].",".$id_estudiante.",".$id_pregunta.",".$respuesta_alumno.")";
                            $resultado_almacenar_respuesta = mysqli_query($conexion, $consulta_almacenar_respuesta) or die("Error al actualizar respuesta");
                            
                            /*Calificación*/
                            if($respuesta_alumno != 0)
                            {
                                if($respuesta_alumno == $respuesta_check)
                                {
                                    $nota = $nota + $bien;
                                }
                                else
                                {
                                    $nota = $nota - $mal;
                                }
                            }
                        }
                        print("<FORM ACTION='Examen_estudiante.php' METHOD='POST'>");
                        print('<input type="hidden" name="id_examen" value="'.$Selecion_examen.'">');
                        print('<input type="submit" class="btn btn-primary mb-5 mt-3" name="Continuar" value="Continuar">');
                        print('</form>');
                        print('</div>');

                        $consulta_almacenar_nota = "insert into examen_calificacion(id_examen, id_estudiante, nota) values (".$_POST['id_examen'].",$id_estudiante,$nota)";
                        $resultado_consulta_almacenar = mysqli_query($conexion, $consulta_almacenar_nota) or die("Error al almacenar la nota");
                    }
                }
            }
        }
    }
    ?>
    <footer class="bg-dark text-center text-white mt-5 relative-bottom">
        <div class="container p-4">Exámenes UCA 2020-2021 Copyright-All rights reserved</div>
    </footer>
</body>
</html>