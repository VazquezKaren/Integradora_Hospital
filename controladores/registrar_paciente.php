<?php
// Preparar y sanitizar los datos del paciente
$nombre = $_POST['nombre'];
$apellido_paterno = $_POST['apellido_paterno'];
$apellido_materno = $_POST['apellido_materno'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$edad = $_POST['edad'];
$lugar_nacimiento = $_POST['lugar_nacimiento'];
$sexo = $_POST['sexo'];
$servicio_solicitado = $_POST['servicio_solicitado'];
$dx_registro = $_POST['dx_registro'];

// Dirección del paciente
$direccion_calle = $_POST['direccion_calle'];
$direccion_numero = $_POST['direccion_numero'];
$direccion_colonia = $_POST['direccion_colonia'];

// Información del tutor
$responsable_nombre = $_POST['responsable_nombre'];
$responsable_apellido_paterno = $_POST['responsable_apellido_paterno'];
$responsable_apellido_materno = $_POST['responsable_apellido_materno'];
$parentesco = $_POST['parentesco'];
$telefono = $_POST['telefono'];
$ocupacion = $_POST['ocupacion'];
$responsable_direccion_calle = $_POST['responsable_direccion_calle'];
$responsable_direccion_numero = $_POST['responsable_direccion_numero'];
$responsable_direccion_colonia = $_POST['responsable_direccion_colonia'];

// Trabajo social
$personas_hogar = $_POST['personas_hogar'];
$clasificacion_trabajo_social = $_POST['clasificacion_trabajo_social'];
$personas_apoyo = $_POST['personas_apoyo'];
$indice_economico = $_POST['indice_economico'];
$derechohabiente = $_POST['derechohabiente'];
$derechohabiente_otro = $_POST['derechohabiente_otro'];
$observaciones = $_POST['observaciones'];

// Insertar los datos del paciente en la tabla correspondiente
$sql_paciente = "INSERT INTO paciente (nombre, apellido_paterno, apellido_materno, fecha_nacimiento, edad, lugar_nacimiento, sexo, servicio_solicitado, dx_registro, direccion_calle, direccion_numero, direccion_colonia)
VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$fecha_nacimiento', '$edad', '$lugar_nacimiento', '$sexo', '$servicio_solicitado', '$dx_registro', '$direccion_calle', '$direccion_numero', '$direccion_colonia')";

if ($conn->query($sql_paciente) === TRUE) {
    $idPaciente = $conn->insert_id;

    // Insertar los datos del tutor
    $sql_tutor = "INSERT INTO tutor (idPaciente, nombre, apellido_paterno, apellido_materno, parentesco, telefono, ocupacion, direccion_calle, direccion_numero, direccion_colonia)
    VALUES ('$idPaciente', '$responsable_nombre', '$responsable_apellido_paterno', '$responsable_apellido_materno', '$parentesco', '$telefono', '$ocupacion', '$responsable_direccion_calle', '$responsable_direccion_numero', '$responsable_direccion_colonia')";

    if ($conn->query($sql_tutor) === TRUE) {
        // Insertar los datos de trabajo social
        $sql_trabajo_social = "INSERT INTO trabajo_social (idPaciente, personas_hogar, clasificacion_trabajo_social, personas_apoyo, indice_economico, derechohabiente, derechohabiente_otro, observaciones)
        VALUES ('$idPaciente', '$personas_hogar', '$clasificacion_trabajo_social', '$personas_apoyo', '$indice_economico', '$derechohabiente', '$derechohabiente_otro', '$observaciones')";

        if ($conn->query($sql_trabajo_social) === TRUE) {
            echo "Registro completado exitosamente.";
        } else {
            echo "Error al registrar datos de trabajo social: " . $conn->error;
        }
    } else {
        echo "Error al registrar datos del tutor: " . $conn->error;
    }
} else {
    echo "Error al registrar datos del paciente: " . $conn->error;
}

$conn->close();
?>