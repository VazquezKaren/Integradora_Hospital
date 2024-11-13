<?php
require_once('../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombres = $_POST['nombre'];
    $apellido_p = $_POST['apellido_paterno'];
    $apellido_m = $_POST['apellido_materno'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $especialidad = $_POST['especialidad'];
    $direccion_calle = $_POST['direccion_calle'];
    $direccion_numero = $_POST['direccion_numero'];
    $direccion_colonia = $_POST['direccion_colonia'];

    $rol = $_POST['rol'];
    $username = $_POST['usuario'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if ($password === $password2) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        try {
            $conn = new conn();
            $pdo = $conn->connect();
            $sql = "INSERT INTO empleado(nombres, apellidoPaterno, apellidoMaterno, calleDireccion, numeroDireccion, coloniaDireccion, telefono, email, especialidad) 
                    VALUES (:nombres, :apellido_p, :apellido_m, :direccion_calle, :direccion_numero, :direccion_colonia, :telefono, :email, :especialidad)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'nombres' => $nombres,
                'apellido_p' => $apellido_p,
                'apellido_m' => $apellido_m,
                'direccion_calle' => $direccion_calle,
                'direccion_numero' => $direccion_numero,
                'direccion_colonia' => $direccion_colonia,
                'telefono' => $telefono,
                'email' => $email,
                'especialidad' => $especialidad,
            ]);

            echo "<script>
                alert('Usuario registrado correctamente');
                window.location.href = '../views/registroEmpleado.php';
            </script>";
        } catch (\Throwable $th) {
            echo "<script>
                alert('Error en el registro del empleado: " . addslashes($th->getMessage()) . "');
                window.location.href = '../views/registroEmpleado.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('Las contraseñas no coinciden');
            window.location.href = '../views/registroEmpleado.php';
        </script>";
    }
}
?>
