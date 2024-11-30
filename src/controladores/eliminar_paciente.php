<?php
include '../config.php';
session_start();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $curp = $_POST['curp'] ?? null;

    if (!$curp) {
        echo json_encode(['success' => false, 'message' => 'CURP del paciente no proporcionado.']);
        exit;
    }

    try {
        $conn = new conn();
        $pdo = $conn->connect();
        $pdo->beginTransaction();

        // Verificar si el paciente existe y está activo
        $sql_check = "SELECT idPaciente FROM paciente WHERE curp = :curp AND status = 1";
        $stmt = $pdo->prepare($sql_check);
        $stmt->execute([':curp' => $curp]);
        $idPaciente = $stmt->fetchColumn();

        if (!$idPaciente) {
            $pdo->rollBack();
            echo json_encode(['success' => false, 'message' => 'Paciente no encontrado o ya inactivo.']);
            exit;
        }

        // Actualizar el 'status' del paciente a 0 (inactivo)
        $sql_update_paciente = "UPDATE paciente SET status = 0 WHERE idPaciente = :idPaciente";
        $stmt = $pdo->prepare($sql_update_paciente);
        $stmt->execute([':idPaciente' => $idPaciente]);

        // Si hay tablas relacionadas que necesitan actualizarse, puedes actualizar su 'status' aquí

        $pdo->commit();
        echo json_encode(['success' => true, 'message' => 'Paciente desactivado correctamente.']);
        exit;
    } catch (Exception $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        error_log('Error al desactivar paciente: ' . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Error al desactivar el paciente. Por favor, inténtalo de nuevo más tarde.']);
        exit;
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
    exit;
}
?>
