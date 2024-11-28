<?php
include '../config.php';

if (isset($_POST['telefono'])) {
    $telefono = $_POST['telefono']; // Número de teléfono ingresado

    if (empty($telefono)) {
        echo "<script>
                alert('Ingrese un número de teléfono para eliminar al empleado');
                window.location.href = '../views/consultarEmpleado.php';
            </script>";
        exit();
    } else {
        try {
            $conn = new conn();
            $pdo = $conn->connect();

            // Obtener el idEmpleado usando el teléfono
            $sqlEmpleado = "SELECT idEmpleado FROM empleado WHERE telefono = :telefono";
            $stmtEmpleado = $pdo->prepare($sqlEmpleado);
            $stmtEmpleado->execute(['telefono' => $telefono]);
            $empleadoData = $stmtEmpleado->fetch(PDO::FETCH_ASSOC);

            if ($empleadoData) {
                $idEmpleado = $empleadoData['idEmpleado'];

                // Eliminar primero el registro relacionado en la tabla usuarios
                $sqlUsuario = "DELETE FROM usuarios WHERE fk_idEmpleado = :idEmpleado";
                $stmtUsuario = $pdo->prepare($sqlUsuario);
                $stmtUsuario->execute(['idEmpleado' => $idEmpleado]);

                // Luego eliminar el registro en la tabla empleado
                $sqlEmpleadoDelete = "DELETE FROM empleado WHERE idEmpleado = :idEmpleado";
                $stmtEmpleadoDelete = $pdo->prepare($sqlEmpleadoDelete);
                $stmtEmpleadoDelete->execute(['idEmpleado' => $idEmpleado]);

                echo "<script>
                        alert('Se ha eliminado con éxito al empleado y su usuario asociado');
                        window.location.href = '../views/consultarEmpleado.php';
                    </script>";
            } else {
                echo "<script>
                        alert('No se encontró un empleado con el número de teléfono proporcionado');
                        window.location.href = '../views/consultarEmpleado.php';
                    </script>";
            }
        } catch (Exception $th) {
            echo "<script>
                    alert('Error al eliminar: " . addslashes($th->getMessage()) . "');
                    window.location.href = '../views/consultarEmpleado.php';
                </script>";
        }
    }
}
?>
