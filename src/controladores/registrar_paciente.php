<?php
// Establecer zona horaria
date_default_timezone_set('America/Mexico_City');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../config.php');

try {
    $connObj = new conn();
    $pdo = $connObj->connect();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Recolección de datos desde el formulario
        $no_registro = htmlspecialchars($_POST['no_registro']);
        $curp = htmlspecialchars($_POST['CURP']);
        $nombres = htmlspecialchars($_POST['nombre']);
        $apellido_paterno = htmlspecialchars($_POST['apellido_paterno']);
        $apellido_materno = htmlspecialchars($_POST['apellido_materno']);
        $fecha_nacimiento = htmlspecialchars($_POST['fecha_nacimiento']);
        $paciente_pais = htmlspecialchars($_POST['paciente_pais']);
        $paciente_estado = htmlspecialchars($_POST['paciente_estado']);
        $paciente_municipio = htmlspecialchars($_POST['paciente_municipio']);
        $edad = htmlspecialchars($_POST['edad']);
        $sexo = htmlspecialchars($_POST['sexo']);
        $direccion_calle = htmlspecialchars($_POST['direccion_calle']);
        $direccion_numero = htmlspecialchars($_POST['direccion_numero']);
        $direccion_colonia = htmlspecialchars($_POST['direccion_colonia']);
        $derechohabiente = htmlspecialchars($_POST['derechohabiente']);
        $dx = htmlspecialchars($_POST['dx']);
        $observaciones = htmlspecialchars($_POST['observaciones']);
        $status = 1; // Nuevo campo

        $servicio_solicitado = htmlspecialchars($_POST['servicio_solicitado']);
        $motivo = htmlspecialchars($_POST['motivo']);

        // Fechas de ingreso/egreso
        $fecha_ingreso = date('Y-m-d');
        $hora_ingreso = date('H:i:s');
        $fecha_egreso = null;
        $hora_egreso = null;
        $egreso = 0;
        

        //tutor
        $tutor_nombres = htmlspecialchars($_POST['tutor_nombres']);
        $tutor_apellido_paterno = htmlspecialchars($_POST['tutor_apellido_paterno']);
        $tutor_apellido_materno = htmlspecialchars($_POST['tutor_apellido_materno']);
        $tutor_no_personas_hogar = htmlspecialchars($_POST['tutor_no_personas_hogar']);
        $tutor_no_apoyan_economia = htmlspecialchars($_POST['tutor_no_apoyan_economia']);
        $tutor_total_ingresos = htmlspecialchars($_POST['tutor_total_ingresos']);
        $tutor_total_egresos = htmlspecialchars($_POST['tutor_total_egresos']);
        $tutor_indice_economico = htmlspecialchars($_POST['tutor_indice_economico']);
        $tutor_trabajo_social = htmlspecialchars($_POST['tutor_trabajo_social']);
        $tutor_parentesco = htmlspecialchars($_POST['tutor_parentesco']);
        $tutor_pais = htmlspecialchars($_POST['tutor_pais']);
        $tutor_estado = htmlspecialchars($_POST['tutor_estado']);
        $tutor_municipio = htmlspecialchars($_POST['tutor_municipio']);
        $tutor_calle = htmlspecialchars($_POST['tutor_calle']);
        $tutor_numero = htmlspecialchars($_POST['tutor_numero']);
        $tutor_colonia = htmlspecialchars($_POST['tutor_colonia']);
        $tutor_telefono = htmlspecialchars($_POST['tutor_telefono']);
        $tutor_ocupacion = htmlspecialchars($_POST['tutor_ocupacion']);

        $pdo->beginTransaction();

        // Inserción en la tabla `paciente` con los nuevos campos
        $sqlPaciente = "INSERT INTO paciente 
            (noRegistro, curp, nombres, apellidoPaterno, apellidoMaterno, fechaNacimiento, pais, estado, municipio, edad, sexo, calleDireccion, numeroDireccion, coloniaDireccion, derechoHabiente, dx, observaciones, status) 
            VALUES 
            (:no_registro, :curp, :nombres, :apellido_paterno, :apellido_materno, :fecha_nacimiento, :paciente_pais, :paciente_estado, :paciente_municipio, :edad, :sexo, :direccion_calle, :direccion_numero, :direccion_colonia, :derechohabiente, :dx, :observaciones, :status)";
        $stmtPaciente = $pdo->prepare($sqlPaciente);
        $stmtPaciente->execute([
            'no_registro' => $no_registro,
            'curp' => $curp,
            'nombres' => $nombres,
            'apellido_paterno' => $apellido_paterno,
            'apellido_materno' => $apellido_materno,
            'fecha_nacimiento' => $fecha_nacimiento,
            'paciente_pais' => $paciente_pais,
            'paciente_estado' => $paciente_estado,
            'paciente_municipio' => $paciente_municipio,
            'edad' => $edad,
            'sexo' => $sexo,
            'direccion_calle' => $direccion_calle,
            'direccion_numero' => $direccion_numero,
            'direccion_colonia' => $direccion_colonia,
            'derechohabiente' => $derechohabiente,
            'dx' => $dx,
            'observaciones' => $observaciones,
            'status' => $status,
        ]);

        // Obtener el ID del paciente recién insertado
        $idPaciente = $pdo->lastInsertId();

        // Inserción en la tabla `ingresos`
        $sqlIngresos = "INSERT INTO ingresos 
            (fechaIngreso, horaIngreso, fechaEgreso, horaEgreso, egreso, motivo, servicioSolicita, fkIdPaciente) 
            VALUES 
            (:fechaIngreso, :horaIngreso, :fechaEgreso, :horaEgreso, :egreso, :motivo, :servicioSolicita, :fkIdPaciente)";
        $stmtIngresos = $pdo->prepare($sqlIngresos);
        $stmtIngresos->execute([
            'fechaIngreso' => $fecha_ingreso,
            'horaIngreso' => $hora_ingreso,
            'fechaEgreso' => $fecha_egreso,
            'horaEgreso' => $hora_egreso,
            'egreso' => $egreso,
            'motivo' => $motivo,
            'servicioSolicita' => $servicio_solicitado,
            'fkIdPaciente' => $idPaciente,
        ]);

        $pdo->commit();

        echo "<script>
                alert('Paciente y registro de ingreso guardados correctamente');
                window.location.href = '../views/registro.php';
                </script>";
    }
} catch (Exception $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    echo "<script>
            alert('Error en el registro: " . addslashes($e->getMessage()) . "');
            window.location.href = '../views/registro.php';
            </script>";
}
?>
