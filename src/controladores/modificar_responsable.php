<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../config.php';
$database = new conn();
$conn = $database->connect();

header('Content-Type: application/json');

$curp = $_POST['curp'] ?? null;
$noRegistro = $_POST['noRegistro'] ?? null;

if (!$curp && !$noRegistro) {
    echo json_encode(['success' => false, 'message' => 'CURP o No. de Registro no proporcionado.']);
    exit;
}

$identificador = $curp ?: $noRegistro;
$column = $curp ? 'curp' : 'noRegistro';

try {
    $conn->beginTransaction();

    $sql_check = "SELECT idPaciente FROM paciente WHERE $column = :identificador";
    $stmt = $conn->prepare($sql_check);
    $stmt->execute([':identificador' => $identificador]);
    $idPaciente = $stmt->fetchColumn();

    if (!$idPaciente) {
        echo json_encode(['success' => false, 'message' => 'Paciente no encontrado con el identificador proporcionado.']);
        $conn->rollBack();
        exit;
    }

    $sql_update_responsable = "UPDATE tutor SET 
        nombres = :nombre_responsable,
        apellidoPaterno = :apellido_p_responsable,
        apellidoMaterno = :apellido_m_responsable,
        parentesco = :parentesco,
        telefono = :telefono,
        ocupacion = :ocupacion,
        pais = :tutor_pais,
        estado = :tutor_estado,
        municipio = :tutor_municipio,
        calleDireccion = :calle_responsable,
        numeroDireccion = :numero_responsable,
        coloniaDireccion = :colonia_responsable,
        noPersonasHogar = :personas_hogar,
        noPersonasApoyanEconomiaHogar = :personas_apoyo,
        indiceEconomico = :indice_economico,
        totalIngresos = :ingresos,
        totalEgresos = :egresos
        WHERE fkIdPaciente = :idPaciente";

    $stmt = $conn->prepare($sql_update_responsable);
    $stmt->execute([
        ':nombre_responsable' => strtoupper($_POST['nombre_responsable'] ?? ''),
        ':apellido_p_responsable' => strtoupper($_POST['apellido_p_responsable'] ?? ''),
        ':apellido_m_responsable' => strtoupper($_POST['apellido_m_responsable'] ?? ''),
        ':parentesco' => strtoupper($_POST['parentesco'] ?? ''),
        ':telefono' => $_POST['telefono'] ?? null,
        ':ocupacion' => strtoupper($_POST['ocupacion'] ?? ''),
        ':tutor_pais' => strtoupper($_POST['tutor_pais'] ?? ''),
        ':tutor_estado' => strtoupper($_POST['tutor_estado'] ?? ''),
        ':tutor_municipio' => strtoupper($_POST['tutor_municipio'] ?? ''),
        ':calle_responsable' => strtoupper($_POST['calle_responsable'] ?? ''),
        ':numero_responsable' => strtoupper($_POST['numero_responsable'] ?? ''),
        ':colonia_responsable' => strtoupper($_POST['colonia_responsable'] ?? ''),
        ':personas_hogar' => (int) ($_POST['personas_hogar'] ?? 0),
        ':personas_apoyo' => (int) ($_POST['personas_apoyo'] ?? 0),
        ':indice_economico' => strtoupper($_POST['indice_economico'] ?? ''),
        ':ingresos' => (float) ($_POST['ingresos'] ?? 0),
        ':egresos' => (float) ($_POST['egresos'] ?? 0),
        ':idPaciente' => $idPaciente
    ]);

    $conn->commit();
    echo json_encode(['success' => true, 'message' => 'Datos del responsable actualizados correctamente.']);
} catch (Exception $e) {
    $conn->rollBack();
    echo json_encode(['success' => false, 'message' => 'Error  ' . $e->getMessage()]);
}
