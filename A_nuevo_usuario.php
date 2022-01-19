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
    if(!isset($_SESSION['id_usuario']) || $_SESSION['rol'] != 'administrador'){
        header('Location: login.php');
        exit;
    }else{

    include('connect.php');
    error_reporting(E_ALL & ~E_NOTICE);
    $enviar = $_POST['Confirmar'];

    if (isset($enviar))
    {
        $nombre = trim($_POST['nombre']);
        $nombre_usuario = trim($_POST['nombre_usuario']);
        $contrasenna = trim($_POST['contrasenna']);
        $rol = trim($_POST['rol']);

        if($nombre==""||$nombre_usuario==""||$contrasenna==""||$rol==""){
            header('Location: A_nuevo_usuario.php');
        }else{
            $consulta = "insert into usuario(nombre, nombre_usuario, password, rol) values('$nombre','$nombre_usuario','$contrasenna','$rol')";
            $resultado = mysqli_query($conexion, $consulta);

            if($resultado){

                print('<div class="container">');
                print('<div class="jumbotron jumbotron-fluid text-center">');
                print('<h3>Éxito</h3>');
                print('<p>Usuario introducido correctamente en el sistema</p>');
                print('</div>');
                print('<div class="container pl-5 text-left">');

                print('<div class="container-fluid border border-secondary rounded mb-1">');
                    print('<div class="row">');
                        print ("Nombre: " . $nombre);
                    print('</div>');
                print('</div>');

                print('<div class="container-fluid border border-secondary rounded mb-1">');
                    print('<div class="row">');
                        print ("Nombre de usuario: " . $nombre_usuario);
                    print('</div>');
                print('</div>');

                print('<div class="container-fluid border border-secondary rounded mb-1">');
                    print('<div class="row">');
                        print ("Rol: " . $rol);
                    print('</div>');
                print('</div>');

                print('<button onclick=location.href="A_nuevo_usuario.php" type="button" class="btn btn-primary">Nuevo usuario</button>');
                print('<button onclick=location.href="menu_administrador.php" type="button" class="btn btn-primary ml-5">Menú</button>');

                print('</div>');
                print('</div>');

            }else{
                print('<div class="container">');
                print('<div class="jumbotron jumbotron-fluid text-center">');
                print('<h3>Error</h3>');
                print('<p>Algo salió mal al introducir el usuario en el sistema</p>');
                print('</div>');
                print('<div class="container pl-5 text-left">');

                print('<button onclick=location.href="A_nuevo_usuario.php" type="button" class="btn btn-primary">Nuevo usuario</button>');
                print('<button onclick=location.href="menu_administrador.php" type="button" class="btn btn-primary ml-5">Menú</button>');

                print('</div>');
                print('</div>');
            }
        }

    }else
    {
    ?>
        <FORM ACTION="A_nuevo_usuario.php" METHOD="POST">
    
    <?php
        print('<div class="container">');
        print('<div class="jumbotron jumbotron-fluid text-center">');
        print('<h3>Nuevo usuario</h3>');
        print('<p>Ingrese un nuevo usuario en el sistema</p>');
        print('</div>');
        print('<div class="container pl-5 text-left">');
    ?>

        <div class="form-row">
            <div class="col">
                <label>Nombre</label>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
            </div>
            <div class="col">
                <label >Nombre de usuario</label>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">@</div>
                    </div>
                    <input type="text" class="form-control" name="nombre_usuario" placeholder="u123..." required>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                    <label>Contraseña</label>
                    <input type="password" class="form-control" name="contrasenna" placeholder="contraseña" required>
                </div>
            <div class="col">
                <div class="form-group">
                    <label>Rol</label>
                    <select class="custom-select" name="rol" required>
                        <option value="estudiante">Estudiante</option>
                        <option value="profesor">Profesor</option>
                        <option value="administrador">Administrador</option>
                    </select>
                </div>
            </div>
        </div>
        
        <input type="submit" class="btn btn-primary" name="Confirmar" value="Confirmar">
        <button onclick=location.href="menu_administrador.php" type="button" class="btn btn-primary ml-5">Menú</button>
    </div>

    </FORM>
    </div>
    </div>

    <?php
        }
    }
    ?>
    <div class="pt-5 pb-5"></div>
    <div class="pt-5 pb-5"></div>
    <div class="pt-5 pb-5"></div>
    <div class="pt-5 pb-5"></div>
    <footer class="bg-dark text-center text-white mt-5 relative-bottom">
        <div class="container p-4">Exámenes UCA 2020-2021 Copyright-All rights reserved</div>
    </footer>
</body>
</html>    