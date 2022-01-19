<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Crear Preguntas</title>
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
    //Datos a meter en la base de datos
    $id_asignatura = $_REQUEST['id_asignatura'];
    $id_tema = $_REQUEST['id_tema'];
    $enunciado = $_REQUEST['enunciado'];
    $opA = $_REQUEST['opA'];
    $opB = $_REQUEST['opB'];
    $opC = $_REQUEST['opC'];
    $opD = $_REQUEST['opD'];
    $correcta = $_REQUEST['correcta'];

    //echo $id_tema;
    //echo $id_asignatura;

    //print(isset($enviar));
    //print(isset($Selecion_asignatura));
    $error = false;

    if (isset($enviar))
    {
        //print("<P>Comprobando errores.</P>");
        if (trim($id_asignatura) == "")
        {
            echo $id_asignatura;
            print("<P>ERROR1.</P>");
            $error = true;
        }
        if (trim($id_tema) == "")
        {
            echo $id_tema;
            print("<P>ERROR01.</P>");
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
        //print("<P>HOLA CONECTANDO CON BD.</P>");
        //$conexion = mysqli_connect("localhost","Profesor1", "123456abc","examenes_online")  or die ("No se puede conectar con el servidor");

        $instruccion = "insert into preguntas (id_tema, id_asignatura, enunciado, opA, opB, opC, opD, correcta) values ('$id_tema','$id_asignatura','$enunciado', '$opA', '$opB', '$opC', '$opD', '$correcta')";
        /*echo $id_tema;
        echo $id_asignatura;
        echo $enunciado;
        echo $opA;
        echo $opB;
        echo $opC;
        echo $opD;
        echo $correcta;*/
        $insercion = mysqli_query ($conexion, $instruccion) or die ("Fallo al realizar la insercion");

        mysqli_close($conexion);

        print('<div class="container">');
        print('<div class="jumbotron jumbotron-fluid text-center">');
        print('<h3>Pregunta registrada</h3>');
        print("<P>Su pregunta ha sido registrada.</P>");
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
        print('<button onclick=location.href="Consulta_Rellenar_Preguntas.php" type="button" class="btn btn-primary ml-5">Nueva pregunta</button>');
        print('</div>');
    }

    else
    {

?>
    <FORM ACTION="Rellenar_preguntas.php" METHOD="POST">
    
<?php
    print('<div class="container">');
    print('<div class="jumbotron jumbotron-fluid text-center">');
    print('<h3>Preguntas</h3>');
    print('<p>Genere la pregunta</p>');
    print('</div>');
    print('<div class="container pl-5 text-left">');

    print('Introduzca los datos de la pregunta:');

    //mysqli_close($conexion);

?>    
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
        ?>
        <input type="submit" class="btn btn-primary ml-5" name="Confirmar" value="Confirmar">
    </div>

    </FORM>
    </div>
    </div>

<?php
    }
}
?>
    <footer class="bg-dark text-center text-white mt-5 relative-bottom">
        <div class="container p-4">Exámenes UCA 2020-2021 Copyright-All rights reserved</div>
    </footer>
</body>
</html>