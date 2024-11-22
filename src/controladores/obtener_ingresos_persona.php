<?php
require_once '../config.php';

if (isset($_POST['fkIdPaciente'])) {
    $busqueda = $_POST['fkIdPaciente'];

    $sql = "SELECT ingresos.*, 
                paciente.nombres AS nombrePaciente, 
                paciente.apellidoPaterno AS apellidoPaternoPaciente, 
                paciente.apellidoMaterno AS apellidoMaternoPaciente 
            FROM ingresos 
            JOIN paciente ON ingresos.fkIdPaciente = paciente.idPaciente 
            WHERE ingresos.fkIdPaciente = :busqueda";

    $connObj = new conn();
    $conn = $connObj->connect();

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":busqueda", $busqueda, PDO::PARAM_INT);
    $stmt->execute();
    $ingresos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($ingresos);
} else {
    echo json_encode([]);
}
?>