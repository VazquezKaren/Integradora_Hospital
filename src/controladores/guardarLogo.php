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
                echo "<script>alert('Logo guardado con éxito'); window.location.href = '../views/configuracion.php';</script>";
            } else {
                echo "<script>alert('Error al guardar el logo'); window.location.href = '../views/configuracion.php';</script>";
            }
        } else {
            echo "<script>alert('Tipo de archivo no permitido'); window.location.href = '../views/configuracion.php';</script>";
        }
    } else {
        echo "<script>alert('Error al subir el archivo'); window.location.href = '../views/configuracion.php';</script>";
    }
}
?>
