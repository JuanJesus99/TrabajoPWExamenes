<html>
	<head>
		<title>Menu</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="estilos.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>

	<body>
        <?php
            include('connect.php');
            session_start();
            if(!isset($_SESSION['id_usuario']) || $_SESSION['rol'] != 'profesor'){
                header('Location: login.php');
                exit;
            }else{
        ?>
        <div class="container">
            <div class="row menu-title mb-5">
            <h3 class="display-3">
                Menú
                <small class="text-muted">Profesor</small>
            </h3>
            </div>
            <div class="row">
                <div class="col">
                    <div class="container mt-5">
                        <div class="row">   <!---->
                            <div class="col">   <!--imagen-->
                                <img src="default-user-image.png" class="rounded float-left" alt="..." width="200" height="200">
                            </div>
                            <div class="col">   <!--nombre-->
                                <?php 
                                    $id = $_SESSION['id_usuario'];
                                    $consulta = "select nombre,nombre_usuario from usuario where id_usuario='$id'";
                                    $mysql_consulta = mysqli_query($conexion, $consulta) or die('Error');
                                    $fetch = mysqli_fetch_array($mysql_consulta);
                                    echo 'Nombre: '.$fetch['nombre'].'</br>';
                                    echo 'Usuario: '.$fetch['nombre_usuario'].'</br>';
                                ?>
                            </div>
                        </div>
                        <button type="button" onclick=location.href="cerrar_sesion.php" class="btn btn-danger mt-3">Salir</button>
                    </div>
                </div>
                <div class="col">
                    <div class="container mt-5 px-5">
                        <div class="row px-5">
                            <h4>Preguntas</h4>
                            <button onclick=location.href="Consulta_Rellenar_preguntas.php" type="button" class="btn btn-light btn-block">Insertar</button>
                            <button onclick=location.href="Consulta_Actualizar_preguntas.php" type="button" class="btn btn-light btn-block">Editar</button>
                            <button onclick=location.href="Consulta_Leer_preguntas.php" type="button" class="btn btn-light btn-block">Ver</button>
                            <button onclick=location.href="Consulta_Eliminar_preguntas.php" type="button" class="btn btn-light btn-block">Eliminar</button>
                            <h4>Exámenes</h4>
                            <button onclick=location.href="Generar_examen.php" type="button" class="btn btn-light btn-block">Planificar</button>
                            <button onclick=location.href="Resultados_profesor.php" type="button" class="btn btn-light btn-block">Resultados</button>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

        <?php
            }
        ?>

	</body>
</html>