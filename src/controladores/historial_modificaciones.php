<?php
require_once '../config.php';

session_start();

$connObj = new conn();
$conn = $connObj->connect();

try {
    if (!isset($_SESSION['usuario'])) {
        exit("No estás autenticado.");
    } else {
        $usuario_actual = $_SESSION['idUsuario'];
        $privilegio = $_SESSION['rol'];
    }

    // Consulta con JOIN para obtener datos adicionales
    $sql = "SELECT h.fecha, h.actividad, u.usuario, e.nombres AS nombreEmpleado, e.telefono
            FROM historial h
            JOIN usuarios u ON h.usuario = u.idUsuario
            JOIN empleado e ON u.fkIdEmpleado = e.idEmpleado
            WHERE u.idUsuario = :us";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':us', $usuario_actual, PDO::PARAM_INT); // Vinculamos el ID del usuario logueado
    $stmt->execute();

    $actividades = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Si se necesitan mostrar los resultados en el navegador
    if ($actividades) {
        echo "<html><head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              </head><body>
              <script>
                  Swal.fire({
                      title: 'Éxito',
                      text: 'Historial de actividades cargado correctamente',
                      icon: 'success',
                      confirmButtonText: 'Aceptar'
                  }).then(() => {
                      window.location.href = '../views/historial.php';
                  });
              </script>
              </body></html>";
    } else {
        echo "<html><head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              </head><body>
              <script>
                  Swal.fire({
                      title: 'Sin datos',
                      text: 'No se encontraron actividades en el historial',
                      icon: 'info',
                      confirmButtonText: 'Aceptar'
                  }).then(() => {
                      window.location.href = '../views/historial.php';
                  });
              </script>
              </body></html>";
    }
} catch (Throwable $th) {
    // Manejo de errores con alerta de SweetAlert2
    echo "<html><head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          </head><body>
          <script>
              Swal.fire({
                  title: 'Error',
                  text: 'Error en el registro del historial: " . addslashes($th->getMessage()) . "',
                  icon: 'error',
                  confirmButtonText: 'Aceptar'
              }).then(() => {
                  window.location.href = '../views/historial.php';
              });
          </script>
          </body></html>";
}
?>
