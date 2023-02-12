<?php
    require_once "includes/redireccion.php";
    require_once "includes/conexion.php";

    $usuario_id = $_SESSION['usuario']['id'];
    $entrada_id = $_GET['id_entrada'];
    $sql = "DELETE FROM entradas WHERE usuario_id = $usuario_id AND id = $entrada_id";

    $borrado_completado = mysqli_query($db,$sql);

    if ($borrado_completado) {
        # code...
        $_SESSION["completado"] = "La eliminacion de la entrada ha sido completada con exito.";
    }
    
    header('Location: index.php');