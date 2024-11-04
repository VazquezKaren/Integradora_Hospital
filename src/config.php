<?php
// Con este archivo se conecta a la base de datos en MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospitalinfantil";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>