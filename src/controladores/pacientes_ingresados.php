<?php

include '../config.php';

try {
    $conn = new conn();
    $pdo = $conn->connect();
    $ingresos = 0;

    $query = "
    SELECT count(*) FROM `ingresos` WHERE egreso = 0
    ";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    // Obtener el valor del conteo
    $ingresos = $stmt->fetchColumn();

    // Imprimir el resultado


} catch (Exception $e) {
    $pdo->rollBack();
    echo "<html><head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              </head><body>
              <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error en el registro: " . addslashes($e->getMessage()) . "'
        }).then(() => {
            window.location.href = '../views/registroEmpleado.php';
        });
    </script>";
}
?>
