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
                        title: 'Logo guardado con éxito',
                        text: 'El logo se ha guardado correctamente.',
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
                        title: 'Error al guardar el logo',
                        text: 'Hubo un problema al guardar el logo en el servidor.',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    }).then(() => {
                        window.location.href = '../views/configuracion.php';
                    });
                </script>";
            }
        } else {
            echo "<html><head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              </head><body>
              <script>
                Swal.fire({
                    title: 'Tipo de archivo no permitido',
                    text: 'Por favor, sube una imagen en formato JPEG, PNG o GIF.',
                    icon: 'warning',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    window.location.href = '../views/configuracion.php';
                });
            </script>";
        }
    } else {
        echo "<html><head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              </head><body>
              <script>
            Swal.fire({
                title: 'Error al subir el archivo',
                text: 'Hubo un error al intentar subir el archivo. Inténtalo nuevamente.',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            }).then(() => {
                window.location.href = '../views/configuracion.php';
            });
        </script>";
    }
}
?>
