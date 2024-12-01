<?php
include '../config.php';

$data = [];
$error = ""; 

if (isset($_POST['busqueda'])) {
    $busqueda = trim($_POST['busqueda']); 

    if (empty($busqueda)) {
        $error = "Por favor, ingrese un CURP o Número de Registro válido.";
    } else {
        $esCURP = (strlen($busqueda) === 18 && preg_match('/^[A-Z0-9]{18}$/', $busqueda));
        $esNoRegistro = preg_match('/^\d{4}\/\d{2}$/', $busqueda);

        if ($esCURP) {
            $criterio = "paciente.curp = :busqueda";
        } elseif ($esNoRegistro) {
            $criterio = "paciente.noRegistro = :busqueda";
        } else {
            $error = "El formato de búsqueda no corresponde a un CURP ni a un Número de Registro válido.";
        }

        if (empty($error)) {
            $sql = "SELECT 
                paciente.noRegistro as no_registro,
                paciente.curp AS paciente_CURP,
                paciente.nombres AS paciente_nombres, 
                paciente.apellidoPaterno AS paciente_apellidoPaterno, 
                paciente.apellidoMaterno AS paciente_apellidoMaterno, 
                paciente.fechaNacimiento AS paciente_fechaNacimiento, 
                paciente.pais AS paciente_pais, 
                paciente.estado AS paciente_estado, 
                paciente.municipio AS paciente_municipio, 
                paciente.sexo AS paciente_sexo, 
                paciente.edad AS paciente_edad,
                paciente.calleDireccion AS paciente_calleDireccion, 
                paciente.numeroDireccion AS paciente_numeroDireccion, 
                paciente.coloniaDireccion AS paciente_coloniaDireccion,
                paciente.derechoHabiente AS paciente_derechoHabiente, 
                paciente.dx AS paciente_dx, 
                paciente.observaciones AS paciente_observaciones,
                paciente.status AS paciente_status,
                tutor.nombres AS tutor_nombres, 
                tutor.apellidoPaterno AS tutor_apellidoPaterno, 
                tutor.apellidoMaterno AS tutor_apellidoMaterno, 
                tutor.parentesco AS tutor_parentesco, 
                tutor.telefono AS tutor_telefono, 
                tutor.ocupacion AS tutor_ocupacion,
                tutor.pais AS tutor_pais,
                tutor.estado AS tutor_estado,
                tutor.municipio AS tutor_municipio,
                tutor.calleDireccion AS tutor_calleDireccion,
                tutor.numeroDireccion AS tutor_numeroDireccion,
                tutor.coloniaDireccion AS tutor_coloniaDireccion,
                tutor.noPersonasHogar AS tutor_noPersonasHogar,
                tutor.noPersonasApoyanEconomiaHogar AS tutor_noPersonasApoyanEconomiaHogar,
                tutor.trabajoSocial AS trabajo_social,
                tutor.totalIngresos AS tutor_totalIngresos, 
                tutor.totalEgresos AS tutor_totalEgresos,
                tutor.indiceEconomico AS tutor_indiceEconomico
            FROM paciente
            LEFT JOIN tutor ON paciente.idPaciente = tutor.fkidPaciente
            WHERE $criterio";

            try {
                $connObj = new conn();
                $conn = $connObj->connect();

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":busqueda", $busqueda, PDO::PARAM_STR);
                $stmt->execute();
                $data = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$data) {
                    $error = "No se encontró un registro con el CURP o Número de Registro proporcionado.";
                } elseif ($data['paciente_status'] == 0) {
                    $error = "El registro existe pero no está activo.";
                    $data = []; 
                }
            } catch (PDOException $e) {
                $error = "Error al buscar los datos: " . $e->getMessage();
                error_log("Error al buscar datos: " . $e->getMessage());
            }
        }
    }
}
?>
