<?php

if (!isset($_SESSION)) {
    # code...
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    # code...
    header("Location: index.php");
}