<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../config.php';
$database = new conn();
$conn = $database->connect();

$paciente_CURP = $_POST['curp'] ?? null;

if (!$paciente_CURP) {
    echo "<html><head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          </head><body>
          <script>
              Swal.fire({
                  title: 'Error',
                  text: 'paciente_CURP (ID del paciente) no proporcionado',
                  icon: 'error',
                  confirmButtonText: 'Aceptar'
              }).then(() => {
                  window.location.href = '../views/formulario_actualizar_paciente.php';
              });
          </script>
          </body></html>";
    exit;
}

try {
    $conn->beginTransaction();

    $sql_check = "SELECT idPaciente FROM paciente WHERE curp = :paciente_CURP";
    $stmt = $conn->prepare($sql_check);
    $stmt->execute([':paciente_CURP' => $paciente_CURP]);
    $idPacienteDB = $stmt->fetchColumn();

    if ($idPacienteDB) {
        $nombre_paciente = strtoupper(filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS));
        $apellido_paterno = strtoupper(filter_input(INPUT_POST, 'apellido_p', FILTER_SANITIZE_SPECIAL_CHARS));
        $apellido_materno = strtoupper(filter_input(INPUT_POST, 'apellido_m', FILTER_SANITIZE_SPECIAL_CHARS));
        $fecha_nacimiento = filter_input(INPUT_POST, 'fecha_nacimiento', FILTER_SANITIZE_SPECIAL_CHARS);
        $paciente_edad = filter_input(INPUT_POST, 'paciente_edad', FILTER_VALIDATE_INT);
        if ($paciente_edad === false) {
            echo "<html><head>
                    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                  </head><body>
                  <script>
                      Swal.fire({
                          title: 'Error',
                          text: 'Edad no válida',
                          icon: 'error',
                          confirmButtonText: 'Aceptar'
                      }).then(() => {
                          window.location.href = '../views/formulario_actualizar_paciente.php';
                      });
                  </script>
                  </body></html>";
            exit;
        }
        $paciente_pais = strtoupper(filter_input(INPUT_POST, 'paciente_pais', FILTER_SANITIZE_SPECIAL_CHARS));
        $paciente_estado = strtoupper(filter_input(INPUT_POST, 'paciente_estado', FILTER_SANITIZE_SPECIAL_CHARS));
        $paciente_municipio = strtoupper(filter_input(INPUT_POST, 'paciente_municipio', FILTER_SANITIZE_SPECIAL_CHARS));
        $sexo = strtoupper(filter_input(INPUT_POST, 'sexo', FILTER_SANITIZE_SPECIAL_CHARS));
        $derecho_habiente = strtoupper(filter_input(INPUT_POST, 'derechoHabiente', FILTER_SANITIZE_SPECIAL_CHARS));
        $dx = strtoupper(filter_input(INPUT_POST, 'dx', FILTER_SANITIZE_SPECIAL_CHARS));
        $observaciones = strtoupper(filter_input(INPUT_POST, 'observaciones', FILTER_SANITIZE_SPECIAL_CHARS));

        $sql_update_paciente = "UPDATE paciente SET
            nombres = :nombre_paciente,
            apellidoPaterno = :apellido_paterno,
            apellidoMaterno = :apellido_materno,
            fechaNacimiento = :fecha_nacimiento,
            edad = :paciente_edad, 
            sexo = :sexo, 
            pais = :paciente_pais,
            estado = :paciente_estado,
            municipio = :paciente_municipio,
            derechoHabiente = :derecho_habiente,
            dx = :dx,
            observaciones = :observaciones
            WHERE idPaciente = :idPaciente";

        $stmt = $conn->prepare($sql_update_paciente);
        $stmt->execute([
            ':nombre_paciente' => $nombre_paciente,
            ':apellido_paterno' => $apellido_paterno,
            ':apellido_materno' => $apellido_materno,
            ':fecha_nacimiento' => $fecha_nacimiento,
            ':paciente_edad' => $paciente_edad,
            ':sexo' => $sexo,
            ':paciente_pais' => $paciente_pais,
            ':paciente_estado' => $paciente_estado,
            ':paciente_municipio' => $paciente_municipio,
            ':derecho_habiente' => $derecho_habiente,
            ':dx' => $dx,
            ':observaciones' => $observaciones,
            ':idPaciente' => $idPacienteDB
        ]);

        $conn->commit();
        echo "<html><head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              </head><body>
              <script>
                  Swal.fire({
                      title: 'Éxito',
                      text: 'Datos del paciente actualizados correctamente',
                      icon: 'success',
                      confirmButtonText: 'Aceptar'
                  }).then(() => {
                      window.location.href = '../views/empleado.php';
                  });
              </script>
              </body></html>";
    } else {
        echo "<html><head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              </head><body>
              <script>
                  Swal.fire({
                      title: 'Error',
                      text: 'Paciente no encontrado',
                      icon: 'error',
                      confirmButtonText: 'Aceptar'
                  }).then(() => {
                      window.location.href = '../views/formulario_actualizar_paciente.php';
                  });
              </script>
              </body></html>";
    }
} catch (Exception $e) {
    $conn->rollBack();
    echo "<html><head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          </head><body>
          <script>
              Swal.fire({
                  title: 'Error',
                  text: 'Error al actualizar los datos del paciente: " . addslashes($e->getMessage()) . "',
                  icon: 'error',
                  confirmButtonText: 'Aceptar'
              }).then(() => {
                  window.location.href = '../views/empleado.php';
              });
          </script>
          </body></html>";
}
?>
