<?php
$logoPath = '../uploads/logo.png';
if (file_exists($logoPath)) {
    unlink($logoPath);
    echo "<html><head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          </head><body>
          <script>
              Swal.fire({
                  title: 'Éxito',
                  text: 'Logo eliminado con éxito',
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
                  text: 'No hay un logo para eliminar',
                  icon: 'error',
                  confirmButtonText: 'Aceptar'
              }).then(() => {
                  window.location.href = '../views/configuracion.php';
              });
          </script>
          </body></html>";
}
?>
