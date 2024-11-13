<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("location: ../../index.php");
} else {
    $us = $_SESSION['usuario'];
    $privilegio = $_SESSION['rol'];
}
?>