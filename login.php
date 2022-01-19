<!-- -->
<html>
	<head>
		<title>Login</title>
        <link href="estilos.css" rel="stylesheet" type="text/css">
	</head>

	<body>
        <?php

            include('connect.php');
            session_start();

            //Login verification process
            if(isset($_POST['submit'])){

                $username = $_POST['login'];
                $password = $_POST['password'];
                if(trim($username)==""||trim($password)=="") {
                    header('Location: login.php');
                }else{

                    $username = trim($username);
                    $consulta = "select id_usuario,rol from usuario where nombre_usuario='$username' and password='$password'";
                    $mysql_consulta = mysqli_query ($conexion, $consulta) or die ("Error");
                    if(!empty($mysql_consulta))
                    {
                        $fetch = mysqli_fetch_array($mysql_consulta); 
                        $_SESSION['id_usuario'] = $fetch['id_usuario'];
                        $_SESSION['rol'] = $fetch['rol'];

                        if($fetch['rol']=='profesor')
                        {
                            header('Location: menu_profesor.php');
                        }elseif($fetch['rol']=='estudiante')
                        {
                            header('Location: menu_alumno.php');
                        }elseif($fetch['rol']=='administrador')
                        {
                            header('Location: menu_administrador.php');
                        }else{
                            header('Location: login.php');
                        }
                    }
                    else{
                        header('Location: login.php');
                    }
                }

            }else{
        ?>
            <div class="contenedor__login">
                    <a class="login__tittle">Exámenes UCA</a>
                <form method="post" action="login.php">
                    <input type="text" id="login" class="user__pass__" name="login" placeholder="login" required>
                    <input type="password" id="password" class="user__pass__" name="password" placeholder="password" required>
                    <input type="submit" class="login__button" name="submit" value="Log In">
                </form>
            </div>
            <?php
            }
            ?>
	</body>
</html>

