<?php
include '../config.php';
session_start();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Obtener y validar el idEmpleado
    $idEmpleado = $_POST['idEmpleado'] ?? null;

    if (!$idEmpleado) {
        echo json_encode(['success' => false, 'message' => 'ID del empleado no proporcionado.']);
        exit;
    }

    try {
        $conn = new conn();
        $pdo = $conn->connect();

        // Iniciar transacción
        $pdo->beginTransaction();

        // Verificar si el empleado existe y está activo
        $sql_check = "SELECT u.idUsuario FROM usuarios u JOIN empleado e ON u.fkIdEmpleado = e.idEmpleado WHERE e.idEmpleado = :idEmpleado AND u.status = 1";
        $stmt = $pdo->prepare($sql_check);
        $stmt->execute([':idEmpleado' => $idEmpleado]);
        $idUsuario = $stmt->fetchColumn();

        if (!$idUsuario) {
            $pdo->rollBack();
            echo json_encode(['success' => false, 'message' => 'Empleado no encontrado o ya inactivo.']);
            exit;
        }

        // Actualizar el 'status' del usuario a 0 (inactivo)
        $sql_update_usuario = "UPDATE usuarios SET status = 0 WHERE idUsuario = :idUsuario";
        $stmt = $pdo->prepare($sql_update_usuario);
        $stmt->execute([':idUsuario' => $idUsuario]);

        $pdo->commit();
        echo json_encode(['success' => true, 'message' => 'Empleado desactivado correctamente.']);
        exit;
    } catch (Exception $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        error_log('Error al desactivar empleado: ' . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Error al desactivar el empleado. Por favor, inténtalo de nuevo más tarde.']);
        exit;
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
    exit;
}
?>
