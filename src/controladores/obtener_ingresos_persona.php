<?php

include_once('../config.php');

try {

    $sql_table = "
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
    WHERE paciente.idPaciente = :busqueda";

$connObj = new conn();
$conn = $connObj->connect();

$stmt_table = $conn->prepare($sql_table);
$stmt_table->bindParam(":busqueda", $busqueda, PDO::PARAM_INT);
$stmt_table->execute();
$data_table = $stmt_table->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $th) {
            echo "<script>
        alert('Error en la busqueda de los registros del paciente: " . addslashes($th->getMessage()) . "');
        window.location.href = '../views/ingresos.php';
    </script>";
        }
?>