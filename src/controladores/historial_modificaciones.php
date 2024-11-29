<?php
require_once '../config.php';

session_start();

$connObj = new conn();
$conn = $connObj->connect();

try {
    if (!isset($_SESSION['usuario'])) {
        exit("No estás autenticado.");
    } else {
        $usuario_actual = $_SESSION['idUsuario'];
        $privilegio = $_SESSION['rol'];
    }

    // Consulta con JOIN para obtener datos adicionales
    $sql = "SELECT h.fecha, h.actividad, u.usuario, e.nombres AS nombreEmpleado, e.telefono
            FROM historial h
            JOIN usuarios u ON h.usuario = u.idUsuario
            JOIN empleado e ON u.fkIdEmpleado = e.idEmpleado
            WHERE u.idUsuario = :us";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':us', $usuario_actual, PDO::PARAM_INT); // Vinculamos el ID del usuario logueado
    $stmt->execute();

    $actividades = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // foreach ($actividades as $actividad) {
    //     echo "Fecha: " . htmlspecialchars($actividad['fecha']) . "<br>";
    //     echo "Actividad: " . htmlspecialchars($actividad['actividad']) . "<br>";
    //     echo "Usuario: " . htmlspecialchars($actividad['usuario']) . "<br>";
    //     echo "Nombre Empleado: " . htmlspecialchars($actividad['nombreEmpleado']) . "<br>";
    //     echo "Teléfono: " . htmlspecialchars($actividad['telefono']) . "<br>";
    // }
} catch (Throwable $th) {
    // Manejo de errores
    echo "<html><head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              </head><body>
              <script>
        Swal.fire({
            title: 'Error en el registro del historial',
            text: 'Hubo un error al registrar el historial: " . addslashes($th->getMessage()) . "',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        }).then(() => {
            window.location.href = '../views/historial.php';
        });
    </script>";
}
?>
