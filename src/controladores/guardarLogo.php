<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['logo'])) {
    $logo = $_FILES['logo'];
    $uploadDir = '../uploads/';
    $uploadFile = $uploadDir . 'logo.png';

    // Verificar que se subió un archivo
    if ($logo['error'] === UPLOAD_ERR_OK) {
        // Validar tipo de archivo
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($logo['type'], $allowedTypes)) {
            // Mover el archivo al directorio
            if (move_uploaded_file($logo['tmp_name'], $uploadFile)) {
                echo "<html><head>
                        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                      </head><body>
                      <script>
                          Swal.fire({
                              title: 'Éxito',
                              text: 'Logo guardado con éxito',
                              icon: 'success',
                              confirmButtonText: 'Aceptar'
                          }).then(() => {
                              window.location.href = '../views/configuracion.php';
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
                              text: 'Error al guardar el logo',
                              icon: 'error',
                              confirmButtonText: 'Aceptar'
                          }).then(() => {
                              window.location.href = '../views/configuracion.php';
                          });
                      </script>
                      </body></html>";
            }
        } else {
            echo "<html><head>
                    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                  </head><body>
                  <script>
                      Swal.fire({
                          title: 'Error',
                          text: 'Tipo de archivo no permitido',
                          icon: 'error',
                          confirmButtonText: 'Aceptar'
                      }).then(() => {
                          window.location.href = '../views/configuracion.php';
                      });
                  </script>
                  </body></html>";
        }
    } else {
        echo "<html><head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              </head><body>
              <script>
                  Swal.fire({
                      title: 'Error',
                      text: 'Error al subir el archivo',
                      icon: 'error',
                      confirmButtonText: 'Aceptar'
                  }).then(() => {
                      window.location.href = '../views/configuracion.php';
                  });
              </script>
              </body></html>";
    }
}
?>
