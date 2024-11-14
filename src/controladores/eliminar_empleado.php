<?php
include '../config.php';

if (isset($_POST['idEmpleado'])) {
    $idEmpleado = $_POST['idEmpleado'];

    if (empty($idEmpleado)) {
        echo "<script>
                    alert('Ingrese un id para eliminar al empleado');
                    window.location.href = '../views/consultarEmpleado.php';
                </script>";
            exit();
    }else {
        try {
            $conn = new conn();
            $pdo = $conn->connect();
    
            $sql = "DELETE FROM empleado WHERE idEmpleado = :idEmpleado";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['idEmpleado' => $idEmpleado]);
    
            $sqlUsuario = "DELETE FROM usuarios WHERE idUsuario = :idEmpleado";
            $stmtUsuario = $pdo->prepare($sqlUsuario);
            $stmtUsuario->execute(['idEmpleado' => $idEmpleado]);
    
            echo "<script>
                    alert('Se ha eliminado con éxito al empleado');
                    window.location.href = '../views/consultarEmpleado.php';
                </script>";
    
        } catch (Exception $th) {
            echo "<script>
                    alert('Error en el registro: " . addslashes($th->getMessage()) . "');
                    window.location.href = '../views/consultarEmpleado.php';
                </script>";
        }
    }

    
}
?>
