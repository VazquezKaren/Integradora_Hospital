<?php

if (!empty($_POST["btningresar"])){
    if (empty($_POST["usuario"]) and empty($_POST["password"])){
        echo "Los campos estan vacios";
    } else {
        $usuario=$_POST["usuario"];
        $password=$_POST["password"];
        $sql = $conn->query("select * from usuarios where usuario=$usuario and contrasena=$password");

        if ($datos=$sql->fetch_object()) {
            header("location:src/views/inicio.php");
        } else {
            echo "acceso denegado";
        }
        
    }
}
?>