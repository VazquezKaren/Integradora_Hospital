<?php
require_once '../config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    try {
        $conn = new conn();
        $pdo = $conn->connect();

        $sql = "SELECT * FROM usuarios WHERE usuario = :usuario";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['usuario' => $usuario]);
        $usuarioData = $stmt->fetch(PDO::FETCH_ASSOC);

        // Sustituir esta linea de codigo aca cuando tengamos el hashing, si no despues no va a jalar
        // if ($usuarioData && password_verify($password,  $usuarioData['contrasena']))    o sin hash     if ($usuarioData && $password === $usuarioData['contrasena'])

        if ($usuarioData && $password === $usuarioData['contrasena']) {
            $_SESSION['usuario'] = $usuarioData['usuario'];
            $_SESSION['rol'] = $usuarioData['rol'];
            $_SESSION['idUsuario'] = $usuarioData['idUsuario'];
            $idEmpleado = $usuarioData['fkIdEmpleado'];
            
            $sqlEmpleado = "SELECT nombres, apellidoPaterno, apellidoMaterno, telefono, email FROM empleado WHERE idEmpleado = :idEmpleado";
            $stmtEmpleado = $pdo->prepare($sqlEmpleado);
            $stmtEmpleado->execute(['idEmpleado' => $idEmpleado]);
            $empleadoData = $stmtEmpleado->fetch(PDO::FETCH_ASSOC);

            if ($empleadoData) {
                $_SESSION['nombreEmpleado'] = $empleadoData['nombres'];
                $_SESSION['apellidoPaternoEmpleado'] = $empleadoData['apellidoPaterno'];
                $_SESSION['apellidoMaternoEmpleado'] = $empleadoData['apellidoMaterno'];
                $_SESSION['telefonoEmpleado'] = $empleadoData['telefono'];
                $_SESSION['emailEmpleado'] = $empleadoData['email'];
            };

            if ($usuarioData['rol'] === "TRABAJO_SOCIAL") {
                header("Location:../views/inicio.php");
                exit();
            }elseif ($usuarioData['rol'] === 'DOCTOR') {
                header("Location:../views/inicio.php");
                exit();
            }elseif ($usuarioData['rol'] === 'ADMIN') {
                header("Location:../views/inicio.php");
                exit();
            }elseif ($usuarioData['rol'] === 'ENFERMERA') {
                header("Location:../views/inicio.php");
                exit();
            }
            else{
                
                header( 'Location:../../index.php?error=Acceso denegado');
                exit();
            }
            exit();
        }else {
            header("Location: ../../index.php?error=Credenciales incorrectas");
            exit();
        }
        
    } catch (\Throwable $th) {
        $error =  "Error en la conexion" . $th->getMessage();
        exit;
    }
}
?>