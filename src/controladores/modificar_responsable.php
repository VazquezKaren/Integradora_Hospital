<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../config.php'; 
$database = new conn();
$conn = $database->connect();

header('Content-Type: application/json');

$paciente_CURP = $_POST['curp'] ?? null;

if (!$paciente_CURP) {
    echo json_encode(['success' => false, 'message' => 'CURP del paciente no proporcionada.']);
    exit;
}

try {
    $conn->beginTransaction();

    $sql_check = "SELECT idPaciente FROM paciente WHERE curp = :curp";
    $stmt = $conn->prepare($sql_check);
    $stmt->execute([':curp' => $paciente_CURP]);
    $idPacienteDB = $stmt->fetchColumn();

    if (!$idPacienteDB) {
        echo json_encode(['success' => false, 'message' => 'Paciente no encontrado.']);
        $conn->rollBack();
        exit;
    }

    $tutor_nombre = strtoupper(htmlspecialchars($_POST['nombre_responsable'] ?? ''));
    $tutor_apellido_paterno = strtoupper(htmlspecialchars($_POST['apellido_p_responsable'] ?? ''));
    $tutor_apellido_materno = strtoupper(htmlspecialchars($_POST['apellido_m_responsable'] ?? ''));
    $parentesco = strtoupper(htmlspecialchars($_POST['parentesco'] ?? ''));
    $telefono = htmlspecialchars($_POST['telefono'] ?? '');
    $ocupacion = strtoupper(htmlspecialchars($_POST['ocupacion'] ?? ''));
    $tutor_pais = strtoupper(htmlspecialchars($_POST['tutor_pais'] ?? ''));
    $tutor_estado = strtoupper(htmlspecialchars($_POST['tutor_estado'] ?? ''));
    $tutor_municipio = strtoupper(htmlspecialchars($_POST['tutor_municipio'] ?? ''));
    $tutor_direccion_calle = strtoupper(htmlspecialchars($_POST['calle_responsable'] ?? ''));
    $tutor_direccion_numero = strtoupper(htmlspecialchars($_POST['numero_responsable'] ?? ''));
    $tutor_direccion_colonia = strtoupper(htmlspecialchars($_POST['colonia_responsable'] ?? ''));

    // Datos económicos y de hogar
    $personas_hogar = (int) ($_POST['personas_hogar'] ?? 0);
    $personas_apoyo = (int) ($_POST['personas_apoyo'] ?? 0);
    $indice_economico = strtoupper(htmlspecialchars($_POST['indice_economico'] ?? ''));
    $ingresos = (float) ($_POST['ingresos'] ?? 0);
    $egresos = (float) ($_POST['egresos'] ?? 0);

    // Consulta para actualizar los datos del tutor
    $sql_update_tutor = "UPDATE tutor SET 
        nombres = :tutor_nombre,
        apellidoPaterno = :tutor_apellido_paterno,
        apellidoMaterno = :tutor_apellido_materno,
        parentesco = :parentesco,
        telefono = :telefono,
        ocupacion = :ocupacion,
        pais = :tutor_pais,
        estado = :tutor_estado,
        municipio = :tutor_municipio,
        calleDireccion = :tutor_direccion_calle,
        numeroDireccion = :tutor_direccion_numero,
        coloniaDireccion = :tutor_direccion_colonia,
        noPersonasHogar = :personas_hogar,
        noPersonasApoyanEconomiaHogar = :personas_apoyo,
        indiceEconomico = :indice_economico,
        totalIngresos = :ingresos,
        totalEgresos = :egresos
        WHERE fkIdPaciente = :idPaciente";

    $stmt = $conn->prepare($sql_update_tutor);
    $stmt->execute([
        ':tutor_nombre' => $tutor_nombre,
        ':tutor_apellido_paterno' => $tutor_apellido_paterno,
        ':tutor_apellido_materno' => $tutor_apellido_materno,
        ':parentesco' => $parentesco,
        ':telefono' => $telefono,
        ':ocupacion' => $ocupacion,
        ':tutor_pais' => $tutor_pais,
        ':tutor_estado' => $tutor_estado,
        ':tutor_municipio' => $tutor_municipio,
        ':tutor_direccion_calle' => $tutor_direccion_calle,
        ':tutor_direccion_numero' => $tutor_direccion_numero,
        ':tutor_direccion_colonia' => $tutor_direccion_colonia,
        ':personas_hogar' => $personas_hogar,
        ':personas_apoyo' => $personas_apoyo,
        ':indice_economico' => $indice_economico,
        ':ingresos' => $ingresos,
        ':egresos' => $egresos,
        ':idPaciente' => $idPacienteDB
    ]);

    if ($stmt->rowCount() === 0) {
        echo json_encode(['success' => false, 'message' => 'No se realizaron cambios en los datos del tutor.']);
        $conn->rollBack();
        exit;
    }

    $conn->commit();
    echo json_encode(['success' => true, 'message' => 'Datos del tutor actualizados correctamente.']);
    exit;
} catch (Exception $e) {
    $conn->rollBack();
    echo json_encode(['success' => false, 'message' => 'Error al actualizar los datos del tutor: ' . $e->getMessage()]);
    exit;
}
?>
