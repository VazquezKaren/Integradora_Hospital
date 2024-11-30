<?php
require_once '../config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

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

        // Verificar si el usuario existe y la contraseña es válida
        if ($usuarioData && password_verify($password, $usuarioData['contrasena'])) {
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
            // Mostrar alerta con SweetAlert cuando las credenciales son incorrectas
            echo "<html><head>
                    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Credenciales incorrectas',
                                text: 'Por favor verifique su usuario y contraseña.',
                            }).then(function() {
                                window.location.href = '../../index.php';
                            });
                        });
                    </script>
                  </head><body></body></html>";
            exit();
        }
    } catch (Exception $e) {
        // Mostrar alerta de error de conexión
        echo "<html><head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error en la conexión',
                            text: '". addslashes($e->getMessage()) ."',
                        }).then(function() {
                            window.location.href = '../../index.php';
                        });
                    });
                </script>
              </head><body></body></html>";
        exit();
    }
}
?>
