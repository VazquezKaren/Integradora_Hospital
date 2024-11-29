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
                echo "<html><head>
                        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                      </head><body>
                      <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Rol encontrado',
                            text: 'El rol del empleado es: " . htmlspecialchars($empleadorol['rol']) . "',
                        }).then(() => {
                            
                        });
                      </script>";
            } else {
                // No se encontró un usuario con esa fk_idEmpleado
                echo "<html><head>
                        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                      </head><body>
                      <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'No encontrado',
                            text: 'No se encontró un usuario asociado al empleado.',
                        }).then(() => {
                            window.location.href = '../views/consultarEmpleado.php';
                        });
                      </script>";
            }
        } else {
            // No se encontró un empleado con ese teléfono
            echo "<html><head>
                    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                  </head><body>
                  <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'No encontrado',
                        text: 'No se encontró un empleado con el número de teléfono proporcionado.',
                    }).then(() => {
                        window.location.href = '../views/consultarEmpleado.php';
                    });
                  </script>";
        }
    } catch (Exception $th) {
        // Manejo de errores
        echo "<html><head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              </head><body>
              <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error en la búsqueda: " . addslashes($th->getMessage()) . "',
                }).then(() => {
                    window.location.href = '../views/consultarEmpleado.php';
                });
              </script>";
    }
}
?>
