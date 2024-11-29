<?php
include '../config.php';

$data = [];
$error = ""; 

if (isset($_POST['busqueda'])) {
    $busqueda = $_POST['busqueda'];

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
    WHERE paciente.curp = :curp OR paciente.noRegistro = :noRegistro";

    try {
        $connObj = new conn();
        $conn = $connObj->connect();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":curp", $busqueda, PDO::PARAM_STR);
        $stmt->bindParam(":noRegistro", $busqueda, PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            $error = "El registro no existe."; 
            echo "<html><head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              </head><body>
              <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El registro no existe.'
                }).then(() => {
                    window.location.href = '../views/consultarPaciente.php';
                });
            </script>";
        }
    } catch (PDOException $e) {
        $error = "Error al buscar los datos: " . $e->getMessage();
        echo "<html><head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              </head><body>
              <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al buscar los datos: " . addslashes($e->getMessage()) . "'
            }).then(() => {
                window.location.href = '../views/consultarPaciente.php';
            });
        </script>";
    }
}
?>
