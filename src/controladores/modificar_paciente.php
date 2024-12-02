<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../config.php';
$database = new conn();
$conn = $database->connect();

header('Content-Type: application/json');

$paciente_CURP = $_POST['curp'] ?? null;
$paciente_noRegistro = $_POST['noRegistro'] ?? null;

if ($paciente_CURP && !preg_match('/^[A-Z0-9]{18}$/', $paciente_CURP)) {
    echo json_encode(['success' => false, 'message' => 'El formato del CURP es inválido. Debe contener 18 caracteres.']);
    exit;
}

if ($paciente_noRegistro && !preg_match('/^\d{4}\/\d{2}$/', $paciente_noRegistro)) {
    echo json_encode(['success' => false, 'message' => 'El formato de No. de Registro es inválido. Debe tener el formato 0000/00.']);
    exit;
}

if (!$paciente_CURP && !$paciente_noRegistro) {
    echo json_encode(['success' => false, 'message' => 'Identificador (CURP o No. de Registro) no proporcionado.']);
    exit;
}

$identificador = $paciente_CURP ?: $paciente_noRegistro;
$column = $paciente_CURP ? 'curp' : 'noRegistro';

try {
    $conn->beginTransaction();

    $sql_check = "SELECT idPaciente FROM paciente WHERE $column = :identificador";
    $stmt = $conn->prepare($sql_check);
    $stmt->execute([':identificador' => $identificador]);
    $idPacienteDB = $stmt->fetchColumn();

    if (!$idPacienteDB) {
        echo json_encode(['success' => false, 'message' => 'Paciente no encontrado.']);
        $conn->rollBack();
        exit;
    }

    error_log("Datos recibidos: " . print_r($_POST, true));

    $sql_update_paciente = "UPDATE paciente SET 
        nombres = :nombres,
        apellidoPaterno = :apellidoPaterno,
        apellidoMaterno = :apellidoMaterno,
        curp = :curp,
        noRegistro = :no_registro,
        fechaNacimiento = :fecha_nacimiento,
        edad = :edad,
        sexo = :sexo,
        pais = :pais,
        estado = :estado,
        municipio = :municipio,
        calleDireccion = :calle,
        numeroDireccion = :numero,
        coloniaDireccion = :colonia,
        derechoHabiente = :derechoHabiente,
        dx = :dx,
        observaciones = :observaciones
        WHERE idPaciente = :idPaciente";

    $stmt = $conn->prepare($sql_update_paciente);
    $stmt->execute([
        ':nombres' => strtoupper($_POST['nombres'] ?? ''),
        ':apellidoPaterno' => strtoupper($_POST['apellidoPaterno'] ?? ''),
        ':apellidoMaterno' => strtoupper($_POST['apellidoMaterno'] ?? ''),
        ':curp' => strtoupper($_POST['curp'] ?? ''),
        ':no_registro' => $_POST['no_registro'] ?? null,
        ':fecha_nacimiento' => $_POST['fecha_nacimiento'] ?? null,
        ':edad' => (int) ($_POST['paciente_edad'] ?? 0),
        ':sexo' => strtoupper($_POST['sexo'] ?? ''),
        ':pais' => strtoupper($_POST['paciente_pais'] ?? ''),
        ':estado' => strtoupper($_POST['paciente_estado'] ?? ''),
        ':municipio' => strtoupper($_POST['paciente_municipio'] ?? ''),
        ':calle' => strtoupper($_POST['calle'] ?? ''),
        ':numero' => strtoupper($_POST['numero'] ?? ''),
        ':colonia' => strtoupper($_POST['colonia'] ?? ''),
        ':derechoHabiente' => strtoupper($_POST['derechoHabiente'] ?? ''),
        ':dx' => strtoupper($_POST['dx'] ?? ''),
        ':observaciones' => strtoupper($_POST['observaciones'] ?? ''),
        ':idPaciente' => $idPacienteDB
    ]);

    $conn->commit();
    echo json_encode(['success' => true, 'message' => 'Datos del paciente actualizados correctamente.']);
} catch (Exception $e) {
    $conn->rollBack();
    echo json_encode(['success' => false, 'message' => 'Error al procesar la solicitud: ' . $e->getMessage()]);
}
