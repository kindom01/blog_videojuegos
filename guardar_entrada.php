<?php

if(isset($_POST)){

    require_once 'includes/conexion.php';

    $titulo = isset($_POST["titulo"]) ? mysqli_real_escape_string($db,$_POST["titulo"]) : false;
    $categoria = isset($_POST["categoria"]) ? (int)$_POST["categoria"] : false;
    $descripcion = isset($_POST["descripcion"]) ? mysqli_real_escape_string($db,$_POST["descripcion"]) : false;
    $usuario = $_SESSION['usuario']['id'];



    //validacion
    $errores = array();
    if (empty($titulo) || strlen($titulo) > 45) {
        # code...
        $errores["titulo"] = "titulo no valido";
    }

    if (empty($categoria) && !is_numeric($categoria)) {
        # code...
        $errores["categoria"] = "categoria no valida";
    }

    if (empty($descripcion) || strlen($descripcion) > 500) {
        # code...
        $errores["descripcion"] = "descripcion no valida";
    }

    if (count($errores) == 0) {
        # code...
        if (isset($_GET['editar'])) {
            # code...
            $entrada_actual = $_GET['editar'];
            $sql = "UPDATE entradas SET categorias_id = $categoria , titulo = '$titulo' , descripcion = '$descripcion'".
            " WHERE id = '$entrada_actual' AND usuario_id='$usuario'";
        }else {
            # code...
            $sql = "INSERT INTO entradas VALUES(NULL,$usuario,$categoria,'$titulo','$descripcion',CURDATE());";
        }
        $guardar = mysqli_query($db,$sql);

        if ($guardar) {
            # code...
            if (isset($_GET['editar'])) {
                # code...
                $_SESSION["completado"] = "La edicion de la entrada ha sido completada con exito.";
            }
            header("Location: index.php");
        }else{
            if (isset($_GET['editar'])) {
                # code...
                $_SESSION["error_entrada"] = "Error al editar la entrada";
                header("Location: editar_entrada.php?id_entrada=".$_GET['editar']);
            }else{
            $_SESSION["error_entrada"] = "Error al crear la entrada";
            header("Location: crear_entradas.php");
            }
        }
    }else{
        if (isset($_GET['editar'])) {
            # code...
            $_SESSION["error_entrada"] = $errores;
            header("Location: editar_entrada.php?id_entrada=".$_GET['editar']);
        }else{
        $_SESSION["error_entrada"] = $errores;
        header("Location: crear_entradas.php");
        }
    }
}else {
    # code...
    header("Location: index.php");
}