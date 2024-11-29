<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener y validar el idEmpleado
    $idEmpleado = $_POST['idEmpleado'] ?? null;

    if (empty($idEmpleado) || !is_numeric($idEmpleado)) {
        echo json_encode(['success' => false, 'message' => 'ID de empleado inválido.']);
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

        echo json_encode(['success' => true, 'message' => 'Empleado eliminado correctamente.']);
    } catch (Exception $e) {
        // Revertir transacción en caso de error
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }

        // Registrar el error en un archivo de log (opcional)
        error_log($e->getMessage());

        // Devolver un mensaje genérico al cliente
        echo json_encode(['success' => false, 'message' => 'Ocurrió un error al eliminar el empleado. Por favor, inténtelo de nuevo más tarde.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
?>
