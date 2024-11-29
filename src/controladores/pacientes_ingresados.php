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

    // Aquí podrías añadir algún código para mostrar el resultado si lo deseas

} catch (Exception $e) {
    // Mostrar la alerta de SweetAlert2 para manejar el error
    echo "<html><head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          </head><body>
          <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error en el registro: " . addslashes($e->getMessage()) . "',
            }).then(() => {
                window.location.href = '../views/registroEmpleado.php';
            });
          </script>";
}
?>
