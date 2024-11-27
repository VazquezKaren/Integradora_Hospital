<?php

include_once '../config.php';

if (isset($_POST['idIngreso'])) {
    $idIngreso = $_POST['idIngreso'];

    if (empty($idIngreso)) {
        echo "<html><head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              </head><body>
              <script>
                  Swal.fire({
                      title: 'Error',
                      text: 'No se ha podido eliminar el ingreso',
                      icon: 'error',
                      confirmButtonText: 'Aceptar'
                  }).then(() => {
                      window.location.href = '../views/ingresos.php';
                  });
              </script>
              </body></html>";
        exit();
    } else {
        try {
            $conn = new conn();
            $pdo = $conn->connect();

            $sql = "DELETE FROM ingresos WHERE idIngreso = :idIngreso";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['idIngreso' => $idIngreso]);

            echo "<html><head>
                    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                  </head><body>
                  <script>
                      Swal.fire({
                          title: 'Éxito',
                          text: 'Se ha eliminado con éxito el ingreso',
                          icon: 'success',
                          confirmButtonText: 'Aceptar'
                      }).then(() => {
                          window.location.href = '../views/ingresos.php';
                      });
                  </script>
                  </body></html>";

        } catch (Exception $th) {
            echo "<html><head>
                    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                  </head><body>
                  <script>
                      Swal.fire({
                          title: 'Error',
                          text: 'Error en la conexión: " . addslashes($th->getMessage()) . "',
                          icon: 'error',
                          confirmButtonText: 'Aceptar'
                      }).then(() => {
                          window.location.href = '../views/ingresos.php';
                      });
                  </script>
                  </body></html>";
        }
    }
}
?>
