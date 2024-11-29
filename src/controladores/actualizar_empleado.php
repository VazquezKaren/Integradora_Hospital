<?php
include '../config.php';
?>
<!-- Incluye el script de SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Inicializar un arreglo para almacenar errores de validación
    $errores = [];
    // Obtener y validar datos del formulario
    $idEmpleado = $_POST['idEmpleado'] ?? null;
    $nombres = $_POST['nombres'] ?? '';
    $apellidoPaterno = $_POST['apellidoPaterno'] ?? '';
    $apellidoMaterno = $_POST['apellidoMaterno'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $email = $_POST['email'] ?? '';
    $especialidad = $_POST['especialidad'] ?? null;
    $rol = $_POST['rol'] ?? '';
    $calleDireccion = $_POST['calleDireccion'] ?? '';
    $numeroDireccion = $_POST['numeroDireccion'] ?? '';
    $coloniaDireccion = $_POST['coloniaDireccion'] ?? '';
    // Validaciones básicas
    if (empty($idEmpleado) || !is_numeric($idEmpleado)) {
        $errores[] = 'ID de empleado inválido.';
    }
    if (empty($nombres)) {
        $errores[] = 'El campo nombres es obligatorio.';
    }
    if (empty($apellidoPaterno)) {
        $errores[] = 'El campo apellido paterno es obligatorio.';
    }
    if (empty($telefono)) {
        $errores[] = 'El campo teléfono es obligatorio.';
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = 'El email proporcionado no es válido.';
    }
    if (empty($rol)) {
        $errores[] = 'El campo rol es obligatorio.';
    }
    // Si hay errores de validación, devolverlos al cliente
    if (count($errores) > 0) {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Errores de validación',
                text: 'Por favor, corrija los errores e intente de nuevo.',
                showConfirmButton: false,
                timer: 3000
            });
        </script>";
        exit;
    }
    try {
        $conn = new conn();
        $pdo = $conn->connect();
        // Iniciar una transacción
        $pdo->beginTransaction();
        // Preparar y ejecutar la actualización en la tabla empleado
        $sqlEmpleado = "UPDATE empleado SET 
            nombres = :nombres, 
            apellidoPaterno = :apellidoPaterno, 
            apellidoMaterno = :apellidoMaterno, 
            telefono = :telefono, 
            email = :email, 
            especialidad = :especialidad, 
            calleDireccion = :calleDireccion, 
            numeroDireccion = :numeroDireccion, 
            coloniaDireccion = :coloniaDireccion
            WHERE idEmpleado = :idEmpleado";
        $stmtEmpleado = $pdo->prepare($sqlEmpleado);
        $stmtEmpleado->execute([
            'nombres' => htmlspecialchars(trim($nombres)),
            'apellidoPaterno' => htmlspecialchars(trim($apellidoPaterno)),
            'apellidoMaterno' => htmlspecialchars(trim($apellidoMaterno)),
            'telefono' => htmlspecialchars(trim($telefono)),
            'email' => htmlspecialchars(trim($email)),
            'especialidad' => htmlspecialchars(trim($especialidad)),
            'calleDireccion' => htmlspecialchars(trim($calleDireccion)),
            'numeroDireccion' => htmlspecialchars(trim($numeroDireccion)),
            'coloniaDireccion' => htmlspecialchars(trim($coloniaDireccion)),
            'idEmpleado' => (int)$idEmpleado
        ]);
        // Verificar si se actualizó algún registro
        if ($stmtEmpleado->rowCount() === 0) {
            throw new Exception('No se pudo actualizar la información del empleado. Verifique que el ID sea correcto.');
        }
        // Preparar y ejecutar la actualización en la tabla usuarios
        $sqlUsuario = "UPDATE usuarios SET rol = :rol WHERE fkIdEmpleado = :idEmpleado";
        $stmtUsuario = $pdo->prepare($sqlUsuario);
        $stmtUsuario->execute([
            'rol' => htmlspecialchars(trim($rol)),
            'idEmpleado' => (int)$idEmpleado
        ]);
        // Confirmar la transacción
        $pdo->commit();
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: 'Empleado actualizado correctamente.',
                showConfirmButton: false,
                timer: 3000
            }).then(() => {
                window.location.href = 'menu.php'; // Redirige al menú después de mostrar la alerta
            });
        </script>";
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        // Registrar el error en un archivo de log (opcional)
        error_log($e->getMessage());
        // Devolver un mensaje genérico al cliente
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Ocurrió un error al actualizar el empleado. Por favor, inténtelo de nuevo más tarde.',
                showConfirmButton: false,
                timer: 3000
            });
        </script>";
    }
} else {
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Método no permitido',
            text: 'El método de solicitud no es válido.',
            showConfirmButton: false,
            timer: 3000
        });
    </script>";
}
?>
