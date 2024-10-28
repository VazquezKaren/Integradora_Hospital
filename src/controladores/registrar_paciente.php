<?php
// Incluir la configuración de la base de datos
include 'config.php';

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
    $responsable_nombre = htmlspecialchars($_POST['responsable_nombre']);
    $responsable_apellido_paterno = htmlspecialchars($_POST['responsable_apellido_paterno']);
    $responsable_apellido_materno = htmlspecialchars($_POST['responsable_apellido_materno']);
    $parentesco = htmlspecialchars($_POST['parentesco']);
    $telefono = htmlspecialchars($_POST['telefono']);
    $ocupacion = htmlspecialchars($_POST['ocupacion']);
    $responsable_direccion_calle = htmlspecialchars($_POST['responsable_direccion_calle']);
    $responsable_direccion_numero = htmlspecialchars($_POST['responsable_direccion_numero']);
    $responsable_direccion_colonia = htmlspecialchars($_POST['responsable_direccion_colonia']);

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
