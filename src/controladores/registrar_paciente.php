<?php
// Incluir la configuración de la base de datos
include '../config.php';

    // Preparar y sanitizar los datos del paciente
    $nombre = htmlspecialchars($_POST['nombre']);
    $apellido_paterno = htmlspecialchars($_POST['apellido_paterno']);
    $apellido_materno = htmlspecialchars($_POST['apellido_materno']);
    $fecha_nacimiento = htmlspecialchars($_POST['fecha_nacimiento']);
    $edad = (int)$_POST['edad'];
    $lugar_nacimiento = htmlspecialchars($_POST['lugar_nacimiento']);
    $sexo = htmlspecialchars($_POST['sexo']);
    $servicio_solicitado = htmlspecialchars($_POST['servicio_solicitado']);
    $dx_registro = htmlspecialchars($_POST['dx_registro']);

    // Dirección del paciente
    $direccion_calle = htmlspecialchars($_POST['direccion_calle']);
    $direccion_numero = htmlspecialchars($_POST['direccion_numero']);
    $direccion_colonia = htmlspecialchars($_POST['direccion_colonia']);

    // Información del tutor
    $tutor_nombre = htmlspecialchars($_POST['tutor_nombre']);
    $tutor_apellido_paterno = htmlspecialchars($_POST['tutor_apellido_paterno']);
    $tutor_apellido_materno = htmlspecialchars($_POST['tutor_apellido_materno']);
    $parentesco = htmlspecialchars($_POST['parentesco']);
    $telefono = htmlspecialchars($_POST['telefono']);
    $ocupacion = htmlspecialchars($_POST['ocupacion']);
    $tutor_direccion_calle = htmlspecialchars($_POST['tutor_direccion_calle']);
    $tutor_direccion_numero = htmlspecialchars($_POST['tutor_direccion_numero']);
    $tutor_direccion_colonia = htmlspecialchars($_POST['tutor_direccion_colonia']);

    // Trabajo social
    $personas_hogar = (int)$_POST['personas_hogar'];
    $clasificacion_trabajo_social = htmlspecialchars($_POST['clasificacion_trabajo_social']);
    $personas_apoyo = htmlspecialchars($_POST['personas_apoyo']);
    $indice_economico = htmlspecialchars($_POST['indice_economico']);
    $derechohabiente = htmlspecialchars($_POST['derechohabiente']);
    $derechohabiente_otro = htmlspecialchars($_POST['derechohabiente_otro']);
    $observaciones = htmlspecialchars($_POST['observaciones']);

    try {
        // Iniciar una transacción
        $conn->beginTransaction();

        // Comprobar si el paciente ya está registrado
        $sql_check = "SELECT idPaciente FROM paciente WHERE nombre = :nombre AND apellido_paterno = :apellido_paterno AND apellido_materno = :apellido_materno AND fecha_nacimiento = :fecha_nacimiento";
        $stmt = $conn->prepare($sql_check);
        $stmt->execute([
            ':nombre' => $nombre,
            ':apellido_paterno' => $apellido_paterno,
            ':apellido_materno' => $apellido_materno,
            ':fecha_nacimiento' => $fecha_nacimiento
        ]);
        $idPaciente = $stmt->fetchColumn();

        if ($idPaciente) {
        // Insertar los datos del paciente
        $sql_paciente = "INSERT INTO paciente (nombre, apellido_paterno, apellido_materno, fecha_nacimiento, edad, lugar_nacimiento, sexo, servicio_solicitado, dx_registro, direccion_calle, direccion_numero, direccion_colonia)VALUES (:nombre, :apellido_paterno, :apellido_materno, :fecha_nacimiento, :edad, :lugar_nacimiento, :sexo, :servicio_solicitado, :dx_registro, :direccion_calle, :direccion_numero, :direccion_colonia)";
        $stmt = $conn->prepare($sql_paciente);
        $stmt->execute([
            ':nombre' => $nombre,
            ':apellido_paterno' => $apellido_paterno,
            ':apellido_materno' => $apellido_materno,
            ':fecha_nacimiento' => $fecha_nacimiento,
            ':edad' => $edad,
            ':lugar_nacimiento' => $lugar_nacimiento,
            ':sexo' => $sexo,
            ':servicio_solicitado' => $servicio_solicitado,
            ':dx_registro' => $dx_registro,
            ':direccion_calle' => $direccion_calle,
            ':direccion_numero' => $direccion_numero,
            ':direccion_colonia' => $direccion_colonia
        ]);
        // Obtener el ID del nuevo paciente
        $idPaciente = $conn->lastInsertId();
    }
        // Obtener el último ID insertado
        $idPaciente = $conn->lastInsertId();

        // Insertar los datos del tutor
        $sql_tutor = "INSERT INTO tutor (idPaciente, nombre, apellido_paterno, apellido_materno, parentesco, telefono, ocupacion, direccion_calle, direccion_numero, direccion_colonia)VALUES (:idPaciente, :nombre, :apellido_paterno, :apellido_materno, :parentesco, :telefono, :ocupacion, :direccion_calle, :direccion_numero, :direccion_colonia)";
        $stmt = $conn->prepare($sql_tutor);
        $stmt->execute([
            ':idPaciente' => $idPaciente,
            ':nombre' => $responsable_nombre,
            ':apellido_paterno' => $responsable_apellido_paterno,
            ':apellido_materno' => $responsable_apellido_materno,
            ':parentesco' => $parentesco,
            ':telefono' => $telefono,
            ':ocupacion' => $ocupacion,
            ':direccion_calle' => $responsable_direccion_calle,
            ':direccion_numero' => $responsable_direccion_numero,
            ':direccion_colonia' => $responsable_direccion_colonia
        ]);

        // Insertar los datos de trabajo social
        $sql_trabajo_social = "INSERT INTO trabajo_social (idPaciente, personas_hogar, clasificacion_trabajo_social, personas_apoyo, indice_economico, derechohabiente, derechohabiente_otro, observaciones)VALUES (:idPaciente, :personas_hogar, :clasificacion_trabajo_social, :personas_apoyo, :indice_economico, :derechohabiente, :derechohabiente_otro, :observaciones)";
        $stmt = $conn->prepare($sql_trabajo_social);
        $stmt->execute([
            ':idPaciente' => $idPaciente,
            ':personas_hogar' => $personas_hogar,
            ':clasificacion_trabajo_social' => $clasificacion_trabajo_social,
            ':personas_apoyo' => $personas_apoyo,
            ':indice_economico' => $indice_economico,
            ':derechohabiente' => $derechohabiente,
            ':derechohabiente_otro' => $derechohabiente_otro,
            ':observaciones' => $observaciones
        ]);

    // Generar Hoja frontal
    $pdf = new TCPDF();
    $pdf->AddPage();
    $pdf->SetFont('helvetica', '', 12);

    // Contenido del PDF
    $pdf->Cell(0, 10, "Hoja Frontal", 0, 1, 'C');
    $pdf->Cell(0, 10, "Fecha de Ingreso: " . date('Y-m-d'), 0, 1);
    $pdf->Cell(0, 10, "Hora de Ingreso: " . date('H:i:s'), 0, 1);
    $pdf->Cell(0, 10, "Número de Registro: " . $idPaciente, 0, 1);
    $pdf->Cell(0, 10, "Nombre: " . $nombre . " " . $apellido_paterno . " " . $apellido_materno, 0, 1);
    $pdf->Cell(0, 10, "Edad: " . $edad, 0, 1);
    $pdf->Cell(0, 10, "Fecha de Nacimiento: " . $fecha_nacimiento, 0, 1);
    $pdf->Cell(0, 10, "DX Inicial: " . $dx_registro, 0, 1);
    $pdf->Cell(0, 10, "Nombre del Tutor: " . $responsable_nombre . " " . $responsable_apellido_paterno, 0, 1);

    // Guardar el PDF
    $pdf->Output("hoja_frontal_$idPaciente.pdf", 'D');

    // Confirmar la transacción
    $conn->commit();
    echo "Registro completado exitosamente.";
} catch (PDOException $e) {
    // Revertir la transacción en caso de error
    $conn->rollBack();
    echo "Error al registrar los datos: " . $e->getMessage();
}

    // Cerrar la conexión
    $conn = null;

?>
