<?php
    //iniciar session con base de datos
    require_once "includes/conexion.php";
    
    //recoger datos del formulario
    if (isset($_POST)) {
        # code...

        //borrar error antiguo
        if (isset($_SESSION["error_login"])) {
            # code...
            unset($_SESSION["error_login"]);
        }

        //recoger datos
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);
        
        //consulta para comprobar las credenciales del usuario
        $sql = "SELECT * FROM usuarios WHERE email = '$email';";
        $login = mysqli_query($db, $sql);

        
        if ($login && mysqli_num_rows($login) == 1) {
            # code...
            $usuario = mysqli_fetch_assoc($login);
            
            //comprobar la contraseña
            $verify = password_verify($password,$usuario["password"]);
            
            if ($verify) {
                # code...
                //utilizar una session para guardar los datos del usuario logged
                $_SESSION["usuario"] = $usuario;

            }else{
                $_SESSION["error_login"] = "login incorrecto, datos erroneos";
            }


        }else{

            //error
            $_SESSION["error_login"] = "login incorrecto, datos erroneos";
        }




    }else{
        //si algo falla enviar una session con el fallo y re dirigir al index
        $_SESSION["error_login"] = "login incorrecto llene datos";
    }

    //regreso a index
header('Location: index.php');
