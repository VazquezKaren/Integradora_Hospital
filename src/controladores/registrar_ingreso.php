<?php
session_start();
include('../config.php');

$conn = new conn();
$pdo = $conn->connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $curp = trim($_POST['curp']);
    $idUsuario = $_SESSION['idUsuario'];

    if (empty($curp)) {
        echo "<html><head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              </head><body>
              <script>
                  Swal.fire({
                      title: 'CURP vacía',
                      text: 'Por favor ingresa una CURP válida.',
                      icon: 'warning',
                      confirmButtonText: 'Intentar de nuevo'
                  }).then(() => {
                      window.history.back();
                  });
              </script>
              </body></html>";
        exit();
    }

    $query = $pdo->prepare("SELECT idPaciente FROM paciente WHERE curp = :curp");
    $query->bindParam(':curp', $curp, PDO::PARAM_STR);
    $query->execute();
    $paciente = $query->fetch(PDO::FETCH_ASSOC);

    if ($paciente) {
        $idPaciente = $paciente['idPaciente'];
        $fechaIngreso = date('Y-m-d');
        $horaIngreso = date('H:i:s');
        $motivo = trim($_POST['motivo']);
        $servicioSolicita = trim($_POST['servicio_solicitado']);
        $turno = trim($_POST['turno']);

        $insertQuery = $pdo->prepare("
            INSERT INTO ingresos (fechaIngreso, horaIngreso, fechaEgreso, horaEgreso, egreso, motivo, servicioSolicita, turno, fkIdPaciente, fkIdUsuario)
            VALUES (:fechaIngreso, :horaIngreso, NULL, NULL, 0, :motivo, :servicioSolicita, :turno, :fkIdPaciente, :fkIdUsuario)
        ");
        $insertQuery->bindParam(':fechaIngreso', $fechaIngreso);
        $insertQuery->bindParam(':horaIngreso', $horaIngreso);
        $insertQuery->bindParam(':motivo', $motivo);
        $insertQuery->bindParam(':servicioSolicita', $servicioSolicita);
        $insertQuery->bindParam(':turno', $turno);
        $insertQuery->bindParam(':fkIdPaciente', $idPaciente, PDO::PARAM_INT);
        $insertQuery->bindParam(':fkIdUsuario', $idUsuario, PDO::PARAM_INT);

        if ($insertQuery->execute()) {
            echo "<html><head>
                    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                  </head><body>
                  <script>
                      Swal.fire({
                          title: 'Ingreso registrado',
                          text: 'El ingreso del paciente ha sido registrado con éxito.',
                          icon: 'success',
                          confirmButtonText: 'Aceptar'
                      }).then(() => {
                          window.location.href = '../views/ingresos.php';
                      });
                  </script>
                  </body></html>";
            exit();
        } else {
            $errorInfo = $insertQuery->errorInfo();
            echo "<html><head>
                    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                  </head><body>
                  <script>
                      Swal.fire({
                          title: 'Error al registrar',
                          text: 'Error en la consulta: {$errorInfo[2]}',
                          icon: 'error',
                          confirmButtonText: 'Intentar de nuevo'
                      }).then(() => {
                          window.history.back();
                      });
                  </script>
                  </body></html>";
            exit();
        }
    } else {
        echo "<html><head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              </head><body>
              <script>
                  Swal.fire({
                      title: 'Paciente no encontrado',
                      text: 'La CURP ingresada no está registrada.',
                      icon: 'error',
                      showCancelButton: true,
                      confirmButtonText: 'Registrar nuevo paciente',
                      cancelButtonText: 'Intentar de nuevo'
                  }).then((result) => {
                      if (result.isConfirmed) {
                          window.location.href = '../views/registro.php';
                      } else {
                          window.history.back();
                      }
                  });
              </script>
              </body></html>";
        exit();
    }
}
?>
