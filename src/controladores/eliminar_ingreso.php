<?php

include_once '../config.php';

if (isset($_POST['idIngreso'])) {
    $idIngreso = $_POST['idIngreso'];

    if (empty($idIngreso)) {
        echo "<script>
                    alert('No se a podido eliminar el ingreso');
                    window.location.href = '../views/ingresos.php';
                </script>";
            exit();
    }else {
        try {
            $conn = new conn();
            $pdo = $conn->connect();
    
            $sql = "DELETE FROM ingresos WHERE idIngreso = :idIngreso";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['idIngreso' => $idIngreso]);
    
            echo "<script>
                    alert('Se ha eliminado con éxito el ingreso');
                    window.location.href = '../views/ingresos.php';
                </script>";
    
        } catch (Exception $th) {
            echo "<script>
                    alert('Error en la conexion: " . addslashes($th->getMessage()) . "');
                    window.location.href = '../views/ingresos.php';
                </script>";
        }
    }

    
}
?>


