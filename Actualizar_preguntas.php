<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Actualizar preguntas</title>
</head>
<body>


<?php
    
    error_reporting(E_ALL & ~E_NOTICE);
    $enviar = $_POST['Confirmar'];
    $Seleccion_pregunta = $_POST['Seleccion_pregunta'];

    //Datos a meter en la base de datos
    $id_pregunta = $_REQUEST['id_pregunta'];
    $id_tema = $_REQUEST['id_tema'];
    $id_asignatura = $_REQUEST['id_asignatura'];
    $enunciado = $_REQUEST['enunciado'];
    $opA = $_REQUEST['opA'];
    $opB = $_REQUEST['opB'];
    $opC = $_REQUEST['opC'];
    $opD = $_REQUEST['opD'];
    $correcta = $_REQUEST['correcta'];

    //print(isset($enviar));

    $error = false;
    if (isset($enviar))
    {
        //print("<P>Comprobando errores.</P>");
        if (trim($id_pregunta) == "")
        {
            print("<P>ERROR01.</P>");
            $error = true;
        }
        if (trim($id_tema) == "")
        {
            print("<P>ERROR01.</P>");
            $error = true;
        }
        if (trim($id_asignatura) == "")
        {
            print("<P>ERROR1.</P>");
            $error = true;
        }
        if (trim($enunciado) == "")
        {
            print("<P>ERROR1.</P>");
            $error = true;
        }
        if (trim($opA) == "")
        {
            print("<P>ERROR2.</P>");
            $error = true;
        }
        if (trim($opB) == "")
        {
            print("<P>ERROR3.</P>");
            $error = true;
        }
        if (trim($opC) == "")
        {
            print("<P>ERROR4.</P>");
            $error = true;
        }
        if (trim($opD) == "")
        {
            print("<P>ERROR5.</P>");
            $error = true;
        }
        if (trim($correcta) == "")
        {
            print("<P>ERROR6.</P>");
            $error = true;
        }

    }
    //Si estan todos los datos metidos correctamente
    if (isset($enviar) && $error == false)
    { 
        include('connect.php');
        //print("<P>HOLA CONECTANDO CON BD2.</P>");
        //$conexion = mysqli_connect("localhost","cursophp", "","examenes_online")  or die ("No se puede conectar con el servidor");

        $instruccion = "update preguntas set id_tema='$id_tema', id_asignatura='$id_asignatura', enunciado='$enunciado', opA='$opA', opB='$opB', opC='$opC', opD='$opD', correcta='$correcta' where id_pregunta='$id_pregunta'";
        $actualizacion = mysqli_query ($conexion, $instruccion) or die ("Fallo al realizar la modificacion");

        mysqli_close($conexion);

        print('<div class="container">');
        print('<div class="jumbotron jumbotron-fluid text-center">');
        print('<h3>Pregunta actualizada</h3>');
        print("<P>Su pregunta ha sido actualizada.</P>");
        print('</div>');
        
        print('Pregunta');
        print('<div class="container-fluid border border-secondary rounded mb-1">');
        print('<div class="row">');
            print ("Enunciado: " . $enunciado);
            print('</div>');
            print('</div>');
        print('<div class="container-fluid border border-secondary rounded mb-1">');
        print('<div class="row">');
            print ("Opcion A: " . $opA);
            print('</div>');
            print('</div>');
        print('<div class="container-fluid border border-secondary rounded mb-1">');
        print('<div class="row">');
            print ("Opcion B: " . $opB);
            print('</div>');
            print('</div>');
        print('<div class="container-fluid border border-secondary rounded mb-1">');
        print('<div class="row">');
            print ("Opcion C: " . $opC);
            print('</div>');
            print('</div>');
        print('<div class="container-fluid border border-secondary rounded mb-1">');
        print('<div class="row">');
            print ("Opcion D: " . $opD);
            print('</div>');
            print('</div>');
        print('<div class="container-fluid border border-secondary rounded mb-1">');
        print('<div class="row">');
            print ("Correcta: " . $correcta);
            print('</div>');
            print('</div>');
        print("</td>");
        print("</table>");

        print('<div class="form-group">');
        print('<button onclick=location.href="menu_profesor.php" type="button" class="btn btn-primary">Menú</button>');
        print('<button onclick=location.href="Consulta_Actualizar_Preguntas.php" type="button" class="btn btn-primary ml-5">Actualizar nuevamente</button>');
        print('</div>');

        print('</div>');
        print('</div>');
    }

    else if(!isset($Seleccion_pregunta))
    {
?>
        <FORM ACTION="Actualizar_preguntas.php" METHOD="POST">

<?php

        print('<div class="container">');
        print('<div class="jumbotron jumbotron-fluid text-center">');
        print('<h3>Preguntas</h3>');
        print('<p>Genere la pregunta</p>');
        print('</div>');
        print('<div class="container pl-5 text-left">');

        print('Introduzca los datos de la pregunta:');

        print ("<TH>Estas son las preguntas del tema $id_tema y asignatura seleccionada $id_asignatura</TH>\n");
        include('connect.php');
        //$conexion = mysqli_connect("localhost","cursophp", "","examenes_online")  or die ("No se puede conectar con el servidor");

        $instruccion_id_pregunta = "select * from preguntas where id_tema='$id_tema' and id_asignatura='$id_asignatura'";
        $consulta_id_pregunta = mysqli_query ($conexion, $instruccion_id_pregunta) or die ("Fallo al realizar la insercion");
        
        $n_filas_id_pregunta = mysqli_num_rows($consulta_id_pregunta);

        if($n_filas_id_pregunta > 0)
        {
            print ("<TABLE class='table'>\n");
            print ("<TR>\n");
            print ("<TH scope='col'>Codigo de la pregunta</TH>\n");
            print ("<TH scope='col'>Codigo del Tema</TH>\n");
            print ("<TH scope='col'>Codigo de la asignatura</TH>\n");
            print ("<TH scope='col'>Enunciado</TH>\n");
            print ("<TH scope='col'>Opcion A</TH>\n");
            print ("<TH scope='col'>Opcion B</TH>\n");
            print ("<TH scope='col'>Opcion C</TH>\n");
            print ("<TH scope='col'>Opcion D</TH>\n");
            print ("<TH scope='col'>Correcta</TH>\n");

            print ("</TR>\n");

            for ($i=0; $i<$n_filas_id_pregunta; $i++)
            {
                $resultado_id_pregunta = mysqli_fetch_array ($consulta_id_pregunta);
                print ("<TR scope='row'>\n");
                print ("<TD>" . $resultado_id_pregunta['id_pregunta'] . "</TD>\n");
                print ("<TD>" . $resultado_id_pregunta['id_tema'] . "</TD>\n");
                print ("<TD>" . $resultado_id_pregunta['id_asignatura'] . "</TD>\n");
                print ("<TD>" . $resultado_id_pregunta['enunciado'] . "</TD>\n");
                print ("<TD>" . $resultado_id_pregunta['opA'] . "</TD>\n");
                print ("<TD>" . $resultado_id_pregunta['opB'] . "</TD>\n");
                print ("<TD>" . $resultado_id_pregunta['opC'] . "</TD>\n");
                print ("<TD>" . $resultado_id_pregunta['opD'] . "</TD>\n");
                print ("<TD>" . $resultado_id_pregunta['correcta'] . "</TD>\n");
                print ("</TR>\n");

            }
            print ("</TABLE>\n");

            
            $instruccion_id_pregunta = "select * from preguntas where id_tema='$id_tema' and id_asignatura='$id_asignatura'";
            $consulta_id_pregunta = mysqli_query ($conexion, $instruccion_id_pregunta) or die ("Fallo al realizar la insercion");

            print("<P>Seleccione le codigo de la pregunta que quieres modificar: </P>");

            $n_filas_id_pregunta2 = mysqli_num_rows($consulta_id_pregunta);

            if($n_filas_id_pregunta2  > 0)
            {   
                print("<select name='id_pregunta' class='form-select'>");
                for ($i=0; $i<$n_filas_id_pregunta2; $i++)
                {
                    $resultado_id_pregunta = mysqli_fetch_array ($consulta_id_pregunta);
                    print("<option>".$resultado_id_pregunta['id_pregunta']."</option>");
                }
                print("</select>");
                    
            }

            print("<input TYPE='hidden' NAME='id_asignatura' VALUE='$id_asignatura'>");
            print("<input TYPE='hidden' NAME='id_tema' VALUE='$id_tema'>");
        ?>
            <input type="submit" class="btn btn-primary ml-5" name="Seleccion_pregunta" value="Seleccion_pregunta">
    
        </FORM>
        
<?php
        }
        print('<div class="form-group">');
        print('<button onclick=location.href="menu_profesor.php" type="button" class="btn btn-primary">Menú</button>');
        print("</div>\n");
        print("</div>");
        print("</div>");
    }

    else
    {

?>
    <FORM ACTION="Actualizar_preguntas.php" METHOD="POST">

<?php

    include('connect.php');
    //$conexion = mysqli_connect("localhost","Profesor1", "123456abc","examenes_online")  or die ("No se puede conectar con el servidor");

    //Mostramos la pregunta seleccionada
    $instruccion4 = "select * from preguntas where id_pregunta='$id_pregunta' and id_tema='$id_tema' and id_asignatura='$id_asignatura'";
    $consulta4 = mysqli_query ($conexion, $instruccion4) or die ("Fallo al realizar la insercion");
    
    $n_filas3 = mysqli_num_rows($consulta4);
    
    print('<div class="container">');
    print('<div class="jumbotron jumbotron-fluid text-center">');
    print('<h3>Pregunta</h3>');
    print('<p>Actualice la pregunta</p>');
    print('</div>');

    print('<div class="container pl-5 text-left">');
    print("Introduzca los datos de la pregunta: <br>");

    if($n_filas3 > 0)
    {
        print ("<TABLE class='table'>\n");
        print ("<TR>\n");
        print ("<TH scope='col'>Codigo de la pregunta</TH>\n");
        print ("<TH scope='col'>Codigo del Tema</TH>\n");
        print ("<TH scope='col'>Codigo de la asignatura</TH>\n");
        print ("<TH scope='col'>Enunciado</TH>\n");
        print ("<TH scope='col'>Opcion A</TH>\n");
        print ("<TH scope='col'>Opcion B</TH>\n");
        print ("<TH scope='col'>Opcion C</TH>\n");
        print ("<TH scope='col'>Opcion D</TH>\n");
        print ("<TH scope='col'>Correcta</TH>\n");

        print ("</TR>\n");

        for ($i=0; $i<$n_filas3; $i++)
        {
            $resultado4 = mysqli_fetch_array ($consulta4);
            print ("<TR scope='row'>\n");
            print ("<TD>" . $resultado4['id_pregunta'] . "</TD>\n");
            print ("<TD>" . $resultado4['id_tema'] . "</TD>\n");
            print ("<TD>" . $resultado4['id_asignatura'] . "</TD>\n");
            print ("<TD>" . $resultado4['enunciado'] . "</TD>\n");
            print ("<TD>" . $resultado4['opA'] . "</TD>\n");
            print ("<TD>" . $resultado4['opB'] . "</TD>\n");
            print ("<TD>" . $resultado4['opC'] . "</TD>\n");
            print ("<TD>" . $resultado4['opD'] . "</TD>\n");
            print ("<TD>" . $resultado4['correcta'] . "</TD>\n");
            print ("</TR>\n");

        }
        print ("</TABLE>\n");
    }

   // mysqli_close($conexion);

?>
    <br><br>
    Introduzca los datos de la pregunta editada: <br>
    <!-- Indique el codigo de la pregunta: <input type="number" name="id_pregunta"> <br>    
    Indique el codigo del tema: <input type="number" name="id_tema"> <br>
    Indique el codigo de la asignatura:  <input type="number" name="id_asignatura"> <br>  -->
    <?php  

        /*print("<br> Indique el codigo de la pregunta:");
        print("<select name='id_pregunta'>");
        print("<option>".$id_pregunta."</option>");
        print("</select>"); 
         
        print("<br> Indique el codigo del tema:");
        print("<select name='id_tema'>");
        print("<option>".$id_tema."</option>");
        print("</select>"); 

        print("<br> Indique el codigo de la asignatura:");
        print("<select name='id_asignatura'>");
        print("<option>".$id_asignatura."</option>");
        print("</select>");*/
         

    ?>
    <br> 
    <div class="form-group">
        <label>Enunciado:</label>
        <textarea class="form-control" type="text" name="enunciado" size=200 required></textarea>
    </div>
    <div class="form-group">
        <label>Primera opción:</label>
        <input class="form-control" type="text" name="opA" size=100 required>
    </div>
    <div class="form-group">
        <label>Segunda opción:</label>
        <input class="form-control" type="text" name="opB" size=100 required>
    </div>
    <div class="form-group">
        <label>Tercera opción:</label>
        <input class="form-control" type="text" name="opC" size=100 required>
    </div>
    <div class="form-group">
        <label>Cuarta opción:</label>
        <input class="form-control" type="text" name="opD" size=100 required>
    </div>

    <div class="form-group">
        <label>Seleccione la opción correcta:</label>
        <select class="form-select" name="correcta">
            <option> 1 </option>
            <option> 2 </option>
            <option> 3 </option>
            <option> 4 </option>
        </select>

    <?php
        print("<input TYPE='hidden' NAME='id_asignatura' VALUE='$id_asignatura'>");
        print("<input TYPE='hidden' NAME='id_tema' VALUE='$id_tema'>");
        print("<input TYPE='hidden' NAME='id_pregunta' VALUE='$id_pregunta'>");
    ?>
    <input type="submit" class="btn btn-primary ml-5" name="Confirmar" value="Confirmar">
    </div>
</FORM>
    </div>
    </div>

<?php

    }
?>
    <footer class="bg-dark text-center text-white mt-5 relative-bottom">
        <div class="container p-4">Exámenes UCA 2020-2021 Copyright-All rights reserved</div>
    </footer>
</body>
</html>