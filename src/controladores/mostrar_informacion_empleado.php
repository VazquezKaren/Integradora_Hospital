<?php
include '../config.php';


if (isset($_POST['busqueda'])) {
    $busqueda = $_POST['busqueda'];

    try {
        $conn = new conn();
        $pdo = $conn->connect();

        $sql = "SELECT * FROM empleado WHERE telefono = :busqueda";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['busqueda' => $busqueda]);
        $empleadoData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($empleadoData) {
            // Obtener el idEmpleado del resultado anterior
            $idEmpleado = $empleadoData['idEmpleado'];

            // Usar el idEmpleado para buscar el rol en la tabla usuarios
            $sqlUsuario = "SELECT rol FROM usuarios WHERE fkIdEmpleado = :idEmpleado";
            $stmtUsuario = $pdo->prepare($sqlUsuario);
            $stmtUsuario->execute(['idEmpleado' => $idEmpleado]);
            $empleadorol = $stmtUsuario->fetch(PDO::FETCH_ASSOC);

            if ($empleadorol) {
                // Rol encontrado
                echo "El rol del empleado es: " . $empleadorol['rol'];
            } else {
                // No se encontró un usuario con esa fk_idEmpleado
                echo "No se encontró un usuario asociado al empleado.";
            }
        } else {
            // No se encontró un empleado con ese teléfono
            echo "No se encontró un empleado con el número de teléfono proporcionado.";
        }
    } catch (Exception $th) {
        // Manejo de errores
        echo "<script>
                alert('Error en la búsqueda: " . addslashes($th->getMessage()) . "');
                window.location.href = '../views/consultarEmpleado.php';
            </script>";
    }
}
?>