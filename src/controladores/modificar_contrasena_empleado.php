<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();





if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../config.php';

try {
    $db = new conn();
    $conn = $db->connect();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nueva_contrasena = $_POST['nueva_contrasena'];
        $confirmar_contrasena = $_POST['confirmar_contrasena'];

        if ($nueva_contrasena === $confirmar_contrasena) {
            $hash_contrasena = password_hash($nueva_contrasena, PASSWORD_BCRYPT);
            $idUsuario = $_SESSION['idUsuario'];

            $query = "UPDATE usuarios SET contrasena = :contrasena WHERE idUsuario = :idUsuario";
            $stmt = $conn->prepare($query);
            $stmt->execute([
                ':contrasena' => $hash_contrasena,
                ':idUsuario' => $idUsuario,
            ]);

            echo "<html><head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              </head><body>
              <script>
                Swal.fire({
                    title: '¡Contraseña actualizada!',
                    text: 'La contraseña se ha cambiado correctamente.',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                });
            </script>";
            exit();
        } else {
            echo "<html><head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              </head><body>
              <script>
                Swal.fire({
                    title: '¡Error!',
                    text: 'Las contraseñas no coinciden. Por favor, inténtelo de nuevo.',
                    icon: 'warning',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    window.location.href = '../views/formulario_cambiar_contrasena.php';
                });
            </script>";
            exit();
        }
    }
} catch (Throwable $th) {
    echo "<html><head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              </head><body>
              <script>
        Swal.fire({
            title: 'Error al procesar la solicitud',
            text: 'Ocurrió un problema: " . $th->getMessage() . "',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        }).then(() => {
            window.location.href = '../views/empleado.php';
        });
    </script>";
    exit();
}
?>
