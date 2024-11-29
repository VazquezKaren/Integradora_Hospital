<?php
include '../config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Inicializar un arreglo para almacenar errores de validación
    $errores = [];

    // Validar y sanitizar los datos del formulario
    $nombre = trim($_POST['nombre'] ?? '');
    $apellido_paterno = trim($_POST['apellido_paterno'] ?? '');
    $apellido_materno = trim($_POST['apellido_materno'] ?? '');
    $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';
    $edad = $_POST['edad'] ?? '';
    $sexo = strtoupper($_POST['sexo'] ?? '');
    $curp = trim($_POST['curp'] ?? '');
    $paciente_pais = trim($_POST['paciente_pais'] ?? '');
    $paciente_estado = trim($_POST['paciente_estado'] ?? '');
    $paciente_municipio = trim($_POST['paciente_municipio'] ?? '');
    $direccion_calle = trim($_POST['direccion_calle'] ?? '');
    $direccion_numero = trim($_POST['direccion_numero'] ?? '');
    $direccion_colonia = trim($_POST['direccion_colonia'] ?? '');
    $derechohabiente = trim($_POST['derechohabiente'] ?? '');
    $dx = trim($_POST['dx'] ?? '');
    $observaciones = trim($_POST['observaciones'] ?? '');
    $servicio_solicitado = trim($_POST['servicio_solicitado'] ?? '');
    $motivo = trim($_POST['motivo'] ?? '');

    // Datos del tutor (responsable)
    $responsable_nombre = trim($_POST['responsable_nombre'] ?? '');
    $responsable_apellido_paterno = trim($_POST['responsable_apellido_paterno'] ?? '');
    $responsable_apellido_materno = trim($_POST['responsable_apellido_materno'] ?? '');
    $parentesco = strtoupper($_POST['parentesco'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $ocupacion = trim($_POST['ocupacion'] ?? '');
    $responsable_pais = trim($_POST['responsable_pais'] ?? '');
    $responsable_estado = trim($_POST['responsable_estado'] ?? '');
    $responsable_municipio = trim($_POST['responsable_municipio'] ?? '');
    $responsable_direccion_calle = trim($_POST['responsable_direccion_calle'] ?? '');
    $responsable_direccion_numero = trim($_POST['responsable_direccion_numero'] ?? '');
    $responsable_direccion_colonia = trim($_POST['responsable_direccion_colonia'] ?? '');
    $personas_hogar = $_POST['personas_hogar'] ?? '';
    $personas_apoyo = $_POST['personas_apoyo'] ?? '';
    $indice_economico = strtoupper($_POST['indice_economico'] ?? '');
    $clasificacion_trabajo_social = strtoupper($_POST['clasificacion_trabajo_social'] ?? '');
    $total_ingresos = $_POST['total_ingresos'] ?? '';
    $total_egresos = $_POST['total_egresos'] ?? '';

    // Validaciones
    if (empty($nombre)) $errores[] = 'El nombre del paciente es obligatorio.';
    if (empty($apellido_paterno)) $errores[] = 'El apellido paterno del paciente es obligatorio.';
    if (empty($fecha_nacimiento)) $errores[] = 'La fecha de nacimiento es obligatoria.';
    if (empty($curp)) $errores[] = 'El CURP es obligatorio.';
    if (empty($sexo) || !in_array($sexo, ['MASCULINO', 'FEMENINO'])) $errores[] = 'El sexo es obligatorio y debe ser MASCULINO o FEMENINO.';
    // Agregar más validaciones según sea necesario

    // Validación del usuario en sesión
    $fkIdUsuario = $_SESSION['idUsuario'] ?? null;
    if (!$fkIdUsuario) {
        $errores[] = 'No se pudo obtener el ID del usuario de la sesión.';
    }

    if (count($errores) > 0) {
        // Si hay errores, almacenarlos en la sesión y redirigir
        $_SESSION['error_message'] = implode('<br>', $errores);
        header('Location: ../views/registro.php');
        exit;
    }

    try {
        $conn = new conn();
        $pdo = $conn->connect();

        // Iniciar transacción
        $pdo->beginTransaction();

        // Establecer status inicial (1 = activo)
        $status = 1;

        // Insertar en la tabla paciente
        $sqlPaciente = "INSERT INTO paciente (
            curp, nombres, apellidoPaterno, apellidoMaterno, fechaNacimiento, pais, estado, municipio,
            sexo, edad, calleDireccion, numeroDireccion, coloniaDireccion, derechoHabiente, dx, observaciones, status
        ) VALUES (
            :curp, :nombres, :apellidoPaterno, :apellidoMaterno, :fechaNacimiento, :pais, :estado, :municipio,
            :sexo, :edad, :calleDireccion, :numeroDireccion, :coloniaDireccion, :derechoHabiente, :dx, :observaciones, :status
        )";

        $stmtPaciente = $pdo->prepare($sqlPaciente);
        $stmtPaciente->execute([
            'curp' => $curp,
            'nombres' => $nombre,
            'apellidoPaterno' => $apellido_paterno,
            'apellidoMaterno' => $apellido_materno,
            'fechaNacimiento' => $fecha_nacimiento,
            'pais' => $paciente_pais,
            'estado' => $paciente_estado,
            'municipio' => $paciente_municipio,
            'sexo' => $sexo,
            'edad' => $edad,
            'calleDireccion' => $direccion_calle,
            'numeroDireccion' => $direccion_numero,
            'coloniaDireccion' => $direccion_colonia,
            'derechoHabiente' => $derechohabiente,
            'dx' => $dx,
            'observaciones' => $observaciones,
            'status' => $status
        ]);

        // Obtener el ID del paciente insertado
        $idPaciente = $pdo->lastInsertId();

        // Insertar en la tabla tutor
        $sqlTutor = "INSERT INTO tutor (
            nombres, apellidoPaterno, apellidoMaterno, noPersonasHogar, noPersonasApoyanEconomiaHogar,
            totalIngresos, totalEgresos, indiceEconomico, trabajoSocial, parentesco, pais, estado, municipio,
            calleDireccion, numeroDireccion, coloniaDireccion, telefono, ocupacion, fkIdPaciente
        ) VALUES (
            :nombres, :apellidoPaterno, :apellidoMaterno, :noPersonasHogar, :noPersonasApoyanEconomiaHogar,
            :totalIngresos, :totalEgresos, :indiceEconomico, :trabajoSocial, :parentesco, :pais, :estado, :municipio,
            :calleDireccion, :numeroDireccion, :coloniaDireccion, :telefono, :ocupacion, :fkIdPaciente
        )";

        $stmtTutor = $pdo->prepare($sqlTutor);
        $stmtTutor->execute([
            'nombres' => $responsable_nombre,
            'apellidoPaterno' => $responsable_apellido_paterno,
            'apellidoMaterno' => $responsable_apellido_materno,
            'noPersonasHogar' => $personas_hogar,
            'noPersonasApoyanEconomiaHogar' => $personas_apoyo,
            'totalIngresos' => $total_ingresos,
            'totalEgresos' => $total_egresos,
            'indiceEconomico' => $indice_economico,
            'trabajoSocial' => $clasificacion_trabajo_social,
            'parentesco' => $parentesco,
            'pais' => $responsable_pais,
            'estado' => $responsable_estado,
            'municipio' => $responsable_municipio,
            'calleDireccion' => $responsable_direccion_calle,
            'numeroDireccion' => $responsable_direccion_numero,
            'coloniaDireccion' => $responsable_direccion_colonia,
            'telefono' => $telefono,
            'ocupacion' => $ocupacion,
            'fkIdPaciente' => $idPaciente
        ]);

        // Datos para la tabla ingresos
        $fechaIngreso = date('Y-m-d');
        $horaIngreso = date('H:i:s');
        $egreso = 0; // No ha egresado aún

        // Determinar el turno basado en la hora actual
        $horaActual = (int)date('H');
        if ($horaActual >= 6 && $horaActual < 14) {
            $turno = 'MATUTINO';
        } elseif ($horaActual >= 14 && $horaActual < 22) {
            $turno = 'VESPERTINO';
        } else {
            $turno = 'NOCTURNO';
        }

        // Insertar en la tabla ingresos
        $sqlIngresos = "INSERT INTO ingresos (
            fechaIngreso, horaIngreso, egreso, motivo, servicioSolicita, turno, fkIdPaciente, fkIdUsuario
        ) VALUES (
            :fechaIngreso, :horaIngreso, :egreso, :motivo, :servicioSolicita, :turno, :fkIdPaciente, :fkIdUsuario
        )";

        $stmtIngresos = $pdo->prepare($sqlIngresos);
        $stmtIngresos->execute([
            'fechaIngreso' => $fechaIngreso,
            'horaIngreso' => $horaIngreso,
            'egreso' => $egreso,
            'motivo' => $motivo,
            'servicioSolicita' => $servicio_solicitado,
            'turno' => $turno,
            'fkIdPaciente' => $idPaciente,
            'fkIdUsuario' => $fkIdUsuario
        ]);

        // Confirmar la transacción
        $pdo->commit();

        // Establecer mensaje de éxito y redirigir
        $_SESSION['success_message'] = 'Paciente registrado exitosamente.';
        header('Location: ../views/registro.php');
        exit;
    } catch (PDOException $e) {
        // Revertir la transacción en caso de error
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }

        // Registrar el error en un archivo de log (opcional)
        error_log('Error en la base de datos: ' . $e->getMessage());

        // Establecer mensaje de error y redirigir
        $_SESSION['error_message'] = 'Error al registrar el paciente. Por favor, inténtelo de nuevo más tarde.';
        header('Location: ../views/registro.php');
        exit;
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }

        // Registrar el error en un archivo de log (opcional)
        error_log('Error general: ' . $e->getMessage());

        // Establecer mensaje de error y redirigir
        $_SESSION['error_message'] = 'Error al registrar el paciente. Por favor, inténtelo de nuevo más tarde.';
        header('Location: ../views/registro.php');
        exit;
    }
} else {
    // Método no permitido
    $_SESSION['error_message'] = 'Método no permitido.';
    header('Location: ../views/registro.php');
    exit;
}
