<?php
require_once '../config.php';
session_start();
?>
<!-- Incluye el script de SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
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

        if ($usuarioData && password_verify($password,  $usuarioData['contrasena'])) {
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
            }

            // Redirección dependiendo del rol
            if ($usuarioData['rol'] === "TRABAJO_SOCIAL" || $usuarioData['rol'] === 'DOCTOR' || $usuarioData['rol'] === 'ADMIN' || $usuarioData['rol'] === 'ENFERMERA') {
                echo "
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Acceso concedido',
                        text: 'Bienvenido, " . htmlspecialchars($usuarioData['usuario']) . "!',
                        showConfirmButton: false,
                        timer: 3000
                    }).then(() => {
                        window.location.href = '../views/inicio.php';
                    });
                </script>";
                exit();
            } else {
                echo "
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Acceso denegado',
                        text: 'No tienes permiso para acceder.',
                        showConfirmButton: false,
                        timer: 3000
                    }).then(() => {
                        window.location.href = '../../index.php';
                    });
                </script>";
                exit();
            }
        } else {
            echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Credenciales incorrectas',
                    text: 'Usuario o contraseña inválidos.',
                    showConfirmButton: false,
                    timer: 3000
                }).then(() => {
                    window.location.href = '../../index.php';
                });
            </script>";
            exit();
        }
        
    } catch (\Throwable $th) {
        $error = "Error en la conexion: " . $th->getMessage();
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error en la conexión',
                text: 'Ocurrió un error al conectar con la base de datos. Inténtalo más tarde.',
                showConfirmButton: false,
                timer: 3000
            }).then(() => {
                window.location.href = '../../index.php';
            });
        </script>";
        exit();
    }
}
?>
