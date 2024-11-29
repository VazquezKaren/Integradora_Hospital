<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener y validar el idEmpleado
    $idEmpleado = $_POST['idEmpleado'] ?? null;

    if (empty($telefono)) {
        echo "<html><head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              </head><body>
              <script>
        Swal.fire({
            title: '¡Atención!',
            text: 'Ingrese un número de teléfono para eliminar al empleado',
            icon: 'warning',
            confirmButtonText: 'Aceptar'
        }).then(() => {
            window.location.href = '../views/consultarEmpleado.php';
        });
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

                echo "<html><head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              </head><body>
              <script>
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Se ha eliminado con éxito al empleado y su usuario asociado',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    window.location.href = '../views/consultarEmpleado.php';
                });
            </script>";
            
            } else {
                echo "<html><head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              </head><body>
              <script>
                Swal.fire({
                    title: 'Empleado no encontrado',
                    text: 'No se encontró un empleado con el número de teléfono proporcionado',
                    icon: 'warning',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    window.location.href = '../views/consultarEmpleado.php';
                });
            </script>";
            
            }
        } catch (Exception $th) {
            echo "<html><head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              </head><body>
            <script>
                Swal.fire({
                    title: 'Error al eliminar',
                    text: 'Error al eliminar: " . addslashes($th->getMessage()) . "',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    window.location.href = '../views/consultarEmpleado.php';
                });
            </script>";
        }
    }

    try {
        $conn = new conn();
        $pdo = $conn->connect();

        // Iniciar transacción
        $pdo->beginTransaction();

        // Eliminar el usuario asociado al empleado
        $sqlUsuario = "DELETE FROM usuarios WHERE fkIdEmpleado = :idEmpleado";
        $stmtUsuario = $pdo->prepare($sqlUsuario);
        $stmtUsuario->execute(['idEmpleado' => $idEmpleado]);

        // Eliminar el empleado
        $sqlEmpleado = "DELETE FROM empleado WHERE idEmpleado = :idEmpleado";
        $stmtEmpleado = $pdo->prepare($sqlEmpleado);
        $stmtEmpleado->execute(['idEmpleado' => $idEmpleado]);

        // Confirmar transacción
        $pdo->commit();

        echo json_encode(['success' => true, 'message' => 'Empleado eliminado correctamente.']);
    } catch (Exception $e) {
        // Revertir transacción en caso de error
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }

        // Registrar el error en un archivo de log (opcional)
        error_log($e->getMessage());

        // Devolver un mensaje genérico al cliente
        echo "<html><head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              </head><body>
            <script>
                Swal.fire({
                    title: 'Error inesperado',
                    text: 'Ocurrió un error al eliminar el empleado. Inténtelo más tarde.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    window.location.href = '../views/consultarEmpleado.php';
                });
            </script>";
    }
} else {
    echo "<html><head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          </head><body>
        <script>
            Swal.fire({
                title: 'Método no permitido',
                text: 'Solo se permite el método POST para esta operación.',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            }).then(() => {
                window.location.href = '../views/consultarEmpleado.php';
            });
        </script>";
}
?>
