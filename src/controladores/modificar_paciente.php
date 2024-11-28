<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../config.php';
$database = new conn();
$conn = $database->connect();

$noRegistro = $_POST['noRegistro'] ?? null;

if (!$noRegistro) {
    echo json_encode(['success' => false, 'message' => 'NoRegistro (ID del paciente) no proporcionado']);
    exit;
}

try {
    $conn->beginTransaction();

    $sql_check = "SELECT idPaciente FROM paciente WHERE noRegistro = :noRegistro";
    $stmt = $conn->prepare($sql_check);
    $stmt->execute([':noRegistro' => $noRegistro]);
    $idPacienteDB = $stmt->fetchColumn();

    if ($idPacienteDB) {
        $nombre_paciente = strtoupper(filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS));
        $apellido_paterno = strtoupper(filter_input(INPUT_POST, 'apellido_p', FILTER_SANITIZE_SPECIAL_CHARS));
        $apellido_materno = strtoupper(filter_input(INPUT_POST, 'apellido_m', FILTER_SANITIZE_SPECIAL_CHARS));
        $fecha_nacimiento = filter_input(INPUT_POST, 'fecha_nacimiento', FILTER_SANITIZE_SPECIAL_CHARS);
        $paciente_edad = filter_input(INPUT_POST, 'paciente_edad', FILTER_VALIDATE_INT);
        if ($paciente_edad === false) {
            echo json_encode(['success' => false, 'message' => 'Edad no válida']);
            exit;
        }
        $paciente_pais = strtoupper(filter_input(INPUT_POST, 'paciente_pais', FILTER_SANITIZE_SPECIAL_CHARS));
        $paciente_estado = strtoupper(filter_input(INPUT_POST, 'paciente_estado', FILTER_SANITIZE_SPECIAL_CHARS));
        $paciente_municipio = strtoupper(filter_input(INPUT_POST, 'paciente_municipio', FILTER_SANITIZE_SPECIAL_CHARS));
        $sexo = strtoupper(filter_input(INPUT_POST, 'sexo', FILTER_SANITIZE_SPECIAL_CHARS));
        $derecho_habiente = strtoupper(filter_input(INPUT_POST, 'derechoHabiente', FILTER_SANITIZE_SPECIAL_CHARS));
        $dx = strtoupper(filter_input(INPUT_POST, 'dx', FILTER_SANITIZE_SPECIAL_CHARS));
        $observaciones = strtoupper(filter_input(INPUT_POST, 'observaciones', FILTER_SANITIZE_SPECIAL_CHARS));

        // Dirección del paciente
        $paciente_calle = strtoupper(htmlspecialchars($_POST['calle'] ?? ''));
        $paciente_numero = strtoupper(htmlspecialchars($_POST['numero'] ?? ''));
        $paciente_colonia = strtoupper(htmlspecialchars($_POST['colonia'] ?? ''));

        // Información del tutor
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

        $personas_hogar = (int) ($_POST['personas_hogar'] ?? 0);
        $personas_apoyo = (int) ($_POST['personas_apoyo'] ?? 0);
        $indice_economico = strtoupper(htmlspecialchars($_POST['indice_economico'] ?? ''));
        $ingresos = (float) ($_POST['ingresos'] ?? 0);
        $egresos = (float) ($_POST['egresos'] ?? 0);

        $sql_update_paciente = "UPDATE paciente SET 
            nombres = :nombre_paciente,
            apellidoPaterno = :apellido_paterno,
            apellidoMaterno = :apellido_materno,
            fechaNacimiento = :fecha_nacimiento,
            edad = :paciente_edad, 
            sexo = :sexo, 
            pais = :paciente_pais,
            estado = :paciente_estado,
            municipio = :paciente_municipio,
            calleDireccion = :paciente_calle,
            numeroDireccion = :paciente_numero,
            coloniaDireccion = :paciente_colonia,
            derechoHabiente = :derecho_habiente,
            dx = :dx,
            observaciones = :observaciones
            WHERE idPaciente = :idPaciente";

        $stmt = $conn->prepare($sql_update_paciente);
        $stmt->execute([
            ':nombre_paciente' => $nombre_paciente,
            ':apellido_paterno' => $apellido_paterno,
            ':apellido_materno' => $apellido_materno,
            ':fecha_nacimiento' => $fecha_nacimiento,
            ':paciente_edad' => $paciente_edad,
            ':sexo' => $sexo,
            ':paciente_pais' => $paciente_pais,
            ':paciente_estado' => $paciente_estado,
            ':paciente_municipio' => $paciente_municipio,
            ':paciente_calle' => $paciente_calle,
            ':paciente_numero' => $paciente_numero,
            ':paciente_colonia' => $paciente_colonia,
            ':derecho_habiente' => $derecho_habiente,
            ':dx' => $dx,
            ':observaciones' => $observaciones,
            ':idPaciente' => $idPacienteDB
        ]);

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

        $conn->commit();
        echo json_encode(['success' => true, 'message' => 'Datos del paciente y tutor actualizados correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Paciente no encontrado']);
    }
} catch (Exception $e) {
    $conn->rollBack();
    echo json_encode(['success' => false, 'message' => 'Error al actualizar los datos: ' . $e->getMessage()]);
}
?>
