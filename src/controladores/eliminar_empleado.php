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

        // Verificar si el empleado existe y obtener el idUsuario
        $stmt = $pdo->prepare("CALL sp_verificar_empleado_activo(:idEmpleado, @idUsuario)");
        $stmt->execute([':idEmpleado' => $idEmpleado]);

        // Obtener el resultado de la variable de salida
        $stmt = $pdo->query("SELECT @idUsuario AS idUsuario");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $idUsuario = $result['idUsuario'] ?? 0;

        if ($idUsuario == 0) {
            $pdo->rollBack();
            echo json_encode(['success' => false, 'message' => 'Empleado no encontrado o ya inactivo.']);
            exit;
        }

        // Desactivar al usuario asociado
        $stmt = $pdo->prepare("CALL sp_desactivar_usuario(:idUsuario)");
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
