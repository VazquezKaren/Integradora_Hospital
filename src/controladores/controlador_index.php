<?php
require_once '../config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $usuario = trim($_POST['usuario']);
    $password = trim($_POST['password']);

    try {
        $conn = new conn();
        $pdo = $conn->connect();

        // Verificar conexión a la base de datos
        if (!$pdo) {
            throw new Exception("No se pudo conectar a la base de datos.");
        }

        // Consultar datos del usuario
        $sql = "SELECT * FROM usuarios WHERE usuario = :usuario";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['usuario' => $usuario]);
        $usuarioData = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si el usuario existe
        if ($usuarioData) {
            // Verificar si el usuario está activo
            if ($usuarioData['status'] == 1) {
                // Verificar la contraseña
                if (password_verify($password, $usuarioData['contrasena'])) {
                    // Verificar si la cuenta está activa (opcional si ya verificaste 'status')
                    // Guardar datos en la sesión
                    $_SESSION['usuario'] = $usuarioData['usuario'];
                    $_SESSION['rol'] = $usuarioData['rol'];
                    $_SESSION['idUsuario'] = $usuarioData['idUsuario'];
                    $idEmpleado = $usuarioData['fkIdEmpleado'];

                    // Consultar información del empleado asociado
                    $sqlEmpleado = "SELECT nombres, apellidoPaterno, apellidoMaterno, telefono, email 
                                    FROM empleado 
                                    WHERE idEmpleado = :idEmpleado";
                    $stmtEmpleado = $pdo->prepare($sqlEmpleado);
                    $stmtEmpleado->execute(['idEmpleado' => $idEmpleado]);
                    $empleadoData = $stmtEmpleado->fetch(PDO::FETCH_ASSOC);

                    if ($empleadoData) {
                        $_SESSION['nombreEmpleado'] = $empleadoData['nombres'];
                        $_SESSION['apellidoPaternoEmpleado'] = $empleadoData['apellidoPaterno'];
                        $_SESSION['apellidoMaternoEmpleado'] = $empleadoData['apellidoMaterno'];
                        $_SESSION['telefonoEmpleado'] = $empleadoData['telefono'];
                        $_SESSION['emailEmpleado'] = $empleadoData['email'];
                    }

                    // Redirigir según el rol del usuario
                    switch ($usuarioData['rol']) {
                        case 'TRABAJO_SOCIAL':
                        case 'DOCTOR':
                        case 'ADMIN':
                        case 'ENFERMERA':
                            header("Location:../views/inicio.php");
                            exit();
                        default:
                            header('Location:../../index.php?error=Acceso denegado');
                            exit();
                    }
                } else {
                    // Contraseña incorrecta
                    mostrarAlerta('Credenciales incorrectas', 'Por favor verifique su usuario y contraseña.');
                }
            } else {
                // Usuario inactivo
                mostrarAlerta('Cuenta Inactiva', 'Tu cuenta está inactiva. Por favor, contacta al administrador.');
            }
        } else {
            // Usuario no encontrado
            mostrarAlerta('Credenciales incorrectas', 'Por favor verifique su usuario y contraseña.');
        }
    } catch (Exception $e) {
        // Manejar errores de conexión u otros
        mostrarAlerta('Error en la conexión', addslashes($e->getMessage()));
    }
}

// Función para mostrar alertas con SweetAlert
function mostrarAlerta($titulo, $mensaje) {
    echo "<html><head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: '". addslashes($titulo) ."',
                        text: '". addslashes($mensaje) ."',
                    }).then(function() {
                        window.location.href = '../../index.php';
                    });
                });
            </script>
          </head><body></body></html>";
    exit();
}
?>
