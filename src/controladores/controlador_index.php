<?php
    session_start();
    include('../config.php');

    
    if (isset($_POST["usuario"]) && isset($_POST["password"])) {
        function validate ($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        };

        $usuario = validate($_POST['usuario']);
        $password = validate($_POST['password']);

        if (empty($usuario)) {
            header("Location: ../../index.php?error-El usuario es requerido");
            exit();
        } elseif (empty($password)) {
            header("Location: ../../index.php?error-La contraseña es requerido");
            exit();
        }else {

            /*
            $password = md5($password);
            */

            $sql = "SELECT * FROM usuarios WHERE usuario='$usuario' AND contrasena = '$password'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) === 1){
                $row = mysqli_fetch_assoc($result);

                if ($row['usuario'] === $usuario && $row['contrasena'] === $password) {
                    $_SESSION['usuario'] = $row['usuario'];
                    $_SESSION['rol'] = $row['rol'];
                    $_SESSION['idUsuario'] = $row['idUsuario'];

                    $idEmpleado = $row['fkIdEmpleado'];
                    $sqlEmpleado = "SELECT nombres, apellidoPaterno, apellidoMaterno, telefono, email FROM empleado WHERE idEmpleado = '$idEmpleado'";
                    $resultEmpleado = mysqli_query($conn, $sqlEmpleado);

                    if (mysqli_num_rows($resultEmpleado) === 1) {
                        $rowEmpleado = mysqli_fetch_assoc($resultEmpleado);
                        $_SESSION['nombreEmpleado'] = $rowEmpleado['nombres'];
                        $_SESSION['apellidoPaternoEmpleado'] = $rowEmpleado['apellidoPaterno'];
                        $_SESSION['apellidoMaternoEmpleado'] = $rowEmpleado['apellidoMaterno'];
                        $_SESSION['telefonoEmpleado'] = $rowEmpleado['telefono'];
                        $_SESSION['emailEmpleado'] = $rowEmpleado['email'];
                    }

                    header("Location:../views/inicio.php");
                    exit();
                }else {
                    header("Location:../../index.php?error=El usuario o la contraseña son incorrectos");
                    exit();
                }
            }else{
                header("Location:../../index.php?error=El usuario o la contraseña son incorrectos");
                exit();
            }

        }

    }else{
        header("Location: ../../index.php?error=Debe ingresar usuario y contraseña");
        exit();
    }
?>