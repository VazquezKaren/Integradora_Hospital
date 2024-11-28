<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../config.php');

try {
    $connObj = new conn();
    $pdo = $connObj->connect();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
        $servicio_solicitado = htmlspecialchars($_POST['servicio_solicitado']);
        $motivo = htmlspecialchars($_POST['motivo']);

        $fecha_ingreso = date('Y-m-d');
        $hora_ingreso = date('H:i:s');
        $fecha_egreso = null; 
        $hora_egreso = null; 
        $egreso = null; 
        $pdo->beginTransaction();

        $sqlPaciente = "INSERT INTO paciente 
            (nombres, apellidoPaterno, apellidoMaterno, fechaNacimiento, pais, estado, municipio, edad, sexo, calleDireccion, numeroDireccion, coloniaDireccion, derechoHabiente, dx, observaciones) 
            VALUES 
            (:nombres, :apellido_paterno, :apellido_materno, :fecha_nacimiento, :paciente_pais, :paciente_estado, :paciente_municipio, :edad, :sexo, :direccion_calle, :direccion_numero, :direccion_colonia, :derechohabiente, :dx, :observaciones)";
        $stmtPaciente = $pdo->prepare($sqlPaciente);
        $stmtPaciente->execute([
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
        ]);

        $idPaciente = $pdo->lastInsertId();

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
