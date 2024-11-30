<?php
$logoPath = '../uploads/logo.png';
if (file_exists($logoPath)) {
    unlink($logoPath);
    echo "<html><head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              </head><body>
              <script>
        Swal.fire({
            title: 'Logo eliminado con éxito',
            text: 'El logo ha sido eliminado correctamente.',
            icon: 'success',
            confirmButtonText: 'Aceptar'
        }).then(() => {
            window.location.href = '../views/configuracion.php';
        });
    </script>";
} else {
    echo "<html><head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              </head><body>
              <script>
        Swal.fire({
            title: 'No hay un logo para eliminar',
            text: 'Actualmente no existe un logo en el sistema para eliminar.',
            icon: 'warning',
            confirmButtonText: 'Aceptar'
        }).then(() => {
            window.location.href = '../views/configuracion.php';
        });
    </script>";
}
?>
