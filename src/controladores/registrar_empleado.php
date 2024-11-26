<?php
include_once('../config.php');

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

    // Comprobar que las contraseñas coinciden
    if ($password === $password2) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        try {
            $conn = new conn();
            $pdo = $conn->connect();
            $pdo->beginTransaction();

            // Insertar en la tabla empleado
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

            $fkIdEmpleado = $pdo->lastInsertId();
            if (!$fkIdEmpleado) {
                throw new Exception("Error al obtener la ID del empleado recién registrado.");
            }

            // Insertar en la tabla usuarios
            $sql_usuario = "INSERT INTO usuarios(usuario, contrasena, rol, fkidEmpleado) 
                            VALUES (:usuario, :contrasena, :rol, :fkIdEmpleado)";
            $stmtUsuario = $pdo->prepare($sql_usuario);
            $stmtUsuario->execute([
                'usuario' => $username,
                'contrasena' => $hashed_password,
                'rol' => $rol,
                'fkIdEmpleado' => $fkIdEmpleado,
            ]);

            $pdo->commit();

            // Usar SweetAlert para notificar éxito
            echo "<!DOCTYPE html>
            <html lang='en'>
            <head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            </head>
            <body>
                <script>
                    Swal.fire({
                        title: 'Registro exitoso',
                        text: 'El usuario ha sido registrado correctamente.',
                        icon: 'success'
                    }).then(() => {
                        window.location.href = '../views/registroEmpleado.php';
                    });
                </script>
            </body>
            </html>";

        } catch (Exception $e) {
            $pdo->rollBack();
            // Usar SweetAlert para notificar error
            echo "<!DOCTYPE html>
            <html lang='en'>
            <head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            </head>
            <body>
                <script>
                    Swal.fire({
                        title: 'Error en el registro',
                        text: '" . addslashes($e->getMessage()) . "',
                        icon: 'error'
                    }).then(() => {
                        window.location.href = '../views/registroEmpleado.php';
                    });
                </script>
            </body>
            </html>";
        }
    } else {
        // Usar SweetAlert para notificar contraseñas no coinciden
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    title: 'Contraseñas no coinciden',
                    text: 'Por favor, asegúrate de que ambas contraseñas sean iguales.',
                    icon: 'warning'
                }).then(() => {
                    window.location.href = '../views/registroEmpleado.php';
                });
            </script>
        </body>
        </html>";
    }
}
?>
