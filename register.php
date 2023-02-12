<?php

if (isset($_POST)) {

    //conexion
    require_once 'includes/conexion.php';

    # code...
    $nombre = isset($_POST["nombre"]) ? mysqli_real_escape_string($db,$_POST["nombre"]) : false;
    $apellidos = isset($_POST["apellidos"]) ? mysqli_real_escape_string($db,$_POST["apellidos"]) : false;
    $email = isset($_POST["email"]) ? mysqli_real_escape_string($db,trim($_POST["email"])) : false;
    $password = isset($_POST["password"]) ? mysqli_real_escape_string($db,trim($_POST["password"])) : false;


    //array de errores//
    $errores = array();

    if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/" , $nombre)) {
        $nombre_valido = true;
    }else{
        $nombre_valido = false;
        $errores["nombre"] = "el nombre no es valido";
    }

    if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/" , $apellidos)) {
        $apellidos_validos = true;
    }else{
        $apellidos_validos = false;
        $errores["apellidos"] = "los apellidos no son validos";
    }

    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_valido = true;
    }else{
        $email_valido = false;
        $errores["email"] = "el email no es valido";
    }

    if (!empty($password)) {
        $password_validos = true;
    }else{
        $password_validos = false;
        $errores["password"] = "el password no es valido";
    }

    $guardar_usuario = false;

    if(count($errores) == 0){
        $guardar_usuario = true;
        
        //cifrar la contraseña//
        
        $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);

        //insertar datos en la base de datos

        $sql = "INSERT INTO usuarios VALUES(NULL, '$nombre', '$apellidos', '$email', '$password_segura', CURDATE());";      

        $guardar = mysqli_query($db,$sql);


        if ($guardar) {
            $_SESSION['completado'] = "El registro se ha completado con exito";
        }else{
            $_SESSION['errores']['general'] = "fallo al guardar usuario!";
        }


    }else{
        $_SESSION['errores'] = $errores;
    }

}


//var_dump($_POST);//

header('Location: index.php');


?>