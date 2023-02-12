<?php

//errores

function mostrarError($errores, $campo){
    $alerta='';

    if (isset($errores[$campo]) && !empty($campo)) {
        $alerta ="<div class='alerta alerta-error'>".$errores[$campo]."</div>";
    }


    return $alerta;

}

function borrarErrores(){
    if (isset($_SESSION["errores"])) {
        # code...
        unset($_SESSION['errores']);
    }

    if (isset($_SESSION["completado"])) {
        # code...
        unset($_SESSION['completado']);
    }

    if (isset($_SESSION["guardaro_completado"])) {
        # code...
        unset($_SESSION["guardaro_completado"]);
    }

    if (isset($_SESSION["error_categoria"])) {
        # code...
        unset($_SESSION['error_categoria']);
    }

    if (isset($_SESSION["error_entrada"])) {
        # code...
        unset($_SESSION['error_entrada']);
    }
}


// conseguir categorias
function conseguirCategorias($conexion){
    $sql = "SELECT * FROM categorias ORDER BY id ASC;";
    $categorias = mysqli_query($conexion,$sql);
    
    $resultado = array();
    if ($categorias && mysqli_num_rows($categorias) >= 1) {
        # code...
        $resultado = $categorias;
    }

    return $resultado;
}

function conseguirCategoria($conexion, $id){
    $sql = "SELECT * FROM categorias WHERE id = $id;";
    $categorias = mysqli_query($conexion,$sql);
    
    $resultado = array();
    if ($categorias && mysqli_num_rows($categorias) >= 1) {
        # code...
        $resultado = mysqli_fetch_assoc($categorias);
    }

    return $resultado;
}

//Buscar entradas
function conseguirEntradas($conexion, $limit = null, $categoria = null){
    $sql = "SELECT e.*, c.nombre AS categoria FROM entradas e ".
    "INNER JOIN categorias c on e.categorias_id = c.id ";
    
    if (!empty($categoria)) {
        # code...
        $sql .= " WHERE e.categorias_id = '$categoria'";
        
    }
    
    $sql .="ORDER BY e.id DESC";

    if ($limit) {
        # code...
        //entradas del index
        $sql .= " LIMIT 4";

    }

    $entradas = mysqli_query($conexion,$sql);

    $resultado = array();
    if ($entradas && mysqli_num_rows($entradas) >= 1) {
        # code...
        $resultado = $entradas;
    }

    return $resultado;
}

function conseguirEntrada($conexion, $id){

    $sql = "SELECT e.*, c.nombre AS 'categoria', CONCAT(u.nombre,' ',u.apellidos)  AS 'autor'".
    " FROM entradas e".
    " INNER JOIN categorias c on e.categorias_id = c.id".
    " INNER JOIN usuarios u on e.usuario_id = u.id".
    " WHERE e.id = $id";

    $entradas = mysqli_query($conexion,$sql);
    
    $resultado = array();
    if ($entradas && mysqli_num_rows($entradas) >= 1) {
        # code...
        $resultado = mysqli_fetch_assoc($entradas);
        
    }

    return $resultado;
}

//buscar entradas

function buscarEntradas($conexion, $busqueda){
    $sql = "SELECT e.*, c.nombre AS categoria FROM entradas e".
    " INNER JOIN categorias c on e.categorias_id = c.id".
    " WHERE e.titulo LIKE '%$busqueda%'".
    " ORDER BY e.id DESC";

    $entradas = mysqli_query($conexion,$sql);

    $resultado = array();
    if ($entradas && mysqli_num_rows($entradas) >= 1) {
        # code...
        $resultado = $entradas;
    }

    return $resultado;
}