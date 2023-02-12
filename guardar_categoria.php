<?php

if(isset($_POST)){

    require_once 'includes/conexion.php';

    $nombre = isset($_POST["nombre"]) ? mysqli_real_escape_string($db,$_POST["nombre"]) : false;

    if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/" , $nombre)) {
        # code...
        $sql = "INSERT INTO categorias VALUES(NULL,'$nombre');";
        $guardar = mysqli_query($db,$sql);

        if ($guardar) {
            # code...
            $_SESSION["guardaro_completado"] = "Se ha guardado con exito";
        }else{
            $_SESSION["error_categoria"] = "Error al crear la categoria";
        }
    }else{
        $_SESSION["error_categoria"] = "El campo esta vacio";
    }

    header("Location: crear_categoria.php");
}