<?php

// Incluir el archivo de conexión a la base de datos
include('../config.php');

$connObj = new conn();
$conn = $connObj->connect();

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener y sanitizar los datos del formulario usando htmlspecialchars
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

    // Datos del responsable
    $responsable_nombre = htmlspecialchars($_POST['responsable_nombre']);
    $responsable_apellido_paterno = htmlspecialchars($_POST['responsable_apellido_paterno']);
    $responsable_apellido_materno = htmlspecialchars($_POST['responsable_apellido_materno']);
    $personas_hogar = htmlspecialchars($_POST['personas_hogar']);
    $personas_apoyo = htmlspecialchars($_POST['personas_apoyo']);
    $ingresos = htmlspecialchars($_POST['ingresos']);
    $egresos = htmlspecialchars($_POST['egresos']);
    $indice_economico = htmlspecialchars($_POST['indice_economico']);
    $clasificacion_trabajo_social = htmlspecialchars($_POST['clasificacion_trabajo_social']);
    $parentesco = htmlspecialchars($_POST['parentesco']);
    $responsable_pais = htmlspecialchars($_POST['responsable_pais']);
    $responsable_estado = htmlspecialchars($_POST['responsable_estado']);
    $responsable_municipio = htmlspecialchars($_POST['responsable_municipio']);
    $responsable_direccion_calle = htmlspecialchars($_POST['responsable_direccion_calle']);
    $responsable_direccion_numero = htmlspecialchars($_POST['responsable_direccion_numero']);
    $responsable_direccion_colonia = htmlspecialchars($_POST['responsable_direccion_colonia']);
    $telefono = htmlspecialchars($_POST['telefono']);
    $derechohabiente = htmlspecialchars($_POST['derechohabiente']);
    // $derechohabiente_otro = htmlspecialchars($_POST['derechohabiente_otro']);
    $ocupacion = htmlspecialchars($_POST['ocupacion']);

    // iNGRESO
    // Inicializar las variables de ingreso
    $fecha_ingreso = date('Y-m-d');
    $hora_ingreso = date('H:i:s');
    $fecha_egreso = null; // o null, según tu lógica de egreso
    $hora_egreso = null;
    $egreso=0;
    $motivo=htmlspecialchars($_POST['motivo']);
    $servicio_solicitado = htmlspecialchars($_POST['servicio_solicitado']);


    // Transacción para insertar los datos en múltiples tablas
    try {
        $conn = new conn();
        $pdo = $conn->connect();

        // Insertar datos en la tabla de paciente
        $sqlPaciente = "INSERT INTO paciente (nombres, apellidoPaterno, apellidoMaterno, fechaNacimiento, pais, estado, municipio, edad, sexo, calleDireccion, numeroDireccion, coloniaDireccion, derechoHabiente, dx, observaciones) VALUES (:nombres, :apellido_paterno, :apellido_materno, :fecha_nacimiento, :paciente_pais, :paciente_estado, :paciente_municipio, :edad, :sexo, :direccion_calle, :direccion_numero, :direccion_colonia, :derechohabiente, :dx, :observaciones)";
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

        // Obtener el ID del paciente recién insertado
        $idPaciente = $pdo->lastInsertId();

        // Insertar datos en la tabla de tutor
        $sqlTutor = "INSERT INTO tutor (nombres, apellidoPaterno, apellidoMaterno, noPersonasHogar, noPersonasApoyanEconomiaHogar, totalIngresos, totalEgresos, indiceEconomico, trabajoSocial, parentesco, pais, estado, municipio, calleDireccion, numeroDireccion, coloniaDireccion, telefono, ocupacion, fkIdPaciente) VALUES (:responsable_nombre, :responsable_apellido_paterno, :responsable_apellido_materno, :personas_hogar, :personas_apoyo, :ingresos, :egresos, :indice_economico, :clasificacion_trabajo_social, :parentesco, :responsable_pais, :responsable_estado, :responsable_municipio, :responsable_direccion_calle, :responsable_direccion_numero, :responsable_direccion_colonia, :telefono, :ocupacion, :fkIdPaciente)";
        $stmtTutor = $pdo->prepare($sqlTutor);
        $stmtTutor->execute([
            'responsable_nombre' => $responsable_nombre,
            'responsable_apellido_paterno' => $responsable_apellido_paterno,
            'responsable_apellido_materno' => $responsable_apellido_materno,
            'personas_hogar' => $personas_hogar,
            'personas_apoyo' => $personas_apoyo,
            'ingresos' => $ingresos,
            'egresos' => $egresos,
            'indice_economico' => $indice_economico,
            'clasificacion_trabajo_social' => $clasificacion_trabajo_social,
            'parentesco' => $parentesco,
            'responsable_pais' => $responsable_pais,
            'responsable_estado' => $responsable_estado,
            'responsable_municipio' => $responsable_municipio,
            'responsable_direccion_calle' => $responsable_direccion_calle,
            'responsable_direccion_numero' => $responsable_direccion_numero,
            'responsable_direccion_colonia' => $responsable_direccion_colonia,
            'telefono' => $telefono,
            'ocupacion' => $ocupacion,
            'fkIdPaciente' => $idPaciente,
        ]);

        echo "<script>
                alert('Paciente y tutor registrados correctamente');
                window.location.href = '../views/registro.php';
                </script>";

    } catch (\Throwable $th) {
        echo "<script>
                alert('Error en el registro del paciente y tutor: " . addslashes($th->getMessage()) . "');
                window.location.href = '../views/registro.php';
                </script>";
    }

        // Generar Hoja frontal en PDF
        // $pdf = new TCPDF();
        //     $pdf->AddPage();
        //     $pdf->SetFont('helvetica', '', 12);

        //     // Contenido del PDF
        //     $pdf->Cell(0, 10, "Hoja Frontal", 0, 1, 'C');
        //     $pdf->Cell(0, 10, "Fecha de Ingreso: " . date('Y-m-d'), 0, 1);
        //     $pdf->Cell(0, 10, "Hora de Ingreso: " . date('H:i:s'), 0, 1);
        //     $pdf->Cell(0, 10, "Número de Registro: " . $paciente_id, 0, 1);
        //     $pdf->Cell(0, 10, "Nombre: " . $nombre . " " . $apellido_paterno . " " . $apellido_materno, 0, 1);
        //     $pdf->Cell(0, 10, "Edad: " . $edad, 0, 1);
        //     $pdf->Cell(0, 10, "Fecha de Nacimiento: " . $fecha_nacimiento, 0, 1);
        //     $pdf->Cell(0, 10, "DX Inicial: " . $dx_registro, 0, 1);
        //     $pdf->Cell(0, 10, "Nombre del Tutor: " . $responsable_nombre . " " . $responsable_apellido_paterno, 0, 1);

        //     // Guardar el PDF
        //     $pdf->Output("hoja_frontal_$paciente_id.pdf", 'D');

        // } catch (Exception $e) {
        //     // Revertir en caso de error
        //     $conn->rollBack();
        //     echo "Error al registrar: " . $e->getMessage();
        // }
}
?>
