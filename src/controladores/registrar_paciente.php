<?php

// Incluir el archivo de conexión a la base de datos
include('../config.php');

$connObj = new conn();
$conn = $connObj->connect();

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener y sanitizar los datos del formulario usando htmlspecialchars
    $nombre = htmlspecialchars($_POST['nombre']);
    $apellido_paterno = htmlspecialchars($_POST['apellido_paterno']);
    $apellido_materno = htmlspecialchars($_POST['apellido_materno']);
    $fecha_nacimiento = htmlspecialchars($_POST['fecha_nacimiento']);
    $edad = htmlspecialchars($_POST['edad']);
    $sexo = htmlspecialchars($_POST['sexo']);
    $servicio_solicitado = htmlspecialchars($_POST['servicio_solicitado']);
    $paciente_pais = htmlspecialchars($_POST['paciente_pais']);
    $paciente_estado = htmlspecialchars($_POST['paciente_estado']);
    $paciente_municipio = htmlspecialchars($_POST['paciente_municipio']);
    $dx_registro = htmlspecialchars($_POST['dx_registro']);
    $direccion_calle = htmlspecialchars($_POST['direccion_calle']);
    $direccion_numero = htmlspecialchars($_POST['direccion_numero']);
    $direccion_colonia = htmlspecialchars($_POST['direccion_colonia']);

    // Datos del responsable
    $responsable_nombre = htmlspecialchars($_POST['responsable_nombre']);
    $responsable_apellido_paterno = htmlspecialchars($_POST['responsable_apellido_paterno']);
    $responsable_apellido_materno = htmlspecialchars($_POST['responsable_apellido_materno']);
    $parentesco = htmlspecialchars($_POST['parentesco']);
    $telefono = htmlspecialchars($_POST['telefono']);
    $ocupacion = htmlspecialchars($_POST['ocupacion']);
    $responsable_pais = htmlspecialchars($_POST['responsable_pais']);
    $responsable_estado = htmlspecialchars($_POST['responsable_estado']);
    $responsable_municipio = htmlspecialchars($_POST['responsable_municipio']);
    $responsable_direccion_calle = htmlspecialchars($_POST['responsable_direccion_calle']);
    $responsable_direccion_numero = htmlspecialchars($_POST['responsable_direccion_numero']);
    $responsable_direccion_colonia = htmlspecialchars($_POST['responsable_direccion_colonia']);

    // Datos de trabajo social
    $personas_hogar = htmlspecialchars($_POST['personas_hogar']);
    $clasificacion_trabajo_social = htmlspecialchars($_POST['clasificacion_trabajo_social']);
    $personas_apoyo = htmlspecialchars($_POST['personas_apoyo']);
    $indice_economico = htmlspecialchars($_POST['indice_economico']);
    $derechohabiente = htmlspecialchars($_POST['derechohabiente']);
    $derechohabiente_otro = htmlspecialchars($_POST['derechohabiente_otro']);
    $observaciones = htmlspecialchars($_POST['observaciones']);



    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Transacción para insertar los datos en múltiples tablas
    $conn->begin_transaction();

    try {
        // Insertar datos del paciente en la tabla 'paciente'
        $sql_paciente = "INSERT INTO paciente (nombre, apellidoPaterno, apellidoMaterno, fechaNacimiento, edad, sexo, servicioSolicitado, pais, estado, municipio, dxRegistro, calle, numero, colonia) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql_paciente);
        $stmt->bind_param("ssssisssssssss", $nombre, $apellido_paterno, $apellido_materno, $fecha_nacimiento, $edad, $sexo, $servicio_solicitado, $paciente_pais, $paciente_estado, $paciente_municipio, $dx_registro, $direccion_calle, $direccion_numero, $direccion_colonia);
        $stmt->execute();
        $paciente_id = $conn->insert_id;

        // Insertar datos del responsable en la tabla 'responsable'
        $sql_responsable = "INSERT INTO responsable (nombre, apellidoPaterno, apellidoMaterno, parentesco, telefono, ocupacion, pais, estado, municipio, calle, numero, colonia, fkPaciente) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql_responsable);
        $stmt->bind_param("ssssssssssssi", $responsable_nombre, $responsable_apellido_paterno, $responsable_apellido_materno, $parentesco, $telefono, $ocupacion, $responsable_pais, $responsable_estado, $responsable_municipio, $responsable_direccion_calle, $responsable_direccion_numero, $responsable_direccion_colonia, $paciente_id);
        $stmt->execute();

        // Insertar datos de trabajo social en la tabla 'trabajo_social'
        $sql_trabajo_social = "INSERT INTO trabajo_social (personasHogar, clasificacionTrabajoSocial, personasApoyo, indiceEconomico, derechohabiente, derechohabienteOtro, observaciones, fkPaciente) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql_trabajo_social);
        $stmt->bind_param("isisissi", $personas_hogar, $clasificacion_trabajo_social, $personas_apoyo, $indice_economico, $derechohabiente, $derechohabiente_otro, $observaciones, $paciente_id);
        $stmt->execute();

        // Confirmar la transacción
        $conn->commit();
        echo "Registro exitoso.";
    } catch (Exception $e) {
        // Revertir en caso de error
        $conn->rollback();
        echo "Error al registrar: " . $e->getMessage();
    } finally {
        $stmt->close();
        $conn->close();
    }
}
?>


<?php
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

    // Cerrar la conexión
    $conn = null;

?>
