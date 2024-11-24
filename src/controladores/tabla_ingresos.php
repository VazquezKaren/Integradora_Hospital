
<?php
if ($_POST['buscar'] == '') {
    $_POST['buscar'] = ' ';
}
$akeyword = explode(" ", $_POST['buscar']);

try {
    if ($_POST["buscar"] == '' and $_POST['buscarfechadesdeingreso'] == '' and $_POST['buscarfechahastaingreso'] == '' and $_POST['buscarfechadesdeegreso'] == '' and $_POST['buscarfechahastaegreso'] == '' and $_POST['estadoingreso'] == '' and $_POST['orden'] == '' and $_POST['buscarempleado'] == '') {

        $query = "
            SELECT ingresos.*, 
                paciente.nombres AS nombrePaciente,
                paciente.apellidoPaterno As apellidoPaternoPaciente,
                paciente.apellidoMaterno As apellidoMaternoPaciente,
                empleado.nombres AS nombreEmpleado,
                empleado.apellidoPaterno As apellidoPaternoEmpleado,
                empleado.telefono As idEmpleado
            FROM ingresos
            JOIN paciente ON ingresos.fkIdPaciente = paciente.idPaciente
            JOIN usuarios ON ingresos.fkIdUsuario = usuarios.idUsuario
            JOIN empleado ON usuarios.fkIdEmpleado = empleado.idEmpleado
        ";
    } else {
        $query = "
            SELECT ingresos.*, 
                paciente.nombres AS nombrePaciente,
                paciente.apellidoPaterno As apellidoPaternoPaciente,
                paciente.apellidoMaterno As apellidoMaternoPaciente,
                empleado.nombres AS nombreEmpleado,
                empleado.apellidoPaterno As apellidoPaternoEmpleado,
                empleado.telefono As idEmpleado
            FROM ingresos
            JOIN paciente ON ingresos.fkIdPaciente = paciente.idPaciente
            JOIN usuarios ON ingresos.fkIdUsuario = usuarios.idUsuario
            JOIN empleado ON usuarios.fkIdEmpleado = empleado.idEmpleado
        ";
        if ($_POST['buscar'] != '') {
            $query .= " WHERE (LOWER(paciente.nombres) LIKE LOWER('%" . $akeyword[0] . "%') OR LOWER(paciente.apellidoPaterno) LIKE LOWER('%" . $akeyword[0] . "%') OR LOWER(paciente.apellidoMaterno) LIKE LOWER('%" . $akeyword[0] . "%'))";

            for ($i = 1; $i < count($akeyword); $i++) {
                if (!empty($akeyword[$i])) {
                    $query .= " OR LOWER(paciente.nombres) LIKE LOWER('%" . $akeyword[$i] . "%') OR LOWER(paciente.apellidoPaterno) LIKE LOWER('%" . $akeyword[$i] . "%') OR LOWER(paciente.apellidoMaterno) LIKE LOWER('%" . $akeyword[$i] . "%')";
                }
            }
        }

        if ($_POST["estadoingreso"] != '') {
            $query .= " AND egreso = '" . $_POST['estadoingreso'] . "' ";
        }

        if ($_POST["buscarfechadesdeingreso"] != '') {
            $query .= " AND fechaIngreso BETWEEN '" . $_POST["buscarfechadesdeingreso"] . "' AND '" . $_POST["buscarfechahastaingreso"] . "' ";
        }

        if ($_POST["buscarfechadesdeegreso"] != '') {
            $query .= " AND fechaEgreso BETWEEN '" . $_POST["buscarfechadesdeegreso"] . "' AND '" . $_POST["buscarfechahastaegreso"] . "' ";
        }

        if ($_POST["buscarhoradesdeingreso"] != '') {
            $query .= " AND horaIngreso BETWEEN '" . $_POST["buscarhoradesdeingreso"] . "' AND '" . $_POST["buscarhorahastaingreso"] . "' ";
        }

        if ($_POST["buscarhoradesdeegreso"] != '') {
            $query .= " AND horaEgreso BETWEEN '" . $_POST["buscarhoradesdeegreso"] . "' AND '" . $_POST["buscarhorahastaegreso"] . "' ";
        }


        if ($_POST["buscarempleado"] != '') {
            $query .= " AND empleado.telefono = '" . $_POST['buscarempleado'] . "' ";
        }
    }

    if ($_POST["orden"] == '1') {
        $query .= " ORDER BY nombrePaciente ASC ";
    }
    if ($_POST["orden"] == '2') {
        $query .= " ORDER BY fechaIngreso DESC ";
    }
    if ($_POST["orden"] == '3') {
        $query .= " ORDER BY fechaIngreso ASC ";
    }
    if ($_POST["orden"] == '4') {
        $query .= " ORDER BY horaIngreso DESC ";
    }
    if ($_POST["orden"] == '5') {
        $query .= " ORDER BY horaIngreso ASC ";
    }
    if ($_POST["orden"] == '6') {
        $query .= " ORDER BY fechaEgreso DESC ";
    }
    if ($_POST["orden"] == '7') {
        $query .= " ORDER BY fechaEgreso ASC ";
    }
    if ($_POST["orden"] == '8') {
        $query .= " ORDER BY horaEgreso DESC ";
    }
    if ($_POST["orden"] == '9') {
        $query .= " ORDER BY horaEgreso ASC ";
    }
    if ($_POST["orden"] == '10') {
        $query .= " ORDER BY servicioSolicitado ASC ";
    }

    $conn = new conn();
    $pdo = $conn->connect();
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $ingresos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $rowCount = $stmt->rowCount();} catch (\Throwable $th) {
        echo "<script>
                alert('Error en la obtencion de los registros: " . addslashes($th->getMessage()) . "');
                window.location.href = '../views/registro.php';
                </script>";
    }
?>