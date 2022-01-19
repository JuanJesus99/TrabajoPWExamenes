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
    //Declaramos variables que obtenemos de Consulta_Eliminar_Preguntas.php y el id_tema que lo obtenemos en este .php
    error_reporting(E_ALL & ~E_NOTICE);
    $enviar = $_POST['Confirmar'];
    $id_asignatura=$_POST['id_asignatura'];
    $id_tema=$_POST['id_tema'];
    $id_pregunta=$_POST['id_pregunta'];
    $listaid=$_POST['listaid'];
    print(isset($enviar));
    include('connect.php');

    //Obtenemos fecha del sistema actual
    $d=date("d");
    $m=date("m");
    $a=date("Y");

    $fecha=$a.'-'.$m.'-'.$d;


    if(!isset($listaid))
    {
?>

        <form action="Eliminar_preguntas.php" method="POST">

    <?php

        print('<div class="container">');
        print('<div class="jumbotron jumbotron-fluid text-center">');
        print('<h3>Preguntas</h3>');
        print('<p>Selecciona las preguntas que desea eliminar</p>');
        print('</div>');
        
        $instruccion1="select * from preguntas where id_asignatura=$id_asignatura AND id_tema=$id_tema";
        //$instruccion1="select id_pregunta, enunciado from preguntas where id_asignatura=4 AND id_tema=1";
        $consulta1= mysqli_query($conexion,$instruccion1) or die ("Fallo en la conexion con base de datos");

        $filas1=mysqli_num_rows($consulta1);

        //TABLA DE ENUNCIADO E ID
        if ($filas1 > 0)
        {
            print ("<TABLE class='table'>\n");
            print ("<TR>\n");
            print ("<TH scope='col'>Id_pregunta</TH>\n");
            print ("<TH scope='col'>Enunciado</TH>\n");
            print ("</TR>\n");

            for($j=0; $j<$filas1; $j++)
            {
                $result2= mysqli_fetch_array ($consulta1);
                print ("<TR scope='row'>\n");
                print ("<TD>" . $result2 ['id_pregunta'] . "</TD>\n");
                print ("<TD>" . $result2 ['enunciado'] . "</TD>\n");
                print("<TD><input type='checkbox' name='listaid[]' value='" . $result2['id_pregunta'] ."'></TD>\n");
                print ("</TR>\n");

            }
            print("</TABLE>\n");

        ?>

            <input type="submit" class="btn btn-primary ml-5" name="confirmareliminacion" value="Confirmar">

            </form>

        <?php
        }
        print('<div class="form-group">');
        print('<button onclick=location.href="menu_profesor.php" type="button" class="btn btn-primary">Menú</button>');
        print("</div>\n");

    }else{
        $nfilas=count($listaid);

        print('<div class="jumbotron jumbotron-fluid text-center">');
        print('<h3>Preguntas</h3>');

        for($i=0; $i<$nfilas; $i++)
        {

            $sql3="select id_examen from examen_pregunta where id_pregunta=$listaid[$i]";
            $consulta2=mysqli_query($conexion,$sql3) or die ("Error obtener id_examen");


            //Numero filas examenes a eliminar
            $nfilas2=mysqli_num_rows($consulta2);
            //-------------------------------------------------------------------------------------------


            if($nfilas2 > 0){
            //Sacar vector de los id_examen de los examenes que tienen la pregunta que queremos eliminar
            for($k=0;$k<$nfilas2;$k++){
                
                $resultado=mysqli_fetch_array($consulta2)or die ("Error al obtener la lista de examenes a eliminar");
                $listaex[$k]=$resultado['id_examen'];

            }

          

            //Sacar vector del fecha de los exmenes que queremos eliminar para ver si se han hecho ya o no
            for($l=0;$l<$nfilas2;$l++){

                $sql4="select fecha_inicio from examenes where id_examen=$listaex[$l]";
                $consulta3=mysqli_query($conexion,$sql4)or die ("Error al sacar la lista de fecha");
    
                $resultado2=mysqli_fetch_array($consulta3);
                $listafech[$l]=$resultado2['fecha_inicio'];

            }


            for($m=0;$m<$nfilas2;$m++){

                if($fecha < $listafech[$m] ){

                    $eliminarex_pregunta="delete FROM examen_pregunta WHERE id_examen=$listaex[$m]";
                    mysqli_query($conexion,$eliminarex_pregunta) or die ("Fallo al eliminar examen_preguntas");

                    $eliminarex="delete FROM examenes WHERE id_examen=$listaex[$m]";
                    mysqli_query($conexion,$eliminarex) or die ("Fallo en eliminar el examen");

                    
                    print("<p>Los examenes que conmparten esa pregunta han sido eliminados<p><BR>");
                }

            }


            
        
        }
            //------------------------------------------------------------------------------------------

            //NULL id_pregunta de la tabla examen_pregunta
            $sql1="update examen_pregunta set id_pregunta= null where id_pregunta=$listaid[$i]";
            mysqli_query($conexion,$sql1) or die ("Fallo consulta de Update tabla examen_pregunta");

            //NULL id_pregunta de la tabla examen_respuesta
            $sql2="update examen_respuesta set id_pregunta= null where id_pregunta=$listaid[$i]";
            mysqli_query($conexion,$sql2) or die ("Fallo consulta de Update tabla examen_respuesta");
            
            //Borramos con DELETE la pregunta de la tabla preguntas
            $instruccion3="delete FROM preguntas WHERE id_pregunta=$listaid[$i]";
            mysqli_query($conexion, $instruccion3) or die ("Fallo en la consulta");

    
    }

    
    print('<p>Las preguntas han sido eliminadas</p>');
    print('</div>');
    print('<div class="form-group">');
    print('<button onclick=location.href="menu_profesor.php" type="button" class="btn btn-primary">Menú</button>');
    print("</div>\n");

//Cerramos conexion
mysqli_close($conexion);

}

?>
<footer class="bg-dark text-center text-white mt-5 relative-bottom">
    <div class="container p-4">Exámenes UCA 2020-2021 Copyright-All rights reserved</div>
</footer>

</body>
</html>