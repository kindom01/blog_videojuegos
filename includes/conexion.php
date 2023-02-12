<?php

$server = "localhost";
$user = "root";
$password = "";
$database = "blog";

$db = mysqli_connect($server,$user,$password,$database);


mysqli_query($db,"SET NAMES 'utf8'");

//iniciar la sesion

if (!isset($_SESSION)) {
    # code...
    session_start();
}


