<?php
include '../config.php';


if (isset($_POST['busqueda'])) {
    $busqueda = $_POST['busqueda'];

    try {
        $conn = new conn();
        $pdo = $conn->connect();

        $sql = "SELECT * FROM empleado WHERE idEmpleado = :busqueda";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['busqueda' => $busqueda]);
        $empleadoData = $stmt->fetch(PDO::FETCH_ASSOC);

        $sqlUsuario = "SELECT rol FROM usuarios WHERE idUsuario = :busqueda";
        $stmtUsuario = $pdo->prepare($sqlUsuario);
        $stmtUsuario->execute(['busqueda' => $busqueda]);
        $empleadorol = $stmtUsuario->fetch(PDO::FETCH_ASSOC);

    } catch (Exception $th) {
        echo "<script>
                alert('Error en el registro: " . addslashes($th->getMessage()) . "');
                window.location.href = '../views/consultarEmpleado.php';
            </script>";
    }
}
?>