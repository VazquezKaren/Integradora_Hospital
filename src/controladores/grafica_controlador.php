<?php
include '../config.php';

try {
    $conn = new conn();
    $pdo = $conn->connect();

    // Inicializa el arreglo con índices de lunes (0) a domingo (6)
    $arregloIngresos = array_fill(0, 7, 0);

    $query = "
        SELECT DAYOFWEEK(fechaIngreso) AS diaSemana, COUNT(*) AS totalIngresos
        FROM ingresos
        WHERE fechaIngreso BETWEEN :fechaInicio AND :fechaFin
        GROUP BY DAYOFWEEK(fechaIngreso)
    ";

    $stmt = $pdo->prepare($query);

    $fechaInicio = '2024-5-18'; // Fecha de inicio de la semana
    $fechaFin = '2024-11-24';    // Fecha de fin de la semana

    $stmt->bindParam(':fechaInicio', $fechaInicio);
    $stmt->bindParam(':fechaFin', $fechaFin);

    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $dia = $row['diaSemana'] - 2; // Ajustar: 1=Domingo -> -1, 2=Lunes -> 0
        if ($dia < 0) $dia = 6;       // Mueve el domingo al final
        $arregloIngresos[$dia] = $row['totalIngresos'];
    }

    // Envía la respuesta en formato JSON
    echo json_encode($arregloIngresos);

} catch (Exception $e) {
    echo json_encode([
        "error" => true,
        "message" => $e->getMessage()
    ]);
}
?>