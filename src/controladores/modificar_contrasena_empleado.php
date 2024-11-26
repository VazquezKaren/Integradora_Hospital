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

            echo "<script>
                alert('La contraseña se ha cambiado correctamente.');
                window.location.href = '../views/empleado.php';
            </script>";
            exit();
        } else {
            echo "<script>
                alert('Las contraseñas no coinciden. Por favor, inténtelo de nuevo.');
                window.location.href = '../views/formulario_cambiar_contrasena.php';
            </script>";
            exit();
        }
    }
} catch (Throwable $th) {
    echo "<script>
        alert('Error al procesar la solicitud: " . $th->getMessage() . "');
        window.location.href = '../views/empleado.php';
    </script>";
    exit();
}
?>
