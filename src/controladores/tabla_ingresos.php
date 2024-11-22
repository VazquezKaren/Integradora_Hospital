<?php

include_once('../config.php');

try {
    $conn = new conn();
    $pdo = $conn->connect();

    $sql = "
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
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $ingresos = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $th) {
    echo "<script>
            alert('Error en la busqueda: " . addslashes($th->getMessage()) . "');
            window.location.href = '../views/ingresos.php';
        </script>";
}

?>
