<?php

if (isset($_POST)) {

    //conexion
    require_once 'includes/conexion.php';

    # code...
    $nombre = isset($_POST["nombre"]) ? mysqli_real_escape_string($db,$_POST["nombre"]) : false;
    $apellidos = isset($_POST["apellidos"]) ? mysqli_real_escape_string($db,$_POST["apellidos"]) : false;
    $email = isset($_POST["email"]) ? mysqli_real_escape_string($db,trim($_POST["email"])) : false;
    $usuario = $_SESSION['usuario']['id'];

    //array de errores//
    $errores = array();
    if (empty($nombre) || is_numeric($nombre) || preg_match("/[0-9]/" , $nombre)) {
        $errores["nombre"] = "el nombre no es valido";
    }

    if (empty($apellidos) || is_numeric($apellidos) || preg_match("/[0-9]/" , $apellidos)) {
        $errores["apellidos"] = "los apellidos no son validos";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errores["email"] = "el email no es valido";
    }

    if(count($errores) == 0){

        //comprobar si el correo existe en la db
        $sql = "SELECT id, email FROM usuarios WHERE email = '$email'";
        $email_existente = mysqli_query($db,$sql);
        $usuario_existente = mysqli_fetch_assoc($email_existente);

        if ($usuario_existente['id'] == $usuario || empty($usuario_existente)) {
            # code...

            //insertar datos en la base de datos

            $sql = "UPDATE usuarios SET ".
            "nombre = '$nombre', ".
            "apellidos = '$apellidos', ".
            "email = '$email' ".
            "WHERE usuarios.id = $usuario";

            $guardar = mysqli_query($db,$sql);


            if ($guardar) {
                $_SESSION['usuario']['nombre'] = $nombre;
                $_SESSION['usuario']['apellidos'] = $apellidos;
                $_SESSION['usuario']['email'] = $email;
                $_SESSION['completado'] = "El cambio se ha completado con exito";
            }else{
                $_SESSION['errores']['general'] = "fallo al modificar";
            }

        }else{
            $_SESSION['errores']['general'] = "el usuario ya existe";
        }


    }else{
        $_SESSION['errores'] = $errores;
    }

}

header('Location: mis_datos.php');