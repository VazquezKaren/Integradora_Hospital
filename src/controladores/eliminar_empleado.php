<?php
include '../config.php';
?>
<!-- Incluye el script de SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener y validar el idEmpleado
    $idEmpleado = $_POST['idEmpleado'] ?? null;

    if (empty($idEmpleado) || !is_numeric($idEmpleado)) {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'ID de empleado inválido',
                text: 'Por favor, proporcione un ID de empleado válido.',
                showConfirmButton: false,
                timer: 3000
            }).then(() => {
                window.location.href = '../../index.php';
            });
        </script>";
        exit;
    }

    try {
        $conn = new conn();
        $pdo = $conn->connect();

        // Iniciar transacción
        $pdo->beginTransaction();

        // Eliminar el usuario asociado al empleado
        $sqlUsuario = "DELETE FROM usuarios WHERE fkIdEmpleado = :idEmpleado";
        $stmtUsuario = $pdo->prepare($sqlUsuario);
        $stmtUsuario->execute(['idEmpleado' => $idEmpleado]);

        // Eliminar el empleado
        $sqlEmpleado = "DELETE FROM empleado WHERE idEmpleado = :idEmpleado";
        $stmtEmpleado = $pdo->prepare($sqlEmpleado);
        $stmtEmpleado->execute(['idEmpleado' => $idEmpleado]);

        // Confirmar transacción
        $pdo->commit();

        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Empleado eliminado',
                text: 'El empleado ha sido eliminado correctamente.',
                showConfirmButton: false,
                timer: 3000
            }).then(() => {
                window.location.href = '../views/empleados.php';
            });
        </script>";
        exit;
    } catch (Exception $e) {
        // Revertir transacción en caso de error
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }

        // Registrar el error en un archivo de log (opcional)
        error_log($e->getMessage());

        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error al eliminar',
                text: 'Ocurrió un error al eliminar el empleado. Inténtelo de nuevo más tarde.',
                showConfirmButton: false,
                timer: 3000
            }).then(() => {
                window.location.href = '../../index.php';
            });
        </script>";
        exit;
    }
} else {
    echo "
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Método no permitido',
            text: 'Este método no es válido. Inténtelo de nuevo.',
            showConfirmButton: false,
            timer: 3000
        }).then(() => {
            window.location.href = '../../index.php';
        });
    </script>";
    exit;
}
?>
