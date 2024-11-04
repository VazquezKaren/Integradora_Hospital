<?php
sesion_start();
    include('../config.php')

    
    if (isset($_POST["usuario"]) && empty($_POST["password"])){
        function validate ($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $usuario = validate($_POST['usuario']);
        $password = validate($_POST['password']);

        if (empty($usuario)) {
            header("Location: Index.php?error-El usuario es requerido");
            exit();
        } elseif (empty($password)) {
            header("Location: Index.php?error-La contraseña es requerido");
            exit();
        }
        else {

            /*
            $password = md5($password);
            */

            $sql = "SELECT * FROM usuarios WHERE usuario='$usuario' AND contrasena = '$password'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) === 1){
                $row = mysqli_fetch_assoc($result);
                if ($row['$usuario'] === $usuario && $row['password'] === $password) {
                    $_SESSION['usuario'] = $row['usuario'];
                    $_SESSION['Nombre_Completo'] = $row['Nombre_Completo'];
                    $_SESSION['Id'] = $row['Id'];
                    header("Location:src/views/inicio.php");
                    exit();
                }else {
                    header("Location:index.php?error=El usuario o la contraseña son incorrectos");
                    exit()
                }
            }else{
                header("Location:index.php?error=El usuario o la contraseña son incorrectos");
                exit()
            }

        }
    }else{
        header("Location:index.php");
        exit()
    }

?>