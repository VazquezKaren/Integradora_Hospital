<?php

include_once '../config.php';

if (isset($_POST['idIngreso'])) {
    $idIngreso = $_POST['idIngreso'];

    if (empty($idIngreso)) {
        echo "<script>
                    alert('No se ha podido marcar la salida del ingreso');
                    window.location.href = '../views/ingresos.php';
                </script>";
        exit();
    } else {
        try {
            $conn = new conn();
            $pdo = $conn->connect();

            $fechaEgreso = date("Y-m-d");
            $horaEgreso = date("H:i:s");

            $sql = "UPDATE ingresos SET fechaEgreso=:fechaEgreso, horaEgreso=:horaEgreso, egreso=1 WHERE idIngreso = :idIngreso";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'fechaEgreso' => $fechaEgreso,
                'horaEgreso' => $horaEgreso,
                'idIngreso' => $idIngreso
            ]);

            echo "<script>
                    alert('Se ha registrado con éxito el egreso');
                    window.location.href = '../views/ingresos.php';
                </script>";

        } catch (Exception $th) {
            echo "<script>
                    alert('Error en la conexión: " . addslashes($th->getMessage()) . "');
                    window.location.href = '../views/ingresos.php';
                </script>";
        }
    }
}
?>
