<?php
session_start();

if (isset($_SESSION["usuario"])) {
    # code...
    session_destroy();
}

header('Location: index.php');